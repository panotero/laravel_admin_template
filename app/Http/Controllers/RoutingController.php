<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Activity;
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

            if ($request->destination_id === $user->office->office_name) {
                Activity::create([
                    'action' => 'route',
                    'document_id' => $document->document_id,
                    'final_approval' => ($destinationOffice === $originOffice) ? 1 : 0,
                    'document_control_number' => $document->document_control_number,
                    'user_id' => $user->id,
                    'routed_to' => $recipientUserId,
                    'final_remarks' => $request->remarks,
                ]);
            } else {
            }
        } catch (Exception $message) {
            \Log::error('An error occured with message:', $message->getMessage());
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
