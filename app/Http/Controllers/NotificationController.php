<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function allNotifications()
    {
        $notifications = DB::table('notifications')->get();

        return response()->json([
            'message' => 'All notifications fetched successfully',
            'notifications' => $notifications
        ], 200);
    }
}