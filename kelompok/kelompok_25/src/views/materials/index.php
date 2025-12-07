<?php
$materials = [
    ['name' => 'Tepung Terigu Premium', 'category' => 'Tepung', 'stock' => '150 Kg', 'min_stock' => '50 Kg', 'price' => 'Rp 12.000', 'supplier' => 'PT Bogasari', 'status' => 'normal'],
    ['name' => 'Gula Pasir', 'category' => 'Gula', 'stock' => '200 Kg', 'min_stock' => '80 Kg', 'price' => 'Rp 15.000', 'supplier' => 'CV Sumber Manis', 'status' => 'normal'],
    ['name' => 'Minyak Goreng', 'category' => 'Minyak', 'stock' => '75 Liter', 'min_stock' => '30 Liter', 'price' => 'Rp 18.000', 'supplier' => 'CV Sumber Rejeki', 'status' => 'normal'],
    ['name' => 'Coklat Bubuk', 'category' => 'Coklat', 'stock' => '5 Kg', 'min_stock' => '20 Kg', 'price' => 'Rp 85.000', 'supplier' => 'PT Coklat Nusantara', 'status' => 'low'],
    ['name' => 'Telur Ayam', 'category' => 'Telur', 'stock' => '45 Kg', 'min_stock' => '40 Kg', 'price' => 'Rp 28.000', 'supplier' => 'Farm Fresh', 'status' => 'normal'],
    ['name' => 'Mentega', 'category' => 'Dairy', 'stock' => '80 Kg', 'min_stock' => '25 Kg', 'price' => 'Rp 45.000', 'supplier' => 'PT Wijsman', 'status' => 'normal'],
];
?>

<section class="p-6 md:p-10 space-y-6">
    <div class="flex flex-col gap-2">
        <h1 class="text-2xl font-semibold text-slate-900">Data Bahan Baku</h1>
        <p class="text-sm text-slate-500">Kelola semua bahan baku inventory Anda</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">
        <div class="relative flex-1">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" /></svg>
            </span>
            <input type="text" placeholder="Cari bahan baku berdasarkan nama atau kategori..." class="w-full rounded-2xl border border-slate-200 pl-12 pr-4 py-3 shadow-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400" />
        </div>
        <button class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-semibold px-5 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" /></svg>
            Tambah Bahan Baku
        </button>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full">
            <thead class="bg-slate-50 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-4">Nama Bahan</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Min. Stok</th>
                    <th class="px-6 py-4">Harga/Unit</th>
                    <th class="px-6 py-4">Supplier</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                <?php foreach ($materials as $material): ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7l-9-4-9 4 9 4 9-4zm0 0v10l-9 4-9-4V7" /></svg>
                                </span>
                                <div>
                                    <p class="font-semibold text-slate-800"><?= e($material['name']) ?></p>
                                    <p class="text-xs text-slate-400">ID-<?= substr(md5($material['name']), 0, 6) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-500"><?= e($material['category']) ?></td>
                        <td class="px-6 py-4 font-semibold text-slate-800"><?= e($material['stock']) ?></td>
                        <td class="px-6 py-4 text-slate-500"><?= e($material['min_stock']) ?></td>
                        <td class="px-6 py-4 text-slate-800"><?= e($material['price']) ?></td>
                        <td class="px-6 py-4 text-slate-500"><?= e($material['supplier']) ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold <?php if ($material['status'] === 'low'): ?>bg-rose-50 text-rose-500<?php else: ?>bg-emerald-50 text-emerald-600<?php endif; ?>">
                                <span class="h-2 w-2 rounded-full <?php if ($material['status'] === 'low'): ?>bg-rose-500<?php else: ?>bg-emerald-500<?php endif; ?>"></span>
                                <?= $material['status'] === 'low' ? 'Habis' : 'Normal' ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3 text-blue-500">
                                <button class="hover:text-blue-600" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2m-1 14v-4m0 0l-4-4m4 4l4-4" /></svg>
                                </button>
                                <button class="text-rose-500 hover:text-rose-600" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V4h6v3m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
