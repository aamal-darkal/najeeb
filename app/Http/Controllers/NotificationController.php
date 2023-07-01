<?php

namespace App\Http\Controllers;

use App\Http\Helpers\NotificationHelper;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        if ($request->user_id)
        NotificationHelper::userNotification($request->user_id, $request->title, $request->body);
        else
        NotificationHelper::broadcastNotification($request->title, $request->body);
        return redirect()->back()->with('success', 'Notification has been sent successfully');
    }
}
