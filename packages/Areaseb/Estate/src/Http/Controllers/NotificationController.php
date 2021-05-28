<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request;
use Areaseb\Estate\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->paginate();
        return view('estate::notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['read' => 1]);
        return 'done';
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return 'done';
    }

    public function show(Notification $notification)
    {
        return view('estate::notifications.show', compact('notification'));
    }

}
