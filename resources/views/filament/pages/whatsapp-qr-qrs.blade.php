<x-filament::page>
    <div class="flex min-h-full flex-grow flex-col">
        <div class="grid lg:grid-cols-12 gap-5">
            <div class="lg:col-span-5">
                <div class="bg-white dark:bg-gray-800 w-full border p-3 dark:border-gray-800 rounded-xl overflow-hidden">
                    <div class="flex justify-end">
                        <div id="indicator-status-online" class="bg-green-400/40 {{ $status === 'connected' ? '' : 'hidden' }} text-green-600 rounded-full p-1 px-3 text-[12px] font-semibold">Online</div>
                        <div id="indicator-status-offline" class="bg-slate-400/40 {{ $status !== 'connected' ? '' : 'hidden' }} text-slate-600 rounded-full p-1 px-3 text-[12px] font-semibold">Offline</div>
                    </div>
                    <div class="flex items-center justify-center py-3">
                        @if ($qrCode)
                            <img class="max-w-full max-h-full" src="{{ $qrCode }}" id="qrpreview" alt="WhatsApp QR Code">
                        @else
                            <div class="py-20 flex items-center text-slate-800" id="display_error">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 12l5 5l-1.5 1.5a3.536 3.536 0 1 1 -5 -5l1.5 -1.5z"></path>
                                    <path d="M17 12l-5 -5l1.5 -1.5a3.536 3.536 0 1 1 5 5l-1.5 1.5z"></path>
                                    <path d="M3 21l2.5 -2.5"></path>
                                    <path d="M18.5 5.5l2.5 -2.5"></path>
                                    <path d="M10 11l-2 2"></path>
                                    <path d="M13 14l-2 2"></path>
                                    <path d="M12 6l0 -3"></path>
                                    <path d="M16.25 7.75l2.15 -2.15"></path>
                                    <path d="M18 12l3 0"></path>
                                    <path d="M16.25 16.25l2.15 2.15"></path>
                                    <path d="M12 18l0 3"></path>
                                    <path d="M7.75 16.25l-2.15 2.15"></path>
                                    <path d="M6 12l-3 0"></path>
                                    <path d="M7.75 7.75l-2.15 -2.15"></path>
                                </svg>
                                <div class="ml-1.5">No QR code available.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="lg:col-span-7">
                <div class="bg-white dark:bg-gray-800 w-full border px-5 pb-5 pt-7 dark:border-gray-800 rounded-xl overflow-hidden">
                    <form id="send-message" action="{{ url('api/send-message') }}" method="POST">
                        @csrf
                        <div class="relative rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 shadow-sm focus-within:border-gray-600 focus-within:ring-0 focus-within:ring-gray-600">
                            <label class="absolute -top-2 left-2 -mt-px inline-block bg-white dark:bg-gray-800 px-1 text-xs font-medium text-gray-900 dark:text-gray-50">Recipient</label>
                            <input placeholder="Enter recipient's phone number" autocomplete="off" value="" type="text" name="recipient" class="block w-full py-1 border-0 p-0 text-gray-900 dark:text-gray-50 bg-transparent placeholder-gray-500 dark:placeholder-gray-400 focus:ring-0 sm:text-sm" required>
                        </div>
                        <div class="relative rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 shadow-sm focus-within:border-gray-600 focus-within:ring-0 focus-within:ring-gray-600 mt-5">
                            <label class="absolute -top-2 left-2 -mt-px inline-block bg-white dark:bg-gray-800 px-1 text-xs font-medium text-gray-900 dark:text-gray-50">Message</label>
                            <textarea placeholder="Enter your message" autocomplete="off" name="message" class="block w-full py-1 border-0 p-0 text-gray-900 dark:text-gray-50 bg-transparent placeholder-gray-500 dark:placeholder-gray-400 focus:ring-0 sm:text-sm" required></textarea>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button class="bg-primary-500 disabled:bg-primary-400 flex justify-center items-center py-2 px-4 font-semibold text-sm rounded-full text-white" type="submit">
                                Send Message
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l14 0"></path>
                                    <path d="M13 18l6 -6"></path>
                                    <path d="M13 6l6 6"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
