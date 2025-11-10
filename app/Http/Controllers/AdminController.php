<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display pending employer registration requests
    public function index()
    {
        // Fetch employers with 'pending' status
//        $employers = User::where('role', 'employer')->where('status', 'pending')->get();
//        return view('admin.requests', compact('employers'));
    }

    // Approve an employer
    public function approve(User $user)
    {
        // Check if the user is an employer
        if ($user->role === 'employer') {
            // Update the user's status to 'approved'
            $user->update(['status' => 'approved']);

            // Send email verification notification
            $user->sendEmailVerificationNotification();

            // Mark the related notification as read (if applicable)
            $this->markNotificationAsRead($user);

            // Redirect with success message
            return redirect()->route('admin.notifications.show')->with('success', 'Employer approved and verification email sent.');
        }

        // Redirect with error message if the user is not an employer
        return redirect()->route('admin.notifications.show')->with('error', 'Invalid user role.');
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
}
