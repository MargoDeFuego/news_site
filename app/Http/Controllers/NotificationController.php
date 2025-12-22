<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function read(DatabaseNotification $notification)
    {
        // Защита: уведомление должно принадлежать текущему пользователю
        if ($notification->notifiable_id !== Auth::id()) {
            abort(403);
        }

        // Помечаем как прочитанное
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        // Переход к статье
        return redirect($notification->data['url']);
    }
}
