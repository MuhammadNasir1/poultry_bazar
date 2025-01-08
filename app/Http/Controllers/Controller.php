<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Exception;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    // user Defined
    protected function errorResponse(Exception $e, $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], $code);
    }
    
    public function addNotification($added_user_id, $notification_title, $notification_type, $notification_description)
    {
        $notification = new Notifications();
        $notification->added_user_id = $added_user_id;
        $notification->notification_title = $notification_title;
        $notification->notification_type = $notification_type;
        $notification->notification_description = $notification_description;
        $notification->save();
    }

    // user Defined
}
