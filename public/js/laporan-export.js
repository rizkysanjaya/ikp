/**
 * Laporan Export Scripts
 * Handles Excel and PDF export logic for the Laporan IKM page.
 * Relies on global window variables injected by PHP:
 * - window.ReportStats
 * - window.UnsurData
 * - window.RespondentsData
 */

function exportToExcel() {
    const reportStats = window.ReportStats;
    const unsurData = window.UnsurData;
    const respondentsData = window.RespondentsData;

    if (!reportStats || !respondentsData || !respondentsData.length) {
        alert("Tidak ada data untuk diexport");
        return;
    }

    // 0. Prepare Metadata
    const layananEl = document.querySelector('select[name="layanan_id"] option:checked');
    const startEl = document.querySelector('input[name="start_date"]');
    const endEl = document.querySelector('input[name="end_date"]');

    const layananText = layananEl ? layananEl.text : '-';
    const periodeText = (startEl && endEl) ? `${startEl.value} s.d ${endEl.value}` : '-';
    
    // 1. Prepare Table Header
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
    ikmRow.push(parseFloat(reportStats.ikm_konversi).toFixed(2).replace('.', ','));
    for(let i=0; i<unsurData.length + 1; i++) ikmRow.push(""); 
    footerRows.push(ikmRow);

    // Mutu Row
    const mutuRow = ["Mutu Pelayanan", ""];
    mutuRow.push(`${reportStats.mutu} (${reportStats.ket})`);
        for(let i=0; i<unsurData.length + 1; i++) mutuRow.push(""); 
    footerRows.push(mutuRow);

    // 4. Construct Excel Rows with Top Header
    const topHeaderRows = [
        ["LAPORAN INDEKS KEPUASAN MASYARAKAT (IKM)"],
        [`Unit Layanan: ${layananText}`],
        [`Periode: ${periodeText}`],
        [`Tanggal Cetak: ${new Date().toLocaleDateString('id-ID')}`],
        [""] // Spacer
    ];

    const wsData = [...topHeaderRows, header1, header2, ...bodyRows, ...footerRows];
    const ws = XLSX.utils.aoa_to_sheet(wsData);

    // OFFSET for Table Start (5 rows of header)
    const T_OFFSET = 5;

    // MERGES
    // Top Header Merges (Span across all columns)
    const totalCols = header1.length - 1;
    const merges = [
        { s: {r:0, c:0}, e: {r:0, c:totalCols} },
        { s: {r:1, c:0}, e: {r:1, c:totalCols} },
        { s: {r:2, c:0}, e: {r:2, c:totalCols} },
        { s: {r:3, c:0}, e: {r:3, c:totalCols} },
    ];

    // Table Header Merges
    merges.push(
        { s: {r:T_OFFSET, c:0}, e: {r:T_OFFSET+1, c:0} }, // No
        { s: {r:T_OFFSET, c:1}, e: {r:T_OFFSET+1, c:1} }, // Nama
        { s: {r:T_OFFSET, c:2}, e: {r:T_OFFSET, c:2 + unsurData.length - 1} }, // Header "Nilai"
        { s: {r:T_OFFSET, c:2 + unsurData.length}, e: {r:T_OFFSET+1, c:2 + unsurData.length} }, // Tanggal
        { s: {r:T_OFFSET, c:2 + unsurData.length + 1}, e: {r:T_OFFSET+1, c:2 + unsurData.length + 1} } // Saran
    );
    
    // Footer Merges
    const footerStart = T_OFFSET + 2 + bodyRows.length;
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
                border: {},
                alignment: { vertical: "center", wrapText: true }
            };

            // Top Header Styling
            if (R < T_OFFSET) {
                style.font.bold = true;
                if(R === 0) style.font.sz = 14; 
                // No border for top header
            } 
            // Table Styling (Headers + Body + Footer)
            else {
                style.border = {
                    top: {style: "thin", color: {rgb: "CCCCCC"}},
                    bottom: {style: "thin", color: {rgb: "CCCCCC"}},
                    left: {style: "thin", color: {rgb: "CCCCCC"}},
                    right: {style: "thin", color: {rgb: "CCCCCC"}}
                };

                // Alignment
                if (C === 0 || (C >= 2 && C < 2 + unsurData.length) || C === 2 + unsurData.length) {
                    style.alignment.horizontal = "center";
                }

                // TABLE HEADERS
                if (R >= T_OFFSET && R < T_OFFSET + 2) {
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
            }
            ws[cellRef].s = style;
        }
    }
    // Set Row Heights
    const wsrows = [];
    wsrows[0] = { hpx: 25 }; 
    wsrows[T_OFFSET] = { hpx: 25 }; // Table Header
    wsrows[T_OFFSET + 1] = { hpx: 25 };
    wsrows[ikmIdx] = { hpx: 35 };
    wsrows[mutuIdx] = { hpx: 40 };
    ws['!rows'] = wsrows;

    // EXPORT
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Laporan IKM");
    XLSX.writeFile(wb, `Laporan_IKM_${new Date().toISOString().slice(0,10)}.xlsx`);
}

function exportToPDF() {
    const reportStats = window.ReportStats;
    const unsurData = window.UnsurData;
    const respondentsData = window.RespondentsData;

    if (!reportStats || !respondentsData || !respondentsData.length) {
        alert("Tidak ada data untuk diexport");
        return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4'); // Landscape

    // 1. Report Header
    doc.setFontSize(16);
    doc.text("LAPORAN INDEKS KEPUASAN MASYARAKAT (IKM)", 14, 20);
    
    // Get Metadata from DOM elements (UI Inputs)
    // We assume these elements exist on the page
    const layananEl = document.querySelector('select[name="layanan_id"] option:checked');
    const startEl = document.querySelector('input[name="start_date"]');
    const endEl = document.querySelector('input[name="end_date"]');

    const layananText = layananEl ? layananEl.text : '-';
    const periodeText = (startEl && endEl) ? `${startEl.value} s.d ${endEl.value}` : '-';

    doc.setFontSize(11);
    doc.text(`Unit Layanan: ${layananText}`, 14, 28);
    doc.text(`Periode: ${periodeText}`, 14, 34);
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
