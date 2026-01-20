<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#0e4c92] to-[#0a386e] px-8 py-10 text-center text-white">
                <h1 class="text-3xl font-extrabold tracking-tight">Tentang Aplikasi IKP</h1>
                <p class="mt-2 text-lg text-blue-100">Sistem Informasi Indeks Kepuasan Pelayanan</p>
            </div>

            <div class="p-8 md:p-10 space-y-10">
                <!-- Description Section -->
                <section>
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-blue-100 rounded-lg text-[#0e4c92] mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Deskripsi Aplikasi</h2>
                    </div>
                    <div class="prose text-gray-600 max-w-none">
                        <p class="leading-relaxed">
                            <strong>Aplikasi IKP (Indeks Kepuasan Pelayanan)</strong> adalah sistem berbasis web yang dikembangkan untuk mengukur tingkat kepuasan masyarakat terhadap penyelenggaraan pelayanan publik. Aplikasi ini dirancang berdasarkan prinsip-prinsip yang tertuang dalam <strong>Peraturan Menteri PANRB Nomor 14 Tahun 2017</strong>.
                        </p>
                        <p class="mt-3 leading-relaxed">
                            Sistem ini memfasilitasi pengumpulan data survei secara digital dari penerima layanan, pengolahan data secara otomatis, hingga penyajian laporan Indeks Kepuasan Masyarakat (IKM) secara real-time. Tujuannya adalah untuk menyediakan data yang akurat dan transparan sebagai bahan evaluasi guna peningkatan kualitas pelayanan publik secara berkelanjutan.
                        </p>
                    </div>
                </section>

                <hr class="border-gray-100">

                <!-- How it Works Section -->
                <section>
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-green-100 rounded-lg text-green-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Bagaimana Sistem Bekerja?</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Step 1 -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-start">
                                <span class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-full bg-[#0e4c92] text-white font-bold text-sm">1</span>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-800">Input Data Survei</h3>
                                    <p class="mt-1 text-sm text-gray-600">Responden mengisi kuesioner digital yang mencakup profil responden dan penilaian terhadap 9 unsur pelayanan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-start">
                                <span class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-full bg-[#0e4c92] text-white font-bold text-sm">2</span>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-800">Pengolahan Data</h3>
                                    <p class="mt-1 text-sm text-gray-600">Sistem secara otomatis menghitung skor rata-rata per unsur dan mengonversinya menjadi nilai dasar IKM.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-start">
                                <span class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-full bg-[#0e4c92] text-white font-bold text-sm">3</span>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-800">Analisis Mutu</h3>
                                    <p class="mt-1 text-sm text-gray-600">Nilai IKM dikategorikan ke dalam Mutu Pelayanan (A, B, C, D) dan Kinerja Unit (Sangat Baik s/d Buruk).</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-start">
                                <span class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-full bg-[#0e4c92] text-white font-bold text-sm">4</span>
                                <div class="ml-4">
                                    <h3 class="font-bold text-gray-800">Pelaporan</h3>
                                    <p class="mt-1 text-sm text-gray-600">Admin dapat memantau dashboard real-time dan mencetak laporan rekapitulasi untuk keperluan evaluasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="mt-8 flex justify-center">
                    <a href="<?= base_url('/') ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-[#0e4c92] bg-blue-50 hover:bg-blue-100 transition-colors">
                        &larr; Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-8 text-gray-500 text-sm">
            &copy; <?= date('Y') ?> Kantor Regional III BKN Bandung. All rights reserved.
        </div>
    </div>
</div>
<?= $this->endSection() ?>