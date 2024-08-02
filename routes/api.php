<?php

use Endroid\QrCode\Builder\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

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
    $qrCodeString = $request->input('qr');
    Log::info('Received QR code', ['qr' => $qrCodeString]);

    // Generate QR code image in base64 format
    $qrCode = QrCode::create($qrCodeString);
    $writer = new PngWriter();
    $result = $writer->write($qrCode);

    // Convert to data URI format
    $dataUri = $result->getDataUri();

    // Save the data URI to cache
    Cache::put('whatsapp_qr', $dataUri, now()->addMinutes(1));

    return response()->json(['status' => 'success', 'message' => 'QR code received']);
});

Route::post('/whatsapp-status', function (Request $request) {
    $status = $request->input('status');
    Log::info('WhatsApp status update', ['status' => $status]);

    // Save the status to cache
    Cache::put('whatsapp_status', $status, now()->addMinutes(1));

    return response()->json(['status' => 'success', 'message' => 'Status updated']);
});

Route::post('/send-message', function (Request $request) {
    // Validate the incoming request
    $request->validate([
        'recipient' => 'required|string',
        'message' => 'required|string',
    ]);

    $recipient = $request->input('recipient');
    $message = $request->input('message');

    // Prepare the data to send to the Node.js API
    $data = [
        'recipient' => $recipient,
        'message' => $message,
    ];

    // Log data to ensure it's correct
    Log::info('Sending data to Node.js API:', $data);

    // Send a POST request to the Node.js server
    $response = Http::post('http://localhost:3000/send-message', $data);

    if ($response->successful()) {
        return redirect()->back()->with('status', 'Message sent successfully');
    } else {
        return redirect()->back()->with('error', 'Failed to send message')->with('response_status', $response->status());
    }
});
