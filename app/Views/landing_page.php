<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<div class="relative bg-[#0b1120] overflow-hidden">
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
                <a href="#unit-layanan" class="inline-flex items-center justify-center bg-gradient-to-r from-[#0e4c92] to-[#0a386e] text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-blue-900/50 hover:shadow-blue-600/50 hover:-translate-y-1 transition-all duration-300 group border border-blue-500/30">
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
<div id="unit-layanan" class="bg-gray-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-20">
    <div class="text-center mb-16">
        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Pilih Layanan</span>
        <h2 class="text-4xl font-black text-gray-900 mb-6">Area Pelayanan Publik</h2>
        <div class="w-20 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-500 mx-auto rounded-full"></div>
        <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-lg">Pilih salah satu unit pelayanan di bawah ini untuk memulai pengisian survei kepuasan masyarakat.</p>
    </div>

    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Unit Template Helper -->
        <?php 
        $units = [
            [
                'url' => 'survey/sidigi',
                'color' => 'blue',
                'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'title' => 'Sistem Informasi & Digitalisasi',
                'desc' => 'Layanan terkait infrastruktur IT, aplikasi, dan digitalisasi data kepegawaian.'
            ],
            [
                'url' => 'survey/mutasi',
                'color' => 'emerald',
                'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z',
                'title' => 'Pengangkatan & Mutasi',
                'desc' => 'Layanan administrasi pengangkatan CPNS/PNS dan mutasi kepegawaian.'
            ],
            [
                'url' => 'survey/status',
                'color' => 'amber',
                'icon' => 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1',
                'title' => 'Status & Pemberhentian',
                'desc' => 'Layanan terkait status kepegawaian dan proses pemberhentian/pensiun.'
            ],
            [
                'url' => 'survey/manajemen',
                'color' => 'purple',
                'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                'title' => 'Pembinaan Manajemen ASN',
                'desc' => 'Layanan pengembangan kompetensi, kinerja, dan disiplin ASN.'
            ],
            [
                'url' => 'survey/pengawasan',
                'color' => 'rose',
                'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'title' => 'Pengawasan & Pengendalian',
                'desc' => 'Layanan pengawasan norma, standar, prosedur, dan kriteria kepegawaian.'
            ],
             [
                'url' => 'survey/narasumber',
                'color' => 'orange',
                'icon' => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z',
                'title' => 'Narasumber',
                'desc' => 'Layanan penilaian kinerja dan kepuasan terhadap narasumber kegiatan.'
            ]
        ];
        
        // Color Map for dynamic classes (Tailwind needs full class names often, but we can interpolate safely if standard colors)
        // Adjusting specific hexes/classes for "Premium" look
        ?>

        <?php foreach($units as $u): ?>
        <a href="<?= base_url($u['url']) ?>" class="group relative bg-white rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-<?= $u['color'] ?>-500/20 transition-all duration-300 hover:-translate-y-2 overflow-hidden border border-gray-100 p-8 flex flex-col items-start z-10">
             <!-- Glow Background on Hover -->
             <div class="absolute inset-0 bg-gradient-to-br from-<?= $u['color'] ?>-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
            
             <div class="w-16 h-16 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-<?= $u['color'] ?>-500 mb-6 group-hover:scale-110 group-hover:bg-<?= $u['color'] ?>-500 group-hover:text-white transition-all duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $u['icon'] ?>"></path>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-<?= $u['color'] ?>-600 transition-colors"><?= $u['title'] ?></h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-6 flex-grow"><?= $u['desc'] ?></p>
            
            <div class="inline-flex items-center text-sm font-bold text-<?= $u['color'] ?>-600 uppercase tracking-wide mt-auto">
                Mulai Survei
                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Stats Section with Pattern -->
<div class="bg-white py-24 relative overflow-hidden border-t border-gray-100">
    <!-- Pattern -->
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#0e4c92_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Statistik Partisipasi</h2>
             <div class="w-20 h-1.5 bg-gray-200 mx-auto rounded-full"></div>
            <p class="mt-4 text-gray-500">Transparansi data responden yang telah berpartisipasi.</p>
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
                // Decode data for loop
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