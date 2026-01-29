<?php foreach ($unitData as $unit): ?>
    <?php
    // Logika Warna Dinamis & Gradient
    $theme = match ($unit['mutu']) {
        'A' => ['bg' => 'bg-emerald-500', 'text' => 'text-emerald-600', 'light' => 'bg-emerald-50', 'gradient' => 'from-emerald-400 to-emerald-600', 'border' => 'border-emerald-100', 'shadow' => 'shadow-emerald-200'],
        'B' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-600', 'light' => 'bg-blue-50', 'gradient' => 'from-blue-400 to-blue-600', 'border' => 'border-blue-100', 'shadow' => 'shadow-blue-200'],
        'C' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-600', 'light' => 'bg-yellow-50', 'gradient' => 'from-yellow-400 to-yellow-600', 'border' => 'border-yellow-100', 'shadow' => 'shadow-yellow-200'],
        'D' => ['bg' => 'bg-red-500', 'text' => 'text-red-600', 'light' => 'bg-red-50', 'gradient' => 'from-red-400 to-red-600', 'border' => 'border-red-100', 'shadow' => 'shadow-red-200'],
        default => ['bg' => 'bg-gray-500', 'text' => 'text-gray-600', 'light' => 'bg-gray-50', 'gradient' => 'from-gray-400 to-gray-600', 'border' => 'border-gray-100', 'shadow' => 'shadow-gray-200'],
    };
    ?>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group h-full flex flex-col">
        <!-- Accent Bar -->
        <div class="absolute left-0 top-0 bottom-0 w-2 bg-gradient-to-b <?= $theme['gradient'] ?>"></div>
        
        <!-- Decoration Circle -->
        <div class="absolute top-0 right-0 w-32 h-32 <?= $theme['light'] ?> rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-150 transition-transform duration-700 ease-in-out"></div>

        <div class="p-7 flex-1 flex flex-col relative z-10">
            <div class="flex justify-between items-start mb-6">
                <div class="flex-1 pr-4">
                     <p class="text-xs text-gray-400 uppercase tracking-widest font-bold mb-2">Unit Pelayanan</p>
                    <div class="h-[4.5rem] flex items-start overflow-hidden">
                        <h3 class="text-xl font-extrabold text-gray-800 leading-snug group-hover:<?= $theme['text'] ?> transition-colors line-clamp-3">
                            <?= esc($unit['nama_layanan']) ?>
                        </h3>
                    </div>
                </div>
                 <div class="w-12 h-12 rounded-2xl <?= $theme['light'] ?> flex items-center justify-center <?= $theme['text'] ?> border <?= $theme['border'] ?> shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>

            <div class="mt-auto pt-4 border-t border-dashed border-gray-100">
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 mb-1">Nilai IKM</p>
                        <div class="flex items-baseline">
                            <span class="text-5xl font-black text-gray-900 tracking-tighter">
                                <?= esc($unit['ikm_score']) ?>
                            </span>
                            <span class="text-sm text-gray-400 font-bold ml-1 mb-1.5">/100</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-center group-hover:transform group-hover:scale-110 transition-transform duration-300">
                         <!-- Glowing Badge -->
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br <?= $theme['gradient'] ?> text-white flex items-center justify-center shadow-lg <?= $theme['shadow'] ?> ring-4 ring-white">
                            <span class="text-3xl font-black tracking-tight" style="text-shadow: 0 2px 4px rgba(0,0,0,0.1);"><?= esc($unit['mutu']) ?></span>
                        </div>
                        <span class="text-[10px] font-bold <?= $theme['text'] ?> mt-2 uppercase tracking-wide bg-white px-2 py-0.5 rounded-full border <?= $theme['border'] ?> shadow-sm"><?= esc($unit['ket']) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50/50 px-7 py-4 border-t border-gray-100 flex items-center justify-between text-sm backdrop-blur-sm">
            <div class="flex items-center text-gray-500">
                 <div class="flex -space-x-2 mr-3 overflow-hidden">
                    <div class="inline-block h-6 w-6 rounded-full ring-2 ring-white bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">
                         <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                     <div class="inline-block h-6 w-6 rounded-full ring-2 ring-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-400">+</div>
                 </div>
                <span class="font-bold text-gray-700 mr-1"><?= number_format($unit['total_responden']) ?></span> <span class="text-xs">Ulasan</span>
            </div>

        </div>
    </div>
<?php endforeach; ?>