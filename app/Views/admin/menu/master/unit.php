<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    showModal: <?= session('errors') ? 'true' : 'false' ?>, 
    isEdit: <?= old('id') ? 'true' : 'false' ?>,
    form: { 
        id: '<?= old('id') ?>', 
        kode_layanan: '<?= old('kode_layanan') ?>', 
        nama_layanan: '<?= old('nama_layanan') ?>' 
    },
    openAdd() {
        this.isEdit = false;
        this.form = { id: '', kode_layanan: '', nama_layanan: '' };
        this.showModal = true;
    },
    openEdit(item) {
        this.isEdit = true;
        this.form = { id: item.id, kode_layanan: item.kode_layanan, nama_layanan: item.nama_layanan };
        this.showModal = true;
    }
}">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Unit Layanan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola referensi unit/jenis layanan (Tim Kerja)</p>
        </div>
        <button @click="openAdd()" class="bg-[#0e4c92] hover:bg-[#0a386e] text-white px-4 py-2 rounded-lg flex items-center transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Unit
        </button>
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

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($units as $item) : ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-200 group flex flex-col h-full relative overflow-hidden">
                <!-- Active Indicator Strip -->
                <div class="absolute top-0 left-0 w-1 h-full <?= $item->is_active ? 'bg-[#0e4c92]' : 'bg-gray-200' ?> transition-colors duration-300"></div>

                <div class="flex justify-between items-start mb-4 pl-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 tracking-wide">
                        <?= esc($item->kode_layanan) ?>
                    </span>
                    <div class="flex space-x-1">
                        <button @click='openEdit(<?= json_encode($item) ?>)' class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <a href="<?= base_url('admin/master/unit/delete/' . $item->id) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-800 mb-4 pl-3 line-clamp-2 flex-grow" title="<?= esc($item->nama_layanan) ?>">
                    <?= esc($item->nama_layanan) ?>
                </h3>

                <div class="flex items-center justify-between pt-4 border-t border-gray-50 pl-3">
                    <span class="text-sm font-medium <?= $item->is_active ? 'text-gray-600' : 'text-gray-400' ?>">
                        <?= $item->is_active ? 'Layanan Aktif' : 'Layanan Nonaktif' ?>
                    </span>
                    <!-- Toggle Switch -->
                    <a href="<?= base_url('admin/master/unit/toggle/' . $item->id) ?>" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:ring-offset-2 <?= $item->is_active ? 'bg-[#0e4c92]' : 'bg-gray-200' ?>" title="<?= $item->is_active ? 'Nonaktifkan' : 'Aktifkan' ?>">
                        <span class="sr-only">Toggle Status</span>
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform shadow-sm <?= $item->is_active ? 'translate-x-6' : 'translate-x-1' ?>"></span>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($units)) : ?>
            <div class="col-span-full text-center py-12 bg-white rounded-xl border border-gray-100 border-dashed">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada unit layanan</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan unit layanan baru.</p>
                <div class="mt-6">
                    <button @click="openAdd()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0e4c92] hover:bg-[#0a386e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0e4c92]">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Unit
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full relative z-10 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800" x-text="isEdit ? 'Edit Unit Layanan' : 'Tambah Unit Layanan'"></h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>
                <form action="<?= base_url('admin/master/unit/save') ?>" method="post" class="p-6 space-y-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" x-model="form.id">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Layanan</label>
                        <input type="text" name="kode_layanan" x-model="form.kode_layanan" required 
                               class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-colors
                               <?= session('errors.kode_layanan') ? 'border-red-500 ring-1 ring-red-500 bg-red-50' : 'border-gray-300' ?>" 
                               placeholder="Contoh: KL001">
                        <?php if (session('errors.kode_layanan')) : ?>
                            <p class="text-red-500 text-xs mt-1 font-medium animate-pulse"><?= session('errors.kode_layanan') ?></p>
                        <?php endif ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Unit Layanan</label>
                        <input type="text" name="nama_layanan" x-model="form.nama_layanan" required 
                               class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-colors
                               <?= session('errors.nama_layanan') ? 'border-red-500 ring-1 ring-red-500 bg-red-50' : 'border-gray-300' ?>" 
                               placeholder="Contoh: Sistem Informasi dan Digitalisasi">
                        <?php if (session('errors.nama_layanan')) : ?>
                            <p class="text-red-500 text-xs mt-1 font-medium animate-pulse"><?= session('errors.nama_layanan') ?></p>
                        <?php endif ?>
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