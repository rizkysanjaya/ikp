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