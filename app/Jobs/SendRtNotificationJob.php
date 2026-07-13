<?php

namespace App\Jobs;

use App\Models\SuratPengantarRt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendRtNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected SuratPengantarRt $surat
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $surat = $this->surat;
        $ketuaRt = $surat->ketuaRt;

        if (!$ketuaRt) {
            Log::warning("SendRtNotificationJob: No Ketua RT assigned for Surat ID #{$surat->id}");
            return;
        }

        $token = config('services.fonnte.token');

        if (empty($token) || $token === 'your_fonnte_token_here') {
            Log::warning("SendRtNotificationJob: Fonnte token is not configured in services/env.");
            return;
        }

        // Construct message
        $message = "Halo Pak/Bu {$ketuaRt->nama}, terdapat pengajuan Surat Pengantar RT baru:\n\n"
                 . "Nama Pemohon: {$surat->nama}\n"
                 . "Keperluan: {$surat->keperluan}\n\n"
                 . "Silakan balas pesan ini dengan format:\n"
                 . "*ACC {$surat->id} [catatan]* (untuk menyetujui)\n"
                 . "*TOLAK {$surat->id} [catatan]* (untuk menolak)\n\n"
                 . "Terima kasih.";

        // Send HTTP request to Fonnte API
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $ketuaRt->no_whatsapp,
            'message' => $message,
            'countryCode' => '62',
        ]);

        $resData = $response->json();
        if ($response->failed() || (isset($resData['status']) && $resData['status'] === false)) {
            Log::error("SendRtNotificationJob: Fonnte API returned an error for Surat ID #{$surat->id}. Response: " . $response->body());
        } else {
            Log::info("SendRtNotificationJob: WhatsApp notification successfully dispatched to Fonnte for Surat ID #{$surat->id}. Response: " . $response->body());
        }
    }
}
