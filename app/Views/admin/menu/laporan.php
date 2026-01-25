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
    <div id="section-header">
        <h1 class="text-2xl font-bold text-gray-800">Laporan IKM</h1>
        <p class="text-sm text-gray-500 mt-1">Rekapitulasi Indeks Kepuasan Masyarakat</p>
    </div>

    <!-- Filter Section -->
    <div id="section-filter" class="scroll-mt-24 bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
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
            <div id="section-table" class="scroll-mt-24 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Legend -->
                <div class="p-4 bg-gray-50 border-b border-gray-200 text-xs text-gray-600">
                    <span class="font-bold">Keterangan Indikator:</span>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 mt-2">
                        <?php foreach ($unsur as $index => $u): ?>
                            <div><span class="font-semibold">P<?= $index + 1 ?>:</span> <?= esc($u->nama_unsur) ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Export Button -->
                <div class="px-4 py-3 bg-white border-b border-gray-200 flex justify-end">
                    <button onclick="exportToExcel()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export Excel
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table id="table-laporan" class="w-full text-left border-collapse text-sm">
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
                                        <div class="font-bold text-gray-800"><?= esc(strtoupper($row->nama_lengkap)) ?></div>
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
                                                    <span x-show="!expanded">Lihat Selengkapnya</span>
                                                    <span x-show="expanded">Sembunyikan</span>
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
            <div id="section-charts" class="scroll-mt-24 grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <!-- Bar Chart -->
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg">Grafik Nilai Rata-rata Per Unsur</h3>
                    <div id="chart-nrr" class="w-full h-80"></div>
                </div>
                <!-- Pie Charts Grid -->
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg">Distribusi Jawaban Per Unsur</h3>
                    <div id="charts-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
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

<script>
    const reportStats = <?= !empty($reportData['stats']) ? json_encode($reportData['stats']) : 'null' ?>;
    const unsurData = <?= !empty($unsur) ? json_encode($unsur) : '[]' ?>;

    function exportToExcel() {
        const table = document.getElementById('table-laporan');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "Laporan IKM"
        });
        const ws = wb.Sheets["Laporan IKM"];

        // 1. Define Column Widths
        const cols = [{
                wch: 5
            }, // No
            {
                wch: 35
            } // Nama Responden
        ];
        unsurData.forEach(() => cols.push({
            wch: 5
        })); // Unsur Columns (Dynamic)
        cols.push({
            wch: 18
        }); // Tanggal
        cols.push({
            wch: 40
        }); // Saran
        ws['!cols'] = cols;

        // 2. Apply Styles
        const range = XLSX.utils.decode_range(ws['!ref']);
        const domRows = table.rows;
        ws['!rows'] = []; // Initialize row heights array

        for (let R = range.s.r; R <= range.e.r; ++R) {
            const domRow = domRows[R];

            // Default row height (simulating padding)
            if (!ws['!rows'][R]) ws['!rows'][R] = {
                hpx: 25
            };

            let rowFill = null;
            let fontColor = "000000";
            let isBold = false;
            let fontSize = 10;

            // Determine style based on HTML classes
            if (domRow) {
                const className = domRow.className;

                // Header Rows
                if (R < 2) {
                    ws['!rows'][R] = {
                        hpx: 35
                    };
                    rowFill = "E5E7EB"; // Gray-200
                    isBold = true;
                }
                // Footer / Summary Rows
                else if (domRow.parentElement.tagName === 'TFOOT') {
                    isBold = true;
                    if (className.includes('bg-gray-100')) rowFill = "F3F4F6";

                    // IKM Row (Blue)
                    if (className.includes('bg-blue-50')) {
                        rowFill = "EFF6FF";
                        fontColor = "0E4C92";
                        fontSize = 12;
                    }

                    // Mutu Classification Row (Dynamic Colors)
                    if (className.includes('bg-emerald-100') || className.includes('bg-blue-100') || className.includes('bg-yellow-100') || className.includes('bg-red-100')) {
                        ws['!rows'][R] = {
                            hpx: 80
                        }; // Set row height to 80px for Mutu Pelayanan
                    }

                    if (className.includes('bg-emerald-100')) {
                        rowFill = "D1FAE5";
                        fontColor = "065F46";
                        fontSize = 14;
                    }
                    if (className.includes('bg-blue-100')) {
                        rowFill = "DBEAFE";
                        fontColor = "1E40AF";
                        fontSize = 14;
                    }
                    if (className.includes('bg-yellow-100')) {
                        rowFill = "FEF9C3";
                        fontColor = "854D0E";
                        fontSize = 14;
                    }
                    if (className.includes('bg-red-100')) {
                        rowFill = "FEE2E2";
                        fontColor = "991B1B";
                        fontSize = 14;
                    }
                }
            }

            for (let C = range.s.c; C <= range.e.c; ++C) {
                const cellRef = XLSX.utils.encode_cell({
                    r: R,
                    c: C
                });
                if (!ws[cellRef]) continue;

                // Fix Content Formatting (Add Newlines)
                let cellVal = ws[cellRef].v;
                if (domRow) {
                    const parentTag = domRow.parentElement ? domRow.parentElement.tagName : '';
                    const dateColIndex = 2 + unsurData.length;

                    // 1. Respondent Name & Instansi (Column 1, Body Rows)
                    if (C === 1 && parentTag === 'TBODY' && typeof cellVal === 'string') {
                        if (cellVal.includes('Instansi:') && !cellVal.includes('\nInstansi:')) {
                            ws[cellRef].v = cellVal.replace(/Instansi:/, '\nInstansi:');
                        }
                    }
                    // 2. Mutu Pelayanan Score (Footer)
                    if (parentTag === 'TFOOT' && typeof cellVal === 'string' && /Mutu [A-D]/.test(cellVal) && !cellVal.includes('\nMutu ')) {
                        ws[cellRef].v = cellVal.replace(/(Mutu [A-D])/, '\n$1');
                    }
                    // 3. Kritik/Saran (Column 12) - Restore full text if truncated
                    if (C === (dateColIndex + 1) && parentTag === 'TBODY') {
                        const fullText = domRow.cells[C]?.getAttribute('data-full-text');
                        if (fullText) {
                            ws[cellRef].v = fullText;
                        }
                    }

                    // 4. Fix Date Format (Column Date) - Force String
                    if (C === dateColIndex && parentTag === 'TBODY') {
                        if (domRow.cells[C]) {
                            ws[cellRef].v = domRow.cells[C].innerText.trim();
                            ws[cellRef].t = 's'; // Force Text Type
                        }
                    }
                }

                // 3. IKM Number (Footer) - Force comma decimal
                if (domRow && domRow.className.includes('bg-blue-50') && reportStats && reportStats.ikm_konversi) {
                    if (cellVal && !String(cellVal).includes('Indeks')) {
                        const rawVal = parseFloat(reportStats.ikm_konversi);
                        ws[cellRef].v = rawVal.toFixed(2).replace('.', ',');
                        ws[cellRef].t = 's';
                    }
                }

                // 4. NRR & Indeks (Footer) - Force comma decimal
                if (domRow && (domRow.classList.contains('row-nrr') || domRow.classList.contains('row-indeks'))) {
                    if (C >= 2 && C < 2 + unsurData.length) {
                        const uIndex = C - 2;
                        const uId = unsurData[uIndex].id;
                        let rawVal = 0;

                        if (domRow.classList.contains('row-nrr')) {
                            rawVal = parseFloat(reportStats.nrr_per_unsur[uId]);
                        } else {
                            rawVal = parseFloat(reportStats.nrr_tertimbang[uId]);
                        }

                        ws[cellRef].v = rawVal.toFixed(2).replace('.', ',');
                        ws[cellRef].t = 's';
                    }
                }

                // Construct Style Object
                ws[cellRef].s = {
                    font: {
                        name: "Arial",
                        sz: fontSize,
                        bold: isBold,
                        color: {
                            rgb: fontColor
                        }
                    },
                    border: {
                        top: {
                            style: "thin",
                            color: {
                                rgb: "BBBBBB"
                            }
                        },
                        bottom: {
                            style: "thin",
                            color: {
                                rgb: "BBBBBB"
                            }
                        },
                        left: {
                            style: "thin",
                            color: {
                                rgb: "BBBBBB"
                            }
                        },
                        right: {
                            style: "thin",
                            color: {
                                rgb: "BBBBBB"
                            }
                        }
                    },
                    alignment: {
                        vertical: "center",
                        wrapText: true
                    },
                    fill: rowFill ? {
                        fgColor: {
                            rgb: rowFill
                        }
                    } : undefined
                };

                // Center align specific columns (No, Scores, Date)
                if (C === 0 || (C >= 2 && C <= 10) || C === 11) ws[cellRef].s.alignment.horizontal = "center";
            }
        }

        const date = new Date().toISOString().slice(0, 10);
        XLSX.writeFile(wb, `Laporan_IKM_${date}.xlsx`);
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