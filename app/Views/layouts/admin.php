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
        <!-- Sidebar -->
        <aside class="w-72 bg-gradient-to-br from-[#0e4c92] to-[#0a386e] text-white flex-shrink-0 hidden md:flex flex-col transition-all duration-300 sticky top-0 h-screen overflow-hidden shadow-2xl z-30">
            <!-- Decorative Background Orbs -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-400/10 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>

            <!-- Logo Area -->
            <div class="h-20 flex items-center justify-center border-b border-white/10 relative z-10 backdrop-blur-sm flex-shrink-0">
                <span class="text-2xl font-bold tracking-wider flex items-center gap-3">
                    <div class="p-2 bg-white/10 rounded-lg backdrop-blur-md border border-white/20 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-200">IKP ADMIN</span>
                </span>
            </div>

            <!-- Nav Content -->
            <div class="flex-1 overflow-y-auto px-4 py-6 custom-scrollbar relative z-10" x-data="{ activeMenu: null, openDemo: false }">
                <nav class="space-y-4"> <!-- Increased spacing -->

                    <div>
                         <div class="px-4 mb-2 text-xs font-bold text-blue-200/60 uppercase tracking-widest">Utama</div>
                         <a href="<?= base_url('dashboard') ?>" class="group flex items-center px-4 py-3 text-white rounded-xl transition-all duration-300 hover:bg-white/10 border border-transparent hover:border-white/10 hover:shadow-lg hover:shadow-blue-900/20">
                            <svg class="w-5 h-5 mr-3 text-blue-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </div>

                    <div>
                        <div class="px-4 mb-2 text-xs font-bold text-blue-200/60 uppercase tracking-widest">Aplikasi</div>
                        <div class="space-y-1">
                            <!-- Survei Menu -->
                            <button @click="activeMenu = activeMenu === 'survei' ? null : 'survei'" :class="{'bg-white/5': activeMenu === 'survei'}" class="w-full flex items-center justify-between px-4 py-3 text-blue-100 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300 border border-transparent focus:outline-none group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-blue-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                    <span class="font-medium">Manajemen Survei</span>
                                </div>
                                <svg :class="{'rotate-180': activeMenu === 'survei'}" class="w-4 h-4 transition-transform transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="activeMenu === 'survei'" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="pl-4 pr-2 space-y-1 pt-1 opacity-90">
                                <a href="<?= base_url('admin/responden') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Data Responden
                                </a>
                                <a href="<?= base_url('admin/laporan') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Laporan IKM
                                </a>
                            </div>

                            <!-- Master Data Menu -->
                            <button @click="activeMenu = activeMenu === 'master' ? null : 'master'" :class="{'bg-white/5': activeMenu === 'master'}" class="w-full mt-2 flex items-center justify-between px-4 py-3 text-blue-100 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300 border border-transparent focus:outline-none group">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-blue-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                    </svg>
                                    <span class="font-medium">Master Data</span>
                                </div>
                                <svg :class="{'rotate-180': activeMenu === 'master'}" class="w-4 h-4 transition-transform transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="activeMenu === 'master'" x-transition class="pl-4 pr-2 space-y-1 pt-1 opacity-90">
                                <a href="<?= base_url('admin/master/unit') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Unit Layanan
                                </a>
                                <a href="<?= base_url('admin/master/pertanyaan') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Pertanyaan Survei
                                </a>
                                <a href="<?= base_url('admin/master/jawaban') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Opsi Jawaban
                                </a>
                                <a href="<?= base_url('admin/master/instansi') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Instansi
                                </a>
                                <!-- Demografi Nested -->
                                <div class="pt-1">
                                    <button @click="openDemo = !openDemo" class="w-full flex items-center justify-between px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                        <div class="flex items-center">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> 
                                            <span>Demografi</span>
                                        </div>
                                        <svg :class="{'rotate-180': openDemo}" class="w-3 h-3 transition-transform transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div x-show="openDemo" class="pl-8 space-y-1 mt-1 border-l border-white/10 ml-5">
                                        <a href="<?= base_url('admin/master/pendidikan') ?>" class="block px-3 py-1.5 text-xs text-blue-300 hover:text-white transition-colors">Pendidikan</a>
                                        <a href="<?= base_url('admin/master/pekerjaan') ?>" class="block px-3 py-1.5 text-xs text-blue-300 hover:text-white transition-colors">Pekerjaan</a>
                                    </div>
                                </div>
                                <a href="<?= base_url('admin/master/unsur') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Unsur Pelayanan
                                </a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="px-4 mb-2 text-xs font-bold text-blue-200/60 uppercase tracking-widest">Pengaturan</div>
                         <button @click="activeMenu = activeMenu === 'settings' ? null : 'settings'" :class="{'bg-white/5': activeMenu === 'settings'}" class="w-full flex items-center justify-between px-4 py-3 text-blue-100 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300 border border-transparent focus:outline-none group">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium">Konfigurasi</span>
                            </div>
                            <svg :class="{'rotate-180': activeMenu === 'settings'}" class="w-4 h-4 transition-transform transform opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="activeMenu === 'settings'" x-transition class="pl-4 pr-2 space-y-1 pt-1 opacity-90">
                            <a href="<?= base_url('admin/users') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Manajemen User
                            </a>
                            <a href="<?= base_url('admin/about') ?>" class="flex items-center px-4 py-2 text-sm text-blue-200 hover:text-white hover:bg-white/5 rounded-lg transition-colors border-l-2 border-transparent hover:border-blue-300">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2.5"></span> Profil Aplikasi
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-white/10 bg-black/20 relative z-10 backdrop-blur-sm flex-shrink-0">
                <a href="<?= base_url('logout') ?>" class="flex items-center px-4 py-3 text-red-100 hover:text-white hover:bg-red-500/20 rounded-xl transition-all duration-300 group border border-transparent hover:border-red-500/30">
                    <div class="p-1.5 bg-red-500/10 rounded-lg mr-3 group-hover:bg-red-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 bg-gray-50/50">
            <!-- Glass Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-200/60 flex items-center justify-between px-6 lg:px-8 z-20 sticky top-0 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <button class="md:hidden p-2 -ml-2 text-gray-500 hover:text-[#0e4c92] hover:bg-blue-50 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div>
                        <div class="font-bold text-gray-800 text-lg leading-tight md:hidden">IKP Admin</div>
                        <div class="hidden md:block font-bold text-[#0e4c92] text-xl tracking-tight">Panel Administrasi</div>
                        <div class="hidden md:block text-xs text-gray-400 font-medium">Sistem Informasi Indeks Kepuasan Pelayanan</div>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Notification Bell (Example) -->
                    <button class="relative p-2 text-gray-400 hover:text-[#0e4c92] transition-colors rounded-full hover:bg-blue-50">
                        <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>

                    <div class="flex items-center gap-4 pl-6 border-l border-gray-100">
                        <div class="text-right hidden sm:block">
                            <div class="font-bold text-gray-800 text-sm"><?= session()->get('name') ?? 'Administrator' ?></div>
                            <div class="text-xs text-[#0e4c92] font-semibold bg-blue-50 px-2 py-0.5 rounded-full inline-block mt-0.5">Super Admin</div>
                        </div>
                        <div class="h-11 w-11 rounded-full bg-gradient-to-br from-[#0e4c92] to-[#0a386e] p-0.5 shadow-md hover:shadow-lg transition-shadow cursor-pointer group">
                            <div class="h-full w-full rounded-full bg-white flex items-center justify-center text-[#0e4c92] font-bold text-lg group-hover:bg-blue-50 transition-colors">
                                <?= substr(session()->get('name') ?? 'A', 0, 1) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-8 scroll-smooth">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
</body>

</html>