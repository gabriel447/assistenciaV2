<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            
            <!-- Hero Section -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl shadow-xl overflow-hidden relative ring-1 ring-black/5">
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 mix-blend-soft-light"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="relative p-6 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-white space-y-2 text-center md:text-left z-10">
                        <h3 class="text-2xl font-black tracking-tight drop-shadow-sm">
                            Olá, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                        </h3>
                        <p class="text-blue-100 text-sm font-medium max-w-xl leading-relaxed drop-shadow-sm opacity-90">
                            Bem-vindo ao seu painel. Tudo pronto para gerenciar seus serviços hoje?
                        </p>
                    </div>
                    <div class="hidden md:block z-10">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-3 border border-white/20 shadow-lg hover:bg-white/15 transition duration-300">
                            <div class="text-blue-100 text-[10px] font-bold uppercase tracking-widest mb-1">Data de Hoje</div>
                            <div class="text-white text-xl font-black tracking-tight">{{ now()->format('d/m') }}</div>
                            <div class="text-blue-50 text-xs font-medium">{{ now()->translatedFormat('l') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Card Clientes -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-lg hover:border-blue-500/20 transition-all duration-300 group">
                    <div class="p-2 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide leading-tight">Total de<br>Clientes</p>
                        <p class="text-xl font-black text-gray-800">{{ $clientesCount ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card Manutenções -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-lg hover:border-green-500/20 transition-all duration-300 group">
                    <div class="p-2 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide leading-tight">Total de<br>Serviços</p>
                        <p class="text-xl font-black text-gray-800">{{ $manutencoesCount ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card Concluídos -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-lg hover:border-purple-500/20 transition-all duration-300 group">
                    <div class="p-2 bg-purple-50 rounded-xl text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide leading-tight">Serviços<br>Concluídos</p>
                        <p class="text-xl font-black text-gray-800">{{ $manutencoesConcluidas ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card Pendentes -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-lg hover:border-orange-500/20 transition-all duration-300 group">
                    <div class="p-2 bg-orange-50 rounded-xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide leading-tight">Serviços em<br>Andamento</p>
                        <p class="text-xl font-black text-gray-800">{{ $manutencoesPendentes ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card Mão de Obra -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-lg hover:border-emerald-500/20 transition-all duration-300 group">
                    <div class="p-2 bg-emerald-50 rounded-xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide leading-tight">Total em Mão<br>de Obra</p>
                        <p class="text-xl font-black text-emerald-600 whitespace-nowrap">
                            <span class="mr-1">R$</span>{{ number_format($totalMaodeobra ?? 0, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- Card Peças -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-lg hover:border-rose-500/20 transition-all duration-300 group">
                    <div class="p-2 bg-rose-50 rounded-xl text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide leading-tight">Total em<br>Peças</p>
                        <p class="text-xl font-black text-rose-600 whitespace-nowrap">
                            <span class="mr-1">R$</span>{{ number_format($totalPecas ?? 0, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Gerenciar Clientes -->
                <a href="{{ route('clientes.index') }}" class="group bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:border-blue-500/30 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Clientes</h3>
                        <p class="text-xs text-gray-500">Gerenciar base de clientes</p>
                    </div>
                    <div class="ml-auto text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <!-- Gerenciar Manutenções -->
                <a href="{{ route('manutencoes.index') }}" class="group bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:border-green-500/30 hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300 flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shadow-sm shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition-colors">Manutenções</h3>
                        <p class="text-xs text-gray-500">Controle de ordens de serviço</p>
                    </div>
                    <div class="ml-auto text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>