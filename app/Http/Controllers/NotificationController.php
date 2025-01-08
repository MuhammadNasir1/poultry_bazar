<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // get notification
    public function getNotification()
    {
        $user = session('user_details');
        $notifications = Notifications::get();

        return view('notification', ['notifications' => $notifications]);
    }
    // get notification

    // add notification
    public function createNotification(Request $request)
    {
        try {
            $user = session('user_details');

            $validatedData = $request->validate([
                'notification_title' => 'required',
                'notification_type' => 'required',
                'notification_description' => 'required',
            ]);

            $notification = Notifications::create([
                'added_user_id' => $user['id'],
                'notification_title' => $validatedData['notification_title'],
                'notification_type' => $validatedData['notification_type'],
                'notification_description' => $validatedData['notification_description'],
            ]);

            return response()->json(['success' => true, 'message' => 'Notification added successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // add notification
}
