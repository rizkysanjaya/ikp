<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    search: '',
    allData: <?= htmlspecialchars(json_encode($instansi), ENT_QUOTES, 'UTF-8') ?>,
    currentPage: 1,
    itemsPerPage: 10,
    showModal: false, 
    isEdit: false,
    form: { original_id: '', id: '', nama_instansi: '' },
    
    // Filter Logic
    get filteredData() {
        if (this.search === '') return this.allData;
        return this.allData.filter(item => {
            return item.nama_instansi.toLowerCase().includes(this.search.toLowerCase()) || 
                   item.id.toLowerCase().includes(this.search.toLowerCase());
        });
    },

    // Pagination Logic
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
        this.form = { original_id: '', id: '', nama_instansi: '' };
        this.showModal = true;
    },
    openEdit(item) {
        this.isEdit = true;
        this.form = { original_id: item.id, id: item.id, nama_instansi: item.nama_instansi };
        this.showModal = true;
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Data Instansi</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola referensi instansi/kementerian/lembaga</p>
        </div>
        <button @click="openAdd()" class="bg-[#0e4c92] hover:bg-[#0a386e] text-white px-4 py-2 rounded-lg flex items-center transition-colors shadow-sm whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Instansi
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
            <input type="text" x-model="search" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#0e4c92] focus:border-[#0e4c92] sm:text-sm transition duration-150 ease-in-out" placeholder="Cari instansi (Ketik untuk memfilter)...">
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc list-inside">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4 font-semibold w-24 text-center">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama Instansi</th>
                        <th class="px-6 py-4 font-semibold text-center w-32">Status</th>
                        <th class="px-6 py-4 font-semibold text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="item in paginatedData" :key="item.id">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500 text-sm text-center" x-text="item.id"></td>
                            <td class="px-6 py-4 text-gray-800 font-medium" x-text="item.nama_instansi"></td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="item.is_active == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" x-text="item.is_active == 1 ? 'Aktif' : 'Nonaktif'">
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-1">
                                <a :href="'<?= base_url('admin/master/instansi/toggle/') ?>' + item.id" class="inline-flex items-center justify-center p-2 rounded-lg transition-colors" :class="item.is_active == 1 ? 'text-orange-500 hover:bg-orange-50' : 'text-green-500 hover:bg-green-50'" :title="item.is_active == 1 ? 'Nonaktifkan' : 'Aktifkan'">
                                    <template x-if="item.is_active == 1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                    </template>
                                    <template x-if="item.is_active != 1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </template>
                                </a>
                                <button @click="openEdit(item)" class="inline-flex items-center justify-center p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <a :href="'<?= base_url('admin/master/instansi/delete/') ?>' + item.id" onclick="return confirm('Yakin ingin menghapus data ini?')" class="inline-flex items-center justify-center p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredData.length === 0">
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            Tidak ada data yang cocok.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Client-Side Pagination Controls -->
    <div class="mt-6 flex justify-center" x-show="totalPages > 1">
        <nav aria-label="Page navigation">
            <ul class="inline-flex -space-x-px text-sm">
                <li>
                    <button @click="prevPage" :disabled="currentPage === 1" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="sr-only">Previous</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </button>
                </li>
                <li>
                    <span class="flex items-center justify-center px-4 h-8 leading-tight text-gray-500 bg-white border border-gray-300">
                        Halaman <span x-text="currentPage" class="font-bold mx-1"></span> dari <span x-text="totalPages" class="font-bold mx-1"></span>
                    </span>
                </li>
                <li>
                    <button @click="nextPage" :disabled="currentPage === totalPages" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="sr-only">Next</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full relative z-10 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800" x-text="isEdit ? 'Edit Instansi' : 'Tambah Instansi'"></h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>
                <form action="<?= base_url('admin/master/instansi/save') ?>" method="post" class="p-6 space-y-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="original_id" x-model="form.original_id">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Instansi</label>
                        <input type="text" name="id" x-model="form.id" :readonly="isEdit" :class="{'bg-gray-100 cursor-not-allowed': isEdit}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent" placeholder="Contoh: 4011">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Instansi</label>
                        <input type="text" name="nama_instansi" x-model="form.nama_instansi" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent" placeholder="Contoh: Badan Kepegawaian Negara">
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