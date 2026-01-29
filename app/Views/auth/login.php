<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl border-t-8 border-[#de1d5e]">
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-50 rounded-full flex items-center justify-center mb-4 shadow-sm">
                <svg class="h-8 w-8 text-[#0e4c92]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900">Login Administrator</h2>
            <p class="mt-2 text-sm text-gray-600">
                Silakan masuk untuk mengelola survei
            </p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700"><?= session()->getFlashdata('error') ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="<?= base_url('login') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input id="username" name="username" type="text" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-[#0e4c92] focus:border-[#0e4c92] focus:z-10 sm:text-sm shadow-sm transition-all duration-200" placeholder="Masukkan username">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-[#0e4c92] focus:border-[#0e4c92] focus:z-10 sm:text-sm shadow-sm transition-all duration-200" placeholder="Masukkan password">
                </div>
            </div>

            <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-gradient-to-r from-[#0e4c92] to-[#0a386e] hover:from-[#0a386e] hover:to-[#062a54] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0e4c92] shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                Masuk Dashboard
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>