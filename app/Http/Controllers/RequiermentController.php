<?php

namespace App\Http\Controllers;

use App\Models\Requierment;
use Illuminate\Http\Request;

class RequiermentController extends Controller
{
    public function index()
    {
        return Requierment::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'technology' => ['required'],
            'offers_id' => ['required', 'exists:offers'],
        ]);

        return Requierment::create($data);
    }

    public function show(Requierment $requierment)
    {
        return $requierment;
    }

    public function update(Request $request, Requierment $requierment)
    {
        $data = $request->validate([
            'technology' => ['required'],
            'offers_id' => ['required', 'exists:offers'],
        ]);

        $requierment->update($data);

        return $requierment;
    }

    public function destroy(Requierment $requierment)
    {
        $requierment->delete();

        return response()->json();
    }
}
