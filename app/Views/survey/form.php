<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-4 border-[#de1d5e]">
        <div class="px-6 py-8">

            <!-- Header & Progress -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Survei Kepuasan Masyarakat</h1>
                <p class="text-[#0e4c92] font-semibold text-lg">Unit: <?= esc($unit_name) ?></p>

                <!-- Simple Steps Indicator -->
                <div class="flex items-center justify-center mt-6 space-x-2">
                    <span id="step-dot-1" class="h-3 w-3 rounded-full bg-[#de1d5e]"></span>
                    <span class="h-1 w-10 bg-gray-200 rounded">
                        <div id="step-line" class="h-full bg-[#de1d5e] w-0 transition-all duration-300"></div>
                    </span>
                    <span id="step-dot-2" class="h-3 w-3 rounded-full bg-gray-300 transition-colors duration-300"></span>
                </div>
            </div>

            <form action="<?= base_url('survey/submit') ?>" method="post" id="surveyForm">
                <input type="hidden" name="unit_slug" value="<?= esc($slug) ?>">

                <!-- PART 1: DATA RESPONDEN -->
                <div id="step1" class="space-y-6 animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Bagian 1: Data Responden</h2>

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]">
                    </div>

                    <!-- Kelompok Usia -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelompok Usia</label>
                        <select name="usia" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]">
                            <option value="">-- Pilih Kelompok Usia --</option>
                            <option value="<20">Kurang dari 20 Tahun</option>
                            <option value="20-29">20 - 29 Tahun</option>
                            <option value="30-39">30 - 39 Tahun</option>
                            <option value="40-49">40 - 49 Tahun</option>
                            <option value="50-59">50 - 59 Tahun</option>
                            <option value=">60">Lebih dari 60 Tahun</option>
                        </select>
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                        <select name="pendidikan" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD">SD / Sederajat</option>
                            <option value="SMP">SMP / Sederajat</option>
                            <option value="SMA">SMA / Sederajat</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1 / D4</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <!-- Instansi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                        <input type="text" name="instansi" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]" placeholder="Contoh: BKN, Pemda Jabar, Umum">
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92]" placeholder="Contoh: PNS, Wiraswasta, Mahasiswa">
                    </div>

                    <div class="pt-4">
                        <button type="button" id="btn-next" class="w-full bg-[#0e4c92] text-white font-bold py-3 px-4 rounded hover:bg-blue-800 transition duration-200">
                            Lanjut ke Pertanyaan
                        </button>
                    </div>
                </div>

                <!-- PART 2: PERTANYAAN (Hidden Initially) -->
                <div id="step2" class="hidden space-y-8 animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Bagian 2: Penilaian Unit</h2>

                    <?php foreach ($questions as $index => $q): ?>
                        <div class="bg-gray-50 p-5 rounded border border-gray-200">
                            <p class="font-medium text-gray-800 mb-3"><?= ($index + 1) . '. ' . $q ?></p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <?php
                                $opts = [
                                    1 => 'Tidak Mudah',
                                    2 => 'Kurang Mudah',
                                    3 => 'Mudah',
                                    4 => 'Sangat Mudah'
                                ];
                                ?>
                                <?php foreach ($opts as $val => $label): ?>
                                    <label class="flex items-center space-x-2 cursor-pointer p-2 rounded hover:bg-blue-50 border border-transparent hover:border-blue-100 transition">
                                        <input type="radio" name="q<?= $index + 1 ?>" value="<?= $val ?>" class="survey-radio text-[#de1d5e] focus:ring-[#de1d5e]">
                                        <span class="text-sm text-gray-600"><?= $label ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="flex justify-between pt-6">
                        <button type="button" id="btn-prev" class="text-gray-600 font-medium hover:text-[#0e4c92]">
                            &larr; Kembali
                        </button>
                        <button type="submit" class="bg-[#de1d5e] text-white font-bold py-3 px-8 rounded hover:bg-[#b01648] transition duration-200 shadow-lg">
                            Kirim Survei
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const btnNext = document.getElementById('btn-next');
        const btnPrev = document.getElementById('btn-prev');

        // Indicators
        const stepLine = document.getElementById('step-line');
        const stepDot2 = document.getElementById('step-dot-2');

        btnNext.addEventListener('click', () => {
            // Validate Step 1 Inputs
            const inputs = step1.querySelectorAll('input[required], select[required]');
            let isValid = true;
            inputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (isValid) {
                step1.classList.add('hidden');
                step2.classList.remove('hidden');
                stepLine.classList.remove('w-0');
                stepLine.classList.add('w-full');
                stepDot2.classList.remove('bg-gray-300');
                stepDot2.classList.add('bg-[#de1d5e]');
                window.scrollTo(0, 0);

                // Enable required on radio buttons now that they are visible
                document.querySelectorAll('.survey-radio').forEach(r => r.required = true);
            } else {
                alert('Mohon lengkapi semua data diri terlebih dahulu.');
            }
        });

        btnPrev.addEventListener('click', () => {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            stepLine.classList.remove('w-full');
            stepLine.classList.add('w-0');
            stepDot2.classList.remove('bg-[#de1d5e]');
            stepDot2.classList.add('bg-gray-300');

            // Disable required so browser doesn't complain about hidden fields
            document.querySelectorAll('.survey-radio').forEach(r => r.required = false);
        });
    });
</script>
<?= $this->endSection() ?>