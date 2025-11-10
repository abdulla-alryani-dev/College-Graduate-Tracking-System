<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display users with their roles and all roles.
     */
    public function index()
    {
        // Fetch all users with their roles
        $users = User::with('roles')->get();

        // Fetch all available roles
        $allRoles = Role::all();

        // Pass data to the index blade view
        return view('user.index', compact('users', 'allRoles'));
    }

    /**
     * Assign roles to a user.
     */
    public function assignRole(Request $request, $userId)
    {

        // Find the user by ID
        $user = User::findOrFail($userId);

        // Validate the roles input
        $request->validate([
            'roles' => 'required|array', // Roles must be an array
            'roles.*' => 'exists:roles,id', // Ensure each role exists in the roles table
        ]);

        // Sync the roles for the user (update pivot table)
        $user->roles()->sync($request->roles);

        // Redirect back to the users index with a success message
        return redirect()->route('users.index')->with('success', 'تم تحديث الأدوار بنجاح.');
    }
    /**
     * Destroy (delete) a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back to the users index
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


}
