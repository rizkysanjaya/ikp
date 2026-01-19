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
                    <?= date('d F Y') ?>
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
                <p class="text-3xl font-bold text-gray-900"><?= number_format($totalSurvei) ?></p>
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
                <p class="text-3xl font-bold text-gray-900"><?= number_format($totalUnit) ?></p>
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
                <p class="text-3xl font-bold text-gray-900"><?= number_format($todaySurvei) ?></p>
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($unitData as $unit): ?>
            <?php
            // Logika Warna Dinamis
            $colorClass = match ($unit['mutu']) {
                'A' => 'emerald',
                'B' => 'blue',
                'C' => 'yellow',
                'D' => 'red',
                default => 'gray',
            };
            ?>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group h-full flex flex-col">

                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-<?= $colorClass ?>-500"></div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-4 pl-2">
                        <div class="flex-1 pr-4">
                            <div class="h-20 flex items-start overflow-hidden">
                                <h3 class="text-lg font-bold text-gray-800 leading-snug group-hover:text-<?= $colorClass ?>-600 transition-colors line-clamp-3">
                                    <?= esc($unit['nama_layanan']) ?>
                                </h3>
                            </div>
                            <p class="text-xs text-gray-400 mt-2 uppercase tracking-wider font-semibold">Unit Pelayanan</p>
                        </div>

                        <div class="w-10 h-10 rounded-full bg-<?= $colorClass ?>-50 flex items-center justify-center text-<?= $colorClass ?>-600 shadow-sm flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-auto pl-2">
                        <div class="flex items-end justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-400 mb-1">Nilai IKM</p>
                                <div class="flex items-baseline">
                                    <span class="text-5xl font-black text-gray-900 tracking-tight">
                                        <?= esc($unit['ikm_score']) ?>
                                    </span>
                                    <span class="text-sm text-gray-400 font-medium ml-1 mb-2">/100</span>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 rounded-2xl bg-<?= $colorClass ?>-500 text-white flex items-center justify-center shadow-lg shadow-<?= $colorClass ?>-200 transform group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-3xl font-bold"><?= esc($unit['mutu']) ?></span>
                                </div>
                                <span class="text-xs font-bold text-<?= $colorClass ?>-600 mt-2 uppercase"><?= esc($unit['ket']) ?></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-gray-50/80 px-6 py-3 border-t border-gray-100 flex items-center justify-between text-sm pl-8">
                    <div class="flex items-center text-gray-500">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="font-bold text-gray-700 mr-1"><?= number_format($unit['total_responden']) ?></span> Responden
                    </div>
                    <a href="#" class="text-<?= $colorClass ?>-600 hover:text-<?= $colorClass ?>-700 font-medium text-xs flex items-center transition-colors">
                        Detail
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<?= $this->endSection() ?>