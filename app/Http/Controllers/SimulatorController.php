<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use App\Models\SuratPengantarRt;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    /**
     * Display the simulator view.
     */
    public function index(Request $request)
    {
        $ketuaRtList = KetuaRt::orderBy('rw')->orderBy('rt')->get();
        $pendingLetters = SuratPengantarRt::where('status', 'pending')
            ->with('ketuaRt')
            ->latest()
            ->get();

        // Optional parameters pre-filled from detail page helper link
        $selectedRtId = $request->input('rt_id');
        $prefilledMessage = $request->input('message');

        return view('simulator', compact('ketuaRtList', 'pendingLetters', 'selectedRtId', 'prefilledMessage'));
    }

    /**
     * Handle the simulation request by calling the webhook handler.
     */
    public function simulate(Request $request)
    {
        $request->validate([
            'rt_id' => ['required', 'exists:ketua_rt,id'],
            'command' => ['required', 'in:ACC,TOLAK'],
            'target_letter' => ['nullable'], // 'latest' or a specific ID
            'catatan' => ['nullable', 'string', 'max:255'],
        ]);

        $ketuaRt = KetuaRt::findOrFail($request->input('rt_id'));
        $command = $request->input('command');
        $target = $request->input('target_letter');
        $catatan = $request->input('catatan');

        // Construct Fonnte-style message: E.g., "ACC 5 catatan" or "ACC catatan"
        $messageParts = [$command];
        if ($target && is_numeric($target)) {
            $messageParts[] = $target;
        }
        if ($catatan) {
            $messageParts[] = $catatan;
        }
        $messageText = implode(' ', $messageParts);

        // Prepare request parameters for FonnteWebhookController
        $webhookRequest = Request::create(route('webhook.fonnte'), 'POST', [
            'sender' => $ketuaRt->no_whatsapp,
            'message' => $messageText,
        ]);

        // Call the webhook handler directly
        $webhookController = app(FonnteWebhookController::class);
        $response = $webhookController->handle($webhookRequest);
        $responseData = json_decode($response->getContent(), true);

        if (isset($responseData['status']) && $responseData['status'] === true) {
            return redirect()->route('simulator.index')
                ->with('success', "Simulasi Sukses! Respon Webhook: " . $responseData['message']);
        } else {
            return redirect()->route('simulator.index')
                ->with('error', "Simulasi Gagal! Respon Webhook: " . ($responseData['message'] ?? 'Unknown error.'));
        }
    }
}
