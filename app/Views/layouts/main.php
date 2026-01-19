<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKP - BKN Kanreg III Bandung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Merriweather', serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-[#0e4c92] to-[#0a386e] shadow-2xl border-b-4 border-[#fdb913] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="<?= base_url('/') ?>" class="group flex-shrink-0 flex items-center space-x-4">
                    <!-- Icon/Logo Placeholder -->
                    <div class="bg-white p-2.5 rounded-xl shadow-lg transform group-hover:rotate-3 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#0e4c92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-2xl text-white leading-none tracking-tight group-hover:text-blue-100 transition-colors">IKP Online</span>
                        <span class="text-xs text-[#fdb913] font-bold tracking-widest uppercase mt-1">BKN Kanreg III Bandung</span>
                    </div>
                </a>
                <div>
                    <a href="<?= base_url('login') ?>" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Login Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-[#0e4c92] to-[#0a386e] border-t-8 border-[#fdb913] text-white mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand & Address -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-white p-2 rounded-lg shadow-md">
                            <svg class="w-6 h-6 text-[#0e4c92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight">IKP Online Kanreg III BKN</span>
                    </div>
                    <p class="text-blue-100 text-sm leading-relaxed max-w-md">
                        Kantor Regional III Badan Kepegawaian Negara.<br>
                        Jl. Surapati No. 10, Cihaur Geulis, Kec. Cibeunying Kaler,<br>
                        Kota Bandung, Jawa Barat 40122
                    </p>
                </div>

                <!-- Socials / Contact -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[#fdb913] mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white transition-colors transform hover:scale-110">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h-.165zm-2.37 6.318a6.448 6.448 0 010 12.896 6.448 6.448 0 010-12.896z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors transform hover:scale-110">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors transform hover:scale-110">
                            <span class="sr-only">Website</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 border-t border-blue-800/50 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-base text-blue-200 text-sm">
                    &copy; <?= date('Y') ?> Kantor Regional III Badan Kepegawaian Negara.
                </p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>