<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TwilioWhatsappService
{
    protected $sid;
    protected $token;
    protected $from;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->from = config('services.twilio.from'); // WhatsApp sender dari Twilio (contoh: whatsapp:+14155238886)
    }

    public function sendMessage($to, $message)
    {
        $to = $this->formatPhoneNumber($to);

        $response = Http::withBasicAuth($this->sid, $this->token)->asForm()->post("https://api.twilio.com/2010-04-01/Accounts/{$this->sid}/Messages.json", [
            'From' => $this->from,
            'To' => "whatsapp:$to",
            'Body' => $message,
        ]);

        if (!$response->successful()) {
            \Log::error('Twilio WhatsApp Error:', $response->json());
        }

        return $response->json();
    }

    protected function formatPhoneNumber($number)
    {
        // Ubah 08xxx jadi +628xxx
        if (strpos($number, '08') === 0) {
            $number = '+62' . substr($number, 1);
        }

        return preg_replace('/[^0-9+]/', '', $number); // bersihkan karakter selain angka/+
    }
}
