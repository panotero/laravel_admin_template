<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Activity;
use App\Models\Notification;
use App\Models\Approvals;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class RoutingController extends Controller
{
    public function routeDocument(Request $request)
    {
        try {

            $user = Auth::user();
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
            }

            // Validate request fields (file NOT in validation yet)
            $validated = $request->validate([
                'document_id'        => 'required|integer',
                'destination_office' => 'required|string',
                'recipient_user_id'  => 'nullable|integer',
                'approval_type'      => 'nullable|string',
                'status'             => 'nullable|string',
                'remarks'            => 'nullable|string',
            ]);



            // Load document
            $document = Document::findOrFail($validated['document_id']);

            $originOffice      = $document->office_origin;
            $destinationOffice = $validated['destination_office'];
            $recipientUserId   = $validated['recipient_user_id'] ?? null;
            $sameOffice        = ($destinationOffice === $user->office->office_name);
            $backToOrigin      = ($destinationOffice === $originOffice);

            //
            // 1. Build Activity Payload
            //
            $activityData = [
                'action'                  => 'route',
                'document_id'             => $document->document_id,
                'final_approval'          => $sameOffice ? ($destinationOffice === $originOffice ? 1 : 0) : ($backToOrigin ? 1 : 1),
                'document_control_number' => $document->document_control_number,
                'user_id'                 => $user->id,
                'from_user_id' => $user->id,
                'routed_to'               => $recipientUserId,
                'final_remarks'           => $validated['remarks'] ?? null,
            ];

            // If routing outside user's office, mark external
            if (!$sameOffice) {
                $activityData['to_external'] = 1;

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
                        'office_origin'      => $originOffice,
                        'destination_office' => $destinationOffice,
                        'from_user_id' => $user->id,
                        'user_id'            => $adminuser->id,
                        'message'            => "$document->document_control_number has been routed to $destinationOffice by  $user->name",
                        'is_read'            => 0,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ]);
                }

                //insert the file and save to files table

                // -------------------------------
                // HANDLE PDF FILE UPLOAD
                // -------------------------------
                if ($request->hasFile('pdf_file') && $request->file('pdf_file')->isValid()) {

                    $file = $request->file('pdf_file');

                    // Office folder name (fallback if null)
                    $officeFolder = $document->office_origin ?: 'UnknownOffice';

                    // Clean file name (remove spaces)
                    $cleanOriginal = str_replace(' ', '_', $file->getClientOriginalName());

                    // Add unique ID to avoid filename conflicts
                    $fileName = uniqid() . '-' . $cleanOriginal;

                    // Folder path
                    $publicPath = public_path("assets/documents/{$officeFolder}/pdf");

                    // Create directory if not existing
                    if (!is_dir($publicPath)) {
                        mkdir($publicPath, 0777, true);
                    }

                    // Move the file to the folder
                    $file->move($publicPath, $fileName);

                    // Relative path saved in DB
                    $filePath = "assets/documents/{$officeFolder}/pdf/{$fileName}";

                    // Save file record in files table
                    DB::table('files')->insert([
                        'document_id'      => $document->document_id,
                        'file_name'        => $cleanOriginal,
                        'file_path'        => $filePath,
                        'file_password'    => null,
                        'uploading_office' => $destinationOffice,
                        'uploaded_by'      => $user->id,
                        'uploaded_at'      => now(),
                    ]);

                    DB::table('documents')
                        ->where('document_id', $document->document_id)
                        ->update([
                            'recipient_id' => null,
                            'receipt_confirmation' => 0,
                            'receipt_confirmed_by' => 0,
                            'date_forwarded' => now(),
                        ]);
                } else {
                    return "no pdf available";
                }
            } else {


                DB::table('notifications')->insert([
                    'document_id'        => $document->document_id,
                    'office_origin'      => $originOffice,
                    'destination_office' => $destinationOffice,
                    'from_user_id' => $user->id,
                    'user_id'            => $recipientUserId,
                    'message'            => "$document->document_control_number has been routed you by  $user->name for approval",
                    'is_read'            => 0,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
                DB::table('documents')
                    ->where('document_id', $document->document_id)
                    ->update(['status' => 'For Approval', 'date_forwarded' => now(),]);
                DB::table('approval_table')
                    ->where('user_id', $user->id)
                    ->update(['status' => 1]);
                //create approval rows
                Approvals::create([
                    'document_id' => $document->document_id,
                    'user_id' => $recipientUserId,
                    'approval_type' => $validated['approval_type'],

                    'remarks' => $validated['remarks'],
                    'status' => 0,
                ]);
            }

            Activity::create($activityData);


            //
            // 3. Update Document
            //
            $document->update([
                'destination_office' => $destinationOffice,
                'recipient_id'       => $recipientUserId,
            ]);

            //
            // 4. Final Response Message
            //
            if ($sameOffice) {
                return response()->json([
                    'status'  => 'success',
                    'message' => "routing to internal office",
                ]);
            }

            if ($backToOrigin) {
                return response()->json([
                    'status'  => 'success',
                    'message' => "routing to origin office",
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'message' => "routing to external office",
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status'  => 'error',
                'message' => "Error on routing: {$e->getMessage()}",
            ]);
        }
    }
}
