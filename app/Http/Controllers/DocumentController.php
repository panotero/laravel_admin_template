<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        $validator = Validator::make($request->all(), [
            'document_code' => 'required|string',
            'date_received'           => 'required|date',
            'particular'              => 'required|string',
            'office_origin'           => 'required|string|max:100',
            'destination_office'      => 'nullable|string|max:100',
            'user_id'                 => 'required|integer',
            'document_form'           => 'required|string|max:50',
            'document_type'           => 'required|string|max:50',
            'date_of_document'        => 'nullable|date',
            'due_date'                => 'nullable|date',
            'signatory'               => 'required|string|max:100',
            'remarks'                 => 'nullable|string',
            'file'                    => 'required|file|mimes:pdf|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2️⃣ Generate document_control_number
        $today = Carbon::now()->format('dmY'); // e.g., 14112025
        $prefix = "0101{$today}-";

        // Get last control number for today
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

        // 3️⃣ Upload PDF to office folder
        $userOffice = $request->office_origin ?? 'UnknownOffice';
        $file = $request->file('file');
        $uploadPath = "uploads/documents/{$userOffice}";
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($uploadPath, $fileName, 'public'); // stored in storage/app/public


        // -------------------------------
        // CREATE DOCUMENT
        // -------------------------------
        $document = Document::create([
            'document_code'          => $request->input('document_code'),
            'document_control_number' => $documentControlNumber,
            'date_received'          => $request->input('date_received'),
            'particular'             => $request->input('particular'),
            'office_origin'          => $request->input('office_origin'),
            'destination_office'     => $request->input('destination_office'),
            'user_id'                => $request->input('user_id'),
            'document_form'          => $request->input('document_form'),
            'document_type'          => $request->input('document_type'),
            'date_of_document'       => $request->input('date_of_document'),
            'due_date'               => $request->input('due_date'),
            'signatory'              => $request->input('signatory'),
            'remarks'                => $request->input('remarks'),
        ]);


        // -------------------------------
        // HANDLE PDF FILE
        // -------------------------------
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $officeFolder = $document->office_origin ?: 'general';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $filePath = $file->storeAs("uploads/documents/$officeFolder", $fileName, 'public');

            // Insert into files table
            DB::table('files')->insert([
                'document_id'    => $document->id, // Make sure this exists!
                'file_path'      => $filePath,
                'file_password'  => null, // or generate password if needed
                'uploading_office' => $document->office_origin,
                'uploaded_by'    => $document->user_id,
                'uploaded_at'    => now(),
            ]);
        }

        // 6️⃣ Insert into notifications table (optional fields nullable)
        DB::table('notifications')->insert([
            'document_id'       => $document->id,
            'office_origin'     => $request->office_origin,
            'destination_office' => $request->destination_office,
            'routed_to'         => $request->routed_to,
            'user_id'           => $request->user_id,
            'message'           => "New document uploaded: {$document->document_code}",
            'is_read'           => 0,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return response()->json(['message' => 'Document created successfully', 'data' => $document], 201);
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
