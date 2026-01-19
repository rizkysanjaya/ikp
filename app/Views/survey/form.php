<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    /* Custom styles to make Select2 match Tailwind inputs */
    .select2-container .select2-selection--single {
        height: 42px !important;
        border: 1px solid #d1d5db !important;
        /* gray-300 */
        border-radius: 0.5rem !important;
        /* rounded-lg */
        position: relative;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #374151 !important;
        /* text-gray-700 */
        padding-left: 0.75rem !important;
        line-height: 40px !important;
        /* Vertically center text */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        top: 1px !important;
        right: 1px !important;
    }

    /* Fix Clear Button Position */
    .select2-container--default .select2-selection--single .select2-selection__clear {
        position: absolute !important;
        right: 35px;
        /* Position to the left of the arrow */
        top: 0;
        height: 40px;
        line-height: 40px;
        color: #9ca3af;
        /* gray-400 */
        font-weight: bold;
        font-size: 18px;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear:hover {
        color: #dc2626;
        /* red-600 */
    }

    .select2-container--open .select2-selection--single {
        border-color: #0e4c92;
        box-shadow: 0 0 0 2px rgba(14, 76, 146, 0.2);
    }
</style>

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-2xl border-t-8 border-[#de1d5e]">
        <div class="px-6 py-8">

            <!-- Header & Progress -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Indeks Kepuasan Pelayanan</h1>
                <p class="text-[#0e4c92] font-semibold text-lg mb-6">Unit: <?= esc($unit_name) ?></p>

                <!-- Intro Section -->
                <div class="bg-blue-50 border-l-4 border-[#0e4c92] rounded-r-lg p-5 mb-8 text-sm text-blue-900 text-left shadow-sm">
                    <p class="mb-2">Mohon berkenan Bapak/Ibu penerima layanan kepegawaian <strong>Kantor Regional III BKN Bandung</strong> untuk dapat mengisi survei <strong>Indeks Kepuasan Pelayanan (IKP)</strong> ini. Kami harap Bapak/Ibu dapat memberikan tanggapan terbaik atas pelayanan yang telah diterima. Hasil dari survei ini akan menjadi dasar evaluasi kami.</p>
                    <p class="font-bold">Form bertanda bintang (*) wajib diisi.</p>
                </div>

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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-all duration-200 shadow-sm" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <!-- Radio Buttons -->
                            <div id="jk-container" class="grid grid-cols-2 gap-4 p-1 rounded-lg transition-colors">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="jenis_kelamin" value="L" required class="peer sr-only">
                                    <div class="p-2.5 rounded-lg border border-gray-300 bg-white text-center hover:bg-gray-50 peer-checked:border-[#0e4c92] peer-checked:bg-blue-50 peer-checked:text-[#0e4c92] peer-checked:ring-1 peer-checked:ring-[#0e4c92] transition-all duration-200 shadow-sm">
                                        <span class="text-sm font-medium">Laki-laki</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="jenis_kelamin" value="P" required class="peer sr-only">
                                    <div class="p-2.5 rounded-lg border border-gray-300 bg-white text-center hover:bg-gray-50 peer-checked:border-[#de1d5e] peer-checked:bg-pink-50 peer-checked:text-[#de1d5e] peer-checked:ring-1 peer-checked:ring-[#de1d5e] transition-all duration-200 shadow-sm">
                                        <span class="text-sm font-medium">Perempuan</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Usia -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Umur (Tahun) <span class="text-red-500">*</span></label>
                            <input type="number" name="umur" required min="17" max="100" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-all duration-200 shadow-sm" placeholder="Contoh: 25">
                        </div>
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                        <select name="pendidikan" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-all duration-200 shadow-sm bg-white">
                            <option value="">-- Pilih Pendidikan --</option>
                            <?php foreach ($pendidikan as $p): ?>
                                <option value="<?= esc($p->id) ?>"><?= esc($p->nama_pendidikan) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Instansi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instansi <span class="text-red-500">*</span></label>
                        <select id="instansi-select" name="instansi" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] shadow-sm">
                            <option value="">-- Pilih Instansi --</option>
                            <!-- Options will be loaded via AJAX -->
                        </select>
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                        <select name="pekerjaan" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-all duration-200 shadow-sm bg-white">
                            <option value="">-- Pilih Pekerjaan --</option>
                            <?php foreach ($pekerjaan as $p): ?>
                                <option value="<?= esc($p->id) ?>"><?= esc($p->nama_pekerjaan) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="pt-4">
                        <button type="button" id="btn-next" class="w-full bg-gradient-to-r from-[#0e4c92] to-[#0a386e] text-white font-bold py-3.5 px-4 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            Lanjut ke Pertanyaan
                        </button>
                    </div>
                </div>

                <!-- PART 2: PERTANYAAN (Hidden Initially) -->
                <div id="step2" class="hidden space-y-8 animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Bagian 2: Penilaian Unit</h2>

                    <!-- Sticky Progress Header -->
                    <div class="sticky top-20 z-30 bg-white/95 backdrop-blur-sm border-b border-gray-200 -mx-6 px-6 py-4 mb-6 shadow-sm transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm sm:text-base">Kuesioner Pelayanan</h3>
                                <p class="text-xs text-gray-500">Mohon isi sesuai pengalaman nyata Anda.</p>
                            </div>
                            <div class="text-right">
                                <span id="progress-count" class="text-xl font-bold text-[#0e4c92]">0</span>
                                <span class="text-gray-500 text-xs sm:text-sm font-medium">/ <?= count($questions) ?> Terisi</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-3 overflow-hidden">
                            <div id="progress-bar" class="bg-[#0e4c92] h-1.5 rounded-full transition-all duration-500 ease-out" style="width: 0%"></div>
                        </div>
                    </div>

                    <?php if (empty($questions)): ?>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: solid/exclamation -->
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Belum ada pertanyaan survei yang dapat ditampilkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($questions as $index => $q): ?>
                            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                <p class="font-semibold text-gray-800 mb-4 text-lg"><?= ($index + 1) . '. ' . esc($q->pertanyaan) ?></p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                    <?php foreach ($q->options as $opt): ?>
                                        <label class="cursor-pointer relative group">
                                            <input type="radio" name="jawaban[<?= $q->id ?>]" value="<?= esc($opt->id) ?>" class="peer sr-only survey-radio">
                                            <div class="h-full p-3 rounded-lg border border-gray-200 bg-gray-50 hover:bg-white hover:border-blue-300 peer-checked:border-[#0e4c92] peer-checked:bg-blue-50 peer-checked:text-[#0e4c92] peer-checked:ring-1 peer-checked:ring-[#0e4c92] transition-all duration-200 flex items-center justify-center text-center">
                                                <span class="text-sm font-medium group-hover:text-gray-900 peer-checked:font-bold"><?= esc($opt->label_jawaban) ?></span>
                                            </div>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Saran -->
                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                            <label class="block font-semibold text-gray-800 mb-3">Saran & Masukan</label>
                            <textarea name="saran_masukan" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-all duration-200" placeholder="Tuliskan saran dan masukan Anda untuk peningkatan kualitas pelayanan kami..."></textarea>
                        </div>
                    <?php endif; ?>

                    <div class="flex justify-between pt-6">
                        <button type="button" id="btn-prev" class="text-gray-600 font-medium hover:text-[#0e4c92]">
                            &larr; Kembali
                        </button>
                        <?php if (!empty($questions)): ?>
                            <button type="submit" class="bg-gradient-to-r from-[#de1d5e] to-[#b01648] text-white font-bold py-3.5 px-10 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                Kirim Survei
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#instansi-select').select2({
            placeholder: '-- Pilih Instansi --',
            allowClear: true,
            width: '100%',
            ajax: {
                url: '<?= base_url('survey/getInstansi') ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const btnNext = document.getElementById('btn-next');
        const btnPrev = document.getElementById('btn-prev');

        // Indicators
        const stepLine = document.getElementById('step-line');
        const stepDot2 = document.getElementById('step-dot-2');

        // Progress Bar Logic
        function updateProgress() {
            const totalQuestions = <?= count($questions) ?>;
            const answered = document.querySelectorAll('.survey-radio:checked').length;
            const percent = totalQuestions > 0 ? (answered / totalQuestions) * 100 : 0;

            document.getElementById('progress-count').innerText = answered;
            document.getElementById('progress-bar').style.width = percent + '%';
        }

        btnNext.addEventListener('click', () => {
            // Validate Step 1 Inputs
            const inputs = step1.querySelectorAll('input[required]:not([type="radio"]), select[required]');
            let isValid = true;
            inputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            // Validate Jenis Kelamin (Radio)
            const jkContainer = document.getElementById('jk-container');
            const jkChecked = step1.querySelector('input[name="jenis_kelamin"]:checked');

            if (!jkChecked) {
                isValid = false;
                jkContainer.classList.add('bg-red-50', 'border', 'border-red-300');
            } else {
                jkContainer.classList.remove('bg-red-50', 'border', 'border-red-300');
            }

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

                // Initialize progress listeners
                document.querySelectorAll('.survey-radio').forEach(radio => {
                    radio.addEventListener('change', updateProgress);
                });
                updateProgress(); // Initial check
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