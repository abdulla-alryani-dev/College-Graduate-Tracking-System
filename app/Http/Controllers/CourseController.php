<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function getCourseForm(){
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
        return view('graduate.course-form', compact('graduate'));

       }
       public function updateCurseForm($id){
        $course = Course::find($id);
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
        return view('graduate.course-form', compact('course', 'graduate'));

       }


        public function store(Request $request)
    {
        $messages = [
            'title.required' => 'حقل عنوان الدورة مطلوب.',
            'school.required' => 'حقل المؤسسة مطلوب.',
            'duration.required' => 'حقل المدة مطلوب.',
        ];

        $data = $request->validate([
            'title' => ['required', 'string'],
            'school' => ['required', 'string'],
            'duration' => ['required', 'string'],
        ], $messages);

        $graduate = Auth::user()->graduate;

        $course = Course::create($data);

        // Attach the course to the graduate
        $graduate->courses()->attach($course->id);

        return redirect()->back()->with('success', 'تمت إضافة الدورة بنجاح.');
    }


        public function show(Course $course)
        {
            return $course;
        }

        public function update(Request $request,  $id)
        {
            $course = Course::find($id);

            $messages = [
                'title.required' => 'حقل عنوان الدورة مطلوب.',
                'school.required' => 'حقل المؤسسة مطلوب.',
                'duration.required' => 'حقل المدة مطلوب.',
            ];

            $data = $request->validate([
                'title' => ['required', 'string'],
                'school' => ['required', 'string'],
                'duration' => ['required', 'string'],
            ], $messages);


            $course->update($data);

            return redirect()->back()->with('success', 'تمت تحديث الدورة بنجاح.');
        }

        public function destroy( $id)
        {
            $course = Course::find($id);


            $course->delete();

            return redirect()->back()->with('success', 'تم حذف الدورة بنجاح.');
        }
}
