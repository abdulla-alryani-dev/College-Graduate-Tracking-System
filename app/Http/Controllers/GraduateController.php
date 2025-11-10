<?php

namespace App\Http\Controllers;

use App\Http\Requests\GraduateRequest;
use App\Http\Resources\GraduateResource;
use App\Models\Graduate;
use App\Models\Job;
use App\Models\UniversityData;

class GraduateController extends Controller
{

    public function index()
    {

        $graduates = Graduate::with(['user', 'universityData'], )->get();

        return view('tables.graduates',  compact('graduates'));
    }
    public function showGraduateInfo($id)
    {
        $graduate = Graduate::find($id);
        $graduate->load([
            'user',
            'universityData',
            'skills',
            'courses',
            'jobs' => function ($query) {
                $query->orderBy('pivot_start_date', 'desc');
            },
            'story'
        ]);

        return view('graduate.graduate-info',  compact('graduate'));
    }



    public function store(GraduateRequest $request)
    {
        return new GraduateResource(Graduate::create($request->validated()));
    }
    public function getInfoForms()
    {
        return  view('graduate.info-forms');
    }


    public function show($graduate_Id)
    {

        $graduate = Graduate::with(['courses', 'jobs', 'skills', 'universityData'])->find($graduate_Id);

        return view('graduate.graduate-info', compact('graduate'));
    }

    public function update(GraduateRequest $request, Graduate $graduate)
    {
        $graduate->update($request->validated());

        return new GraduateResource($graduate);
    }

    public function destroy(Graduate $graduate)
    {
        $graduate->delete();

        return response()->json();
    }
}
