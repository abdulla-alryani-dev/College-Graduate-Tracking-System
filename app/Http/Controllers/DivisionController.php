<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Graduate;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::with('user')->get();
        return view('tables.division', compact('divisions'));

    }
    public function create()
    {
         $users = DB::table('users')
         ->join('role_user', 'users.id', '=', 'role_user.user_id')
         ->join('roles', 'roles.id', '=', 'role_user.role_id')
         ->where('roles.name', 'supervisor')->select('users.*')
         ->get();
        return view('divisions.create', compact('users'));

    }
    public function edit($id)
{
    $division = Division::findOrFail($id);
    $users = DB::table('users')
    ->join('role_user', 'users.id', '=', 'role_user.user_id')
    ->join('roles', 'roles.id', '=', 'role_user.role_id')
    ->where('roles.name', 'supervisor')->select('users.*')
    ->get();
    return view('divisions.edit', compact('division', 'users'));
}

    public function showDivisions()
    {
        $user = Auth::user();

        $activeDivisions = $user->divisions()
        ->active()
        ->get();
        return view('supervisor.divisions', compact('activeDivisions'));
    }

    public function showChats()
    {

        $activeDivisions = Division::where('active', true)->with('user')->get();
        return view('graduate.chats', compact('activeDivisions'));
    }
    public function showChat($id){
        $user = Auth::user();

        $inquiries = $user->graduate->inquiries()
                ->where('division_id', $id)  // Replace $divisionId with the actual division id
                ->orderBy('created_at', 'asc')
                ->get();

       $division = Division::find($id);
       $activeDivisions = Division::where('active', true, )->with('user')->get();

        return view('graduate.chat-room', compact('division', 'activeDivisions', 'inquiries'));
    }

    public function showGraduates($id)
    {
        $divisionId = $id;
        $graduates = Graduate::with(['user', 'universityData'], )->get();


        return view('supervisor.graduates-message', compact('divisionId', 'graduates'));
    }
    public function showGraduatesChatRoom($div, $grad)
    {
        $division = Division::find($div);
        $graduate = Graduate::find($grad);
        $inquiries = Inquiry::where('graduate_id', $graduate->id)
        ->where('division_id', $division->id)
        ->with(['graduate', 'division'])
        ->get();

        return view('supervisor.chat-room', compact('division', 'graduate', 'inquiries'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'room' => 'required|string|max:255',
            'active' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        Division::create($validated);

        return redirect()->route('divisions.index')->with('success', 'Division تمت إضافتها بنجاح.');
    }

    public function toggleStatus($id)
{
    $division = Division::findOrFail($id);
    $division->active = !$division->active;
    $division->save();

    return redirect()->back()->with('success', 'تم تحديث حالة القسم بنجاح.');
}


    public function show($id)
    {
        $division = Division::with('user')->findOrFail($id);
        return view('divisions.show', compact('division'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'room' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $division = Division::findOrFail($id);
        $division->title = $request->title;
        $division->description = $request->description;
        $division->room = $request->room;
        $division->user_id = $request->user_id;
        $division->active = $request->has('active');
        $division->save();

        return redirect()->route('divisions.index')->with('success', 'تم تحديث القسم بنجاح.');
    }


    public function destroy(Division $division)
    {
        $division->delete();

        return response()->json();
    }
}
