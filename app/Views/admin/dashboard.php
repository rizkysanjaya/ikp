<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto">
    <!-- Welcome Card -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-[#0e4c92] mb-8">
        <div class="p-8 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    <p class="mt-2 text-gray-600">Selamat datang kembali, <span class="font-bold text-[#0e4c92]"><?= esc($username) ?></span>!</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-full">
                    <svg class="w-8 h-8 text-[#0e4c92]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid (Placeholder) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Survei</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">0</div>
        </div>
        <!-- Stat 2 -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Unit Layanan</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">6</div>
        </div>
        <!-- Stat 3 -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Responden Hari Ini</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">0</div>
        </div>
    </div>

    <!-- Unit Performance Grid -->
    <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">Rekapitulasi Nilai IKP Per Unit</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Unit 1: Sistem Informasi -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-700">Sistem Informasi</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">88.50</span>
                        <span class="ml-2 text-sm font-medium text-green-600 bg-green-100 px-2 py-0.5 rounded-full">Mutu A</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Sangat Baik</p>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                120 Responden
            </div>
        </div>

        <!-- Unit 2: Pengangkatan & Mutasi -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-700">Pengangkatan & Mutasi</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">82.10</span>
                        <span class="ml-2 text-sm font-medium text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Mutu B</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Baik</p>
                </div>
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                95 Responden
            </div>
        </div>

        <!-- Unit 3: Status & Pemberhentian -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-700">Status & Pemberhentian</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">90.00</span>
                        <span class="ml-2 text-sm font-medium text-green-600 bg-green-100 px-2 py-0.5 rounded-full">Mutu A</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Sangat Baik</p>
                </div>
                <div class="p-2 bg-yellow-50 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                150 Responden
            </div>
        </div>

        <!-- Unit 4: Manajemen ASN -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-700">Manajemen ASN</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">78.50</span>
                        <span class="ml-2 text-sm font-medium text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Mutu B</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Baik</p>
                </div>
                <div class="p-2 bg-purple-50 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                60 Responden
            </div>
        </div>

        <!-- Unit 5: Pengawasan -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-700">Pengawasan</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">85.00</span>
                        <span class="ml-2 text-sm font-medium text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Mutu B</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Baik</p>
                </div>
                <div class="p-2 bg-red-50 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                45 Responden
            </div>
        </div>

        <!-- Unit 6: Narasumber -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-gray-700">Narasumber</h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">92.00</span>
                        <span class="ml-2 text-sm font-medium text-green-600 bg-green-100 px-2 py-0.5 rounded-full">Mutu A</span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Sangat Baik</p>
                </div>
                <div class="p-2 bg-orange-50 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                30 Responden
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>