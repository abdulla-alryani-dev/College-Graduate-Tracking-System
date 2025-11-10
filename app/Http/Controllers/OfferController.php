<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Skill;
use App\Models\TechnicalTool;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OfferController extends Controller
{

    // لوحة التحكم



public function dashboard()
{

    $employerId = Auth::user()->employeer->id;

    // Get all offers (for admin)
    $allOffers = Offer::all();

    // Get employer's offers
    $offers = Offer::where('employeer_id', $employerId)->get();

    // Counts for all offers
    $totalOffers = $allOffers->count();
    $activeOffers = $allOffers->filter(function($offer) {
        return $offer->is_active && Carbon::parse($offer->expiration_date)->isFuture();
    })->count();

    // Counts for employer's offers
    $employerTotalOffers = $offers->count();
    $employerActiveOffers = $offers->filter(function($offer) {
        return $offer->is_active && Carbon::parse($offer->expiration_date)->isFuture();
    })->count();

    // Percentage calculation
    $lastMonthCount = Offer::where('employeer_id', $employerId)
        ->where('created_at', '>=', now()->subMonth())
        ->count();

    $offerPercentageChange = $lastMonthCount > 0
        ? round(($employerTotalOffers - $lastMonthCount) / $lastMonthCount * 100)
        : ($employerTotalOffers > 0 ? 100 : 0);

    return view('offers.dashboard', [
        'allOffers' => $allOffers,
        'offers' => $offers,
        'totalOffers' => $totalOffers,
        'activeOffers' => $activeOffers,
        'employerTotalOffers' => $employerTotalOffers,
        'employerActiveOffers' => $employerActiveOffers,
        'offerPercentageChange' => $offerPercentageChange
    ]);
}




    public function create()
    {
        $skills = Skill::all();
        $technicalTools = TechnicalTool::all();

        return view('offers.create', compact('skills', 'technicalTools'));
    }

    public function store(Request $request)
    {

        try {


            // Validate the incoming request
            $validated = $request->validate([
                'job_title' => 'required|string|max:255',
                'job_description' => 'required|string',
                'location' => 'nullable|string|max:255',
                'job_type' => 'required|string|in:دوام كامل,دوام جزئي,عقد,عمل حر,تدريب',
                'experience_level' => 'required|string|in:مبتدئ (0-2 سنة),متوسط (2-5 سنوات),خبير (5-10 سنوات),قائد/إداري (+10 سنوات)',
                'expiration_date' => 'required|date',
                'job_category' => 'required|string|max:255',
                'location_type' => 'required|string|max:255',
                'vacancies' => 'required|integer|min:1',
                'salary_type' => 'required|string',
                'fixed_salary' => 'nullable|numeric',
                'fixed_salary_currency' => 'nullable|string|max:3',
                'fixed_salary_period' => 'nullable|string|max:10',
                'salary_min' => 'nullable|numeric',
                'salary_max' => 'nullable|numeric',
                'salary_range_currency' => 'nullable|string|max:3',
                'salary_range_period' => 'nullable|string|max:10',
                'qualifications' => 'nullable|string',
                'application_instructions' => 'required|string',
                'additional_info' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'technical_tools' => 'required|array',
                'technical_tools.*.name' => 'required|string|max:255',
                'technical_tools.*.proficiency' => 'required|string|in:basic,intermediate,advanced,expert',
                'technical_tools.*.is_mandatory' => 'nullable|boolean',
            ]);


            // Store the offer
            $offer = Offer::create([
                'employeer_id' => Auth::user()->employeer->id,  // assuming you're authenticated
                'job_title' => $validated['job_title'],
                'job_description' => $validated['job_description'],
                'location' => $validated['location'],
                'job_type' => $validated['job_type'],
                'experience_level' => $validated['experience_level'],
                'expiration_date' => $validated['expiration_date'],
                'job_category' => $validated['job_category'],
                'location_type' => $validated['location_type'],
                'vacancies' => $validated['vacancies'],
                'salary_type' => $validated['salary_type'],
                'fixed_salary' => $validated['fixed_salary'],
                'fixed_salary_currency' => $validated['fixed_salary_currency'],
                'fixed_salary_period' => $validated['fixed_salary_period'],
                'salary_min' => $validated['salary_min'],
                'salary_max' => $validated['salary_max'],
                'salary_range_currency' => $validated['salary_range_currency'],
                'salary_range_period' => $validated['salary_range_period'],
                'qualifications' => $validated['qualifications'],
                'application_instructions' => $validated['application_instructions'],
                'additional_info' => $validated['additional_info'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            // Handle the technical tools (create or find existing ones)
            $toolIds = [];
            foreach ($validated['technical_tools'] as $toolData) {
                // Check if the technical tool already exists, or create it
                $tool = TechnicalTool::firstOrCreate(
                    ['name' => $toolData['name']], // Find by name
                    ['category' => $toolData['category'] ?? null, 'description' => $toolData['description'] ?? null] // Additional fields if available
                );

                // Add the tool's ID to the list of tool IDs for the pivot table
                $toolIds[$tool->id] = [
                    'proficiency_level' => $toolData['proficiency'],
                    'is_mandatory' => $toolData['is_mandatory'] ?? true, // Default to true if not provided
                ];
            }

            // Attach technical tools to the offer
            $offer->technicalTools()->attach($toolIds);

            // Return success response
            return response()->json([
                'message' => 'Job offer created successfully with technical tools',
                'offer' => $offer
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation failed, return errors
                return response()->json([
                    'errors' => $e->validator->errors()
                ], 422);
            } catch (\Exception $e) {
                // Catch any other exceptions
                return response()->json([
                    'error' => 'An error occurred while processing your request.',
                    'message' => $e->getMessage()
                ], 500);
            }
    }




    // عرض تفاصيل العرض
    public function show($id)
    {
        $offer = Offer::find($id);

        return view('offers.offer', compact('offer'));
    }


    // عرض نموذج التعديل
    public function edit( $id)
    {
        $offer = Offer::find($id);
        $skills = Skill::all();
        $technicalTools = TechnicalTool::all();
        return view('offers.edit', compact('skills', 'technicalTools', 'offer'));
    }

    // تحديث العرض
    public function update(Request $request,  $id)
    {
        $offer = Offer::find($id);

        try {
            // Validate the incoming request
            $validated = $request->validate([
                'job_title' => 'required|string|max:255',
                'job_description' => 'required|string',
                'location' => 'nullable|string|max:255',
                'job_type' => 'required|string|in:دوام كامل,دوام جزئي,عقد,عمل حر,تدريب',
                'experience_level' => 'required|string|in:مبتدئ (0-2 سنة),متوسط (2-5 سنوات),خبير (5-10 سنوات),قائد/إداري (+10 سنوات)',
                'expiration_date' => 'required|date',
                'job_category' => 'required|string|max:255',
                'location_type' => 'required|string|max:255',
                'vacancies' => 'required|integer|min:1',
                'salary_type' => 'required|string',
                'fixed_salary' => 'nullable|numeric',
                'fixed_salary_currency' => 'nullable|string|max:3',
                'fixed_salary_period' => 'nullable|string|max:10',
                'salary_min' => 'nullable|numeric',
                'salary_max' => 'nullable|numeric',
                'salary_range_currency' => 'nullable|string|max:3',
                'salary_range_period' => 'nullable|string|max:10',
                'qualifications' => 'nullable|string',
                'application_instructions' => 'required|string',
                'additional_info' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'technical_tools' => 'required|array',
                'technical_tools.*.name' => 'required|string|max:255',
                'technical_tools.*.proficiency' => 'required|string|in:basic,intermediate,advanced,expert',
                'technical_tools.*.is_mandatory' => 'nullable|boolean',
            ]);

            // Update the offer
            $offer->update([
                'job_title' => $validated['job_title'],
                'job_description' => $validated['job_description'],
                'location' => $validated['location'],
                'job_type' => $validated['job_type'],
                'experience_level' => $validated['experience_level'],
                'expiration_date' => $validated['expiration_date'],
                'job_category' => $validated['job_category'],
                'location_type' => $validated['location_type'],
                'vacancies' => $validated['vacancies'],
                'salary_type' => $validated['salary_type'],
                'fixed_salary' => $validated['fixed_salary'],
                'fixed_salary_currency' => $validated['fixed_salary_currency'],
                'fixed_salary_period' => $validated['fixed_salary_period'],
                'salary_min' => $validated['salary_min'],
                'salary_max' => $validated['salary_max'],
                'salary_range_currency' => $validated['salary_range_currency'],
                'salary_range_period' => $validated['salary_range_period'],
                'qualifications' => $validated['qualifications'],
                'application_instructions' => $validated['application_instructions'],
                'additional_info' => $validated['additional_info'],
                'is_active' => $validated['is_active'] ?? true,
            ]);

            // Handle the technical tools
            $toolIds = [];
            foreach ($validated['technical_tools'] as $toolData) {
                $tool = TechnicalTool::firstOrCreate(
                    ['name' => $toolData['name']],
                    [
                        'category' => $toolData['category'] ?? null,
                        'description' => $toolData['description'] ?? null
                    ]
                );

                $toolIds[$tool->id] = [
                    'proficiency_level' => $toolData['proficiency'],
                    'is_mandatory' => $toolData['is_mandatory'] ?? true,
                ];
            }

            // Sync the technical tools with the pivot table
            $offer->technicalTools()->sync($toolIds);

            return response()->json([
                'message' => 'Job offer updated successfully with technical tools',
                'offer' => $offer
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->validator->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the offer.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // حذف العرض
    public function destroy( $id)
    {
        $offer = Offer::find($id);

        $offer->delete();
        return redirect()->route('employerDashboard')->with('success', 'تم حذف العرض بنجاح');
    }

    // تغيير حالة العرض
    public function toggleStatus($id)
    {
        $offer = Offer::find($id);
        $offer->update(['is_active' => !$offer->is_active]);
        return back()->with('success', 'تم تغيير حالة العرض بنجاح');
    }

    public function showOffers()
{
    $offers = Offer::with('employeer')->get();
    return view('graduate.jobs-offers', compact('offers'));
}
public function showOffer($id)
{
    $offer = Offer::find($id);

    return view('graduate.offer', compact('offer'));
}
}
