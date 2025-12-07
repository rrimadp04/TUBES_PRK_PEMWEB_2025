<?php
$statCards = [
	['label' => 'Total Bahan Baku', 'value' => '156', 'change' => '+12', 'status' => 'up', 'icon' => 'cube'],
	['label' => 'Stok Masuk (Bulan Ini)', 'value' => '2,458', 'change' => '+18%', 'status' => 'up', 'icon' => 'arrow-down'],
	['label' => 'Stok Keluar (Bulan Ini)', 'value' => '1,832', 'change' => '-5%', 'status' => 'down', 'icon' => 'arrow-up'],
	['label' => 'Bahan Hampir Habis', 'value' => '23', 'change' => '+3', 'status' => 'warn', 'icon' => 'alert'],
];

$trendData = [
	'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
	'in' => [1800, 2100, 1900, 2600, 2400, 1750],
	'out' => [1500, 1700, 1650, 2000, 1850, 1600],
];

$categoryDistribution = [
	['label' => 'Tepung', 'percentage' => 35, 'color' => '#4f46e5'],
	['label' => 'Minyak', 'percentage' => 20, 'color' => '#f97316'],
	['label' => 'Telur', 'percentage' => 15, 'color' => '#facc15'],
	['label' => 'Lain', 'percentage' => 25, 'color' => '#22c55e'],
	['label' => 'Bumbu', 'percentage' => 5, 'color' => '#ec4899'],
];

$recentActivities = [
	['type' => 'in', 'title' => 'Tepung Terigu Premium', 'detail' => '50 Kg · PT Bogasari', 'time' => '2 jam lalu'],
	['type' => 'out', 'title' => 'Gula Pasir', 'detail' => '25 Kg · Produksi Roti', 'time' => '3 jam lalu'],
	['type' => 'in', 'title' => 'Minyak Goreng', 'detail' => '30 L · CV Sumber Rejeki', 'time' => '5 jam lalu'],
	['type' => 'out', 'title' => 'Telur Ayam', 'detail' => '10 Kg · Produksi Kue', 'time' => '6 jam lalu'],
];

$lowStockWarnings = [
	['label' => 'Coklat Bubuk', 'current' => 5, 'min' => 20, 'unit' => 'Kg'],
	['label' => 'Vanili Extract', 'current' => 2, 'min' => 10, 'unit' => 'Botol'],
	['label' => 'Baking Powder', 'current' => 8, 'min' => 25, 'unit' => 'Kg'],
	['label' => 'Keju Parut', 'current' => 3, 'min' => 15, 'unit' => 'Kg'],
];

function statIcon($type)
{
	$icons = [
		'cube' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 7l-9-4-9 4 9 4 9-4zm0 0v10l-9 4-9-4V7" />',
		'arrow-down' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m0 0l-6-6m6 6l6-6" />',
		'arrow-up' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m0 0l6 6m-6-6l-6 6" />',
		'alert' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M4.93 19h14.14a2 2 0 001.73-3l-7.07-12a2 2 0 00-3.46 0l-7.07 12a2 2 0 001.73 3z" />',
	];

	return $icons[$type] ?? $icons['cube'];
}

$trendMax = max(max($trendData['in']), max($trendData['out']));

$categoryGradientStops = [];
$current = 0;
foreach ($categoryDistribution as $category) {
	$next = $current + $category['percentage'];
	$categoryGradientStops[] = $category['color'] . ' ' . $current . '% ' . $next . '%';
	$current = $next;
}
$categoryGradient = implode(', ', $categoryGradientStops);
?>

<section class="p-6 md:p-10 space-y-8">
	<div>
		<p class="text-sm text-slate-500 uppercase tracking-[0.3em]">Dashboard</p>
		<h1 class="text-2xl font-semibold text-slate-800 mt-1">Selamat datang kembali!</h1>
		<p class="text-sm text-slate-500">Berikut ringkasan inventory Anda hari ini.</p>
	</div>

	<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
		<?php foreach ($statCards as $card): ?>
			<article class="rounded-2xl bg-white shadow-sm border border-slate-100 p-5 flex flex-col gap-3">
				<div class="flex items-center justify-between">
					<span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
							<?= statIcon($card['icon']) ?>
						</svg>
					</span>
					<span class="text-sm font-semibold <?php if ($card['status'] === 'up'): ?>text-emerald-600<?php elseif ($card['status'] === 'down'): ?>text-rose-500<?php else: ?>text-amber-500<?php endif; ?>">
						<?= e($card['change']) ?>
					</span>
				</div>
				<p class="text-sm text-slate-500"><?= e($card['label']) ?></p>
				<p class="text-2xl font-semibold text-slate-900"><?= e($card['value']) ?></p>
			</article>
		<?php endforeach; ?>
	</div>

	<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
		<article class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6 xl:col-span-2">
			<div class="flex items-center justify-between mb-6">
				<div>
					<h2 class="text-lg font-semibold text-slate-800">Tren Stok Masuk & Keluar</h2>
					<p class="text-sm text-slate-500">Perbandingan 6 bulan terakhir</p>
				</div>
			</div>
			<div class="grid grid-cols-6 gap-4 items-end h-64">
				<?php foreach ($trendData['labels'] as $index => $month): ?>
					<?php
					$inHeight = ($trendData['in'][$index] / $trendMax) * 100;
					$outHeight = ($trendData['out'][$index] / $trendMax) * 100;
					?>
					<div class="flex flex-col items-center gap-2">
						<div class="flex items-end gap-1 h-52 w-full">
							<span class="flex-1 rounded-full bg-emerald-200" style="height: <?= $inHeight ?>%"></span>
							<span class="flex-1 rounded-full bg-amber-200" style="height: <?= $outHeight ?>%"></span>
						</div>
						<p class="text-xs font-medium text-slate-500"><?= e($month) ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="flex items-center gap-4 mt-6 text-sm text-slate-500">
				<div class="flex items-center gap-2">
					<span class="h-3 w-3 rounded-full bg-emerald-400"></span> Stok Masuk
				</div>
				<div class="flex items-center gap-2">
					<span class="h-3 w-3 rounded-full bg-amber-400"></span> Stok Keluar
				</div>
			</div>
		</article>

		<article class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6">
			<h2 class="text-lg font-semibold text-slate-800">Distribusi Kategori Bahan</h2>
			<p class="text-sm text-slate-500">Komposisi stok saat ini</p>
			<div class="flex flex-col items-center gap-6 mt-6">
				<div class="relative h-48 w-48">
					<div class="absolute inset-0 rounded-full" style="background: conic-gradient(<?= $categoryGradient ?>);"></div>
					<div class="absolute inset-6 rounded-full bg-white flex items-center justify-center">
						<div class="text-center">
							<p class="text-xs text-slate-500">Total Bahan</p>
							<p class="text-xl font-semibold text-slate-800">100%</p>
						</div>
					</div>
				</div>
				<ul class="w-full space-y-3">
					<?php foreach ($categoryDistribution as $category): ?>
						<li class="flex items-center justify-between text-sm">
							<div class="flex items-center gap-3">
								<span class="h-3 w-3 rounded-full" style="background: <?= $category['color'] ?>"></span>
								<span class="text-slate-600"><?= e($category['label']) ?></span>
							</div>
							<span class="font-semibold text-slate-800"><?= $category['percentage'] ?>%</span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</article>
	</div>

	<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
		<article class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6">
			<div class="flex items-center justify-between mb-4">
				<h2 class="text-lg font-semibold text-slate-800">Aktivitas Terbaru</h2>
				<span class="text-sm text-slate-500">Update terakhir hari ini</span>
			</div>
			<div class="space-y-4">
				<?php foreach ($recentActivities as $activity): ?>
					<div class="flex items-start gap-4">
						<span class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-white <?php if ($activity['type'] === 'in'): ?>bg-emerald-400<?php else: ?>bg-amber-400<?php endif; ?>">
							<?php if ($activity['type'] === 'in'): ?>
								<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0l6-6m-6 6l-6-6" /></svg>
							<?php else: ?>
								<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l6 6m-6-6l-6 6" /></svg>
							<?php endif; ?>
						</span>
						<div class="flex-1">
							<p class="text-sm font-semibold text-slate-800"><?= e($activity['title']) ?></p>
							<p class="text-sm text-slate-500"><?= e($activity['detail']) ?></p>
						</div>
						<p class="text-xs text-slate-400"><?= e($activity['time']) ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</article>

		<article class="rounded-2xl bg-white border border-slate-100 shadow-sm p-6">
			<div class="flex items-center justify-between mb-4">
				<h2 class="text-lg font-semibold text-slate-800">Peringatan Stok Menipis</h2>
				<span class="text-xs font-semibold text-rose-500 bg-rose-50 px-3 py-1 rounded-full"><?= count($lowStockWarnings) ?> Item</span>
			</div>
			<div class="space-y-4">
				<?php foreach ($lowStockWarnings as $warning): ?>
					<?php $percentage = min(100, ($warning['current'] / $warning['min']) * 100); ?>
					<div>
						<div class="flex items-center justify-between text-sm">
							<p class="font-semibold text-slate-800"><?= e($warning['label']) ?></p>
							<p class="text-slate-500"><?= $warning['current'] ?>/<?= $warning['min'] ?> <?= e($warning['unit']) ?></p>
						</div>
						<div class="h-2 w-full bg-rose-100 rounded-full mt-2">
							<div class="h-full rounded-full bg-rose-500" style="width: <?= $percentage ?>%"></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</article>
	</div>
</section>
