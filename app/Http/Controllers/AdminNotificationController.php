<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class AdminNotificationController extends Controller
{
    public function index()
    {

        $notifications = auth()->user()->notifications()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function show(DatabaseNotification $notification)
    {
        // Mark the notification as read
        $notification->markAsRead();

        // Fetch the employer details
        $employer = User::find($notification->data['employer_id']);

        return view('admin.notifications.show', compact('notification', 'employer'));
    }


    public function approve(DatabaseNotification $notification)
    {

    $user = User::find($notification->data['employer_id']);
        // Check if the user is an employer


        if ($user->hasRole('employer')) {
            // Update the user's status to 'approved'

            $user->update(['status' => 'approved']);

            // Send email verification notification
            $user->sendEmailVerificationNotification();

            // Mark the related notification as read (if applicable)
            $this->markNotificationAsRead($user);

            // Redirect with success message
            return redirect()->route('dashboard')->with('success', 'Employer approved and verification email sent.');
        }

        // Redirect with error message if the user is not an employer
        return redirect()->route('dashboard')->with('error', 'Invalid user role.');
    }

    public function reject(User $user)
    {
        // Check if the user is an employer
        if ($user->role === 'employer') {
            // Update the user's status to 'rejected'
            $user->update(['status' => 'rejected']);

            // Mark the related notification as read (if applicable)
            $this->markNotificationAsRead($user);

            // Redirect with success message
            return redirect()->route('admin.notifications.show')->with('success', 'Employer rejected.');
        }

        // Redirect with error message if the user is not an employer
        return redirect()->route('admin.notifications.show')->with('error', 'Invalid user role.');
    }

    /**
     * Mark the notification related to the employer as read.
     *
     * @param User $user
     */
    protected function markNotificationAsRead(User $user)
    {
        // Find the notification related to this employer
        $notification = auth()->user()->notifications()
            ->where('type', 'App\Notifications\NewEmployerRegistration')
            ->where('data->employer_id', $user->id)
            ->first();

        // Mark the notification as read
        if ($notification) {
            $notification->markAsRead();
        }
    }
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
