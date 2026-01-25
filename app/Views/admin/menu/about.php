<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="relative bg-gradient-to-br from-[#0e4c92] to-[#0a386e] px-8 py-12 text-center text-white overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-400/20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                
                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold tracking-tight mb-2">Tentang Aplikasi IKP</h1>
                    <p class="text-lg text-blue-100 font-medium">Sistem Informasi Indeks Kepuasan Pelayanan</p>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-12">
                <!-- Description Section -->
                <section>
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-blue-50 rounded-xl text-[#0e4c92] mr-4 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Deskripsi Aplikasi</h2>
                    </div>
                    <div class="prose text-gray-600 max-w-none text-justify leading-relaxed">
                        <p class="mb-4">
                            <strong>Aplikasi IKP (Indeks Kepuasan Pelayanan)</strong> adalah sistem berbasis web yang dikembangkan untuk mengukur tingkat kepuasan masyarakat terhadap penyelenggaraan pelayanan publik. Aplikasi ini dirancang berdasarkan prinsip-prinsip yang tertuang dalam <strong>Peraturan Menteri PANRB Nomor 14 Tahun 2017</strong>.
                        </p>
                        <p>
                            Sistem ini memfasilitasi pengumpulan data survei secara digital dari penerima layanan, pengolahan data secara otomatis, hingga penyajian laporan Indeks Kepuasan Masyarakat (IKM) secara real-time. Tujuannya adalah untuk menyediakan data yang akurat dan transparan sebagai bahan evaluasi guna peningkatan kualitas pelayanan publik secara berkelanjutan.
                        </p>
                    </div>
                </section>

                <hr class="border-gray-100">

                <!-- How it Works Section -->
                <section>
                    <div class="flex items-center mb-8">
                        <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600 mr-4 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Bagaimana Sistem Bekerja?</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Step 1 -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                            <div class="flex items-start relative z-10">
                                <span class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-[#0e4c92] text-white font-bold text-lg shadow-lg shadow-blue-200">1</span>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Input Data Survei</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">Responden mengisi kuesioner digital yang mencakup profil responden dan penilaian terhadap 9 unsur pelayanan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                            <div class="flex items-start relative z-10">
                                <span class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-[#0e4c92] text-white font-bold text-lg shadow-lg shadow-blue-200">2</span>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Pengolahan Data</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">Sistem secara otomatis menghitung skor rata-rata per unsur dan mengonversinya menjadi nilai dasar IKM.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                            <div class="flex items-start relative z-10">
                                <span class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-[#0e4c92] text-white font-bold text-lg shadow-lg shadow-blue-200">3</span>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Analisis Mutu</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">Nilai IKM dikategorikan ke dalam Mutu Pelayanan (A, B, C, D) dan Kinerja Unit (Sangat Baik s/d Tidak Baik).</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                            <div class="flex items-start relative z-10">
                                <span class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-[#0e4c92] text-white font-bold text-lg shadow-lg shadow-blue-200">4</span>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">Pelaporan</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">Admin dapat memantau dashboard real-time dan mencetak laporan rekapitulasi untuk keperluan evaluasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

               
            </div>
        </div>

        <div class="text-center mt-8 text-gray-500 text-sm">
            &copy; <?= date('Y') ?> Kantor Regional III BKN Bandung. All rights reserved.
        </div>
    </div>
</div>
<?= $this->endSection() ?>