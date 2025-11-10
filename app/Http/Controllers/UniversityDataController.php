<?php

namespace App\Http\Controllers;

use App\Models\UniversityData;
use App\Models\Graduate;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Course;

use Illuminate\Http\Request;

class UniversityDataController extends Controller
{
    public function index()
    {
        return UniversityData::all();
    }

    public function showUniversityData()
    {
        $majors = UniversityData::distinct()->pluck('major');
        $universityData = UniversityData::paginate(15);
        $singupGraduates = Graduate::with('universityData', 'user')->get();

        return view('supervisor.university-data', compact('universityData', 'majors', 'singupGraduates'));
    }

    public function getGraduateJobs($id)
    {
        $graduate = Graduate::firstOrCreate(
            ['university_data_id' => $id],
            ['user_id' => null, 'job_status' => false]
        );

        $grad = Graduate::with('jobs')->find($graduate->id);
        $graduate = $grad;
        $jobs = $grad->jobs;
        return view('supervisor.jobs', compact('jobs', 'graduate'));
    }

    public function getGraduateSkills($id)
    {
        $graduate = Graduate::firstOrCreate(
            ['university_data_id' => $id],
            ['user_id' => null, 'job_status' => false]
        );

        $grad = Graduate::with('skills')->find($graduate->id);
        $graduate = $grad;
        $skills = $grad->skills;
        return view('supervisor.skills', compact('skills', 'graduate'));
    }

    public function updateGraduateJobs($job, $graduate)
    {
        $graduate = Graduate::find($graduate);
        $edit_job = Job::find($job);

        if (!$graduate) {
            $graduate = Graduate::create([
                'user_id' => null,
                'university_data_id' => $id,
                'job_status' => false,
            ]);
        }

        $grad = Graduate::with('jobs')->find($graduate->id);
        $graduate = $grad;
        $jobs = $grad->jobs;

        return view('supervisor.jobs', compact('jobs', 'graduate', 'edit_job'));
    }


    public function updateGraduateSkill($skill, $graduate)
    {
        $graduate = Graduate::find($graduate);
        $edit_skill = Skill::find($skill);

        if (!$graduate) {
            $graduate = Graduate::create([
                'user_id' => null,
                'university_data_id' => $id,
                'job_status' => false,
            ]);
        }

        $grad = Graduate::with('skills')->find($graduate->id);
        $graduate = $grad;
        $skills = $grad->skills;
        return view('supervisor.skills', compact('skills', 'graduate', 'edit_skill'));
    }

    public function destroyJob(Job $job, $graduateId)
    {
        $job->graduates()->detach($graduateId);

        if ($job->graduates()->count() === 0) {
            $job->delete();
        }

        return redirect()->back()->with('success', 'تم حذف الوظيفة بنجاح');
    }

    public function destroySkill(Skill $skill, $graduateId)
    {
        $skill->graduates()->detach($graduateId);

        if ($skill->graduates()->count() === 0) {
            $skill->delete();
        }

        return redirect()->back()->with('success', 'تم حذف المهارة بنجاح');
    }

    public function storeJob(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string',
            'compony' => 'required|string',
            'location' => 'required|string',
            'field_of_work' => 'required|string',
            'technology' => 'required|string',
            'start_date' => 'required|date',
            'graduate_id' => 'required|exists:graduates,id'
        ]);

        $endDate = $request['job_ended'] == 'yes' ? $request['start_date'] : null;
        $job = Job::create([
            'title' => $validated['title'],
            'compony' => $validated['compony'],
            'location' => $validated['location'],
            'field_of_work' => $validated['field_of_work'],
            'technology' => $validated['technology'],
            'created_by' => null,
        ]);

        $job->graduates()->attach($validated['graduate_id'], [
            'start_date' => $validated['start_date'],
            'end_date' => $endDate,
        ]);

        // ✅ Update graduate job_status to 1
        $graduate = Graduate::find($validated['graduate_id']);
        $graduate->job_status = $endDate ? 1 : 0;
        $graduate->save();

        return redirect()->back()->with('success', 'تمت إضافة الوظيفة بنجاح');
    }


    public function storeSkill(Request $request)
    {


        $validated = $request->validate([
            'title' => 'required|string',
            'technology' => 'required|string',
            'accomplishment' => 'required|string',
            'graduate_id' => 'required|exists:graduates,id'
        ]);

        $skill = Skill::create([
            'title' => $validated['title'],
            'technology' => $validated['technology'],
            'accomplishment' => $validated['accomplishment'],
            'graduate_id' => $validated['graduate_id'],
        ]);

        $skill->graduates()->attach($validated['graduate_id']);

        return redirect()->back()->with('success', 'تمت إضافة المهارة بنجاح');
    }

    public function jobUpdate(Request $request,  $id)
    {
        $job = Job::find($id);
        $request->validate([
            'title' => 'required|string',
            'compony' => 'required|string',
            'location' => 'required|string',
            'field_of_work' => 'required|string',
            'technology' => 'required|string',
            'start_date' => 'required|date',
            'graduate_id' => 'required|exists:graduates,id'
        ]);
        $endDate = $request['job_ended'] == 'yes' ? $request['start_date'] : null;
        $job->update([
            'title' => $request->title,
            'compony' => $request->compony,
            'location' => $request->location,
            'field_of_work' => $request->field_of_work,
            'technology' => $request->technology,
        ]);

        $job->graduates()->updateExistingPivot($request->graduate_id, [
            'start_date' => $request->start_date,
            'end_date' => $endDate,
        ]);

        return redirect()->back()->with('success', 'تم تحديث الوظيفة بنجاح');
    }

    public function skillUpdate(Request $request, $id)
    {
        $skill = Skill::find($id);
        $request->validate([
           'title' => 'required|string',
            'technology' => 'required|string',
            'accomplishment' => 'required|string',
            'graduate_id' => 'required|exists:graduates,id'
        ]);

        $skill->update([
            'title' => $request->title,
            'technology' => $request->technology,
            'accomplishment' => $request->accomplishment,
        ]);


        return redirect()->back()->with('success', 'تم تحديث المهارة بنجاح');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
            'full_name' => ['required'],
            'sex' => ['required'],
            'major' => ['required'],
            'GPA' => ['required', 'numeric'],
            'honours_degree' => ['boolean'],
            'graduation_year' => ['required', 'integer'],
        ]);

        return UniversityData::create($data);
    }

    public function show(UniversityData $universityData)
    {
        return $universityData;
    }

    public function update(Request $request, UniversityData $universityData)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
            'full_name' => ['required'],
            'sex' => ['required'],
            'major' => ['required'],
            'GPA' => ['required', 'numeric'],
            'honours_degree' => ['boolean'],
            'graduation_year' => ['required', 'integer'],
        ]);

        $universityData->update($data);

        return $universityData;
    }

    public function destroy(UniversityData $universityData)
    {
        $universityData->delete();

        return response()->json();
    }


public function getGraduateCourses($id)
{
    $graduate = Graduate::firstOrCreate(
        ['university_data_id' => $id],
        ['user_id' => null, 'job_status' => false]
    );

    $grad = Graduate::with('courses')->find($graduate->id);
    $graduate = $grad;
    $courses = $grad->courses;
    $allCourses = Course::all();

    return view('supervisor.courses', compact('courses', 'graduate', 'allCourses'));
}
public function storeCourse(Request $request)
{
    // Validate the course and graduate data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'school' => 'required|string|max:255',
        'duration' => 'required|string|max:255',
        'graduate_id' => 'required|exists:graduates,id'
    ]);

    // Retrieve the graduate
    $graduate = Graduate::findOrFail($validated['graduate_id']);

    // Check if the course already exists or create a new one
    $course = Course::firstOrCreate([
        'title' => $validated['title'],
        'school' => $validated['school'],
        'duration' => $validated['duration']
    ]);

    // Attach the course to the graduate
    $graduate->courses()->syncWithoutDetaching([$course->id]);

    // Return success message
    return redirect()->back()->with('success', 'تمت إضافة الدورة بنجاح');
}


public function updateGraduateCourse($courseId, $graduateId)
{
    $graduate = Graduate::findOrFail($graduateId);
    $edit_course = Course::findOrFail($courseId);

    $grad = Graduate::with('courses')->find($graduateId);
    $courses = $grad->courses;
    $allCourses = Course::all();

    return view('supervisor.courses', compact('courses', 'graduate', 'edit_course', 'allCourses'));
}

public function destroyCourse(Course $course, $graduateId)
{
    $course->graduates()->detach($graduateId);

    if ($course->graduates()->count() === 0) {
        $course->delete();
    }

    return redirect()->back()->with('success', 'تم حذف الدورة بنجاح');
}
public function courseUpdate(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'school' => 'required|string|max:255',
        'duration' => 'required|string|max:255',
        'graduate_id' => 'required|exists:graduates,id'
    ]);

    $course = Course::findOrFail($id);

    $course->update([
        'title' => $request->title,
        'school' => $request->school,
        'duration' => $request->duration,
    ]);

    return redirect()->back()->with('success', 'تم تحديث الدورة بنجاح');
}

}
