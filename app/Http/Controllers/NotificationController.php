<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function UnreadNotifications()
    {
        $UnreadNotifications = Auth::user()->unreadNotifications()->count();
        return response()->json(['Unread_Notifications' => $UnreadNotifications], 200);
    }

    public function ReadNotifications()
    {
        $ReadNotifications = Auth::user()->readNotifications()->count();
        return response()->json(['Read_Notifications' => $ReadNotifications,], 200);
    }
}
