<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/whatsapp-qr', function (Request $request) {
    $qr = $request->input('qr');
    if ($qr) {
        Cache::put('whatsapp-qr', $qr, now()->addMinutes(1)); // Save Base64 encoded QR code in cache for 5 minutes
        Log::info('QR Code stored in cache: ' . $qr);
    } else {
        Log::warning('No QR code received in request');
    }
    return response()->json(['status' => 'success']);
});

Route::post('/whatsapp-status', function (Request $request) {
    $status = $request->input('status');
    if ($status) {
        Cache::put('whatsapp-status', $status, now()->addMinutes(1)); // Save connection status in cache for 5 minutes
        Log::info('Connection status stored in cache: ' . $status);
    } else {
        Log::warning('No connection status received in request');
    }
    return response()->json(['status' => 'success']);
});
