<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama_pengirim;
    public $pesan;
    public $fileUrl;

    public function __construct($nama_pengirim, $pesan, $fileUrl = null)
    {
        $this->nama_pengirim = $nama_pengirim;
        $this->pesan = $pesan;
        $this->fileUrl = $fileUrl;
    }

    public function build()
    {
        return $this->subject('Pesan Dari SIS-APP')
                    ->view('email.tampil-pesan')
                    ->with([
                        'nama_pengirim' => $this->nama_pengirim,
                        'pesan' => $this->pesan,
                        'fileUrl' => $this->fileUrl,
                    ]);
    }
}