<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    search: '',
    allData: <?= htmlspecialchars(json_encode($respondents), ENT_QUOTES, 'UTF-8') ?>,
    currentPage: 1,
    itemsPerPage: 10,
    showModal: false,
    selectedItem: null,
    
    get filteredData() {
        if (this.search === '') return this.allData;
        const lowerSearch = this.search.toLowerCase();
        return this.allData.filter(item => {
            return item.nama_lengkap.toLowerCase().includes(lowerSearch) || 
                   item.nama_layanan.toLowerCase().includes(lowerSearch);
        });
    },

    get totalPages() {
        return Math.ceil(this.filteredData.length / this.itemsPerPage);
    },
    get paginatedData() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.filteredData.slice(start, end);
    },
    nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
    prevPage() { if (this.currentPage > 1) this.currentPage--; },
    
    init() {
        this.$watch('search', () => this.currentPage = 1);
    },

    openDetail(item) {
        this.selectedItem = item;
        this.showModal = true;
    },
    formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
}">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Responden</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar masyarakat yang telah mengisi survei kepuasan</p>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" x-model="search" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#0e4c92] focus:border-[#0e4c92] sm:text-sm transition duration-150 ease-in-out" placeholder="Cari nama responden atau unit layanan...">
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                        <th class="px-6 py-4 font-semibold">Nama Responden</th>
                        <th class="px-6 py-4 font-semibold">Unit Layanan</th>
                        <th class="px-6 py-4 font-semibold">Tanggal Survei</th>
                        <th class="px-6 py-4 font-semibold text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="(item, index) in paginatedData" :key="item.id">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500 text-sm text-center" x-text="(currentPage - 1) * itemsPerPage + index + 1"></td>
                            <td class="px-6 py-4 text-gray-800 font-medium" x-text="item.nama_lengkap"></td>
                            <td class="px-6 py-4 text-gray-600" x-text="item.nama_layanan"></td>
                            <td class="px-6 py-4 text-gray-600 text-sm" x-text="formatDate(item.tanggal_survei)"></td>
                            <td class="px-6 py-4 text-center">
                                <button @click="openDetail(item)" class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg transition-colors text-sm font-medium">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredData.length === 0">
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada data yang cocok.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Controls -->
    <div class="mt-6 flex justify-center" x-show="totalPages > 1">
        <nav class="inline-flex -space-x-px text-sm">
            <button @click="prevPage" :disabled="currentPage === 1" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50">Previous</button>
            <span class="flex items-center justify-center px-4 h-8 leading-tight text-gray-500 bg-white border border-gray-300">Halaman <span x-text="currentPage" class="font-bold mx-1"></span> dari <span x-text="totalPages" class="font-bold mx-1"></span></span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50">Next</button>
        </nav>
    </div>

    <!-- Detail Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full relative z-10 transform transition-all" x-show="selectedItem">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-xl">
                    <h3 class="text-lg font-bold text-gray-800" x-text="selectedItem?.nama_lengkap"></h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Top Part: Respondent Info -->
                    <div class="grid grid-cols-2 gap-4 bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <div><span class="block text-xs text-gray-500 uppercase">Jenis Kelamin</span><span class="font-medium text-gray-800" x-text="selectedItem?.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'"></span></div>
                        <div><span class="block text-xs text-gray-500 uppercase">Umur</span><span class="font-medium text-gray-800" x-text="selectedItem?.umur + ' Tahun'"></span></div>
                        <div><span class="block text-xs text-gray-500 uppercase">Pendidikan</span><span class="font-medium text-gray-800" x-text="selectedItem?.nama_pendidikan"></span></div>
                        <div><span class="block text-xs text-gray-500 uppercase">Pekerjaan</span><span class="font-medium text-gray-800" x-text="selectedItem?.nama_pekerjaan"></span></div>
                    </div>

                    <!-- Middle Part: Scores -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-3">Penilaian Per Unsur</h4>
                        <div class="space-y-2 max-h-60 overflow-y-auto pr-2">
                            <template x-for="ans in selectedItem?.answers" :key="ans.kode_unsur">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <div>
                                        <span class="font-bold text-[#0e4c92] mr-2" x-text="ans.kode_unsur"></span>
                                        <span class="text-sm text-gray-700" x-text="ans.nama_unsur"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-xs text-gray-500 mr-2">Skor:</span>
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full border font-bold shadow-sm"
                                            :class="{
                                                'bg-red-100 text-red-700 border-red-200': ans.nilai_skor == 1,
                                                'bg-orange-100 text-orange-700 border-orange-200': ans.nilai_skor == 2,
                                                'bg-blue-100 text-blue-700 border-blue-200': ans.nilai_skor == 3,
                                                'bg-green-100 text-green-700 border-green-200': ans.nilai_skor == 4
                                            }" x-text="ans.nilai_skor"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Bottom Part: Saran -->
                    <div>
                        <h4 class="font-bold text-gray-800 mb-2">Saran & Masukan</h4>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-gray-700 italic">
                            "<span x-text="selectedItem?.saran_masukan || 'Tidak ada saran'"></span>"
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-between items-center">
                    <a :href="'<?= base_url('admin/responden/delete/') ?>' + selectedItem?.id"
                        onclick="return confirm('PERINGATAN: Cuma data spam yang sebaiknya dihapus.\n\nYakin ingin menghapus data responden ini?')"
                        class="text-red-500 hover:text-red-700 text-sm font-medium hover:underline transition-colors">
                        Hapus Data (Spam)
                    </a>
                    <button @click="showModal = false" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium shadow-sm">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>