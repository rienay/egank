<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PengajuanSurat;

class SuratDisetujui extends Mailable {
    use Queueable, SerializesModels;
    public $pengajuan;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\PengajuanSurat $pengajuan
     */
    public function __construct(PengajuanSurat $pengajuan) {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informasi: Pengajuan Surat Anda Telah Disetujui',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.surat_disetujui',
        );
    }
}