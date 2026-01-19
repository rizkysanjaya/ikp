<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-50 to-transparent rounded-full -mr-16 -mt-16 opacity-60 pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="mt-1 text-gray-600">Selamat datang kembali, <span class="font-bold text-[#0e4c92]"><?= esc($username) ?></span>!</p>
            </div>
            <div class="hidden sm:block">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span id="current-date"><?= date('d F Y') ?></span>
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
            <div class="p-4 rounded-full bg-blue-50 text-blue-600 mr-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Survei Masuk</p>
                <p class="text-3xl font-bold text-gray-900" id="val-total-survei"><?= number_format($totalSurvei) ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
            <div class="p-4 rounded-full bg-green-50 text-green-600 mr-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Unit Layanan Aktif</p>
                <p class="text-3xl font-bold text-gray-900" id="val-total-unit"><?= number_format($totalUnit) ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center transition-all duration-300 hover:shadow-md hover:-translate-y-1">
            <div class="p-4 rounded-full bg-orange-50 text-orange-600 mr-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Responden Hari Ini</p>
                <p class="text-3xl font-bold text-gray-900" id="val-today-survei"><?= number_format($todaySurvei) ?></p>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 mt-12 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Performa Unit Layanan</h2>
            <p class="text-gray-500 mt-1">Pantauan real-time indeks kepuasan per unit kerja</p>
        </div>
        <div class="flex gap-3 text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100 self-start md:self-auto">
            <div class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 mr-2"></span>A</div>
            <div class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 mr-2"></span>B</div>
            <div class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-yellow-500 mr-2"></span>C</div>
            <div class="flex items-center"><span class="w-2.5 h-2.5 rounded-full bg-red-500 mr-2"></span>D</div>
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