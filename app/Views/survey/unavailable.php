<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl border-t-8 border-gray-400 text-center relative overflow-hidden">

        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 rounded-full bg-gray-100 opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 rounded-full bg-gray-100 opacity-50"></div>

        <div class="relative">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-gray-100 mb-6">
                <svg class="h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
            </div>

            <h2 class="mt-2 text-2xl font-extrabold text-gray-900 tracking-tight">Mohon Maaf</h2>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Masih belum ada survei untuk unit layanan ini.
            </p>

            <div class="mt-10">
                <a href="<?= base_url('/') ?>" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-gray-600 hover:bg-gray-700 transform hover:-translate-y-1 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>