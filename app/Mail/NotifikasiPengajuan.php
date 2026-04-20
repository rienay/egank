<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiPengajuan extends Mailable
{
    use Queueable, SerializesModels;

    public $dataPengajuan;

    public function __construct($dataPengajuan)
    {
        $this->dataPengajuan = $dataPengajuan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan Surat Magang Berhasil - e-Surat',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notifikasi', // Kita buat file ini di langkah selanjutnya
        );
    }
}