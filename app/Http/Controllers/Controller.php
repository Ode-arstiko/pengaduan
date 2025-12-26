<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function markAsRead($id) {
        $notif = Notifications::find($id);
        $notif->update([
            'status' => 'dibaca'
        ]);
    }

    public function markAll() {
        $notif = Notifications::where('user_id', Auth::user()->id)->where('status', 'baru')->get();
        foreach ($notif as $n) {
            $n->update([
                'status' => 'dibaca'
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function deleteNotif($id) {
        $notif = Notifications::find($id);
        $notif->delete();
    }
}
