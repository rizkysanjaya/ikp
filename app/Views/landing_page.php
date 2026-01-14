<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Hero -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
        <!-- Left Text -->
        <div class="w-full md:w-1/2 text-left mb-8 md:mb-0 md:pr-12">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl leading-tight mb-6">
                Indeks Kepuasan Pelayanan
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Selamat datang di portal survei kepuasan pelayanan Kantor Regional III BKN Bandung. Masukan Anda sangat berharga bagi kami untuk meningkatkan kualitas layanan.
            </p>
            <a href="#unit-layanan" class="inline-block bg-[#de1d5e] text-white font-bold py-3 px-8 rounded shadow-lg hover:shadow-2xl hover:bg-[#b01648] transition duration-300 transform hover:-translate-y-1">
                Isi Survey
            </a>
        </div>

        <!-- Right Carousel -->
        <div class="w-full md:w-1/2">
            <div class="relative w-full h-64 md:h-96 overflow-hidden rounded-lg shadow-xl bg-gray-100">
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
    <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Pilih Unit Layanan</h2>

    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Unit 1 -->
        <a href="<?= base_url('survey/sistem-informasi') ?>" class="group block bg-white rounded-md shadow hover:shadow-lg border border-gray-200 transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="h-2 bg-blue-500 group-hover:bg-blue-600 transition-colors"></div>
            <div class="p-6">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-700 transition-colors">Sistem Informasi dan Digitalisasi</h3>
                <p class="mt-2 text-sm text-gray-500">Layanan terkait infrastruktur IT, aplikasi, dan digitalisasi data kepegawaian.</p>
            </div>
        </a>

        <!-- Unit 2 -->
        <a href="<?= base_url('survey/mutasi') ?>" class="group block bg-white rounded-md shadow hover:shadow-lg border border-gray-200 transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="h-2 bg-green-500 group-hover:bg-green-600 transition-colors"></div>
            <div class="p-6">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-700 transition-colors">Pengangkatan dan Mutasi</h3>
                <p class="mt-2 text-sm text-gray-500">Layanan administrasi pengangkatan CPNS/PNS dan mutasi kepegawaian.</p>
            </div>
        </a>

        <!-- Unit 3 -->
        <a href="<?= base_url('survey/status-pemberhentian') ?>" class="group block bg-white rounded-md shadow hover:shadow-lg border border-gray-200 transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="h-2 bg-yellow-500 group-hover:bg-yellow-600 transition-colors"></div>
            <div class="p-6">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4 text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-yellow-700 transition-colors">Status dan Pemberhentian</h3>
                <p class="mt-2 text-sm text-gray-500">Layanan terkait status kepegawaian dan proses pemberhentian/pensiun.</p>
            </div>
        </a>

        <!-- Unit 4 -->
        <a href="<?= base_url('survey/pembinaan') ?>" class="group block bg-white rounded-md shadow hover:shadow-lg border border-gray-200 transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="h-2 bg-purple-500 group-hover:bg-purple-600 transition-colors"></div>
            <div class="p-6">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-purple-700 transition-colors">Pembinaan Manajemen ASN</h3>
                <p class="mt-2 text-sm text-gray-500">Layanan pengembangan kompetensi, kinerja, dan disiplin ASN.</p>
            </div>
        </a>

        <!-- Unit 5 -->
        <a href="<?= base_url('survey/pengawasan') ?>" class="group block bg-white rounded-md shadow hover:shadow-lg border border-gray-200 transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="h-2 bg-red-500 group-hover:bg-red-600 transition-colors"></div>
            <div class="p-6">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-red-700 transition-colors">Pengawasan dan Pengendalian</h3>
                <p class="mt-2 text-sm text-gray-500">Layanan pengawasan norma, standar, prosedur, dan kriteria kepegawaian.</p>
            </div>
        </a>

        <!-- Unit 6 -->
        <a href="<?= base_url('survey/narasumber') ?>" class="group block bg-white rounded-md shadow hover:shadow-lg border border-gray-200 transition-all duration-200 hover:-translate-y-1 overflow-hidden">
            <div class="h-2 bg-orange-500 group-hover:bg-orange-600 transition-colors"></div>
            <div class="p-6">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 group-hover:text-orange-700 transition-colors">Narasumber</h3>
                <p class="mt-2 text-sm text-gray-500">Layanan penilaian kinerja dan kepuasan terhadap narasumber kegiatan.</p>
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