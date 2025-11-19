<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function getNotifications()
    {
        $user = Auth::user();
        $notifications = Notification::with('document')->where(function ($query) use ($user) {
            // 1. Show notifications explicitly routed to this user
            $query->where('routed_to', $user->id)

                // 2. OR notifications that are not routed to anyone
                ->orWhere(function ($sub) use ($user) {
                    $sub->whereNull('routed_to')
                        ->where('destination_office', $user->office->office_name);
                });
        })
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($user);
        return response()->json($notifications);
    }

    public function stream()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403); // prevent unauthorized access
        }

        return response()->stream(function () use ($user) {
            while (true) {
                $notifications = Notification::where(function ($query) use ($user) {
                    $query->where('routed_to', $user->id)
                        ->orWhere(function ($sub) use ($user) {
                            $sub->whereNull('routed_to')
                                ->where('destination_office', $user->office->office_name);
                        });
                })
                    ->with('document')
                    ->orderBy('created_at', 'desc')
                    ->get();

                echo "data: " . json_encode($notifications) . "\n\n";
                ob_flush();
                flush();

                sleep(3);
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no'
        ]);
    }


    public function markRead(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $user = Auth::user();

        Notification::whereIn('id', $request->ids)
            ->where(function ($query) use ($user) {
                // Only mark notifications that belong to this user or are unassigned (routed_to null)
                $query->where('routed_to', $user->id)
                    ->orWhere(function ($sub) use ($user) {
                        $sub->whereNull('routed_to')
                            ->where('destination_office', $user->office->office_name);
                    });
            })
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
