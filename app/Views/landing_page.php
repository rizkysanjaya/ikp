<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Hero -->
<div class="relative bg-gradient-to-br from-blue-50 via-white to-gray-50 border-b border-gray-200 overflow-hidden">
    <!-- Decorative blobs -->
    <div class="absolute top-0 left-0 -ml-20 -mt-20 w-72 h-72 rounded-full bg-blue-100 opacity-50 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 -mr-20 -mb-20 w-80 h-80 rounded-full bg-yellow-50 opacity-40 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
        <!-- Left Text -->
        <div class="w-full md:w-1/2 text-left mb-12 md:mb-0 md:pr-12 z-10">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-[#0e4c92] text-xs font-bold tracking-wider mb-4 uppercase shadow-sm">Portal Layanan</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                Indeks Kepuasan <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0e4c92] to-[#0077b6]">Pelayanan</span>
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Selamat datang di portal survei kepuasan pelayanan <strong>Kantor Regional III BKN Bandung</strong>. Masukan Anda sangat berharga bagi kami untuk meningkatkan kualitas layanan.
            </p>
            <a href="#unit-layanan" class="inline-flex items-center justify-center bg-gradient-to-r from-[#de1d5e] to-[#b01648] text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                <span>Mulai Survei</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>

        <!-- Right Carousel -->
        <div class="w-full md:w-1/2 z-10">
            <!-- Added tilt and stronger shadow for modern look -->
            <div class="relative w-full h-64 md:h-96 overflow-hidden rounded-2xl shadow-2xl border-4 border-white transform md:rotate-2 hover:rotate-0 transition-transform duration-500 bg-gray-100">
                <!-- Slide 1 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-100">
                    <img src="<?= base_url('images/placeholder1.png') ?>" alt="Kantor BKN" class="w-full h-full object-cover">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="<?= base_url('images/placeholder2.png') ?>" alt="Pelayanan" class="w-full h-full object-cover">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="<?= base_url('images/placeholder3.png') ?>" alt="Integritas" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Unit Selection Grid -->
<div id="unit-layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pilih Unit Layanan</h2>
        <div class="w-24 h-1.5 bg-gradient-to-r from-[#de1d5e] to-[#fdb913] mx-auto rounded-full"></div>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Silakan pilih unit layanan yang ingin Anda nilai kinerjanya.</p>
    </div>

    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Unit 1 -->
        <a href="<?= base_url('survey/sidigi') ?>" class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-blue-400 to-blue-600"></div>
            <div class="p-8 flex-grow">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-3">Sistem Informasi dan Digitalisasi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Layanan terkait infrastruktur IT, aplikasi, dan digitalisasi data kepegawaian.</p>
            </div>
            <div class="px-8 pb-8 pt-0 mt-auto">
                <span class="text-sm font-bold text-blue-600 group-hover:text-blue-800 flex items-center uppercase tracking-wide">
                    Isi Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- Unit 2 -->
        <a href="<?= base_url('survey/mutasi') ?>" class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-green-400 to-green-600"></div>
            <div class="p-8 flex-grow">
                <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mb-6 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-green-700 transition-colors mb-3">Pengangkatan dan Mutasi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Layanan administrasi pengangkatan CPNS/PNS dan mutasi kepegawaian.</p>
            </div>
            <div class="px-8 pb-8 pt-0 mt-auto">
                <span class="text-sm font-bold text-green-600 group-hover:text-green-800 flex items-center uppercase tracking-wide">
                    Isi Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- Unit 3 -->
        <a href="<?= base_url('survey/status') ?>" class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-yellow-400 to-yellow-600"></div>
            <div class="p-8 flex-grow">
                <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center mb-6 text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-yellow-700 transition-colors mb-3">Status dan Pemberhentian</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Layanan terkait status kepegawaian dan proses pemberhentian/pensiun.</p>
            </div>
            <div class="px-8 pb-8 pt-0 mt-auto">
                <span class="text-sm font-bold text-yellow-600 group-hover:text-yellow-800 flex items-center uppercase tracking-wide">
                    Isi Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- Unit 4 -->
        <a href="<?= base_url('survey/manajemen') ?>" class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-purple-400 to-purple-600"></div>
            <div class="p-8 flex-grow">
                <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-purple-700 transition-colors mb-3">Pembinaan Manajemen ASN</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Layanan pengembangan kompetensi, kinerja, dan disiplin ASN.</p>
            </div>
            <div class="px-8 pb-8 pt-0 mt-auto">
                <span class="text-sm font-bold text-purple-600 group-hover:text-purple-800 flex items-center uppercase tracking-wide">
                    Isi Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- Unit 5 -->
        <a href="<?= base_url('survey/pengawasan') ?>" class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-red-400 to-red-600"></div>
            <div class="p-8 flex-grow">
                <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mb-6 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-700 transition-colors mb-3">Pengawasan dan Pengendalian</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Layanan pengawasan norma, standar, prosedur, dan kriteria kepegawaian.</p>
            </div>
            <div class="px-8 pb-8 pt-0 mt-auto">
                <span class="text-sm font-bold text-red-600 group-hover:text-red-800 flex items-center uppercase tracking-wide">
                    Isi Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- Unit 6 -->
        <a href="<?= base_url('survey/narasumber') ?>" class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-orange-400 to-orange-600"></div>
            <div class="p-8 flex-grow">
                <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-orange-700 transition-colors mb-3">Narasumber</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Layanan penilaian kinerja dan kepuasan terhadap narasumber kegiatan.</p>
            </div>
            <div class="px-8 pb-8 pt-0 mt-auto">
                <span class="text-sm font-bold text-orange-600 group-hover:text-orange-800 flex items-center uppercase tracking-wide">
                    Isi Survei
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </div>
        </a>
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
<?= $this->endSection() ?>