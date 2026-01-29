<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - IKP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

    <div class="text-center max-w-lg w-full">
        <div class="mb-8 relative inline-block">
            <div class="absolute inset-0 bg-blue-100 rounded-full animate-pulse blur-2xl opacity-50"></div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Logo_BKN_%28Badan_Kepegawaian_Negara%29_2015.png/1200px-Logo_BKN_%28Badan_Kepegawaian_Negara%29_2015.png" alt="Logo BKN" class="h-32 w-auto relative z-10 mx-auto drop-shadow-xl">
        </div>
        
        <h1 class="text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 mb-2">404</h1>
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-500 mb-8 text-lg">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= base_url() ?>" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-gray-300 transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Halaman Depan
            </a>
        </div>

        <div class="mt-12 pt-6 border-t border-gray-200 text-sm text-gray-400">
            &copy; 2024 Survey IKM - Kantor Regional III BKN
        </div>
    </div>

</body>
</html>
