<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    showModal: <?= session('errors') ? 'true' : 'false' ?>, 
    form: { 
        id: '<?= old('id') ?>', 
        kode_unsur: '<?= old('kode_unsur') ?>', 
        nama_unsur: '<?= old('nama_unsur') ?>' 
    },
    openEdit(item) {
        this.form = { id: item.id, kode_unsur: item.kode_unsur, nama_unsur: item.nama_unsur };
        this.showModal = true;
    }
}">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Master Unsur Pelayanan</h1>
            <p class="text-sm text-gray-500 mt-1">Data referensi unsur penilaian (Read Only / Edit)</p>
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
                        <th class="px-6 py-4 font-semibold w-24">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama Unsur Pelayanan</th>
                        <th class="px-6 py-4 font-semibold text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($unsur as $item) : ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium"><?= esc($item->kode_unsur) ?></td>
                            <td class="px-6 py-4 text-gray-600"><?= esc($item->nama_unsur) ?></td>
                            <td class="px-6 py-4 text-right">
                                <button @click='openEdit(<?= json_encode($item) ?>)' class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors flex items-center justify-end ml-auto">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($unsur)) : ?>
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada data unsur pelayanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showModal = false"></div>

        <!-- Modal Content -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full relative z-10 transform transition-all">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Edit Unsur Pelayanan</h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="<?= base_url('admin/master/unsur/update') ?>" method="post" class="p-6 space-y-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" x-model="form.id">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Unsur</label>
                        <input type="text" name="kode_unsur" x-model="form.kode_unsur" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Unsur</label>
                        <textarea name="nama_unsur" x-model="form.nama_unsur" required rows="3" 
                                  class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0e4c92] focus:border-transparent transition-colors
                                  <?= session('errors.nama_unsur') ? 'border-red-500 ring-1 ring-red-500 bg-red-50' : 'border-gray-300' ?>"></textarea>
                        <?php if (session('errors.nama_unsur')) : ?>
                            <p class="text-red-500 text-xs mt-1 font-medium animate-pulse"><?= session('errors.nama_unsur') ?></p>
                        <?php endif ?>
                    </div>

                    <div class="pt-4 flex justify-end space-x-3">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-[#0e4c92] text-white rounded-lg hover:bg-[#0a386e] transition-colors font-medium shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>