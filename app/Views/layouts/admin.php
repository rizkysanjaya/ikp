<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - IKP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-[#0e4c92] text-white flex-shrink-0 hidden md:flex flex-col transition-all duration-300">
            <div class="h-16 flex items-center justify-center border-b border-blue-800 shadow-sm">
                <span class="text-xl font-bold tracking-wider flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    IKP ADMIN
                </span>
            </div>

            <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">
                <nav class="space-y-1" x-data="{ openSurvei: false, openMaster: false, openDemo: false, openSettings: false }">

                    <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-3 bg-blue-800/50 hover:bg-blue-800 text-white rounded-lg transition-colors shadow-sm mb-4 border border-blue-700/30">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <div class="px-4 pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase tracking-wider">
                        Main Menu
                    </div>

                    <div class="space-y-1">
                        <button @click="openSurvei = !openSurvei" class="w-full flex items-center justify-between px-4 py-2.5 text-blue-100 hover:bg-blue-800 hover:text-white rounded-lg transition-colors focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                <span class="font-medium">Survei</span>
                            </div>
                            <svg :class="{'rotate-180': openSurvei}" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="openSurvei" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="pl-11 pr-2 space-y-1">
                            <a href="<?= base_url('penilaian') ?>" class="block px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Input Survei Baru
                            </a>
                            <a href="<?= base_url('responden') ?>" class="block px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Data Responden
                            </a>
                            <a href="<?= base_url('laporan') ?>" class="block px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Laporan IKM
                            </a>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <button @click="openMaster = !openMaster" class="w-full flex items-center justify-between px-4 py-2.5 text-blue-100 hover:bg-blue-800 hover:text-white rounded-lg transition-colors focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                                <span class="font-medium">Master Data</span>
                            </div>
                            <svg :class="{'rotate-180': openMaster}" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="openMaster" x-transition class="pl-4 pr-2 space-y-1">
                            <a href="<?= base_url('unit') ?>" class="flex items-center px-3 py-2 pl-8 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Unit Layanan
                            </a>
                            <a href="<?= base_url('soal') ?>" class="flex items-center px-3 py-2 pl-8 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Pertanyaan Survei
                            </a>
                            <a href="<?= base_url('instansi') ?>" class="flex items-center px-3 py-2 pl-8 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Instansi
                            </a>

                            <div>
                                <button @click="openDemo = !openDemo" class="w-full flex items-center justify-between px-3 py-2 pl-8 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                    <span>Data Demografi</span>
                                    <svg :class="{'rotate-180': openDemo}" class="w-3 h-3 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openDemo" class="pl-4 space-y-1 mt-1 border-l border-blue-700 ml-8">
                                    <a href="<?= base_url('pendidikan') ?>" class="block px-3 py-1.5 text-sm text-blue-300 hover:text-white transition-colors">Pendidikan</a>
                                    <a href="<?= base_url('pekerjaan') ?>" class="block px-3 py-1.5 text-sm text-blue-300 hover:text-white transition-colors">Pekerjaan</a>
                                </div>
                            </div>

                            <a href="<?= base_url('unsur') ?>" class="flex items-center px-3 py-2 pl-8 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Unsur Pelayanan
                            </a>
                        </div>
                    </div>

                    <div class="px-4 pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase tracking-wider">
                        System
                    </div>

                    <div class="space-y-1">
                        <button @click="openSettings = !openSettings" class="w-full flex items-center justify-between px-4 py-2.5 text-blue-100 hover:bg-blue-800 hover:text-white rounded-lg transition-colors focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium">Pengaturan</span>
                            </div>
                            <svg :class="{'rotate-180': openSettings}" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="openSettings" x-transition class="pl-11 pr-2 space-y-1">
                            <a href="<?= base_url('users') ?>" class="block px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Manajemen User
                            </a>
                            <a href="<?= base_url('profil') ?>" class="block px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-700/50 rounded-md transition-colors">
                                Profil Aplikasi
                            </a>
                        </div>
                    </div>

                </nav>
            </div>

            <div class="p-4 border-t border-blue-800 bg-blue-900/20">
                <a href="<?= base_url('logout') ?>" class="flex items-center px-4 py-2 text-blue-200 hover:text-white hover:bg-red-600/80 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 lg:px-8 z-10 sticky top-0">
                <div class="flex items-center gap-3">
                    <button class="md:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="font-semibold text-gray-700 md:hidden">IKP Admin</div>
                    <div class="hidden md:block font-semibold text-gray-500">Panel Administrasi</div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-sm text-right hidden sm:block">
                        <div class="font-medium text-gray-900"><?= session()->get('name') ?? 'Administrator' ?></div>
                        <div class="text-xs text-gray-500">Super Admin</div>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-[#0e4c92] font-bold border border-blue-200 shadow-sm">
                        <?= substr(session()->get('name') ?? 'A', 0, 1) ?>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-50 p-6 lg:p-8">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
</body>

</html>