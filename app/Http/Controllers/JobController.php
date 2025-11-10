<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

/**
 * JobController handles CRUD operations for Job model.
 */
class JobController extends Controller
{
    /**
     * Display a listing of all jobs.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Job::all();
    }
    public function getJobForm(){

        $jobs = Job::select('title', 'technology')->get();
        $titles = $jobs->pluck('title')->all();
        $technology = $jobs->pluck('technology')->all();

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
        return view('graduate.jobs-form', compact('titles', 'technology', 'jobs', 'graduate'));

       }


       public function updateJobForm($id){
        $job = Job::find($id);
        $jobs = Job::select('title', 'technology')->get();
        $titles = $jobs->pluck('title')->all();
        $technology = $jobs->pluck('technology')->all();

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
        return view('graduate.jobs-form', compact('titles', 'technology', 'jobs', 'graduate', 'job'));

       }


   public function store(Request $request)
{
    # $graduate = Auth::user()->graduate;
    $graduate  = Auth::user()->graduate;



        $messages = [
            'title.required' => 'حقل عنوان الوظيفة مطلوب.',
            'company_name.required' => 'حقل الشركة مطلوب.',
            'location.required' => 'حقل الموقع مطلوب.',
            'field_of_work.required' => 'حقل المجال الوظيفي مطلوب.',
            'technology.required' => 'حقل التقنية مطلوب.',
            'start_date.required' => 'حقل تاريخ البدء مطلوب.',
            'start_date.date' => 'يجب أن يكون تاريخ البدء تاريخًا صالحًا.',
            'end_datetime.date' => 'يجب أن يكون تاريخ الانتهاء تاريخًا صالحًا.',
        ];

        $request->validate([
            'title' => 'required|string',
            'company_name' => 'required|string',
            'location' => 'required|string',
            'field_of_work' => 'required|string',
            'technology' => 'required|string',
            'start_date' => 'required|date',
            'end_datetime' => 'required|date',
        ], $messages);

        $job = Job::create([
            'title' => $request->title,
            'compony' => $request->company_name,
            'location' => $request->location,
            'field_of_work' => $request->field_of_work,
            'technology' => $request->technology,

        ]);

        // Then manually attach to the graduate
        $graduate->jobs()->attach($job->id, [
            'start_date' => $request->start_date,  // Static date for testing
            'end_date' => $request->end_datetime,
        ]);





    return redirect()->back()->with('success', 'تم إضافة الوظيفة بنجاح.');
}


    public function show(Job $job)
    {
        return $job;
    }

    public function update(Request $request,  $id)
    {

        $job = Job::find($id);

        $messages = [
            'title.required' => 'حقل عنوان الوظيفة مطلوب.',
            'company_name.required' => 'حقل الشركة مطلوب.',
            'location.required' => 'حقل الموقع مطلوب.',
            'field_of_work.required' => 'حقل المجال الوظيفي مطلوب.',
            'technology.required' => 'حقل التقنية مطلوب.',
            'start_date.required' => 'حقل تاريخ البدء مطلوب.',
            'start_date.date' => 'يجب أن يكون تاريخ البدء تاريخًا صالحًا.',
            'end_date.date' => 'يجب أن يكون تاريخ الانتهاء تاريخًا صالحًا.',
        ];
        $data = $request->validate([
            'title' => 'required|string',
            'company_name' => 'required|string',
            'location' => 'string',
            'field_of_work' => 'required|string',
            'technology' => 'required|string',
        ], $messages);
        $o= $job->update([
           "title" => $request->title,
            "company" => $request->company_name,
            "location" => $request->location,
            "field_of_work" => $request->field_of_work,
            "technology" => $request->technology,
        ]);

        return redirect()->route('job.job-form')->with('success', 'تم تحديث الوظيفة بنجاح.');
    }

    public function destroy( $id)
    {
        $job = Job::find($id);


        $job->delete();

        return redirect()->back()->with('success', 'تم حذف الوظيفة بنجاح.');
    }
}
