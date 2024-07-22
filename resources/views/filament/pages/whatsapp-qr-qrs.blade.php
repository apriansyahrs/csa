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

    <script>
        async function fetchStatusAndQRCode() {
            try {
                const response = await fetch('{{ url("/api/whatsapp-status-qr") }}');
                const data = await response.json();

                const statusMessage = document.getElementById('status-message');
                const qrCodeContainer = document.getElementById('qr-code-container');

                if (data.connectionStatus === 'connected') {
                    statusMessage.innerHTML = '<p>You are connected!</p>';
                    qrCodeContainer.innerHTML = '';
                } else if (data.connectionStatus === 'disconnected') {
                    statusMessage.innerHTML = '<p>You are disconnected!</p>';
                    if (data.qrCode) {
                        qrCodeContainer.innerHTML = `<img src="data:image/png;base64,${data.qrCode}" alt="QR Code">`;
                    } else {
                        qrCodeContainer.innerHTML = '<p>No QR code available. Please check the connection.</p>';
                    }
                }
            } catch (error) {
                console.error('Error fetching status and QR code:', error);
            }
        }

        // Polling every 5 seconds
        setInterval(fetchStatusAndQRCode, 5000);

        // Initial fetch
        fetchStatusAndQRCode();
    </script>
</x-filament::page>
