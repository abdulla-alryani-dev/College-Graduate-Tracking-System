<?php

namespace App\Http\Controllers;

use App\Models\GraduateStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduateStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllStorys()
    {
        $graduate = Auth::user()->graduate;

        // جلب القصة الخاصة بهذا الخريج إن وُجدت
        $existingStory = GraduateStory::where('graduate_id', $graduate->id)->first();

        $graduateStorys = GraduateStory::paginate(3);

        return view("graduate.graduate-storys", compact("graduateStorys", "existingStory"));
    }
    public function addStory()
    {
        //
        return view("graduate.add-story");
    }
    public function editStory($id)
    {

        $story = GraduateStory::find($id);
        //
        return view("graduate.add-story", compact('story'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request with custom messages in Arabic
        $graduate = Auth::user()->graduate->id;


        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'des' => 'required|string|min:40', // Ensure description has at least 40 characters
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image upload
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب أن يكون نصًا',
            'name.max' => 'الاسم يجب أن لا يتجاوز 255 حرفًا',

            'position.required' => 'الوظيفة مطلوبة',
            'position.string' => 'الوظيفة يجب أن تكون نصًا',
            'position.max' => 'الوظيفة يجب أن لا تتجاوز 255 حرفًا',

            'des.required' => 'الوصف مطلوب',
            'des.string' => 'الوصف يجب أن يكون نصًا',
            'des.min' => 'الوصف يجب أن لا يقل عن 40 حرفًا',

            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'يجب أن تكون الصورة من نوع صورة',
            'image.mimes' => 'الصورة يجب أن تكون بصيغة jpeg، png، jpg، gif أو svg',
            'image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت',


        ]);



        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories_images', 'public');
        }

        // Create the new story and associate it with a graduate
        $story = GraduateStory::create([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'des' => $request->input('des'),
            'image' => $imagePath,  // Store the image path
            'graduate_id' => $graduate
        ]);
        // Redirect back or to a new page with a success message
        return redirect()->route('story.getAllStorys')->with('success', 'تم إضافة القصة بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(GraduateStory $graduateStory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GraduateStory $graduateStory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Fetch the story by ID, making sure it's a single instance, not a collection
        $story = GraduateStory::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'des' => 'required|string|min:40',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the fields in the story instance
        $story->name = $request->input('name');
        $story->position = $request->input('position');
        $story->des = $request->input('des');

        // If a new image is uploaded, update the image path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories_images', 'public');
            $story->image = $imagePath;
        }

        // Save the updated story
        $story->save();

        // Redirect back with a success message
        return redirect()->route('story.getAllStorys')->with('success', 'تم تحديث القصة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GraduateStory $graduateStory)
    {
        //
    }
}
