<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Graduate;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InquiryController extends Controller
{
    public function index()
    {
        return Inquiry::all();
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048', // Adjust file types & size
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public'); // Saves in storage/app/public/uploads
        }

        $inquiry = Inquiry::create([
            'title' => "title",
            'description' => $request->input('description'),
            'graduate_id' => Auth::user()->graduate->id,
            'division_id' => $id,
            'respond' => 'send',
            'file' => $filePath, // Save file path in database
        ]);



        return redirect()->route('division.chat-room', $id)->with('success', 'Inquiry saved successfully.');
    }
    public function storeSupervisiorText(Request $request, $division, $graduate){
        $request->validate([
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048', // Adjust file types & size
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chats_uploads', 'public'); // Saves in storage/app/public/uploads
        }

        $inquiry = Inquiry::create([
            'title' => "title",
            'description' => $request->input('description'),
            'graduate_id' => $graduate,
            'division_id' => $division,
            'respond' => 'received',
            'file' => $filePath, // Save file path in database
        ]);

        // $grad = Graduate::find($graduate);

        // $notification = Notification::create([
        //     'type' => 'inquiry',
        //     'notifiable_type' => get_class($grad),
        //     'notifiable_id' => $grad->id,
        //     'data' => $division,
        //     'read_at' => null
        // ]);

        return redirect()->back()->with('success', 'Inquiry saved successfully.');
    }
    public function show(Inquiry $inquiry)
    {
        return $inquiry;
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'respond' => ['required'],
            'graduate_id' => ['required', 'exists:graduate'],
            'division_id' => ['required', 'exists:divisions'],
        ]);

        $inquiry->update($data);

        return $inquiry;
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return response()->json();
    }
}
