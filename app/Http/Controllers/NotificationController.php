<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function UnreadNotifications()
    {
        $UnreadNotifications = Auth::user()->unreadNotifications()->get();
        $count = Auth::user()->unreadNotifications()->count();
        return response()->json(['Unread_Notifications' => $UnreadNotifications , 'Number' => $count], 200);
    }

    public function AllNotifications()
    {
        $AllNotifications = Auth::user()->notifications;
        return response()->json(['All_Notifications' => $AllNotifications,], 200);
    }
}
