<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php 
// Visual Configuration Map (Key = Kode Layanan)
// Maps DB Data to UI Elements (Icon, Color, Description) which are not in DB
$visualConfig = [
    'KL001' => [
        'color' => 'blue',
        'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        'desc' => 'Layanan terkait infrastruktur IT, aplikasi, dan digitalisasi data kepegawaian.'
    ],
    'KL002' => [
        'color' => 'emerald',
        'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z',
        'desc' => 'Layanan administrasi pengangkatan CPNS/PNS dan mutasi kepegawaian.'
    ],
    'KL003' => [
        'color' => 'amber',
        'icon' => 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1',
        'desc' => 'Layanan terkait status kepegawaian dan proses pemberhentian/pensiun.'
    ],
    'KL004' => [
        'color' => 'purple',
        'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        'desc' => 'Layanan pengembangan kompetensi, kinerja, dan disiplin ASN.'
    ],
    'KL005' => [
        'color' => 'rose',
        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'desc' => 'Layanan pengawasan norma, standar, prosedur, dan kriteria kepegawaian.'
    ],
    'KL006' => [
        'color' => 'orange',
        'icon' => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z',
        'desc' => 'Layanan penilaian kinerja dan kepuasan terhadap narasumber kegiatan.'
    ]
];

// Fallback for new units not in config
$defaultConfig = [
    'color' => 'gray', 
    'icon'  => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    'desc'  => 'Silakan klik untuk memulai survei pada layanan ini.'
];
?>
<!-- Floating Navigation Sidebar -->
<div x-data="{ activeSection: 'home' }" 
     @scroll.window="
        const home = document.getElementById('home').getBoundingClientRect();
        const units = document.getElementById('unit-layanan').getBoundingClientRect();
        const stats = document.getElementById('statistics').getBoundingClientRect();
        const offset = window.innerHeight / 3;

        if (stats.top < offset) { activeSection = 'statistics'; }
        else if (units.top < offset) { activeSection = 'units'; }
        else { activeSection = 'home'; }
     "
     class="fixed right-6 top-1/2 transform -translate-y-1/2 z-50 hidden md:flex flex-col gap-4">
    
    <!-- Home Dot -->
    <a href="#home" @click.prevent="document.getElementById('home').scrollIntoView({behavior: 'smooth'})" 
       class="group flex items-center justify-end">
        <span class="mr-3 px-3 py-1 bg-gray-900 text-white text-xs font-bold rounded-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            Beranda
        </span>
        <div :class="activeSection === 'home' ? 'bg-blue-600 scale-125 ring-4 ring-blue-600/20' : 'bg-gray-300 hover:bg-blue-400'" 
             class="w-3 h-3 rounded-full transition-all duration-300"></div>
    </a>

    <!-- Units Dot -->
    <a href="#unit-layanan" @click.prevent="document.getElementById('unit-layanan').scrollIntoView({behavior: 'smooth'})"
       class="group flex items-center justify-end">
        <span class="mr-3 px-3 py-1 bg-gray-900 text-white text-xs font-bold rounded-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            Survei Layanan
        </span>
        <div :class="activeSection === 'units' ? 'bg-blue-600 scale-125 ring-4 ring-blue-600/20' : 'bg-gray-300 hover:bg-blue-400'" 
             class="w-3 h-3 rounded-full transition-all duration-300"></div>
    </a>

    <!-- Statistics Dot -->
    <a href="#statistics" @click.prevent="document.getElementById('statistics').scrollIntoView({behavior: 'smooth'})"
       class="group flex items-center justify-end">
        <span class="mr-3 px-3 py-1 bg-gray-900 text-white text-xs font-bold rounded-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            Statistik IKM
        </span>
        <div :class="activeSection === 'statistics' ? 'bg-blue-600 scale-125 ring-4 ring-blue-600/20' : 'bg-gray-300 hover:bg-blue-400'" 
             class="w-3 h-3 rounded-full transition-all duration-300"></div>
    </a>
</div>

<!-- Hero Section -->
<div id="home" class="relative bg-[#0b1120] overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-[#0e4c92] opacity-20 blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-blue-600 opacity-10 blur-[100px]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto pt-32 pb-20 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center z-10">
        <!-- Left Text -->
        <div class="w-full md:w-1/2 text-left mb-16 md:mb-0 md:pr-12">
            <div class="inline-flex items-center px-3 py-1 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-300 text-xs font-bold tracking-wider mb-6 uppercase backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-blue-400 mr-2 animate-pulse"></span>
                Portal Layanan Digital
            </div>
            <h1 class="text-5xl md:text-6xl font-black text-white leading-tight mb-6 tracking-tight">
                Indeks <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Kepuasan</span><br>Pelayanan
            </h1>
            <p class="text-lg text-blue-200/80 mb-10 leading-relaxed max-w-lg">
                Platform resmi survei digital <span class="text-white font-semibold">Kantor Regional III BKN Bandung</span>. Partisipasi Anda adalah kunci transformasi pelayanan publik kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#unit-layanan" @click.prevent="document.getElementById('unit-layanan').scrollIntoView({behavior: 'smooth'})" class="inline-flex items-center justify-center bg-gradient-to-r from-[#0e4c92] to-[#0a386e] text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-blue-900/50 hover:shadow-blue-600/50 hover:-translate-y-1 transition-all duration-300 group border border-blue-500/30">
                    <span>Mulai Survei Sekarang</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <!-- Admin Login Removed as per request -->
            </div>
        </div>

        <!-- Right Carousel -->
        <div class="w-full md:w-1/2 z-10 perspective-1000">
             <!-- MacBook-like Frame Container -->
            <div class="relative mx-auto bg-gray-900 rounded-t-2xl border-4 border-gray-800 border-b-0 shadow-2xl" style="max-width: 600px;">
                 <!-- Camera Dot -->
                 <div class="absolute top-2 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-gray-800 rounded-full z-20"></div>
                 
                 <!-- Screen Bezel -->
                 <div class="relative bg-black rounded-t-lg overflow-hidden border-2 border-gray-800/50" style="aspect-ratio: 16/10;">
                    <!-- Carousel Inner -->
                    <div class="relative w-full h-full group">
                        <!-- Slide 1 -->
                        <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-100">
                            <img src="<?= base_url('images/placeholder1.png') ?>" alt="Kantor BKN" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                            <img src="<?= base_url('images/placeholder2.png') ?>" alt="Pelayanan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                            <img src="<?= base_url('images/placeholder3.png') ?>" alt="Integritas" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        
                         <!-- Caption Overlay -->
                         <div class="absolute bottom-4 left-4 right-4 z-20">
                             <div class="bg-black/30 backdrop-blur-md p-3 rounded-lg border border-white/10 inline-block">
                                 <p class="font-bold text-white text-sm">Kantor Regional III BKN Bandung</p>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
             <!-- MacBook Base -->
             <div class="relative mx-auto bg-gray-800 rounded-b-xl shadow-xl h-4" style="max-width: 680px;">
                 <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-24 h-1.5 bg-gray-700 rounded-b-md"></div>
             </div>
        </div>
    </div>
    
    <!-- Wave Separator -->
    <div class="absolute bottom-0 w-full leading-none z-20">
        <svg class="block w-full h-12 md:h-24" viewBox="0 0 1440 320" preserveAspectRatio="none">
             <path fill="#f9fafb" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </div>
</div>

<!-- Unit Selection Grid -->
<!-- Main Content Area with Alpine State -->
<div x-data="{ view: 'category' }" id="unit-layanan" class="bg-gray-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-20 min-h-[600px]">
    
    <!-- CATEGORY SELECTION VIEW -->
    <div x-show="view === 'category'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
        <div class="text-center mb-16">
            <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Langkah 1</span>
            <h2 class="text-4xl font-black text-gray-900 mb-6">Pilih Jenis Survei</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-500 mx-auto rounded-full"></div>
            <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-lg">Silakan pilih kategori survei yang ingin Anda isi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Card 1: Layanan Tim Kerja (Existing) -->
            <div @click="view = 'units'" class="group cursor-pointer bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 p-8 flex flex-col items-center text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="w-24 h-24 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 relative z-10">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3 relative z-10">Survei Layanan Tim Kerja</h3>
                <p class="text-gray-500 mb-6 relative z-10">Penilaian kepuasan terhadap 6 unit layanan utama Kantor Regional III BKN.</p>
                <span class="px-6 py-2 bg-blue-600 text-white font-bold rounded-full group-hover:bg-blue-700 transition-colors relative z-10">Pilih Layanan</span>
            </div>

            <!-- Card 2: Pembinaan Kepegawaian (Active) -->
            <div @click="view = 'pembinaan_units'" class="group cursor-pointer bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 p-8 flex flex-col items-center text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="w-24 h-24 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 relative z-10">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3 relative z-10">Survei Pembinaan Kepegawaian</h3>
                <p class="text-gray-500 mb-6 relative z-10">Penilaian khusus terkait bimbingan dan pembinaan kepegawaian.</p>
                <span class="px-6 py-2 bg-orange-500 text-white font-bold rounded-full group-hover:bg-orange-600 transition-colors relative z-10">Pilih Layanan</span>
            </div>
        </div>
    </div>


    <!-- PEMBINAAN UNITS SELECTION VIEW -->
    <div x-show="view === 'pembinaan_units'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
        
        <!-- Navigation Back -->
        <div class="mb-8">
            <button @click="view = 'category'" class="flex items-center text-orange-600 font-bold hover:underline transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Pilih Kategori
            </button>
        </div>

        <div class="text-center mb-16">
            <span class="text-orange-600 font-bold tracking-wider uppercase text-sm mb-2 block">Langkah 2</span>
            <h2 class="text-4xl font-black text-gray-900 mb-6">Area Pembinaan</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-orange-600 to-yellow-500 mx-auto rounded-full"></div>
            <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-lg">Pilih unit kerja terkait untuk memulai survei pembinaan.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php 
             // Use the SAME units as IKP, but link to Pembinaan
            foreach($units as $u): 
                $conf = $visualConfig[$u->kode_layanan] ?? $defaultConfig;
            ?>
            <a href="<?= base_url('pembinaan?unit=' . urlencode($u->nama_layanan)) ?>" class="group relative bg-white rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-<?= $conf['color'] ?>-500/20 transition-all duration-300 hover:-translate-y-2 overflow-hidden border border-gray-100 p-8 flex flex-col items-start z-10">
                <!-- Glow Background on Hover -->
                <div class="absolute inset-0 bg-gradient-to-br from-<?= $conf['color'] ?>-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                
                <div class="w-16 h-16 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-<?= $conf['color'] ?>-500 mb-6 group-hover:scale-110 group-hover:bg-<?= $conf['color'] ?>-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $conf['icon'] ?>"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-<?= $conf['color'] ?>-600 transition-colors"><?= esc($u->nama_layanan) ?></h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-6 flex-grow"><?= $conf['desc'] ?></p>
                
                <div class="inline-flex items-center text-sm font-bold text-<?= $conf['color'] ?>-600 uppercase tracking-wide mt-auto">
                    Mulai Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- UNIT SELECTION VIEW (Existing Grid) -->
    <!-- Wrapped in x-show -->
    <div x-show="view === 'units'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
        
        <!-- Navigation Back -->
        <div class="mb-8">
            <button @click="view = 'category'" class="flex items-center text-blue-600 font-bold hover:underline transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Pilih Kategori
            </button>
        </div>

        <div class="text-center mb-16">
            <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Langkah 2</span>
            <h2 class="text-4xl font-black text-gray-900 mb-6">Area Pelayanan Publik</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-500 mx-auto rounded-full"></div>
            <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-lg">Pilih salah satu unit pelayanan di bawah ini untuk memulai pengisian survei.</p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Unit Template Helper -->
            <?php 
            // Config moved to top of file
            ?>

            <?php foreach($units as $u): 
                $conf = $visualConfig[$u->kode_layanan] ?? $defaultConfig;
                // Generate friendly slug (e.g. "sistem-informasi-dan-digitalisasi")
                $slug = url_title($u->nama_layanan, '-', true);
            ?>
            <a href="<?= base_url('survey/' . $slug) ?>" class="group relative bg-white rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-<?= $conf['color'] ?>-500/20 transition-all duration-300 hover:-translate-y-2 overflow-hidden border border-gray-100 p-8 flex flex-col items-start z-10">
                <!-- Glow Background on Hover -->
                <div class="absolute inset-0 bg-gradient-to-br from-<?= $conf['color'] ?>-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                
                <div class="w-16 h-16 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-<?= $conf['color'] ?>-500 mb-6 group-hover:scale-110 group-hover:bg-<?= $conf['color'] ?>-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $conf['icon'] ?>"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-<?= $conf['color'] ?>-600 transition-colors"><?= esc($u->nama_layanan) ?></h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-6 flex-grow"><?= $conf['desc'] ?></p>
                
                <div class="inline-flex items-center text-sm font-bold text-<?= $conf['color'] ?>-600 uppercase tracking-wide mt-auto">
                    Mulai Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Stats Section with Pattern -->
<div id="statistics" class="bg-white py-24 relative overflow-hidden border-t border-gray-100">
    <!-- Pattern -->
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#0e4c92_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Statistik Partisipasi</h2>
             <div class="w-20 h-1.5 bg-gray-200 mx-auto rounded-full"></div>
            <p class="mt-4 text-gray-500">Transparansi data responden yang telah berpartisipasi.</p>
        </div>

        <!-- NEW: Global IKM Score Card -->
        <div class="max-w-4xl mx-auto mb-20">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl shadow-blue-900/10 border border-blue-100/50 relative overflow-hidden text-center group hover:shadow-blue-900/20 transition-all duration-500">
                <!-- Decoration -->
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-cyan-400 to-blue-600"></div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-50 group-hover:opacity-70 transition-opacity"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gradient-to-b from-transparent to-blue-50/20 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>

                <h3 class="text-sm md:text-base font-bold text-blue-500 uppercase tracking-widest mb-3 relative z-10">
                    Indeks Kepuasan Masyarakat (IKM)
                </h3>
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-10 relative z-10 leading-tight">
                    Kantor Regional III BKN
                </h2>

                <div class="flex flex-col md:flex-row items-center justify-center gap-10 md:gap-16 relative z-10">
                    <!-- Score -->
                    <div class="relative">
                        <div class="text-7xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-br from-blue-600 to-cyan-400 drop-shadow-sm">
                            <?= $globalStats['ikm_formatted'] ?>
                        </div>
                        <div class="text-sm font-bold text-gray-400 mt-2">Skala 100</div>
                    </div>
                    
                    <!-- Separator -->
                    <div class="hidden md:block w-px h-32 bg-gray-200"></div>

                    <!-- Mutu -->
                    <div class="text-center md:text-left space-y-6">
                        <div>
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-wider block mb-1">Mutu Pelayanan</span>
                            <div class="flex items-center gap-3 justify-center md:justify-start">
                                <span class="text-5xl font-black text-<?= $globalStats['class_color'] ?>-500">
                                    <?= $globalStats['mutu'] ?>
                                </span>
                                <span class="px-3 py-1 rounded-full bg-<?= $globalStats['class_color'] ?>-100 text-<?= $globalStats['class_color'] ?>-700 text-sm font-bold border border-<?= $globalStats['class_color'] ?>-200">
                                    <?= $globalStats['ket'] ?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-wider block mb-1">Total Partisipan</span>
                            <div class="text-3xl font-bold text-gray-800">
                                <?= number_format($globalStats['total_responden'], 0, ',', '.') ?>
                                <span class="text-base text-gray-400 font-medium ml-1">Orang</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 pt-6 border-t border-gray-100 inline-block px-8">
                    <span class="text-gray-400 text-sm font-medium bg-gray-50 px-3 py-1 rounded-full">Periode: Tahun <?= $currentYear ?></span>
                </div>
            </div>
        </div>

        <!-- NEW SECTION: Unit NRR Performance Grid -->
        <div id="unit-performance-grid" class="mb-20">
             <div class="flex flex-col md:flex-row justify-between items-end mb-10">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 mb-2">Indeks Kepuasan Pelayanan Tim Kerja</h2>
                    <p class="text-gray-500">Nilai Rata-rata Unsur (NRR) per Unit - Periode <?= $currentYear ?></p>
                </div>
                 <div class="mt-4 md:mt-0">
                    <span class="px-4 py-2 bg-blue-50 text-[#0e4c92] text-sm font-bold rounded-full border border-blue-100">
                        Total Unit: <?= count(json_decode($gridUnitData)) ?>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php 
                $units = json_decode($gridUnitData, true);
                if (!empty($units)):
                    foreach($units as $index => $u):
                ?>
                <div class="bg-white rounded-3xl p-6 shadow-xl shadow-gray-200/50 border border-gray-100 relative overflow-hidden group hover:shadow-2xl transition-all">
                    <!-- Top Ribbon -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-<?= $u['chart_color'] ?>-500"></div>

                    <!-- Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-3/4">
                            <h3 class="text-lg font-bold text-gray-800 line-clamp-2 leading-tight" title="<?= $u['nama'] ?>">
                                <?= $u['nama'] ?>
                            </h3>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Mutu</span>
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-<?= $u['mutu_color'] ?>-100 text-<?= $u['mutu_color'] ?>-600 font-black text-xl">
                                <?= $u['mutu'] ?>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div id="chart-unit-<?= $index ?>" class="w-full h-48"></div>

                    <!-- Footer Info -->
                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center text-xs">
                        <div class="text-gray-400 font-medium">Skor IKM</div>
                        <div class="text-lg font-black text-gray-800"><?= $u['ikm'] ?></div>
                    </div>
                </div>
                <?php endforeach; else: ?>
                    <div class="col-span-3 text-center py-10 text-gray-400">Belum ada data unit untuk tahun <?= $currentYear ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Chart Card 1 -->
            <div class="bg-white p-8 rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-bold text-gray-800">Gender Responden</h3>
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                </div>
                <div id="genderChart" class="flex justify-center"></div>
            </div>

            <!-- Chart Card 2 -->
             <div class="bg-white p-8 rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-bold text-gray-800">Kelompok Usia</h3>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div id="usiaChart"></div>
            </div>

            <!-- Chart Card 3 -->
             <div class="bg-white p-8 rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-bold text-gray-800">Latar Belakang Pekerjaan</h3>
                     <div class="p-2 bg-purple-50 rounded-lg text-purple-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div id="pekerjaanChart"></div>
            </div>

             <!-- Chart Card 4 -->
             <div class="bg-white p-8 rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-bold text-gray-800">Tingkat Pendidikan</h3>
                     <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                    </div>
                </div>
                <div id="pendidikanChart"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide');
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
        }, 4000);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // 1. Ambil Data dari PHP Controller
    const rawGender = <?= $chartGender ?>;
    const rawPendidikan = <?= $chartPendidikan ?>;
    const rawPekerjaan = <?= $chartPekerjaan ?>;
    const rawUsia = <?= $chartUsia ?>;
    const gridUnitData = <?= $gridUnitData ?>;

    // --- Helper Functions ---
    const getLabels = (data, key) => data.map(item => item[key]);
    const getValues = (data, key) => data.map(item => parseInt(item[key]));

    // --- RENDER GRID CHARTS ---
    if (gridUnitData && gridUnitData.length > 0) {
        // Color Map for Tailwind classes
        const colorMap = {
            'emerald': '#10b981', 'blue': '#3b82f6', 'yellow': '#f59e0b', 'red': '#ef4444',
            'gray': '#9ca3af', 'violet': '#8b5cf6', 'amber': '#f59e0b', 'rose': '#f43f5e',
            'cyan': '#06b6d4', 'fuchsia': '#d946ef', 'lime': '#84cc16', 'sky': '#0ea5e9',
            'orange': '#f97316', 'teal': '#14b8a6', 'indigo': '#6366f1', 'pink': '#ec4899'
        };

        gridUnitData.forEach((unit, index) => {
            const chartData = unit.nrr_values.map(v => parseFloat(v));
            const categories = unit.unsur_keys; // U1, U2...
            const themeColor = colorMap[unit.chart_color] || '#3b82f6'; // Use distinct chart_color

            const options = {
                series: [{
                    name: 'NRR',
                    data: chartData
                }],
                chart: {
                    type: 'bar',
                    height: 200,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif'
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '60%',
                        distributed: false, // Unified color for this unit
                        dataLabels: {
                            position: 'top', 
                        },
                    }
                },
                colors: [themeColor], // Use the unit's theme color
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed(1);
                    },
                    offsetY: -15,
                    style: {
                        fontSize: '10px',
                        colors: ["#64748b"]
                    }
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            fontSize: '10px',
                            fontWeight: 600
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    max: 4,
                    tickAmount: 4,
                    labels: {
                        show: false
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                grid: {
                    show: false,
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    } 
                },
                legend: { show: false },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " (Skala 4)";
                        }
                    }
                }
            };

            new ApexCharts(document.querySelector("#chart-unit-" + index), options).render();
        });
    }

    // --- EXISTING DEMOGRAPHIC CHARTS ---
    const genderOptions = {
        series: getValues(rawGender, 'total'),
        labels: rawGender.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'),
        chart: {
            type: 'donut',
            height: 320,
            fontFamily: 'Inherit'
        },
        colors: ['#3b82f6', '#ec4899'], // Biru & Pink
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%'
                }
            }
        },
        dataLabels: {
            enabled: true
        },
        tooltip: {
            y: {
                formatter: val => val + " Orang"
            }
        }
    };
    new ApexCharts(document.querySelector("#genderChart"), genderOptions).render();

    // --- CHART 2: USIA (Column) ---
    const usiaOptions = {
        series: [{
            name: 'Jumlah',
            data: getValues(rawUsia, 'total')
        }],
        chart: {
            type: 'bar',
            height: 320,
            fontFamily: 'Inherit',
            toolbar: {
                show: false
            }
        },
        colors: ['#10b981'], // Hijau
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '50%',
                distributed: true
            }
        },
        xaxis: {
            categories: getLabels(rawUsia, 'kelompok_usia')
        },
        legend: {
            show: false
        },
        tooltip: {
            y: {
                formatter: val => val + " Orang"
            }
        }
    };
    new ApexCharts(document.querySelector("#usiaChart"), usiaOptions).render();

    // --- CHART 3: PEKERJAAN (Bar Horizontal) ---
    const pekerjaanOptions = {
        series: [{
            name: 'Jumlah',
            data: getValues(rawPekerjaan, 'total')
        }],
        chart: {
            type: 'bar',
            height: 320,
            fontFamily: 'Inherit',
            toolbar: {
                show: false
            }
        },
        colors: ['#8b5cf6'], // Ungu
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
                barHeight: '60%'
            }
        },
        xaxis: {
            categories: getLabels(rawPekerjaan, 'nama_pekerjaan')
        },
        tooltip: {
            y: {
                formatter: val => val + " Orang"
            }
        }
    };
    new ApexCharts(document.querySelector("#pekerjaanChart"), pekerjaanOptions).render();

    // --- CHART 4: PENDIDIKAN (Bar Horizontal) ---
    const pendidikanOptions = {
        series: [{
            name: 'Jumlah',
            data: getValues(rawPendidikan, 'total')
        }],
        chart: {
            type: 'bar',
            height: 320,
            fontFamily: 'Inherit',
            toolbar: {
                show: false
            }
        },
        colors: ['#f97316'], // Orange
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
                barHeight: '60%'
            }
        },
        xaxis: {
            categories: getLabels(rawPendidikan, 'nama_pendidikan')
        },
        tooltip: {
            y: {
                formatter: val => val + " Orang"
            }
        }
    };
    new ApexCharts(document.querySelector("#pendidikanChart"), pendidikanOptions).render();

    // --- Carousel Script Lama Anda ---
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide');
        if (slides.length > 0) {
            let currentSlide = 0;
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');
            }, 4000);
        }
    });
</script>
<?= $this->endSection() ?>