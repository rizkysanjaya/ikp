<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="space-y-6 relative">
    
    <!-- Floating Navigation (Sticky) -->
    <!-- Floating Navigation (Fixed) -->
    <div class="fixed bottom-8 left-0 right-0 z-50 flex justify-center pointer-events-none">
        <div class="bg-white/90 backdrop-blur-md shadow-2xl border border-gray-200/50 rounded-full px-2 py-1.5 flex items-center gap-1 pointer-events-auto transition-all hover:scale-105">
            <button onclick="scrollToSection('section-header')" class="px-3 py-1.5 rounded-full text-sm font-medium text-gray-600 hover:text-[#0e4c92] hover:bg-blue-50 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                Atas
            </button>
            <div class="w-px h-4 bg-gray-300 mx-1"></div>
            <button id="btn-filter" onclick="scrollToSection('section-filter')" class="px-3 py-1.5 rounded-full text-sm font-medium text-gray-600 hover:text-[#0e4c92] hover:bg-blue-50 transition-colors">
                Filter
            </button>
            <button id="btn-table" onclick="scrollToSection('section-table')" class="px-3 py-1.5 rounded-full text-sm font-medium text-gray-600 hover:text-[#0e4c92] hover:bg-blue-50 transition-colors">
                Tabel Data
            </button>
            <button id="btn-charts" onclick="scrollToSection('section-charts')" class="px-3 py-1.5 rounded-full text-sm font-medium text-gray-600 hover:text-[#0e4c92] hover:bg-blue-50 transition-colors">
                Grafik
            </button>
        </div>
    </div>

    <!-- Page Header -->
    <div id="section-header" class="relative bg-gradient-to-r from-[#0e4c92] to-[#1e60a8] rounded-2xl p-8 text-white overflow-hidden shadow-lg">
        <div class="absolute top-0 right-0 opacity-10 transform translate-x-10 -translate-y-10">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold tracking-tight">Laporan IKM</h1>
            <p class="text-blue-100 mt-2 text-lg">Rekapitulasi Indeks Kepuasan Masyarakat & Analisis Mutu Pelayanan</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div id="section-filter" class="scroll-mt-32 -mt-6 mx-4 relative z-20">
        <div class="bg-white p-6 rounded-xl shadow-xl border border-gray-100 transition-all hover:shadow-2xl">
            <form action="" method="get" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div class="space-y-1 group">
                    <label class="block text-sm font-semibold text-gray-700">Tanggal Mulai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0e4c92]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="date" name="start_date" value="<?= esc($filters['start_date']) ?>" required class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0e4c92] focus:border-[#0e4c92] transition-colors bg-gray-50 focus:bg-white">
                    </div>
                </div>
                <div class="space-y-1 group">
                    <label class="block text-sm font-semibold text-gray-700">Tanggal Selesai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0e4c92]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="date" name="end_date" value="<?= esc($filters['end_date']) ?>" required class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0e4c92] focus:border-[#0e4c92] transition-colors bg-gray-50 focus:bg-white">
                    </div>
                </div>
                <div class="space-y-1 group">
                    <label class="block text-sm font-semibold text-gray-700">Unit Layanan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0e4c92]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <select name="layanan_id" required class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0e4c92] focus:border-[#0e4c92] transition-colors bg-gray-50 focus:bg-white appearance-none">
                            <option value="">-- Pilih Unit Layanan --</option>
                            <?php foreach ($layanan as $l): ?>
                                <option value="<?= $l->id ?>" <?= $filters['layanan_id'] == $l->id ? 'selected' : '' ?>><?= esc($l->nama_layanan) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full bg-[#0e4c92] hover:bg-[#093566] text-white px-6 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2 transform active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($reportData !== null): ?>
        <?php if (empty($reportData)): ?>
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100 mx-4 mt-8">
                <div class="bg-gray-50 p-6 rounded-full mb-4">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Data Belum Tersedia</h3>
                <p class="text-gray-500 max-w-md text-center">Belum ada responden yang mengisi survei pada periode dan unit layanan yang Anda pilih. Coba sesuaikan filter di atas.</p>
            </div>
        <?php else: ?>
            <!-- Report Section -->
            <div id="section-table" class="scroll-mt-32 mt-8 mx-4 bg-white rounded-2xl shadow-xl border border-gray-200/60 overflow-hidden">
                <!-- Legend -->
                <div class="p-5 bg-gray-50/50 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-2">Indikator Penilaian</span>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($unsur as $index => $u): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    <span class="font-bold mr-1">P<?= $index + 1 ?>:</span> <?= esc($u->nama_unsur) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Export Buttons -->
                    <div class="flex gap-3">
                        <button onclick="exportToPDF()" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center transition-all shadow-sm hover:shadow-md transform active:scale-95">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Export PDF
                        </button>
                        <button onclick="exportToExcel()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center transition-all shadow-sm hover:shadow-md transform active:scale-95">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto relative max-h-[600px] overflow-y-auto custom-scrollbar">
                    <table id="table-laporan" class="w-full text-left border-collapse text-sm">
                        <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider sticky top-0 z-20 shadow-sm">
                            <tr>
                                <th rowspan="2" class="px-4 py-4 font-bold border-r border-gray-300 text-center w-12 bg-gray-100 sticky left-0 z-30">No</th>
                                <th rowspan="2" class="px-4 py-4 font-bold border-r border-gray-300 w-64 bg-gray-100 sticky left-12 z-30 drop-shadow-sm">Nama Responden</th>
                                <th colspan="<?= count($unsur) ?>" class="px-4 py-2 font-bold border-r border-gray-300 text-center bg-blue-50/80 text-[#0e4c92]">Nilai Per Indikator</th>
                                <th rowspan="2" class="px-4 py-4 font-bold border-r border-gray-300 w-32 bg-gray-100">Tanggal</th>
                                <th rowspan="2" class="px-4 py-4 font-bold w-64 bg-gray-100">Kritik/Saran</th>
                            </tr>
                            <tr>
                                <?php foreach ($unsur as $index => $u): ?>
                                    <th class="px-2 py-2 font-bold border-r border-gray-300 text-center w-10 bg-blue-50/80 text-[#0e4c92]" title="<?= esc($u->nama_unsur) ?>">P<?= $index + 1 ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <?php foreach ($reportData['respondents'] as $index => $row): ?>
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-4 py-3 text-center border-r border-gray-200 font-medium text-gray-500 bg-white group-hover:bg-blue-50/30 sticky left-0 z-10"><?= $index + 1 ?></td>
                                    <td class="px-4 py-3 border-r border-gray-200 bg-white group-hover:bg-blue-50/30 sticky left-12 z-10">
                                        <div class="font-bold text-gray-800"><?= esc(strtoupper($row->nama_lengkap)) ?></div>
                                        <div class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            <?= esc($row->nama_instansi ?? 'Tidak Diketahui') ?>
                                        </div>
                                    </td>
                                    <?php foreach ($unsur as $u): ?>
                                        <?php 
                                            $val = $row->scores[$u->id] ?? 0;
                                            $colorClass = 'text-gray-400';
                                            if ($val == 1) $colorClass = 'text-red-600 bg-red-50 font-bold';
                                            elseif ($val == 2) $colorClass = 'text-orange-600 bg-orange-50 font-bold';
                                            elseif ($val == 3) $colorClass = 'text-blue-600 bg-blue-50 font-bold';
                                            elseif ($val == 4) $colorClass = 'text-emerald-600 bg-emerald-50 font-bold';
                                        ?>
                                        <td class="px-2 py-3 text-center border-r border-gray-200">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full <?= $val > 0 ? $colorClass : 'text-gray-300' ?>">
                                                <?= $val > 0 ? $val : '-' ?>
                                            </span>
                                        </td>
                                    <?php endforeach; ?>
                                    <td class="px-4 py-3 border-r border-gray-200 text-xs whitespace-nowrap text-gray-600">
                                        <?= date('d/m/Y H:i', strtotime($row->tanggal_survei)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-xs italic text-gray-600" data-full-text="<?= esc($row->saran_masukan, 'attr') ?>">
                                        <?php $saran = (string)$row->saran_masukan; ?>
                                        <?php if (mb_strlen($saran) > 100): ?>
                                            <div x-data="{ expanded: false }">
                                                <span x-show="!expanded">
                                                    <?= esc(mb_substr($saran, 0, 100)) ?>...
                                                </span>
                                                <span x-show="expanded" style="display: none;">
                                                    <?= esc($saran) ?>
                                                </span>
                                                <button @click="expanded = !expanded" class="text-blue-600 hover:text-blue-800 font-semibold ml-1 focus:outline-none underline">
                                                    <span x-show="!expanded">Lihat</span>
                                                    <span x-show="expanded">Tutup</span>
                                                </button>
                                            </div>
                                        <?php else: ?>
                                            <?= esc($saran) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <!-- Footer / Summary -->
                        <tfoot class="bg-gray-50 font-bold text-gray-700 border-t-2 border-gray-300">
                            <!-- Jumlah Nilai -->
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Jumlah Nilai Per Parameter</td>
                                <td colspan="<?= count($unsur) ?>" class="px-0">
                                    <div class="grid" style="grid-template-columns: repeat(<?= count($unsur) ?>, 1fr);">
                                        <?php foreach ($unsur as $u): ?>
                                            <div class="px-2 py-3 text-center border-r border-gray-300">
                                                <?= number_format($reportData['stats']['total_per_unsur'][$u->id], 0, ',', '.') ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td colspan="2" class="bg-gray-100"></td>
                            </tr>
                            <!-- NRR -->
                            <tr class="row-nrr">
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Nilai Rata-rata (NRR)</td>
                                <td colspan="<?= count($unsur) ?>" class="px-0">
                                    <div class="grid" style="grid-template-columns: repeat(<?= count($unsur) ?>, 1fr);">
                                        <?php foreach ($unsur as $u): ?>
                                            <div class="px-2 py-3 text-center border-r border-gray-300">
                                                <?= number_format($reportData['stats']['nrr_per_unsur'][$u->id], 2, ',', '.') ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td colspan="2" class="bg-gray-100"></td>
                            </tr>
                            <!-- NRR Tertimbang -->
                            <tr class="row-indeks">
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Nilai Indeks Per Parameter</td>
                                <td colspan="<?= count($unsur) ?>" class="px-0">
                                    <div class="grid" style="grid-template-columns: repeat(<?= count($unsur) ?>, 1fr);">
                                        <?php foreach ($unsur as $u): ?>
                                            <div class="px-2 py-3 text-center border-r border-gray-300 text-blue-700">
                                                <?= number_format($reportData['stats']['nrr_tertimbang'][$u->id], 2, ',', '.') ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
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

            <!-- Charts Section -->
            <div id="section-charts" class="scroll-mt-32 grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10 mb-24 mx-4">
                <!-- Bar Chart -->
                <div class="lg:col-span-3 bg-white p-8 rounded-3xl shadow-xl border border-gray-200/60 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#0e4c92]"></div>
                    <div class="flex items-center justify-between mb-8">
                         <h3 class="font-extrabold text-gray-800 text-2xl tracking-tight flex items-center gap-3">
                            <span class="p-2 bg-blue-100 rounded-lg text-[#0e4c92]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </span>
                            Grafik Nilai Rata-rata Per Unsur
                        </h3>
                    </div>
                    <div id="chart-nrr" class="w-full h-96"></div>
                </div>
                
                <!-- Pie Charts Grid -->
                <div class="lg:col-span-3 bg-white p-8 rounded-3xl shadow-xl border border-gray-200/60 relative overflow-hidden">
                     <div class="absolute top-0 left-0 w-2 h-full bg-emerald-500"></div>
                     <div class="flex items-center justify-between mb-8">
                        <h3 class="font-extrabold text-gray-800 text-2xl tracking-tight flex items-center gap-3">
                            <span class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            </span>
                            Distribusi Jawaban Per Unsur
                        </h3>
                    </div>
                    <div id="charts-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    // Smooth Scroll
    function scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            const offset = 100; // Increased offset for fixed header
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });
        }
    }

    // ScrollSpy (Active State Tracking)
    document.addEventListener('DOMContentLoaded', () => {
        const sections = ['section-filter', 'section-table', 'section-charts'];
        const navButtons = {
            'section-filter': document.getElementById('btn-filter'),
            'section-table': document.getElementById('btn-table'),
            'section-charts': document.getElementById('btn-charts')
        };

        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -60% 0px', // Trigger active state when section is near top
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Remove active class from all
                    Object.values(navButtons).forEach(btn => {
                        if(btn) {
                            btn.classList.remove('text-[#0e4c92]', 'bg-blue-50', 'ring-1', 'ring-blue-100');
                            btn.classList.add('text-gray-600');
                        }
                    });

                    // Add active class to current
                    const activeBtn = navButtons[entry.target.id];
                    if (activeBtn) {
                        activeBtn.classList.remove('text-gray-600');
                        activeBtn.classList.add('text-[#0e4c92]', 'bg-blue-50', 'ring-1', 'ring-blue-100');
                    }
                }
            });
        }, observerOptions);

        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    });
</script>


<!-- Highcharts Library -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- SheetJS with Styling Support -->
<script src="https://cdn.jsdelivr.net/npm/xlsx-js-style@1.2.0/dist/xlsx.bundle.js"></script>
<!-- jsPDF for PDF Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

<script>
    const reportStats = <?= ($reportData && !empty($reportData['stats'])) ? json_encode($reportData['stats']) : 'null' ?>;
    const unsurData = <?= !empty($unsur) ? json_encode($unsur) : '[]' ?>;
    const respondentsData = <?= ($reportData && !empty($reportData['respondents'])) ? json_encode($reportData['respondents']) : '[]' ?>;

    function exportToExcel() {
        if (!reportStats || !respondentsData.length) {
            alert("Tidak ada data untuk diexport");
            return;
        }

        // 1. Prepare Header
        const header1 = ["No", "Nama Responden"];
        const header2 = ["", ""];
        
        unsurData.forEach(u => {
            header1.push("Nilai Per Indikator");
            header2.push(u.kode_unsur || `P${u.id}`);
        });
        
        header1.push("Tanggal", "Kritik/Saran");
        header2.push("", "");

        // 2. Prepare Body Rows
        const bodyRows = respondentsData.map((row, index) => {
            const rowData = [
                index + 1,
                `${row.nama_lengkap.toUpperCase()}\nInstansi: ${row.nama_instansi || '-'}`
            ];
            
            // Scores
            unsurData.forEach(u => {
                rowData.push(row.scores[u.id] || "-"); 
            });

            // Date
            const date = new Date(row.tanggal_survei);
            const dateStr = date.toLocaleDateString('id-ID') + ' ' + date.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
            rowData.push(dateStr);

            // Suggestion
            rowData.push(row.saran_masukan || "-");

            return rowData;
        });

        // 3. Prepare Footer Rows
        const footerRows = [];
        const emptyCols = ["", ""];
        
        // Helper to pad rows
        const padRow = (label, dataObj, isFloat = false) => {
             const row = [label, ""]; // Col 0 Label (for merge), Col 1 Empty
             unsurData.forEach(u => {
                 let val = dataObj[u.id];
                 if (isFloat) val = parseFloat(val).toFixed(2).replace('.', ',');
                 row.push(val);
             });
             row.push("", ""); // Date & Saran empty
             return row;
        };

        footerRows.push(padRow("Jumlah Nilai Per Parameter", reportStats.total_per_unsur));
        footerRows.push(padRow("Nilai Rata-rata (NRR)", reportStats.nrr_per_unsur, true));
        footerRows.push(padRow("Nilai Indeks Per Parameter", reportStats.nrr_tertimbang, true));
        
        // IKM Row (Custom)
        const ikmRow = ["Indeks Kepuasan Masyarakat (IKM)", ""];
        // Merge cells for IKM value? No, just put in first slot and span later
        ikmRow.push(parseFloat(reportStats.ikm_konversi).toFixed(2).replace('.', ','));
        // Fill rest
        for(let i=0; i<unsurData.length + 1; i++) ikmRow.push(""); 
        footerRows.push(ikmRow);

        // Mutu Row
        const mutuRow = ["Mutu Pelayanan", ""];
        mutuRow.push(`${reportStats.mutu} (${reportStats.ket})`);
         for(let i=0; i<unsurData.length + 1; i++) mutuRow.push(""); 
        footerRows.push(mutuRow);

        // CONSTRUCT SHEET
        const wsData = [header1, header2, ...bodyRows, ...footerRows];
        const ws = XLSX.utils.aoa_to_sheet(wsData);

        // MERGES
        const merges = [
            { s: {r:0, c:0}, e: {r:1, c:0} }, // No
            { s: {r:0, c:1}, e: {r:1, c:1} }, // Nama
            { s: {r:0, c:2}, e: {r:0, c:2 + unsurData.length - 1} }, // Header "Nilai"
            { s: {r:0, c:2 + unsurData.length}, e: {r:1, c:2 + unsurData.length} }, // Tanggal
            { s: {r:0, c:2 + unsurData.length + 1}, e: {r:1, c:2 + unsurData.length + 1} }, // Saran
        ];
        
        // Footer Merges
        const footerStart = 2 + bodyRows.length;
        // Merge "Nilai Rata-rata" label (Cols 0-1)
        for (let i=0; i<3; i++) {
             merges.push({ s: {r:footerStart+i, c:0}, e: {r:footerStart+i, c:1} });
        }
        // IKM Row Merge
        const ikmIdx = footerStart + 3;
        merges.push({ s: {r:ikmIdx, c:0}, e: {r:ikmIdx, c:1} }); // Label
        merges.push({ s: {r:ikmIdx, c:2}, e: {r:ikmIdx, c:2 + unsurData.length - 1} }); // Value Spanning Scores
        
        // Mutu Row Merge
        const mutuIdx = footerStart + 4;
        merges.push({ s: {r:mutuIdx, c:0}, e: {r:mutuIdx, c:1} });
        merges.push({ s: {r:mutuIdx, c:2}, e: {r:mutuIdx, c:2 + unsurData.length - 1} });

        ws['!merges'] = merges;

        // COLUMN WIDTHS
        const wscols = [
            { wch: 5 }, // No
            { wch: 40 }, // Nama
        ];
        unsurData.forEach(() => wscols.push({ wch: 8 })); // Scores
        wscols.push({ wch: 20 }); // Date
        wscols.push({ wch: 50 }); // Saran
        ws['!cols'] = wscols;

        // STYLING
        const range = XLSX.utils.decode_range(ws['!ref']);
        for (let R = range.s.r; R <= range.e.r; ++R) {
            for (let C = range.s.c; C <= range.e.c; ++C) {
                const cellRef = XLSX.utils.encode_cell({c: C, r: R});
                if (!ws[cellRef]) continue;
                
                const style = {
                    font: { name: "Arial", sz: 10 },
                    border: {
                        top: {style: "thin", color: {rgb: "CCCCCC"}},
                        bottom: {style: "thin", color: {rgb: "CCCCCC"}},
                        left: {style: "thin", color: {rgb: "CCCCCC"}},
                        right: {style: "thin", color: {rgb: "CCCCCC"}}
                    },
                    alignment: { vertical: "center", wrapText: true }
                };

                // Alignment
                if (C === 0 || (C >= 2 && C < 2 + unsurData.length) || C === 2 + unsurData.length) {
                    style.alignment.horizontal = "center";
                }

                // HEADER STYLES
                if (R < 2) {
                    style.fill = { fgColor: { rgb: "E5E7EB" } }; // Gray-200
                    style.font.bold = true;
                    style.alignment.horizontal = "center";
                }

                // FOOTER STYLES
                if (R >= footerStart) {
                     style.font.bold = true;
                     style.alignment.horizontal = (C >= 2 && C < 2 + unsurData.length) ? "center" : "right";
                     
                     // Specific Footer Colors
                     if (R === footerStart) style.fill = { fgColor: { rgb: "F3F4F6" } }; // Total
                     if (R === ikmIdx) { // IKM
                         style.fill = { fgColor: { rgb: "EFF6FF" } }; // Blue-50
                         style.font.color = { rgb: "0E4C92" };
                         style.font.sz = 14;
                         if (C === 2) style.alignment.horizontal = "center";
                     }
                     if (R === mutuIdx) { // Mutu
                        // Dynamic Color based on Class
                        let color = "FFFFFF";
                        if (reportStats.mutu === 'A') color = "D1FAE5"; // Emerald
                        if (reportStats.mutu === 'B') color = "DBEAFE"; // Blue
                        if (reportStats.mutu === 'C') color = "FEF9C3"; // Yellow
                        if (reportStats.mutu === 'D') color = "FEE2E2"; // Red
                        style.fill = { fgColor: { rgb: color } };
                        style.font.sz = 14;
                        if (C === 2) style.alignment.horizontal = "center";
                     }
                }

                ws[cellRef].s = style;
            }
        }
        // Set Row Heights
        const wsrows = [];
         wsrows[0] = { hpx: 25 };
         wsrows[1] = { hpx: 25 };
         wsrows[ikmIdx] = { hpx: 35 };
         wsrows[mutuIdx] = { hpx: 40 };
         ws['!rows'] = wsrows;

        // EXPORT
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Laporan IKM");
        XLSX.writeFile(wb, `Laporan_IKM_${new Date().toISOString().slice(0,10)}.xlsx`);
    }

    function exportToPDF() {
        if (!reportStats || !respondentsData.length) {
            alert("Tidak ada data untuk diexport");
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4'); // Landscape

        // 1. Report Header
        doc.setFontSize(16);
        doc.text("LAPORAN INDEKS KEPUASAN MASYARAKAT (IKM)", 14, 20);
        
        doc.setFontSize(11);
        doc.text(`Unit Layanan: ${document.querySelector('select[name="layanan_id"] option:checked').text}`, 14, 28);
        doc.text(`Periode: ${document.querySelector('input[name="start_date"]').value} s.d ${document.querySelector('input[name="end_date"]').value}`, 14, 34);
        doc.text(`Tanggal Cetak: ${new Date().toLocaleDateString('id-ID')}`, 14, 40);

        // 2. Prepare Table Data
        // Header
        const head = [
            ["No", "Nama Responden", ...unsurData.map(u => u.kode_unsur || `P${u.id}`), "Tanggal", "Saran"]
        ];

        // Body
        const body = respondentsData.map((row, index) => {
            const rowData = [
                index + 1,
                row.nama_lengkap.toUpperCase() + (row.nama_instansi ? `\n(${row.nama_instansi})` : ''),
                ...unsurData.map(u => row.scores[u.id] || "-"),
                new Date(row.tanggal_survei).toLocaleDateString('id-ID'),
                row.saran_masukan || "-"
            ];
            return rowData;
        });

        // 3. Footer Rows (Summary)
        const foot = [];
        
        // Total Row
        const totalRow = ["", "Jumlah Nilai Per Parameter", ...unsurData.map(u => reportStats.total_per_unsur[u.id]), "", ""];
        foot.push(totalRow);

        // NRR Row
        const nrrRow = ["", "Nilai Rata-rata (NRR)", ...unsurData.map(u => parseFloat(reportStats.nrr_per_unsur[u.id]).toFixed(2).replace('.',',')), "", ""];
        foot.push(nrrRow);

         // Indeks Row
        const indeksRow = ["", "Nilai Indeks Per Parameter", ...unsurData.map(u => parseFloat(reportStats.nrr_tertimbang[u.id]).toFixed(2).replace('.',',')), "", ""];
        foot.push(indeksRow);

        // IKM Row
        const ikmRow = ["", "Indeks Kepuasan Masyarakat (IKM)", { content: parseFloat(reportStats.ikm_konversi).toFixed(2).replace('.',','), colSpan: unsurData.length, styles: { halign: 'center', fontStyle: 'bold', fontSize: 12, textColor: [14, 76, 146], fillColor: [239, 246, 255] } }, "", ""];
        foot.push(ikmRow);
        
        // Mutu Row
        let mutuColor = [255, 255, 255]; // Default white
        if (reportStats.mutu === 'A') mutuColor = [209, 250, 229]; // Emerald
        else if (reportStats.mutu === 'B') mutuColor = [219, 234, 254]; // Blue
        else if (reportStats.mutu === 'C') mutuColor = [254, 249, 195]; // Yellow
        else if (reportStats.mutu === 'D') mutuColor = [254, 226, 226]; // Red

        const mutuRow = ["", "Mutu Pelayanan", { content: `${reportStats.mutu} (${reportStats.ket})`, colSpan: unsurData.length, styles: { halign: 'center', fontStyle: 'bold', fontSize: 12, fillColor: mutuColor } }, "", ""];
        foot.push(mutuRow);


        // 4. Generate Table
        doc.autoTable({
            startY: 45,
            head: head,
            body: body,
            foot: foot,
            theme: 'grid',
            headStyles: { fillColor: [14, 76, 146], textColor: 255, fontStyle: 'bold' }, // Blue Header
            footStyles: { fillColor: [243, 244, 246], textColor: 0, fontStyle: 'bold' }, // Gray Footer
            styles: { fontSize: 8, cellPadding: 2, overflow: 'linebreak' },
            columnStyles: {
                0: { cellWidth: 10, halign: 'center' }, // No
                1: { cellWidth: 40 }, // Nama
                // Dynamic columns for scores handled automatically or defaulting to auto
                [2 + unsurData.length]: { cellWidth: 25, halign: 'center' }, // Tanggal
                [2 + unsurData.length + 1]: { cellWidth: 'auto' } // Saran
            },
            showFoot: 'lastPage' // Show footer only on last page
        });

        doc.save(`Laporan_IKM_${new Date().toISOString().slice(0, 10)}.pdf`);
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php if (!empty($reportData)): ?>
            // Data Preparation
            const stats = reportStats;

            // 1. Bar Chart (NRR per Unsur)
            const nrrValues = unsurData.map(u => parseFloat(parseFloat(stats.nrr_per_unsur[u.id]).toFixed(2)));
            const unsurLabels = unsurData.map(u => u.kode_unsur); // U1, U2, etc.
            const unsurFullNames = unsurData.map(u => u.nama_unsur);

            Highcharts.chart('chart-nrr', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: unsurLabels,
                    crosshair: true,
                    title: {
                        text: 'Unsur Pelayanan'
                    }
                },
                yAxis: {
                    min: 0,
                    max: 4,
                    title: {
                        text: 'Nilai Skala 4'
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.x + ' - ' + unsurFullNames[this.point.index] + '</b><br/>' +
                            'Nilai Rata-rata: <b>' + this.y + '</b>';
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        borderRadius: 5,
                        color: '#0e4c92',
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    enabled: false
                },
                series: [{
                    name: 'Nilai Rata-rata',
                    data: nrrValues
                }]
            });

            // 2. Highcharts Pie Charts (9 Charts)
            const container = document.getElementById('charts-grid');

            unsurData.forEach(u => {
                const f = stats.frequency[u.id];

                // Create wrapper
                const wrapper = document.createElement('div');
                wrapper.className = "border border-gray-100 rounded-lg p-2 bg-white shadow-sm";

                const chartDiv = document.createElement('div');
                chartDiv.id = `chart-pie-${u.id}`;
                chartDiv.style.height = '300px';
                wrapper.appendChild(chartDiv);

                container.appendChild(wrapper);

                Highcharts.chart(`chart-pie-${u.id}`, {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: u.kode_unsur,
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                        }
                    },
                    subtitle: {
                        text: u.nama_unsur,
                        style: {
                            fontSize: '11px',
                            color: '#666'
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        },
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Responden ({point.percentage:.1f}%)<br/>'
                    },
                    plotOptions: {
                        pie: {
                            borderRadius: 5,
                            dataLabels: [{
                                enabled: true,
                                distance: 15,
                                format: '{point.name}'
                            }, {
                                enabled: true,
                                distance: '-30%',
                                filter: {
                                    property: 'percentage',
                                    operator: '>',
                                    value: 5
                                },
                                format: '{point.percentage:.1f} %',
                                style: {
                                    fontSize: '0.9em',
                                    textOutline: 'none'
                                }
                            }],
                            showInLegend: false
                        }
                    },
                    series: [{
                        name: 'Responden',
                        colorByPoint: true,
                        data: [{
                                name: 'Tidak Baik',
                                y: f[1],
                                color: '#EF4444'
                            },
                            {
                                name: 'Kurang Baik',
                                y: f[2],
                                color: '#F97316'
                            },
                            {
                                name: 'Baik',
                                y: f[3],
                                color: '#3B82F6'
                            },
                            {
                                name: 'Sangat Baik',
                                y: f[4],
                                color: '#10B981'
                            }
                        ]
                    }]
                });
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection() ?>