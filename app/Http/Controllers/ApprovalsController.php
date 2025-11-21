<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approvals;
use Illuminate\Support\Facades\Auth;

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
}
