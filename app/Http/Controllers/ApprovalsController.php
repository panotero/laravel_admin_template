<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approvals;
use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                'status'  => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        $approvals = Approvals::with('document')
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status'    => 'success',
            'approvals' => $approvals
        ]);
    }

    /**
     * Process approval actions for a document
     */
    public function handleApprovalAction(Request $request, $document_id)
    {
        $user = User::with(['office', 'userConfig'])->find(Auth::id());

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'action'       => 'required|in:approved,disapproved,remand',
            'next_action'  => 'nullable|in:pre-approval,final-approval',
            'next_user_id' => 'nullable|integer|exists:users,id',
            'remarks'      => 'nullable|string|max:500',
        ]);

        $currentOffice = $user->office->office_name ?? null;

        // Get current approval
        $approval = Approvals::with('document')
            ->where('document_id', $document_id)
            ->where('status', 0)
            ->firstOrFail();

        $action = $validated['action'];

        switch ($action) {
            case 'approved':
                $this->processApproval($approval, $validated, $user, $currentOffice);
                break;

            case 'disapproved':
                $approval->status  = 1;
                $approval->remarks = 'Disapproved';
                break;

            case 'remand':
                $approval->status  = 1;
                $approval->remarks = 'Remanded';
                break;
        }

        $approval->save();

        return response()->json([
            'message' => 'Action completed successfully.',
            'status'  => $approval->status,
        ]);
    }

    /**
     * Handles logic for approval actions
     */
    private function processApproval($approval, $validated, $user, $currentOffice)
    {
        $approval->remarks = 'Approved';

        $nextAction = $validated['next_action'] ?? null;

        if ($nextAction === 'pre-approval') {
            $this->createNextApproval(
                $approval->document->document_id,
                $validated['next_user_id'],
                $validated['remarks'],
                'pre-approval'
            );

            Document::where('document_id', $approval->document->document_id)
                ->update([
                    'recipient_id'   => $validated['next_user_id'],
                    'date_forwarded' => now(),
                ]);
        } elseif ($nextAction === 'final-approval') {
            $finalApprover = $this->getFinalApprover($currentOffice, $nextAction);

            if (!$finalApprover) {
                throw new \Exception("No final approver found.");
            }

            $this->createNextApproval(
                $approval->document->document_id,
                $finalApprover->id,
                $validated['remarks'],
                'final-approval'
            );

            $this->createNotification($approval, $user, $finalApprover->id);

            Document::where('document_id', $approval->document->document_id)
                ->update([
                    'recipient_id'   => $finalApprover->id,
                    'date_forwarded' => now(),
                ]);
        }

        // Mark current approval complete
        $approval->status = 1;
        $approval->updated_at = now();
    }

    /**
     * Gets final approver based on office and approval type
     */
    private function getFinalApprover($office, $approvalType)
    {
        return User::with(['userConfig', 'office'])
            ->whereHas('userConfig', function ($query) use ($approvalType) {
                $query->where('approval_type', $approvalType);
            })
            ->whereHas('office', function ($query) use ($office) {
                $query->where('office_name', $office);
            })
            ->first();
    }

    /**
     * Creates next approval entry
     */
    private function createNextApproval($documentId, $userId, $remarks, $approvalType)
    {
        Approvals::create([
            'document_id'   => $documentId,
            'user_id'       => $userId,
            'status'        => 0,
            'remarks'       => $remarks,
            'approval_type' => $approvalType,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }

    /**
     * Creates notification for final approval routing
     */
    private function createNotification($approval, $user, $destinationUserId)
    {
        DB::table('notifications')->insert([
            'document_id'        => $approval->document->document_id,
            'office_origin'      => $user->office->office_name,
            'destination_office' => $user->office->office_name,
            'from_user_id'       => $user->id,
            'user_id'            => $destinationUserId,
            'message'            => "{$approval->document->document_control_number} has been approved by {$user->name}",
            'is_read'            => 0,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);
    }
}
