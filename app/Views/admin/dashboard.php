<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto">

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-[#0e4c92] to-[#0a386e] rounded-3xl p-8 mb-10 overflow-hidden shadow-xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-400/20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Overview</h1>
                <p class="mt-2 text-blue-100 text-lg">Selamat datang kembali, <span class="font-bold text-white"><?= esc($username) ?></span>! Berikut laporan terkini.</p>
            </div>
            <div class="hidden md:block">
                <div class="inline-flex items-center px-5 py-2.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white shadow-lg">
                    <svg class="w-5 h-5 mr-3 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span id="current-date" class="font-medium tracking-wide"><?= date('d F Y') ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

        <!-- Card 1 -->
        <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group relative overflow-hidden">
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            <div class="p-4 rounded-2xl bg-blue-50 text-blue-600 mr-5 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Survei</p>
                <p class="text-4xl font-extrabold text-gray-800" id="val-total-survei"><?= number_format($totalSurvei) ?></p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group relative overflow-hidden">
             <div class="absolute bottom-0 left-0 w-full h-1 bg-emerald-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            <div class="p-4 rounded-2xl bg-emerald-50 text-emerald-600 mr-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Unit Layanan</p>
                <p class="text-4xl font-extrabold text-gray-800" id="val-total-unit"><?= number_format($totalUnit) ?></p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group relative overflow-hidden">
             <div class="absolute bottom-0 left-0 w-full h-1 bg-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
            <div class="p-4 rounded-2xl bg-orange-50 text-orange-600 mr-5 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-1">Responden Hari Ini</p>
                <p class="text-4xl font-extrabold text-gray-800" id="val-today-survei"><?= number_format($todaySurvei) ?></p>
            </div>
        </div>
    </div>

    <!-- NEW: Global IKM Score Banner -->
    <div class="mb-12">
        <div class="bg-gradient-to-r from-white to-blue-50/50 rounded-3xl p-8 border border-blue-100 shadow-xl shadow-blue-900/5 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 group">
             <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:20px_20px] opacity-[0.05]"></div>
            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
            
            <div class="text-center md:text-left relative z-10 md:w-1/2">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-3">
                    Laporan Akumulatif <?= $currentYear ?>
                </span>
                <h2 class="text-3xl font-black text-gray-900 leading-tight mb-2">
                    Skor IKM Global
                </h2>
                <p class="text-gray-500 text-sm">
                    Nilai rata-rata kepuasan masyarakat dari seluruh unit layanan di Kantor Regional III BKN.
                </p>
            </div>

            <div class="relative z-10 flex items-center justify-center md:justify-end gap-6 md:w-1/2">
                <!-- Score -->
                <div class="text-right">
                     <span class="block text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">
                        <?= $globalStats['ikm_formatted'] ?>
                    </span>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Skala 100</span>
                </div>

                <!-- Divider -->
                <div class="w-px h-16 bg-gray-200"></div>

                <!-- Grade -->
                <div>
                     <span class="block text-4xl font-black text-<?= $globalStats['class_color'] ?>-500">
                        <?= $globalStats['mutu'] ?>
                    </span>
                    <span class="inline-block px-2 py-1 bg-<?= $globalStats['class_color'] ?>-50 text-<?= $globalStats['class_color'] ?>-700 text-xs font-bold rounded border border-<?= $globalStats['class_color'] ?>-100 mt-1">
                        <?= $globalStats['ket'] ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Header & Legend -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 px-2">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Performa Unit Layanan</h2>
            <p class="text-gray-500 mt-1 text-sm bg-gray-50 inline-block px-3 py-1 rounded-full border border-gray-100">Pantauan real-time indeks kepuasan</p>
        </div>
        
        <div class="mt-4 md:mt-0 bg-white/80 backdrop-blur-sm p-1.5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-1">
            <div class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100 flex items-center">
                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>A (Sangat Baik)
            </div>
            <div class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100 flex items-center">
                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>B (Baik)
            </div>
            <div class="px-3 py-1.5 rounded-lg bg-yellow-50 text-yellow-700 text-xs font-bold border border-yellow-100 flex items-center">
                <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>C (Kurang)
            </div>
            <div class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700 text-xs font-bold border border-red-100 flex items-center">
                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>D (Tidak Baik)
            </div>
        </div>
    </div>

    <div id="unit-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?= $this->include('admin/partials/unit_cards') ?>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Fungsi Fetch Data Terbaru
        async function fetchRealtimeData() {
            try {
                // Request ke Controller
                const response = await fetch('<?= base_url('dashboard/getUpdates') ?>');

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                // 1. Update Angka Statistik (Header)
                document.getElementById('val-total-survei').innerText = data.totalSurvei;
                document.getElementById('val-total-unit').innerText = data.totalUnit;
                document.getElementById('val-today-survei').innerText = data.todaySurvei;

                // 2. Update Grid Kartu Unit (Replace HTML Content)
                document.getElementById('unit-cards-container').innerHTML = data.htmlUnits;

            } catch (error) {
                console.error('Gagal mengambil data realtime:', error);
            }
        }

        // Jalankan polling setiap 5 detik (5000 milidetik)
        setInterval(fetchRealtimeData, 5000);
    });
</script>

<?= $this->endSection() ?>