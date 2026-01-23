<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Laporan IKM</h1>
        <p class="text-sm text-gray-500 mt-1">Rekapitulasi Indeks Kepuasan Masyarakat</p>
    </div>

    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <form action="" method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="<?= esc($filters['start_date']) ?>" required class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" value="<?= esc($filters['end_date']) ?>" required class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Unit Layanan</label>
                <select name="layanan_id" required class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]">
                    <option value="">-- Pilih Unit --</option>
                    <?php foreach ($layanan as $l): ?>
                        <option value="<?= $l->id ?>" <?= $filters['layanan_id'] == $l->id ? 'selected' : '' ?>><?= esc($l->nama_layanan) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-[#0e4c92] hover:bg-[#0a386e] text-white px-4 py-2 rounded-lg transition-colors shadow-sm font-medium">
                    Tampilkan Data
                </button>
            </div>
        </form>
    </div>

    <?php if ($reportData !== null): ?>
        <?php if (empty($reportData)): ?>
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                Tidak ada data survei pada periode dan unit layanan yang dipilih.
            </div>
        <?php else: ?>
            <!-- Report Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Legend -->
                <div class="p-4 bg-gray-50 border-b border-gray-200 text-xs text-gray-600">
                    <span class="font-bold">Keterangan Indikator:</span>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 mt-2">
                        <?php foreach ($unsur as $index => $u): ?>
                            <div><span class="font-semibold">P<?= $index + 1 ?>:</span> <?= esc($u->nama_unsur) ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 uppercase tracking-wider border-b border-gray-300">
                                <th rowspan="2" class="px-4 py-3 font-bold border-r border-gray-300 text-center w-12">No</th>
                                <th rowspan="2" class="px-4 py-3 font-bold border-r border-gray-300 w-64">Nama Responden</th>
                                <th colspan="<?= count($unsur) ?>" class="px-4 py-2 font-bold border-r border-gray-300 text-center bg-gray-200">Nilai Per Indikator</th>
                                <th rowspan="2" class="px-4 py-3 font-bold border-r border-gray-300 w-32">Tanggal</th>
                                <th rowspan="2" class="px-4 py-3 font-bold w-64">Kritik/Saran</th>
                            </tr>
                            <tr class="bg-gray-100 text-gray-700 uppercase tracking-wider border-b border-gray-300">
                                <?php foreach ($unsur as $index => $u): ?>
                                    <th class="px-2 py-2 font-bold border-r border-gray-300 text-center w-10" title="<?= esc($u->nama_unsur) ?>">P<?= $index + 1 ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($reportData['respondents'] as $index => $row): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center border-r border-gray-200"><?= $index + 1 ?></td>
                                    <td class="px-4 py-3 border-r border-gray-200">
                                        <div class="font-bold text-gray-800"><?= esc($row->nama_lengkap) ?></div>
                                        <div class="text-xs text-gray-500 mt-0.5">Instansi: <?= esc($row->nama_instansi ?? 'Tidak Diketahui') ?></div>
                                    </td>
                                    <?php foreach ($unsur as $u): ?>
                                        <td class="px-2 py-3 text-center border-r border-gray-200 font-medium">
                                            <?= $row->scores[$u->id] ?? '-' ?>
                                        </td>
                                    <?php endforeach; ?>
                                    <td class="px-4 py-3 border-r border-gray-200 text-xs">
                                        <?= date('d-m-Y H:i', strtotime($row->tanggal_survei)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-xs italic text-gray-600">
                                        <?= esc($row->saran_masukan) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <!-- Footer / Summary -->
                        <tfoot class="bg-gray-50 font-bold text-gray-700 border-t-2 border-gray-300">
                            <!-- Jumlah Nilai -->
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Jumlah Nilai Per Parameter</td>
                                <?php foreach ($unsur as $u): ?>
                                    <td class="px-2 py-3 text-center border-r border-gray-300">
                                        <?= number_format($reportData['stats']['total_per_unsur'][$u->id], 0, ',', '.') ?>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="2" class="bg-gray-100"></td>
                            </tr>
                            <!-- NRR -->
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Nilai Rata-rata (NRR)</td>
                                <?php foreach ($unsur as $u): ?>
                                    <td class="px-2 py-3 text-center border-r border-gray-300">
                                        <?= number_format($reportData['stats']['nrr_per_unsur'][$u->id], 2, ',', '.') ?>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="2" class="bg-gray-100"></td>
                            </tr>
                            <!-- NRR Tertimbang -->
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Nilai Indeks Per Parameter</td>
                                <?php foreach ($unsur as $u): ?>
                                    <td class="px-2 py-3 text-center border-r border-gray-300 text-blue-700">
                                        <?= number_format($reportData['stats']['nrr_tertimbang'][$u->id], 2, ',', '.') ?>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="2" class="bg-gray-100"></td>
                            </tr>
                            <!-- Final IKM -->
                            <tr class="bg-blue-50 border-t-2 border-blue-200">
                                <td colspan="2" class="px-4 py-4 text-right border-r border-blue-200 text-lg text-[#0e4c92] font-bold">Indeks Kepuasan Masyarakat (IKM)</td>
                                <td colspan="<?= count($unsur) ?>" class="px-4 py-4 text-center text-3xl font-black text-[#0e4c92] tracking-wider">
                                    <?= number_format($reportData['stats']['ikm_konversi'], 2, ',', '.') ?>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <!-- Classification -->
                            <tr class="<?= $reportData['stats']['class'] ?> border-t-2">
                                <td colspan="2" class="px-4 py-6 text-right font-bold text-xl border-r border-black/5">Mutu Pelayanan</td>
                                <td colspan="<?= count($unsur) ?>" class="px-4 py-6 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="text-4xl font-black uppercase tracking-tight"><?= $reportData['stats']['ket'] ?></span>
                                        <span class="text-sm font-bold mt-1 px-3 py-1 rounded-full bg-white/40 border border-black/5">Mutu <?= $reportData['stats']['mutu'] ?></span>
                                    </div>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>