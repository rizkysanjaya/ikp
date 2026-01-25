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

<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <!-- Navbar (Glassmorphism & Transparent) -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-gradient-to-r from-[#0e4c92]/90 to-[#0a386e]/90 backdrop-blur-md border-b-4 border-[#fdb913] shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="<?= base_url('/') ?>" class="group flex-shrink-0 flex items-center space-x-4">
                    <!-- Icon/Logo Placeholder -->
                    <div class="bg-white/10 p-2.5 rounded-xl shadow-lg backdrop-blur-sm border border-white/20 transform group-hover:rotate-3 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-2xl text-white leading-none tracking-tight group-hover:text-amber-300 transition-colors drop-shadow-sm">IKP Online</span>
                        <span class="text-xs text-blue-100 font-bold tracking-widest uppercase mt-1 opacity-90">BKN Kanreg III Bandung</span>
                    </div>
                </a>
                <div>
                    <!-- Login Button Removed as per request -->
                </div>
            </div>
        </div>
    </nav>

    <!-- Spacer for Fixed Navbar -->
    <div class="h-0"></div> 

    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="bg-[#0b1120] border-t-8 border-[#fdb913] text-white mt-auto relative overflow-hidden">
         <!-- Decorative Background -->
         <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>

        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Brand & Address -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-700 p-2.5 rounded-xl shadow-lg border border-white/10">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-2xl tracking-tight text-white">IKP Online <span class="text-blue-400 font-normal">Kanreg III BKN</span></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-md border-l-2 border-blue-900 pl-4">
                        Kantor Regional III Badan Kepegawaian Negara.<br>
                        Jl. Surapati No. 10, Cihaur Geulis, Kec. Cibeunying Kaler,<br>
                        Kota Bandung, Jawa Barat 40122
                    </p>
                </div>

                <!-- Footer Menu / Copyright (Simplified) -->
                <div class="flex flex-col md:items-end space-y-4">
                    <div class="flex space-x-6 text-sm font-medium text-gray-400">
                        <a href="https://kanreg3.bkn.go.id" target="_blank" class="hover:text-blue-400 transition-colors">Website Resmi</a>
                        <a href="#" class="hover:text-blue-400 transition-colors">Bantuan</a>
                        <a href="#" class="hover:text-blue-400 transition-colors">Kebijakan Privasi</a>
                    </div>
                </div>
            </div>


            <div class="mt-12 border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-500">
                    &copy; <?= date('Y') ?> Kantor Regional III Badan Kepegawaian Negara.
                </p>
                <p class="text-xs text-gray-600 mt-2 md:mt-0 px-3 py-1 bg-white/5 rounded-full">
                    Sistem IKP v2.0
                </p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>