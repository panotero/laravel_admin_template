<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NavMenu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MenusController extends Controller
{
    //
    // ✅ Get all menus
    public function index()
    {
        $user = Auth::user();

        Log::info('Authenticated user:', [
            'id' => $user->id,
            'email' => $user->email,
            'role' => $user->role, // should show "superadmin"
        ]);

        // Filter menus by allowed_roles and reset array keys
        $menus = NavMenu::all()->filter(function ($menu) use ($user) {
            $allowedRoles = json_decode($menu->allowed_roles, true) ?? [];
            return in_array($user->role, $allowedRoles);
        })->values(); // 🔑 important: reset keys

        return response()->json($menus);
    }

    public function menulist()
    {
        return response()->json(NavMenu::all());
    }

    public function store(Request $request)
    {
        Log::info('STORE request received', [
            'payload' => $request->all()
        ]);

        try {
            $data = $request->validate([
                'title' => 'required|string',
                'icon' => 'nullable|string',
                'link' => 'nullable|string',
                'allowed_roles' => 'nullable',
                'parent_menu' => 'nullable|integer',
            ]);

            $menu = NavMenu::create($data);

            Log::info('STORE success', ['menu' => $menu]);

            return response()->json([
                'success' => true,
                'message' => 'Menu created successfully',
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            Log::error('STORE error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('UPDATE request received', [
            'id' => $id,
            'payload' => $request->all()
        ]);

        try {
            $menu = NavMenu::findOrFail($id);

            $data = $request->validate([
                'title' => 'required|string',
                'icon' => 'nullable|string',
                'link' => 'nullable|string',
                'allowed_roles' => 'nullable',
                'parent_menu' => 'nullable|integer',
            ]);

            $menu->update($data);

            Log::info('UPDATE success', ['updated_menu' => $menu]);

            return response()->json([
                'success' => true,
                'message' => 'Menu updated successfully',
                'data' => $menu
            ]);
        } catch (\Exception $e) {
            Log::error('UPDATE error', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        Log::info('DELETE request received', ['id' => $id]);

        try {
            $menu = NavMenu::findOrFail($id);
            $menu->delete();

            Log::info('DELETE success', ['id' => $id]);

            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('DELETE error', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
