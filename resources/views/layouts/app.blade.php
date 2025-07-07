<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-inter antialiased bg-gradient-to-br from-neutral-50 via-white to-neutral-100 min-h-screen">
        <!-- Toast Notification Container -->
        <div id="toast-container" class="fixed top-6 right-6 z-50 space-y-3" role="region" aria-label="Notifications"></div>

        <!-- Loading Overlay -->
        <div id="loading-overlay" class="fixed inset-0 bg-neutral-900/60 backdrop-blur-sm z-40 hidden items-center justify-center">
            <div class="bg-white rounded-2xl p-8 shadow-large border border-neutral-200 max-w-sm mx-4">
                <div class="flex items-center space-x-4">
                    <div class="loading-spinner"></div>
                    <div>
                        <div class="text-neutral-800 font-semibold">Processing...</div>
                        <div class="text-neutral-500 text-sm">Please wait a moment</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="min-h-screen bg-gradient-to-br from-neutral-50 via-white to-neutral-100 relative">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,_rgba(156,163,175,0.15)_1px,_transparent_0)] bg-[length:24px_24px] pointer-events-none"></div>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-neutral-200/60 sticky top-0 z-30 shadow-soft">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="animate-fade-in">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-12 relative z-10">
                <div class="animate-fade-in">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer Gradient -->
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-neutral-100/50 to-transparent pointer-events-none"></div>
        </div>

        <!-- Session Messages as Toast -->
        @if(session('success') || session('error') || session('info'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if(session('success'))
                        showToast('{!! addslashes(session('success')) !!}', 'success');
                    @endif
                    @if(session('error'))
                        showToast('{!! addslashes(session('error')) !!}', 'error');
                    @endif
                    @if(session('info'))
                        showToast('{!! addslashes(session('info')) !!}', 'info');
                    @endif
                });
            </script>
        @endif
    </body>
</html>
