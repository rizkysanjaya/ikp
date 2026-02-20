<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    /* Custom styles from IKP Form */
    .select2-container .select2-selection--single {
        height: 42px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        position: relative;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #374151 !important;
        padding-left: 0.75rem !important;
        line-height: 40px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        top: 1px !important;
        right: 1px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__clear {
        position: absolute !important;
        right: 35px;
        top: 0;
        height: 40px;
        line-height: 40px;
        color: #9ca3af;
        font-weight: bold;
        font-size: 18px;
    }
    .select2-container--default .select2-selection--single .select2-selection__clear:hover {
        color: #ea580c; /* orange-600 */
    }
    .select2-container--open .select2-selection--single {
        border-color: #ea580c;
        box-shadow: 0 0 0 2px rgba(234, 88, 12, 0.2);
    }
    
    /* Validation Error Styles */
    .input-error {
        border-color: #ef4444 !important;
        background-color: #fef2f2;
    }
    .text-error {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        font-weight: 500;
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-2xl border-t-8 border-orange-500">
        <div class="px-6 py-8">

            <!-- Header & Progress -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Survei Pembinaan Kepegawaian</h1>
                <p class="text-orange-600 font-semibold text-lg mb-6">Unit: <?= esc($selected_unit) ?></p>

                <!-- Intro Section -->
                <div class="bg-orange-50 border-l-4 border-orange-600 rounded-r-lg p-5 mb-8 text-sm text-orange-900 text-left shadow-sm">
                    <p class="mb-2">Mohon berkenan Bapak/Ibu untuk mengisi survei pembinaan kepegawaian ini. Masukan Anda sangat berharga untuk peningkatan kualitas pembinaan kami.</p>
                    <p class="font-bold">Form bertanda bintang (*) wajib diisi.</p>
                </div>

                <!-- Simple Steps Indicator -->
                <div class="flex items-center justify-center mt-6 space-x-2">
                    <span id="step-dot-1" class="h-3 w-3 rounded-full bg-orange-500"></span>
                    <span class="h-1 w-10 bg-gray-200 rounded">
                        <div id="step-line" class="h-full bg-orange-500 w-0 transition-all duration-300"></div>
                    </span>
                    <span id="step-dot-2" class="h-3 w-3 rounded-full bg-gray-300 transition-colors duration-300"></span>
                </div>
            </div>

            <form action="<?= base_url('pembinaan/submit') ?>" method="post" id="surveyForm">
                <?= csrf_field() ?>
                <input type="hidden" name="unit_kerja_terkait" value="<?= esc($selected_unit) ?>">

                <!-- PART 1: DATA RESPONDEN -->
                <div id="step1" class="space-y-6 animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Bagian 1: Data Responden & Kegiatan</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap Text -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" required value="<?= esc(old('nama_lengkap')) ?>" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 shadow-sm" placeholder="Masukkan nama lengkap Anda">
                        </div>

                         <!-- Instansi Select2 -->
                         <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Instansi <span class="text-red-500">*</span></label>
                            <select id="instansi-select" name="instansi_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 shadow-sm">
                                <option value="">-- Pilih Instansi --</option>
                                <?php foreach($instansi as $ins): ?>
                                    <option value="<?= $ins->nama_instansi ?>" <?= (old('instansi_id') == $ins->nama_instansi) ? 'selected' : '' ?>><?= $ins->nama_instansi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Kelompok Usia -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kelompok Usia <span class="text-red-500">*</span></label>
                            <select name="kelompok_usia" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 shadow-sm bg-white">
                                <option value="">Pilih Kelompok Usia</option>
                               <?php 
                               $ages = ['< 25 Tahun', '25 - 35 Tahun', '36 - 45 Tahun', '46 - 55 Tahun', '> 55 Tahun'];
                               foreach($ages as $a): ?>
                                <option value="<?= $a ?>" <?= (old('kelompok_usia') == $a) ? 'selected' : '' ?>><?= $a ?></option>
                               <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div id="jk-container" class="grid grid-cols-2 gap-4 p-1 rounded-lg transition-colors">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="jenis_kelamin" value="L" <?= (old('jenis_kelamin') == 'L') ? 'checked' : '' ?> required class="peer sr-only">
                                    <div class="p-2.5 rounded-lg border border-gray-300 bg-white text-center hover:bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-600 peer-checked:ring-1 peer-checked:ring-blue-600 transition-all duration-200 shadow-sm">
                                        <span class="text-sm font-medium">Laki-laki</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="jenis_kelamin" value="P" <?= (old('jenis_kelamin') == 'P') ? 'checked' : '' ?> required class="peer sr-only">
                                    <div class="p-2.5 rounded-lg border border-gray-300 bg-white text-center hover:bg-gray-50 peer-checked:border-pink-500 peer-checked:bg-pink-50 peer-checked:text-pink-500 peer-checked:ring-1 peer-checked:ring-pink-500 transition-all duration-200 shadow-sm">
                                        <span class="text-sm font-medium">Perempuan</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Pendidikan Terakhir -->
                         <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                            <select name="pendidikan_terakhir" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 shadow-sm bg-white">
                                <option value="">Pilih Pendidikan</option>
                                <?php 
                                $edu = ['SD ke bawah', 'SMP / Sederajat', 'SMA / Sederajat', 'D1', 'D2', 'D3', 'D4 / S1', 'S2', 'S3'];
                                foreach($edu as $e): ?>
                                    <option value="<?= $e ?>" <?= (old('pendidikan_terakhir') == $e) ? 'selected' : '' ?>><?= $e ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                         <!-- Tempat Pelaksanaan -->
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Pelaksanaan <span class="text-red-500">*</span></label>
                            <select name="tempat_pelaksanaan" required class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 shadow-sm bg-white">
                                <option value="">Pilih Tempat</option>
                                <option value="Kantor Regional III BKN" <?= (old('tempat_pelaksanaan') == 'Kantor Regional III BKN') ? 'selected' : '' ?>>Kantor Regional III BKN</option>
                                <option value="Luar Lingkungan Kantor Regional III BKN" <?= (old('tempat_pelaksanaan') == 'Luar Lingkungan Kantor Regional III BKN') ? 'selected' : '' ?>>Luar Lingkungan Kantor Regional III BKN</option>
                            </select>
                        </div>

                        <!-- Tanggal Pelaksanaan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_pelaksanaan" required value="<?= esc(old('tanggal_pelaksanaan')) ?>" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 shadow-sm">
                        </div>

                         <!-- Metode Penyampaian -->
                         <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Metode Penyampaian <span class="text-red-500">*</span></label>
                             <div id="metode-container" class="grid grid-cols-2 gap-4 p-1 rounded-lg transition-colors">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="metode_penyampaian" value="Luring" <?= (old('metode_penyampaian') == 'Luring') ? 'checked' : '' ?> required class="peer sr-only">
                                    <div class="p-2.5 rounded-lg border border-gray-300 bg-white text-center hover:bg-gray-50 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 peer-checked:ring-1 peer-checked:ring-orange-500 transition-all duration-200 shadow-sm">
                                        <span class="text-sm font-medium">Tatap Muka (Luring)</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="metode_penyampaian" value="Daring" <?= (old('metode_penyampaian') == 'Daring') ? 'checked' : '' ?> required class="peer sr-only">
                                    <div class="p-2.5 rounded-lg border border-gray-300 bg-white text-center hover:bg-gray-50 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 peer-checked:ring-1 peer-checked:ring-orange-500 transition-all duration-200 shadow-sm">
                                        <span class="text-sm font-medium">Zoom (Daring)</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                         <!-- Tema Kegiatan -->
                         <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tema Kegiatan <span class="text-red-500">*</span></label>
                            <input type="text" name="tema_kegiatan" required value="<?= esc(old('tema_kegiatan')) ?>" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 shadow-sm" placeholder="Judul acara / kegiatan">
                        </div>

                    </div>

                    <div class="pt-4">
                        <button type="button" id="btn-next" class="w-full bg-gradient-to-r from-orange-600 to-orange-500 text-white font-bold py-3.5 px-4 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            Lanjut ke Pertanyaan
                        </button>
                    </div>
                </div>

                <!-- PART 2: PERTANYAAN (Hidden Initially) -->
                <div id="step2" class="hidden space-y-8 animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Bagian 2: Penilaian Kualitas</h2>

                    <!-- Sticky Progress Header -->
                    <div class="sticky top-0 z-30 bg-white/95 backdrop-blur-sm border-b border-gray-200 -mx-6 px-6 py-4 mb-6 shadow-sm transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm sm:text-base">Kuesioner Pembinaan</h3>
                                <p class="text-xs text-gray-500">Mohon isi sesuai pengalaman nyata Anda.</p>
                            </div>
                            <div class="text-right">
                                <span id="progress-count" class="text-xl font-bold text-orange-600">0</span>
                                <span class="text-gray-500 text-xs sm:text-sm font-medium">/ <?= count($questions) ?> Terisi</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-3 overflow-hidden">
                            <div id="progress-bar" class="bg-orange-600 h-1.5 rounded-full transition-all duration-500 ease-out" style="width: 0%"></div>
                        </div>
                    </div>

                    <?php foreach ($questions as $q): ?>
                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <p class="font-semibold text-gray-800 mb-4 text-lg"><?= $q->nomor_urut . '. ' . esc($q->pertanyaan) ?></p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <?php 
                                $options = [
                                    4 => 'Sangat Setuju / Sangat Sesuai',
                                    3 => 'Setuju / Sesuai',
                                    2 => 'Kurang Setuju / Kurang Sesuai',
                                    1 => 'Tidak Setuju / Tidak Sesuai'
                                ];
                                foreach($options as $val => $label): 
                                ?>
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="jawaban[<?= $q->id ?>]" value="<?= $val ?>" <?= (old('jawaban.' . $q->id) == $val) ? 'checked' : '' ?> class="peer sr-only survey-radio">
                                        <div class="h-full p-3 rounded-lg border border-gray-200 bg-gray-50 hover:bg-white hover:border-orange-300 peer-checked:border-orange-600 peer-checked:bg-orange-50 peer-checked:text-orange-600 peer-checked:ring-1 peer-checked:ring-orange-600 transition-all duration-200 flex items-center justify-center text-center">
                                            <span class="text-sm font-medium group-hover:text-gray-900 peer-checked:font-bold"><?= $label ?></span>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Saran -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <label class="block font-semibold text-gray-800 mb-3">Saran dan Masukan yang ingin anda sampaikan guna peningkatan pembinaan yang diberikan oleh Kantor Regional III BKN</label>
                        <textarea name="saran_masukan" rows="4" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200" placeholder="Tuliskan saran dan masukan Anda..."><?= esc(old('saran_masukan')) ?></textarea>
                    </div>

                    <div class="flex justify-between pt-6">
                        <button type="button" id="btn-prev" class="text-gray-600 font-medium hover:text-orange-600">
                            &larr; Kembali
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-orange-600 to-orange-500 text-white font-bold py-3.5 px-10 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            Kirim Survei
                        </button>
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
            width: '100%'
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const btnNext = document.getElementById('btn-next');
        const btnPrev = document.getElementById('btn-prev');

        const stepLine = document.getElementById('step-line');
        const stepDot2 = document.getElementById('step-dot-2');

        function updateProgress() {
            const totalQuestions = <?= count($questions) ?>;
            const answered = document.querySelectorAll('.survey-radio:checked').length;
            const percent = totalQuestions > 0 ? (answered / totalQuestions) * 100 : 0;
            document.getElementById('progress-count').innerText = answered;
            document.getElementById('progress-bar').style.width = percent + '%';
        }

        const showError = (element, message) => {
            const parent = element.closest('div');
            const existingError = parent.querySelector('.text-error');
            if(existingError) existingError.remove();

            if(element.classList.contains('select2-hidden-accessible')) {
                 const selection = parent.querySelector('.select2-selection');
                 if(selection) selection.style.borderColor = '#ef4444';
            } else if (element.type !== 'radio') {
                element.classList.add('input-error');
            }

            const msg = document.createElement('p');
            msg.className = 'text-error';
            msg.innerText = message;
            
            if (element.type === 'radio') {
                 const container = element.closest('.grid');
                 container.parentElement.appendChild(msg);
            } else if(element.classList.contains('select2-hidden-accessible')) {
                 parent.appendChild(msg);
            } else {
                 element.parentElement.appendChild(msg);
            }
        };

        const clearError = (element) => {
             if (element.type === 'radio') {
                 const container = element.closest('.grid');
                 container.classList.remove('bg-red-50', 'border', 'border-red-300');
                 const existingError = container.parentElement.querySelector('.text-error');
                 if(existingError) existingError.remove();
                 return;
             }
             const parent = element.closest('div');
             const existingError = parent.querySelector('.text-error');
             if(existingError) existingError.remove();
             if(element.classList.contains('select2-hidden-accessible')) {
                 const selection = parent.querySelector('.select2-selection');
                 if(selection) selection.style.borderColor = '';
            } else {
                element.classList.remove('input-error');
            }
        };

        const inputs = step1.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('input', () => clearError(input));
            input.addEventListener('change', () => clearError(input));
            if(input.tagName === 'SELECT') {
                 $(input).on('select2:select', function (e) { clearError(input); });
            }
        });

        btnNext.addEventListener('click', () => {
            let isValid = true;
            let firstInvalid = null;

            // Simple Required Validation
            const requiredInputs = step1.querySelectorAll('input[required], select[required]');
            requiredInputs.forEach(input => {
                if(input.type === 'radio') {
                    const groupName = input.name;
                    const checked = step1.querySelector(`input[name="${groupName}"]:checked`);
                    const container = input.closest('.grid');
                    if(!checked) {
                        isValid = false;
                        container.classList.add('bg-red-50', 'border', 'border-red-300');
                        showError(input, 'Harap pilih salah satu opsi.');
                        if(!firstInvalid) firstInvalid = container;
                    }
                } else if(!input.value.trim()) {
                    isValid = false;
                    showError(input, 'Field ini wajib diisi.');
                    if(!firstInvalid) firstInvalid = input;
                }
            });

            if (isValid) {
                step1.classList.add('hidden');
                step2.classList.remove('hidden');
                stepLine.classList.remove('w-0');
                stepLine.classList.add('w-full');
                stepDot2.classList.remove('bg-gray-300');
                stepDot2.classList.add('bg-orange-500');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                document.querySelectorAll('.survey-radio').forEach(r => {
                    r.required = true;
                    r.addEventListener('change', updateProgress);
                });
                updateProgress();
            } else {
                 if(firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });

        btnPrev.addEventListener('click', () => {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            stepLine.classList.remove('w-full');
            stepLine.classList.add('w-0');
            stepDot2.classList.remove('bg-orange-500');
            stepDot2.classList.add('bg-gray-300');
            document.querySelectorAll('.survey-radio').forEach(r => r.required = false);
        });
    });
</script>
<?= $this->endSection() ?>
