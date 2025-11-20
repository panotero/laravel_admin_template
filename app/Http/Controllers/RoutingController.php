<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Activity;
use App\Models\Notification;
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
            $document = Document::findOrFail($request->document_id);
            $originOffice = $document->office_origin;
            $destinationOffice = $request->destination_office;
            $recipientUserId = $request->recipient_user_id;

            if ($request->destination_office === $user->office->office_name) {
                //create route activity
                Activity::create([
                    'action' => 'route',
                    'document_id' => $document->document_id,
                    'final_approval' => ($destinationOffice === $originOffice) ? 1 : 0,
                    'document_control_number' => $document->document_control_number,
                    'user_id' => $user->id,
                    'routed_to' => $recipientUserId,
                    'final_remarks' => $request->remarks,
                ]);

                //update document information

                //update destination office

                //createnotification of the routing.
                Notification::create([
                    'office_origin' => $user->office->office_name,
                    'destination_office' => $request->destination_office,
                    'routed_to' => $recipientUserId,
                    'document_id' => $document->document_id,
                    'user_id' => $user->id,
                    'message' => 'routed',
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => "routing to internal office",
                ]);
            } else {

                //check if the destination office is equals to document origin office

                if ($request->destination_office === $document->office_origin) {

                    Activity::create([
                        'action' => 'route',
                        'document_id' => $document->document_id,
                        'final_approval' => ($destinationOffice === $originOffice) ? 1 : 0,
                        'to_external' => 1,
                        'document_control_number' => $document->document_control_number,
                        'user_id' => $user->id,
                        'routed_to' => $recipientUserId,
                        'final_remarks' => $request->remarks,
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' => "routing to origin office $request->destination_office === $document->office_origin",
                    ]);
                } else {
                    Activity::create([
                        'action' => 'route',
                        'document_id' => $document->document_id,
                        'final_approval' => 1,
                        'to_external' => 1,
                        'document_control_number' => $document->document_control_number,
                        'user_id' => $user->id,
                        'routed_to' => $recipientUserId,
                        'final_remarks' => $request->remarks,
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' => "routing to external office",
                    ]);
                }
            }
        } catch (Exception $message) {
            return response()->json([
                'status' => 'error',
                'message' => "Error on routing:  $message",
            ]);
        }



        $originOffice = $document->office_origin;
        $destinationOffice = $request->destination_office;
        $recipientUserId = $request->recipient_user_id;
        // dd($request->all());
        // $request->validate([
        //     'document_id' => 'required|exists:documents,document_id',
        //     'destination_office' => 'required|string',
        //     'recipient_user_id' => 'nullable|exists:users,id',
        //     'approval_type' => 'nullable|string',
        //     'status' => 'nullable|string',
        //     'remarks' => 'nullable|string',
        // ]);

        // $user = Auth::user();
        // $document = Document::findOrFail($request->document_id);

        // $originOffice = $document->office_origin;
        // $destinationOffice = $request->destination_office;
        // $recipientUserId = $request->recipient_user_id;

        // // If destination office is same as current user's office (internal routing)
        // if ($destinationOffice === $user->office->office_name) {
        //     // Insert new activity row with routed_to as recipient user
        //     Activity::create([
        //         'action' => 'route',
        //         'document_id' => $document->document_id,
        //         'final_approval' => ($destinationOffice === $originOffice) ? 1 : null,
        //         'document_control_number' => $document->document_control_number,
        //         'user_id' => $user->id,
        //         'routed_to' => $recipientUserId,
        //         'final_remarks' => $request->remarks,
        //     ]);

        //     // Log routing (similar to your frontend logActivity)
        //     // Here you could fire an event or simply return success message
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => "Document routed internally to user ID $recipientUserId",
        //     ]);
        // }

        // // External routing (destination office is different)
        // Activity::create([
        //     'action' => 'route',
        //     'document_id' => $document->document_id,
        //     'final_approval' => ($destinationOffice === $originOffice) ? 1 : null,
        //     'document_control_number' => $document->document_control_number,
        //     'user_id' => $user->id,
        //     'routed_to' => null,
        //     'final_remarks' => $request->remarks,
        // ]);

        // return response()->json([
        //     'status' => 'success',
        //     'message' => "Document routed externally to office $destinationOffice",
        // ]);
    }
}
