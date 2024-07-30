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

    protected function getViewData(): array
    {
        $qrCodeString = Cache::get('whatsapp-qr');
        $connectionStatus = Cache::get('whatsapp-status');
        $dataUri = null;

        if ($qrCodeString && $connectionStatus !== 'connected') {
            Log::info('QR Code retrieved from cache: ' . $qrCodeString);

            // Generate QR code image in base64 format
            $qrCode = QrCode::create($qrCodeString);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // Convert to data URI format
            $dataUri = $result->getDataUri();
        } elseif ($connectionStatus === 'connected') {
            Log::info('Connection status retrieved from cache: ' . $connectionStatus);
        } else {
            Log::warning('No QR code or connection status found in cache');
        }

        return [
            'qrCode' => $dataUri,
            'connectionStatus' => $connectionStatus,
        ];
    }

}
