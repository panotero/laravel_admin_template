<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approvals;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Document;

class ApprovalsController extends Controller
{
    /**
     * Get all approvals assigned to the logged-in user
     */
    public function getMyApprovals()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // Fetch approvals where user_id = auth()->id()
        $approvals = Approvals::with('document')
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'approvals' => $approvals
        ]);
    }

    public function handleApprovalAction(Request $request, $document_id)
    {
        $user = User::with('office', 'userConfig')->find(Auth::id());
        // dd($user->office->office_name);
        $currentOffice = $user->office->office_name;
        // $post = $request->validate([
        //     'approval_id'   => 'required|integer|exists:approvals,id',
        //     'action'        => 'required|in:approve,disapprove,remand',
        //     'next_user_id'  => 'nullable|integer|exists:users,id', // required only if pre-approval
        //     'remarks'       => 'nullable|string|max:500',          // required only if final-approval
        // ]);

        $action = $request->input('action');

        // Process logic here
        // Example:
        $approval = Approvals::with('document')
            ->where('document_id', $document_id)
            ->where('status', 0)
            ->firstOrFail();
        switch ($action) {
            case 'approved':
                $approval->remarks = 'Approved';
                //check the next acction
                $next_action = $request->input('next_action');
                if ($next_action === "pre-approval") {
                    Approvals::create([
                        'document_id'   => $approval->document->document_id,
                        'user_id'  => $request->next_user_id,
                        'status'        => 0,
                        'remarks'       => $request->remarks,
                        'approval_type' => $request->next_action,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                } else if ($next_action === "final-approval") {

                    //get final approver from based on the office
                    $finalApprover = User::with('userConfig', 'office')
                        ->whereHas('userConfig', function ($query) use ($next_action) {
                            $query->where('approval_type', $next_action);
                        })
                        ->whereHas('office', function ($query) use ($currentOffice) {
                            $query->where('office_name', $currentOffice);
                        })
                        ->get();


                    $approverID = $finalApprover[0]->id;
                    //create new row on approval and route it to final approver's ID
                    Approvals::create([
                        'document_id'   => $approval->document->document_id,
                        'user_id'  => $approverID,
                        'status'        => 0,
                        'remarks'       => $request->remarks,
                        'approval_type' => $request->next_action,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);

                    //create notification

                    DB::table('notifications')->insert([
                        'document_id'        => $approval->document->document_id,
                        'office_origin'      => $user->office->office_name,
                        'destination_office' => $user->office->office_name,
                        'from_user_id' => $user->id,
                        'user_id'            => $approverID,
                        'message'            => "{$approval->document->document_control_number} has been approved by $user->name",
                        'is_read'            => 0,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ]);

                    //update the document info to recipient id to final approve'rs id
                    Document::where('document_id', $approval->document->document_id)
                        ->update([
                            'recipient_id' => $approverID,
                        ]);
                    //update the previous approval id status to 1
                    // dd($finalApprover[0]->id);
                }
                // dd($request->all());
                //update the current approval id to 1
                Approvals::where('id', $approval->id)
                    ->update([
                        'status' => 1,
                        'updated_at' => now(),
                    ]);

                break;

            case 'disapproved':
                $approval->status = 'Disapproved';
                break;

            case 'remand':
                $approval->status = 'Remanded';
                break;
        }

        $approval->save();

        return response()->json([
            'message' => 'Action completed successfully.',
            'status'  => $approval->status,
        ]);
    }
}
