<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gestão - AssistenciaV2</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans selection:bg-red-500 selection:text-white overflow-hidden">

    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-red-500/20 rounded-full blur-3xl opacity-30 pointer-events-none mix-blend-screen"></div>
        <div class="absolute bottom-0 right-0 w-[800px] h-[600px] bg-blue-500/10 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
    </div>

    <div class="relative min-h-screen flex flex-col items-center justify-center p-6 sm:p-12">
        
        <!-- Main Card -->
        <div class="w-full max-w-4xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden p-8 sm:p-16 flex flex-col items-center text-center transform transition-all hover:scale-[1.01] duration-500">
            
            <!-- Logo Section -->
            <div class="mb-10 relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-600 rounded-full blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative p-6 bg-white dark:bg-gray-900 rounded-full ring-1 ring-gray-900/5 dark:ring-white/10 shadow-xl">
                    <x-application-logo class="w-20 h-20 fill-current text-red-600" />
                </div>
            </div>

            <!-- Typography -->
            <div class="space-y-6 max-w-2xl mx-auto mb-12">
                <h1 class="text-4xl sm:text-6xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                    Sistema de Gestão
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 font-medium leading-relaxed">
                    Bem-vindo ao <span class="text-red-600 dark:text-red-400 font-bold">AssistenciaV2</span>. 
                    <br class="hidden sm:block" />
                    A solução completa para gerenciar seus clientes e manutenções com eficiência e agilidade.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-red-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 w-full sm:w-auto overflow-hidden">
                            <span class="absolute inset-0 w-full h-full -mt-10 transition-all duration-700 ease-out translate-x-12 rotate-45 bg-white opacity-10 group-hover:translate-x-0"></span>
                            <span class="relative flex items-center gap-2">
                                Acessar Dashboard
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold rounded-xl hover:bg-gray-800 dark:hover:bg-gray-200 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Entrar
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-transparent border-2 border-gray-200 dark:border-gray-700 hover:border-red-500 dark:hover:border-red-500 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 font-bold rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Cadastrar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Footer Info -->
            <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-700/50 w-full">
                <p class="text-sm text-gray-400 font-medium">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </p>
            </div>
        </div>
        
    </div>
</body>
</html>
