<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Division;
class SupervisorController extends Controller
{
    public function index()
    {
        $supervisors = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', 'supervisor')->select('users.*')
            ->get();


            $divisions = Division::all();

        return view('tables.supervisors',  compact('supervisors', 'divisions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'active' => ['boolean'],
        ]);

        return Supervisor::create($data);
    }

    public function updateStatus(Request $request) {
        $supervisor = Supervisor::find($request->user_id);
        if ($supervisor) {
            $supervisor->active = !$supervisor->active;
            $supervisor->save();
        }
        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function show(Supervisor $supervisor)
    {
        return $supervisor;
    }

    public function update(Request $request, Supervisor $supervisor)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'active' => ['boolean'],
        ]);

        $supervisor->update($data);

        return $supervisor;
    }

    public function destroy(Supervisor $supervisor)
    {
        $supervisor->delete();

        return response()->json();
    }
}
