<?php

namespace App\Http\Controllers;


class NotificationsController extends Controller
{
    public function list() {
        $data['notifications'] = auth()->user()->readNotifications()->latest()->paginate(10);

        return view('user.notifications' , $data);
    }
    public function readAll() {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function unReadAll() {
        auth()->user()->readNotifications->markAsUnRead();
        return redirect()->back();
    }
    public function readNotification($id) {
        $notification = auth()
                ->user()
                ->notifications()
                ->findOrFail($id);

            $notification->markAsRead();

            return back();
    }
    public function unReadNotification($id) {
        $notification = auth()
                ->user()
                ->notifications()
                ->findOrFail($id);

            $notification->markAsUnRead();

            return back();
    }
    public function deleteNotification($id) {
                 auth()
                ->user()
                ->notifications()
                ->findOrFail($id)
                ->delete();

            return back();
    }

}
