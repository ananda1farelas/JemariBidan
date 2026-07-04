<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Ambil semua notifikasi user yang login
     */
    public function index()
    {
        $user = auth()->user();

        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get()
            ->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'data' => $notif->data,
                    'read_at' => $notif->read_at,
                    'created_at' => $notif->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $user->unreadNotifications()->count(),
        ]);
    }

    /**
     * Tandai satu notifikasi sebagai dibaca
     */
    public function baca($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Tandai semua notifikasi sebagai dibaca
     */
    public function bacaSemua()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}