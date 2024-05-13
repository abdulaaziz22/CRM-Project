<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
        $notify_id=$request->query('notify_id');
        dd($notify_id);
        if($notify_id){
            $notification=Auth::user()->unreadNotifications()->find($notify_id);
            if($notification){
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
