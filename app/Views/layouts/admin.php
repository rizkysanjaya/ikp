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
        <aside class="w-64 bg-[#0e4c92] text-white flex-shrink-0 hidden md:flex flex-col transition-all duration-300">
            <div class="h-16 flex items-center justify-center border-b border-blue-800 shadow-sm">
                <span class="text-xl font-bold tracking-wider">IKP ADMIN</span>
            </div>

            <div class="flex-1 overflow-y-auto p-4">
                <nav class="space-y-2" x-data="{ openSurvey: false, openData: false }">
                    <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-3 bg-blue-800 rounded-lg text-white transition-colors shadow-sm">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Penilaian -->
                    <a href="#" class="flex items-center px-4 py-3 text-blue-100 hover:bg-blue-800 hover:text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="font-medium">Penilaian</span>
                    </a>

                    <!-- Hasil Survey -->
                    <div>
                        <button @click="openSurvey = !openSurvey" class="w-full flex items-center justify-between px-4 py-3 text-blue-100 hover:bg-blue-800 hover:text-white rounded-lg transition-colors focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span class="font-medium">Hasil Survei</span>
                            </div>
                            <svg :class="{'rotate-180': openSurvey}" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="openSurvey" class="pl-11 pr-4 space-y-1 mt-1" style="display: none;">
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Sistem Informasi</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Pengangkatan & Mutasi</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Status & Pemberhentian</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Manajemen ASN</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Pengawasan</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Narasumber</a>
                        </div>
                    </div>

                    <!-- Kelola Data -->
                    <div>
                        <button @click="openData = !openData" class="w-full flex items-center justify-between px-4 py-3 text-blue-100 hover:bg-blue-800 hover:text-white rounded-lg transition-colors focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                                <span class="font-medium">Kelola Data</span>
                            </div>
                            <svg :class="{'rotate-180': openData}" class="w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="openData" class="pl-11 pr-4 space-y-1 mt-1" style="display: none;">
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Instansi</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Pendidikan</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Pekerjaan</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Soal</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Unit (Tim Kerja)</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Unsur Pelayanan</a>
                            <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white transition-colors">Opsi Jawaban</a>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="p-4 border-t border-blue-800">
                <a href="<?= base_url('logout') ?>" class="flex items-center px-4 py-2 text-blue-200 hover:text-white transition-colors group">
                    <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 lg:px-8 z-10">
                <div class="font-semibold text-gray-700 md:hidden">IKP Admin</div>
                <div class="hidden md:block font-semibold text-gray-500">Panel Administrasi</div>

                <div class="flex items-center space-x-4">
                    <div class="text-sm text-right hidden sm:block">
                        <div class="font-medium text-gray-900"><?= session()->get('name') ?? 'Administrator' ?></div>
                        <div class="text-xs text-gray-500">Super Admin</div>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-[#0e4c92] font-bold border border-blue-200">
                        <?= substr(session()->get('name') ?? 'A', 0, 1) ?>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6 lg:p-8">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
</body>

</html>