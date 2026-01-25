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
                            <tr class="row-nrr">
                                <td colspan="2" class="px-4 py-3 text-right border-r border-gray-300">Nilai Rata-rata (NRR)</td>
                                <?php foreach ($unsur as $u): ?>
                                    <td class="px-2 py-3 text-center border-r border-gray-300">
                                        <?= number_format($reportData['stats']['nrr_per_unsur'][$u->id], 2, ',', '.') ?>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="2" class="bg-gray-100"></td>
                            </tr>
                            <!-- NRR Tertimbang -->
                            <tr class="row-indeks">
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

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <!-- Bar Chart -->
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg">Grafik Nilai Rata-rata Per Unsur</h3>
                    <div id="chart-nrr" class="w-full h-80"></div>
                </div>
                <!-- Pie Charts Grid -->
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg">Distribusi Jawaban (Drilldown)</h3>
                    <div id="chart-drilldown" class="w-full h-[500px]"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Highcharts Library -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
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
        ws['!cols'] = [{
                wch: 5
            }, // No
            {
                wch: 35
            }, // Nama Responden
            // P1-P9 (9 Columns)
            {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            }, {
                wch: 5
            },
            {
                wch: 18
            }, // Tanggal
            {
                wch: 40
            } // Saran
        ];

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
                if (typeof cellVal === 'string' && domRow) {
                    const parentTag = domRow.parentElement ? domRow.parentElement.tagName : '';

                    // 1. Respondent Name & Instansi (Column 1, Body Rows)
                    if (C === 1 && parentTag === 'TBODY') {
                        if (cellVal.includes('Instansi:') && !cellVal.includes('\nInstansi:')) {
                            ws[cellRef].v = cellVal.replace(/Instansi:/, '\nInstansi:');
                        }
                    }
                    // 2. Mutu Pelayanan Score (Footer)
                    if (parentTag === 'TFOOT' && /Mutu [A-D]/.test(cellVal) && !cellVal.includes('\nMutu ')) {
                        ws[cellRef].v = cellVal.replace(/(Mutu [A-D])/, '\n$1');
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
                    tooltip: {
                        pointFormat: '<b>{point.y}</b> Responden ({point.percentage:.1f}%)'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                distance: -20,
                                style: {
                                    fontSize: '9px',
                                    textOutline: 'none'
                                }
                            },
                            showInLegend: true
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                        name: 'Responden',
                        colorByPoint: true,
                        innerSize: '50%', // Donut style looks cleaner
                        data: [{
                                name: '1',
                                y: f[1],
                                color: '#EF4444'
                            },
                            {
                                name: '2',
                                y: f[2],
                                color: '#F97316'
                            },
                            {
                                name: '3',
                                y: f[3],
                                color: '#3B82F6'
                            },
                            {
                                name: '4',
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