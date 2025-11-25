<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    //
    // GET /api/documents
    public function index()
    {
        $documents = Document::with('files', 'activities')->get();
        return response()->json($documents);
    }

    // GET /api/documents/{idOrControlNumber}
    public function show($id)
    {
        $document = Document::with('files', 'activities')
            ->where('document_id', $id)
            ->first();

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        return response()->json($document);
    }

    public function store(Request $request)
    {
        // -------------------------------
        // VALIDATION
        // -------------------------------
        $validator = Validator::make($request->all(), [
            'document_code'        => 'required|string',
            'date_received'        => 'required|date',
            'particular'           => 'required|string',
            'office_origin'        => 'required|string|max:100',
            'destination_office'   => 'nullable|string|max:100',
            'user_id'              => 'required|integer',
            'document_form'        => 'required|string|max:50',
            'document_type'        => 'required|string|max:50',
            'date_of_document'     => 'nullable|date',
            'due_date'             => 'nullable|date',
            'signatory'            => 'required|string|max:100',
            'remarks'              => 'nullable|string',
            'file'                 => 'required|file|mimes:pdf|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        // -------------------------------
        // GENERATE DOCUMENT CONTROL NUMBER
        // -------------------------------
        $today  = Carbon::now()->format('dmY');
        $prefix = "{$today}-";

        $lastDoc = DB::table('documents')
            ->where('document_control_number', 'like', $prefix . '%')
            ->orderByDesc('document_control_number')
            ->first();

        if ($lastDoc) {
            $lastSequence = (int)substr($lastDoc->document_control_number, strlen($prefix));
            $sequence = str_pad($lastSequence + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $sequence = '00001';
        }

        $documentControlNumber = $prefix . $sequence;

        $involved_office = [];

        // Always include origin
        $involved_office[] = $request->office_origin;

        // Only include destination if different from origin
        if ($request->destination_office !== $request->office_origin) {
            $involved_office[] = $request->destination_office;
        }
        // -------------------------------
        // CREATE DOCUMENT RECORD
        // -------------------------------
        $document = Document::create([
            'document_code'           => $request->document_code,
            'document_control_number' => $documentControlNumber,
            'date_received'           => $request->date_received,
            'particular'              => $request->particular,
            'office_origin'           => $request->office_origin,
            'destination_office'      => $request->destination_office,
            'involved_office'         => $involved_office,
            'user_id'                 => $request->user_id,
            'document_form'           => $request->document_form,
            'document_type'           => $request->document_type,
            'date_of_document'        => $request->date_of_document,
            'due_date'                => $request->due_date,
            'signatory'               => $request->signatory,
            'remarks'                 => $request->remarks,
        ]);


        // -------------------------------
        // HANDLE PDF FILE UPLOAD
        // -------------------------------
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $officeFolder = $document->office_origin ?? 'UnknownOffice';

            // Clean filename (remove spaces)
            $cleanOriginal = str_replace(' ', '_', $file->getClientOriginalName());
            $fileName = uniqid() . '-' . $cleanOriginal;

            // Folder path
            $publicPath = public_path("assets/documents/$officeFolder/pdf");

            if (!is_dir($publicPath)) {
                mkdir($publicPath, 0777, true);
            }
            // dd($document->document_id);
            // Save file
            $file->move($publicPath, $fileName);
            // Path stored in DB
            $filePath = "assets/documents/$officeFolder/pdf/$fileName";
            // Insert into files table
            DB::table('files')->insert([
                'document_id'      => $document->document_id,
                'file_name'      => $cleanOriginal,
                'file_path'        => $filePath,
                'file_password'    => null,
                'uploading_office' => $document->office_origin,
                'uploaded_by'      => $document->user_id,
                'uploaded_at'      => now(),
            ]);
        }


        // -------------------------------
        // NOTIFICATION ENTRY
        // -------------------------------
        //get all user id base on office name

        $admin_users = User::with(['userConfig', 'office'])
            ->whereHas('userConfig', function ($q) {
                $q->where('approval_type', 'routing')
                    ->where('status', 'active');
            })
            ->whereHas('office', function ($q) use ($request) {
                $q->where('office_name', $request->destination_office);
            })
            ->get();
        // dd($admin_users);
        foreach ($admin_users as $adminuser) {
            DB::table('notifications')->insert([
                'document_id'        => $document->document_id,
                'office_origin'      => $request->office_origin,
                'destination_office' => $request->destination_office,
                'routed_to'          => $request->routed_to,
                'from_user_id' => $request->user_id,
                'user_id'            => $adminuser->id,
                'message'            => "New document uploaded: {$document->document_code}",
                'is_read'            => 0,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }



        $activityData = [
            'action'                  => 'upload',
            'document_id'             => $document->document_id,
            'final_approval'          => 0,
            'document_control_number' => $documentControlNumber,
            'user_id'                 => $request->user_id,
            'from_user_id' => $request->user_id,
            'routed_to'               => null,
            'final_remarks'           => $validated['remarks'] ?? null,
        ];
        Activity::create($activityData);

        return response()->json([
            'message' => 'Document created successfully ' . $admin_users,
            'data'    => $document,
            'userlist' => $admin_users,
            'docControlNumber' => $documentControlNumber,
        ], 201);
    }






    // PUT/PATCH /api/documents/{id}
    public function update(Request $request, $id)
    {
        $document = Document::find($id);

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $document->update($request->all());
        return response()->json(['message' => 'Document updated successfully', 'data' => $document]);
    }

    // DELETE /api/documents/{id}
    public function destroy($id)
    {
        $document = Document::find($id);

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $document->delete();
        return response()->json(['message' => 'Document deleted successfully']);
    }
}
