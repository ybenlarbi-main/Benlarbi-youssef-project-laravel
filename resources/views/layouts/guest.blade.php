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
    <body class="font-inter text-neutral-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-neutral-50 via-white to-brand-50 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,_rgba(12,140,233,0.1)_1px,_transparent_0)] bg-[length:32px_32px] pointer-events-none"></div>

            <!-- Floating Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-gradient-to-br from-brand-200 to-purple-200 rounded-full opacity-60 animate-float"></div>
            <div class="absolute bottom-10 right-10 w-16 h-16 bg-gradient-to-br from-success-200 to-brand-200 rounded-full opacity-50 animate-float" style="animation-delay: -1s;"></div>
            <div class="absolute top-1/2 right-20 w-12 h-12 bg-gradient-to-br from-purple-200 to-error-200 rounded-full opacity-40 animate-float" style="animation-delay: -2s;"></div>

            <div class="relative z-10">
                <a href="/" class="group">
                    <div class="flex items-center justify-center space-x-3 mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-brand-500 via-brand-600 to-purple-600 rounded-3xl flex items-center justify-center text-white font-bold text-2xl shadow-large group-hover:shadow-glow-brand transition-all duration-300 group-hover:scale-105">
                            <span class="animate-float">SN</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-neutral-800 to-neutral-600 bg-clip-text text-transparent group-hover:from-brand-600 group-hover:to-purple-600 transition-all duration-300">
                                Social Network
                            </h1>
                            <p class="text-sm text-neutral-500 font-medium">Connect & Share Moments</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/90 backdrop-blur-md shadow-large border border-neutral-200/60 overflow-hidden rounded-3xl relative z-10">
                <div class="animate-fade-in">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center relative z-10">
                <p class="text-xs text-neutral-500">
                    Made with ❤️ for connecting people
                </p>
            </div>
        </div>
    </body>
</html>
