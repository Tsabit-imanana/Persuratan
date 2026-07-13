<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KetuaRtController;
use App\Http\Controllers\SuratPengantarRtController;
use App\Http\Controllers\SuratPengantarKelurahanController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\FonnteWebhookController;
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Master Ketua RT CRUD
    Route::resource('ketua-rt', KetuaRtController::class)->except(['show']);
    
    // Surat Pengantar RT Routes
    Route::resource('surat-rt', SuratPengantarRtController::class)->only(['index', 'create', 'store', 'show']);
    
    // Surat Pengantar Kelurahan Routes
    Route::resource('surat-kelurahan', SuratPengantarKelurahanController::class)->only(['index', 'create', 'store', 'show']);
    
    // Fonnte Webhook Simulator
    Route::get('/simulator', [SimulatorController::class, 'index'])->name('simulator.index');
    Route::post('/simulator/run', [SimulatorController::class, 'simulate'])->name('simulator.simulate');
});

// Fonnte WhatsApp Webhook Route (Exclude from CSRF in bootstrap/app.php)
Route::match(['get', 'post'], '/api/fonnte/webhook', [FonnteWebhookController::class, 'handle'])->name('webhook.fonnte');

