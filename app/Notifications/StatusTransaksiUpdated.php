<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusTransaksiUpdated extends Notification
{
    use Queueable;

    public $transaksi;
    public $statusLama;

    /**
     * Create a new notification instance.
     */
    public function __construct($transaksi, $statusLama = null)
    {
        $this->transaksi = $transaksi;
        $this->statusLama = $statusLama;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $statusLabels = [
            'menunggu' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $statusColors = [
            'menunggu' => 'amber',
            'diproses' => 'blue',
            'selesai' => 'emerald',
            'dibatalkan' => 'red',
        ];

        return [
            'type' => 'status_update',
            'title' => 'Status Pesanan Diperbarui',
            'message' => "Pesanan {$this->transaksi->kode_transaksi} statusnya berubah menjadi {$statusLabels[$this->transaksi->status]}",
            'transaksi_id' => $this->transaksi->id,
            'kode_transaksi' => $this->transaksi->kode_transaksi,
            'status' => $this->transaksi->status,
            'status_label' => $statusLabels[$this->transaksi->status] ?? $this->transaksi->status,
            'status_color' => $statusColors[$this->transaksi->status] ?? 'gray',
            'status_lama' => $this->statusLama,
            'total_harga' => $this->transaksi->total_formatted,
            'waktu' => now()->format('d M Y H:i'),
        ];
    }
}