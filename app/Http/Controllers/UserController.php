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
        // if (auth()->user()->role !== 'superadmin') {
        //     abort(403);
        // }
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {

        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            // 🔒 Auth check first
            // if (!auth()->check() || auth()->user()->role !== 'developer') {
            //     Log::warning('Unauthorized user tried to create a new user.', [
            //         'user_id' => auth()->id(),
            //         'user_email' => auth()->user()->email ?? 'guest'
            //     ]);

            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Unauthorized action.',
            //     ], 403);
            // }

            // ✅ Validation rules
            $validated = $request->validate([
                'name'     => 'required|string|max:255|regex:/^[a-zA-Z\s\.\-]+$/',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role_id'  => 'required|integer|exists:setting_role,id',
                'role'     => 'nullable|string|max:50',
            ]);

            // ✅ Use DB transaction for integrity
            $user = DB::transaction(function () use ($validated) {
                // Fetch role name if not passed (fallback)
                $role = $validated['role'] ?? DB::table('setting_role')->where('id', $validated['role_id'])->value('role_name');

                return User::create([
                    'name'     => trim($validated['name']),
                    'email'    => strtolower($validated['email']),
                    'password' => Hash::make($validated['password']),
                    'role_id'  => (int) $validated['role_id'],
                    'role'     => Str::lower($role ?? 'user'),
                ]);
            });

            // 🧾 Log success
            Log::info('User created successfully.', [
                'created_by' => auth()->user()->email ?? 'unknown',
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
                'data'    => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'created_at' => $user->created_at,
                ],
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed while creating user.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
                'user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Unexpected error while creating user.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
                'user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error.',
                'error'   => config('app.debug') ? $e->getMessage() : 'Something went wrong.',
            ], 500);
        }
    }
}
