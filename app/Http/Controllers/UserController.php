<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    // UserController.php
    public function index()
    {
        return response()->json(User::all());
    }

    public function create()
    {

        return view('users.create');
    }

    public function show($id)
    {
        try {
            $user = User::with('office', 'userConfig')->findOrFail($id);

            return response()->json($user, 200);
        } catch (\Exception $e) {
            Log::error('Failed to fetch user', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    /**
     * Deactivate a user by ID
     */
    public function deactivate($id)
    {
        try {
            $user = User::findOrFail($id);

            // Update status to deactivated
            $user->status = 'deactivated';
            $user->save();

            Log::info('User deactivated successfully', ['id' => $id]);

            return response()->json(['message' => 'User deactivated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to deactivate user', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json(['error' => 'Failed to deactivate user.'], 500);
        }
    }

    public function reactivate($id)
    {

        try {
            $user = User::findOrFail($id);

            // Update status to deactivated
            $user->status = 'active';
            $user->save();

            Log::info('User deactivated successfully', ['id' => $id]);

            return response()->json(['message' => 'User deactivated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to deactivate user', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json(['error' => 'Failed to deactivate user.'], 500);
        }
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string',
            'office_id' => 'nullable|integer',
            'role_id' => 'nullable|integer',
        ]);

        try {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'] ?? null,
                'office_id' => $validated['office_id'] ?? null,
                'role_id' => $validated['role_id'] ?? null,
                'status' => 'active', // default active
            ]);

            Log::info('User created successfully', ['user_id' => $user->id]);

            return response()->json($user, 201);
        } catch (\Exception $e) {
            Log::error('Failed to create user', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return response()->json([
                'error' => 'Failed to create user.'
            ], 500);
        }
    }
}
