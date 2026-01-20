<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    search: '',
    allData: <?= htmlspecialchars(json_encode($questions), ENT_QUOTES, 'UTF-8') ?>,
    currentPage: 1,
    itemsPerPage: 10,
    showModal: false, 
    isEdit: false,
    form: { id: '', jenis_layanan_id: '', unsur_id: '', pertanyaan: '' },
    
    get filteredData() {
        if (this.search === '') return this.allData;
        const lowerSearch = this.search.toLowerCase();
        return this.allData.filter(item => {
            return item.pertanyaan.toLowerCase().includes(lowerSearch) || 
                   item.nama_layanan.toLowerCase().includes(lowerSearch) ||
                   item.nama_unsur.toLowerCase().includes(lowerSearch);
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

    openAdd() {
        this.isEdit = false;
        this.form = { id: '', jenis_layanan_id: '', unsur_id: '', pertanyaan: '' };
        this.showModal = true;
    },
    openEdit(item) {
        this.isEdit = true;
        this.form = { id: item.id, jenis_layanan_id: item.jenis_layanan_id, unsur_id: item.unsur_id, pertanyaan: item.pertanyaan };
        this.showModal = true;
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Pertanyaan Survei</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola daftar pertanyaan untuk setiap unit layanan</p>
        </div>
        <button @click="openAdd()" class="bg-[#0e4c92] hover:bg-[#0a386e] text-white px-4 py-2 rounded-lg flex items-center transition-colors shadow-sm whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pertanyaan
        </button>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" x-model="search" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#0e4c92] focus:border-[#0e4c92] sm:text-sm transition duration-150 ease-in-out" placeholder="Cari pertanyaan, unit layanan, atau unsur...">
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                        <th class="px-6 py-4 font-semibold w-1/4">Unit Layanan</th>
                        <th class="px-6 py-4 font-semibold w-1/6">Unsur</th>
                        <th class="px-6 py-4 font-semibold">Pertanyaan</th>
                        <th class="px-6 py-4 font-semibold text-center w-24">Status</th>
                        <th class="px-6 py-4 font-semibold text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="(item, index) in paginatedData" :key="item.id">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500 text-sm text-center" x-text="(currentPage - 1) * itemsPerPage + index + 1"></td>
                            <td class="px-6 py-4 text-gray-800 text-sm font-medium" x-text="item.nama_layanan"></td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                <span class="font-bold text-gray-700" x-text="item.kode_unsur"></span> - <span x-text="item.nama_unsur"></span>
                            </td>
                            <td class="px-6 py-4 text-gray-800 text-sm" x-text="item.pertanyaan"></td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="item.is_active == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" x-text="item.is_active == 1 ? 'Aktif' : 'Nonaktif'"></span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-1">
                                <a :href="'<?= base_url('admin/master/pertanyaan/toggle/') ?>' + item.id" class="inline-flex items-center justify-center p-2 rounded-lg transition-colors" :class="item.is_active == 1 ? 'text-orange-500 hover:bg-orange-50' : 'text-green-500 hover:bg-green-50'" :title="item.is_active == 1 ? 'Nonaktifkan' : 'Aktifkan'">
                                    <svg x-show="item.is_active == 1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                    <svg x-show="item.is_active != 1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                                <button @click="openEdit(item)" class="inline-flex items-center justify-center p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <a :href="'<?= base_url('admin/master/pertanyaan/delete/') ?>' + item.id" onclick="return confirm('Yakin ingin menghapus data ini?')" class="inline-flex items-center justify-center p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredData.length === 0">
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Tidak ada data yang cocok.</td>
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

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-lg w-full relative z-10 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800" x-text="isEdit ? 'Edit Pertanyaan' : 'Tambah Pertanyaan'"></h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>
                <form action="<?= base_url('admin/master/pertanyaan/save') ?>" method="post" class="p-6 space-y-4">
                    <input type="hidden" name="id" x-model="form.id">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit Layanan</label>
                        <select name="jenis_layanan_id" x-model="form.jenis_layanan_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent">
                            <option value="">-- Pilih Unit Layanan --</option>
                            <?php foreach ($layanan as $l): ?><option value="<?= $l->id ?>"><?= esc($l->nama_layanan) ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unsur Pelayanan</label>
                        <select name="unsur_id" x-model="form.unsur_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent">
                            <option value="">-- Pilih Unsur --</option>
                            <?php foreach ($unsur as $u): ?><option value="<?= $u->id ?>"><?= esc($u->kode_unsur) ?> - <?= esc($u->nama_unsur) ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                        <textarea name="pertanyaan" x-model="form.pertanyaan" required rows="3" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent"></textarea>
                    </div>
                    <div class="pt-4 flex justify-end space-x-3">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-[#0e4c92] text-white rounded-lg hover:bg-[#0a386e] transition-colors font-medium shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>