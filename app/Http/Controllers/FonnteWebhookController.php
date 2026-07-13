<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use App\Models\SuratPengantarRt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FonnteWebhookController extends Controller
{
    /**
     * Handle incoming webhook requests from Fonnte.
     */
    public function handle(Request $request)
    {
        // Handle verification request from Fonnte (GET)
        if ($request->isMethod('get')) {
            return response()->json([
                'status' => true,
                'message' => 'Fonnte Webhook endpoint is online and active.'
            ]);
        }

        // Fonnte webhook parameters: sender (628xxx), message (text)
        $sender = $request->input('sender');
        $message = trim($request->input('message'));

        if (!$sender || !$message) {
            return response()->json([
                'status' => false,
                'message' => 'Sender or message parameter is missing.'
            ], 400);
        }

        // Find the Ketua RT matching this phone number
        $ketuaRt = KetuaRt::where('no_whatsapp', $sender)->first();

        if (!$ketuaRt) {
            Log::warning("Fonnte Webhook: Received message from unregistered number {$sender}: {$message}");
            return response()->json([
                'status' => false,
                'message' => 'Sender number is not registered as a Ketua RT.'
            ], 403);
        }

        // Parse message: ACC [id] [catatan] OR TOLAK [id] [catatan]
        // or ACC [catatan] / TOLAK [catatan] (finding latest pending letter)
        $words = preg_split('/\s+/', $message);
        if (count($words) === 0) {
            return response()->json([
                'status' => false,
                'message' => 'Empty message.'
            ], 400);
        }

        $command = strtoupper($words[0]);
        if (!in_array($command, ['ACC', 'TOLAK', 'DISETUJUI'])) {
            return response()->json([
                'status' => false,
                'message' => 'Command not recognized. Must start with ACC or TOLAK.'
            ]);
        }

        $status = ($command === 'ACC' || $command === 'DISETUJUI') ? 'disetujui' : 'ditolak';
        $suratRt = null;
        $catatan = '';

        // Check if the second word is numeric (representing the Surat ID)
        if (isset($words[1]) && is_numeric($words[1])) {
            $suratId = (int)$words[1];
            $suratRt = SuratPengantarRt::where('id', $suratId)
                ->where('rt_id', $ketuaRt->id)
                ->first();

            // Extract the remaining words as notes
            $catatan = implode(' ', array_slice($words, 2));
        } else {
            // Find the latest pending letter for this RT
            $suratRt = SuratPengantarRt::where('rt_id', $ketuaRt->id)
                ->where('status', 'pending')
                ->latest()
                ->first();

            // Extract notes starting from the second word
            $catatan = implode(' ', array_slice($words, 1));
        }

        if (!$suratRt) {
            Log::info("Fonnte Webhook: No matching or pending letter found for Ketua RT {$ketuaRt->nama} ({$sender})");
            return response()->json([
                'status' => false,
                'message' => 'Tidak ditemukan permohonan pending yang cocok untuk diproses.'
            ]);
        }

        // Update the letter status and notes
        $suratRt->update([
            'status' => $status,
            'catatan' => $catatan ? trim($catatan) : null,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Permohonan ID #{$suratRt->id} atas nama {$suratRt->nama} telah berhasil di-{$status}.",
            'data' => [
                'id' => $suratRt->id,
                'nama' => $suratRt->nama,
                'status' => $status,
                'catatan' => $suratRt->catatan
            ]
        ]);
    }
}
