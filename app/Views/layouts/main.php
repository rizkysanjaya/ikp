<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKP - BKN Kanreg III Bandung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Merriweather', serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-[#0e4c92] shadow-lg border-b-4 border-yellow-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center space-x-4">
                    <!-- Icon/Logo Placeholder -->
                    <div class="bg-white p-2 rounded-full shadow-sm">
                        <svg class="w-8 h-8 text-[#0e4c92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-white leading-tight">IKP Online</span>
                        <span class="text-xs text-[#fdb913] font-medium tracking-wide">BKN KANREG III BANDUNG</span>
                    </div>
                </div>
                <div>
                    <a href="#" class="text-white hover:text-blue-200 text-sm font-medium">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="bg-[#0e4c92] border-t-4 border-[#fdb913] text-white mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-blue-100 text-sm">
                    &copy; <?= date('Y') ?> Kantor Regional III Badan Kepegawaian Negara. Jl. Surapati No. 10 Bandung.
                </p>
            </div>
        </div>
    </footer>
    <?= $this->renderSection('scripts') ?>
</body>

</html>