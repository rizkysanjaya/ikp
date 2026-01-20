<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    showModal: false, 
    isEdit: false,
    form: { original_id: '', id: '', nama_pendidikan: '' },
    openAdd() {
        this.isEdit = false;
        this.form = { original_id: '', id: '', nama_pendidikan: '' };
        this.showModal = true;
    },
    openEdit(item) {
        this.isEdit = true;
        this.form = { original_id: item.id, id: item.id, nama_pendidikan: item.nama_pendidikan };
        this.showModal = true;
    }
}">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Data Pendidikan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola referensi tingkat pendidikan responden</p>
        </div>
        <button @click="openAdd()" class="bg-[#0e4c92] hover:bg-[#0a386e] text-white px-4 py-2 rounded-lg flex items-center transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pendidikan
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

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4 font-semibold w-24 text-center">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama Pendidikan</th>
                        <th class="px-6 py-4 font-semibold text-center w-32">Status</th>
                        <th class="px-6 py-4 font-semibold text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($pendidikan as $item) : ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500 text-sm text-center"><?= esc($item->id) ?></td>
                            <td class="px-6 py-4 text-gray-800 font-medium"><?= esc($item->nama_pendidikan) ?></td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $item->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                    <?= $item->is_active ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-1">
                                <a href="<?= base_url('admin/master/pendidikan/toggle/' . $item->id) ?>" class="inline-flex items-center justify-center p-2 rounded-lg transition-colors <?= $item->is_active ? 'text-orange-500 hover:bg-orange-50' : 'text-green-500 hover:bg-green-50' ?>" title="<?= $item->is_active ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                    <?php if ($item->is_active): ?>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    <?php endif; ?>
                                </a>
                                <button @click='openEdit(<?= json_encode($item) ?>)' class="inline-flex items-center justify-center p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <a href="<?= base_url('admin/master/pendidikan/delete/' . $item->id) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="inline-flex items-center justify-center p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pendidikan)) : ?>
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data pendidikan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full relative z-10 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800" x-text="isEdit ? 'Edit Pendidikan' : 'Tambah Pendidikan'"></h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>
                <form action="<?= base_url('admin/master/pendidikan/save') ?>" method="post" class="p-6 space-y-4">
                    <input type="hidden" name="original_id" x-model="form.original_id">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pendidikan</label>
                        <input type="text" name="id" x-model="form.id" :readonly="isEdit" :class="{'bg-gray-100 cursor-not-allowed': isEdit}" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent" placeholder="Contoh: kp-001">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pendidikan</label>
                        <input type="text" name="nama_pendidikan" x-model="form.nama_pendidikan" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent" placeholder="Contoh: S1 / D4">
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