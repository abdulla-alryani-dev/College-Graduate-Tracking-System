<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function getSkillForm(){
        $graduate = auth()->user()->graduate;
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

        return view('graduate.skills-form', compact('graduate'));

       }

    public function updateSkillForm($id){
        $graduate = auth()->user()->graduate;
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
        $skill = Skill::find($id);
        return view('graduate.skills-form', compact('skill', 'graduate'));

       }


       public function store(Request $request)
       {
           $messages = [
               'title.required' => 'حقل العنوان مطلوب.',
               'technology.required' => 'حقل التقنية مطلوب.',
               'accomplishment.required' => 'حقل الإنجاز مطلوب.',
           ];

           $data = $request->validate([
               'title' => 'required|string',
               'technology' => 'required|string',
               'accomplishment' => 'required|string',
           ], $messages);

           // Get the authenticated graduate
           $graduate = Auth::user()->graduate;


           // Create a new skill
           $skill = Skill::create([
                'title' => $request->title,
               'technology' => $request->technology,
               'accomplishment' => $request->accomplishment,
               'graduate_id' => $graduate->id

           ]);

           // Attach skill to the graduate
           $graduate->skills()->attach($skill->id);

           return redirect()->back()->with('success', 'تمت إضافة المهارة بنجاح.');
       }
    public function show(Skill $skill)
    {
        return $skill;
    }

    public function update(Request $request,  $id)
    {
        $skill = Skill::find($id);

            $messages = [
                'title.required' => 'حقل العنوان مطلوب.',
                'technology.required' => 'حقل التقنية مطلوب.',
                'accomplishment.required' => 'حقل الإنجاز مطلوب.',
                ];

         $data = $request->validate([
                'title' => 'required|string',
                'technology' => 'required|string',
                'accomplishment' => 'required|string',
           ], $messages);

        $skill->update($data);

        return redirect()->back()->with('success', 'تمت تحديث المهارة بنجاح.');

    }
    public function destroy( $id)
    {
        $skill = Skill::find($id);


        $skill->delete();

        return redirect()->back()->with('success', 'تم حذف المهارة بنجاح.');
    }
}
