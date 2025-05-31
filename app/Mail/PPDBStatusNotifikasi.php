<?php

namespace App\Mail;

use App\Models\PPDBRegistrasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PPDBStatusNotifikasi extends Mailable
{
    use Queueable, SerializesModels;

    public $registrasi;
    
    public function __construct(PPDBRegistrasi $registrasi)
    {
        $this->registrasi = $registrasi;
    }

    public function build()
    {
        $statusText = $this->registrasi->status === 'Disetujui' ? 'DITERIMA' : 'DITOLAK';

        return $this->subject("Status pendaftaran Anda: $statusText")
                    ->view('email.ppdb.ppdb-status');
    }
}
