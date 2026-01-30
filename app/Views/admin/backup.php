<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6">
    <h1 class="text-3xl font-black text-gray-900"><?= $title ?></h1>
    <p class="text-gray-500 mt-2">Amankan data aplikasi secara berkala.</p>
</div>

<div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 mb-8">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Status Database</h2>
            </div>
            <p class="text-gray-500">Database: <span class="font-mono font-bold text-gray-700 bg-gray-100 px-2 py-0.5 rounded"><?= $dbName ?></span></p>
            <p class="text-gray-500 mt-1">Total Entri Data: <span class="font-bold text-blue-600"><?= number_format($totalRows, 0, ',', '.') ?></span> baris</p>
        </div>

        <div>
            <a href="<?= base_url('admin/backup/download') ?>" class="inline-flex items-center px-6 py-3 bg-[#0e4c92] hover:bg-[#0a386e] text-white font-bold rounded-xl shadow-lg shadow-blue-900/20 transition-all hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download SQL Dump
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h3 class="font-bold text-gray-800">Detail Tabel</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-500 uppercase font-bold text-xs">
                <tr>
                    <th class="px-6 py-3">Nama Tabel</th>
                    <th class="px-6 py-3 text-right">Jumlah Data</th>
                    <th class="px-6 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($stats as $stat): ?>
                <tr class="hover:bg-blue-50/50 transition-colors">
                    <td class="px-6 py-3 font-medium text-gray-800 font-mono"><?= $stat['name'] ?></td>
                    <td class="px-6 py-3 text-right font-bold"><?= number_format($stat['rows'], 0, ',', '.') ?></td>
                    <td class="px-6 py-3 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            OK
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
