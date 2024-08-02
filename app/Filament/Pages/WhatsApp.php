<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class WhatsApp extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static string $view = 'filament.pages.whatsapp-qr-qrs';

    public $qrCode;
    public $status;

    public function mount()
    {
        // Load QR code and status from cache
        $this->qrCode = Cache::get('whatsapp_qr');
        $this->status = Cache::get('whatsapp_status');
    }

    public function receiveQrCode($qrCodeString)
    {
        Log::info('Received QR code', ['qr' => $qrCodeString]);

        // Generate QR code image in base64 format
        $qrCode = QrCode::create($qrCodeString);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Convert to data URI format
        $dataUri = $result->getDataUri();

        // Save the data URI to cache
        Cache::put('whatsapp_qr', $dataUri, now()->addMinutes(1));

        // Update local property
        $this->qrCode = $dataUri;

        return response()->json(['status' => 'success', 'message' => 'QR code received']);
    }

    public function receiveStatus($status)
    {
        Log::info('WhatsApp status update', ['status' => $status]);

        // Save the status to cache
        Cache::put('whatsapp_status', $status, now()->addMinutes(1));

        // Update local property
        $this->status = $status;

        return response()->json(['status' => 'success', 'message' => 'Status updated']);
    }

}
