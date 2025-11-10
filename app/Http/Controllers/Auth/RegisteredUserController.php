<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UniversityData;
use App\Models\User;
use App\Models\Graduate;
use App\Notifications\NewEmployerRegistration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {



        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:graduate,employer', // Validate the role
             ]);

        if ($request->role == 'graduate') {
            $univiersityData = UniversityData::where('email', $request->mailCheck)->first();
            $exists = UniversityData::where('email', $request->mailCheck)->exists();

            if (!$exists) {
                return back()->withErrors(['mailCheck' => 'هذا البريد الإلكتروني غير مسجل في بيانات الجامعة.']);
            }


            $exist = Graduate::where('university_data_id', $univiersityData->id)->exists();
            $grad = Graduate::where('university_data_id', $univiersityData->id)->first();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' =>'approved'
            ]);
            if(!$exist){
            $grad = Graduate::create([
                'user_id' =>  $user->id,
                'university_data_id' =>  UniversityData::where('email', $request->mailCheck)->first()?->id,
                'job_status' => 0

            ]);
        }
        else{
            $grad->user_id = $user->id;
             $grad->save();
        }
        }else{

                $request->validate([
                    'employer_name' => 'required|string|max:255',
                    'employer_location' => 'required|string|max:255',
                    'employer_industry' => 'required|string|max:255',
                ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'pending'
            ]);

            $user->employeer()->create([
                'email'=>$user->email,
                'name' => $request->employer_name,
                'location' => $request->employer_location,
                'industry' => $request->employer_industry,
                'password'=>Hash::make($request->password)]);

        }


        // Assign role based on the hidden input
        if ($request->role === 'employer') {

         $role = config('roles.models.role')::where('name', '=', 'employer')->first();  //choose the default role upon user creation.
            $user->attachRole($role); // Assign the 'employer' role
        } else {
            $role = config('roles.models.role')::where('name', '=', 'User')->first();  //choose the default role upon user creation.

            $user->attachRole($role); // Assign the 'user' role
        }
        event(new Registered($user));
        Auth::login($user);
        // If the user is not an employer, log them in and send verification email
        if (!$user->hasRole('employer')) {

            return ($user->hasRole('admin')|| $user->hasRole('supervisor')) ? redirect()->route('dashboard') : redirect()->route('graduate.dashboard');
           // $user->sendEmailVerificationNotification(); // Send verification email
        }


        // Send notification to admin if the user is an employer
        if ($request->role === 'employer') {
            $admins = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.name', 'Admin')->select('users.*')
                ->get();

            if ($admins->isNotEmpty()) {
                // Convert stdClass objects to User models
                foreach ($admins as $admin) {
                    $adminUser = User::find($admin->id); // Convert to User model instance
                    $adminUser->notify(new NewEmployerRegistration($user));
                }
            } else {
                // Log an error if no admin is found
                Log::error('No admin users found to send notification.');
            }

        }
        // Send email verification for employers
        if ($user->hasRole('employer')) {


            // Send the email verification notification
            $user->sendEmailVerificationNotification();
            // Optionally, log the employer out if you don't want them to be logged in before verification
            Auth::logout();
            // Redirect the user to the email verification notice page
            return redirect()->route('verification.notice');
        }

        return redirect('/')->with('success', $request->role === 'employer'
            ? 'Your registration is pending admin approval.'
            : 'Registration successful!.');



       // return redirect(route('dashboard', absolute: false));
    }
}
