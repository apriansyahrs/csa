<x-filament::page>
    <div class="p-6">
        <h1 class="text-2xl font-semibold">WhatsApp QR Code</h1>
        @if($connectionStatus === 'connected')
            <p>You are connected!</p>
        @elseif($connectionStatus === 'disconnected')
            <p>You are disconnected!</p>
        @elseif($qrCode)
            <img src="{{ $qrCode }}" alt="QR Code">
        @else
            <p>No QR code available. Please check the connection.</p>
        @endif
    </div>

</x-filament::page>
