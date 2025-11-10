<?php

namespace App\Http\Controllers;

use App\Models\Employeer;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeerController extends Controller
{
    public function index()
    {
        $employers = Employeer::with(['user','offers'])->get();
        $offers = Offer::all();
        return view('tables.employers', compact('employers','offers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
            'location' => ['required'],
            'field' => ['required'],
        ]);

        return Employeer::create($data);
    }

    public function show(Employeer $employeer)
    {
        return $employeer;
    }

    public function update(Request $request, Employeer $employeer)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
            'location' => ['required'],
            'field' => ['required'],
        ]);

        $employeer->update($data);

        return $employeer;
    }

    public function destroy(Employeer $employeer)
    {
        $employeer->delete();

        return response()->json();
    }
}
