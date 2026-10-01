<?= $this->extend('template/index'); ?>

<?= $this->section('title'); ?>
<title><?= esc($title); ?></title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Dashboard Monitoring</h2>
            <p class="text-muted mb-0">Ringkasan master user, status pelabuhan, dan prakiraan maritim BMKG</p>
        </div>
        <div>
            <a href="<?= site_url('ports') ?>" class="btn btn-outline-primary btn-sm me-2">
                <i class="bi bi-geo-alt"></i> Kelola Pelabuhan
            </a>
            <a href="<?= site_url('ports/weather/sync-all') ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-repeat"></i> Sync Semua Cuaca
            </a>
        </div>
    </div>

    <!-- 4 Kartu Statistik Ringkas -->
    <div class="row g-3 mb-4">
        <!-- Card Total User -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-primary border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Pengguna</div>
                            <div class="h4 mb-0 fw-bold text-gray-800"><?= number_format($totalUsers) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Card Total Pelabuhan -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-info border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">Master Pelabuhan</div>
                            <div class="h4 mb-0 fw-bold text-gray-800"><?= number_format($totalPorts) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-compass fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Pelabuhan Dipantau -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-success border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Pelabuhan Dipantau</div>
                            <div class="h4 mb-0 fw-bold text-gray-800"><?= number_format($monitoredPorts) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-radar fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Prakiraan Cuaca -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-warning border-4 h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">Record Prakiraan Cuaca</div>
                            <div class="h4 mb-0 fw-bold text-gray-800"><?= number_format($totalWeathers) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cloud-sun fs-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris Konten: Pelabuhan Dipantau & User Terbaru -->
    <div class="row g-4">
        <!-- Kolom Kiri: Cuaca Pelabuhan Terpantau -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Kondisi Cuaca Pelabuhan Pantauan (3 Jam)</h6>
                    <span class="badge bg-primary"><?= count($monitoredWeather) ?> Pelabuhan</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Pelabuhan</th>
                                    <th>Wilayah</th>
                                    <th>Cuaca</th>
                                    <th class="text-center">Suhu</th>
                                    <th class="text-center">Angin</th>
                                    <th class="text-center">Gelombang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($monitoredWeather)): ?>
                                    <?php foreach ($monitoredWeather as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="fw-bold"><?= esc($item['name']) ?></div>
                                                <small class="text-muted"><code><?= esc($item['code']) ?></code></small>
                                            </td>
                                            <td><?= esc($item['province'] ?? '-') ?></td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    <?= esc($item['weather'] ?? 'Belum Sync') ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><?= isset($item['temp_avg']) ? esc($item['temp_avg']) . ' °C' : '-' ?></td>
                                            <td class="text-center"><?= isset($item['wind_speed']) ? esc($item['wind_speed']) . ' kts' : '-' ?></td>
                                            <td class="text-center">
                                                <?php if (isset($item['wave_height'])): ?>
                                                    <span class="badge <?= $item['wave_height'] >= 2.0 ? 'bg-danger' : ($item['wave_height'] >= 1.25 ? 'bg-warning text-dark' : 'bg-success') ?>">
                                                        <?= esc($item['wave_height']) ?> m
                                                    </span>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('ports/weather/show/' . $item['code']) ?>" class="btn btn-sm btn-outline-info">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            Belum ada pelabuhan yang diaktifkan saklar pantauannya. Kunjungi <a href="<?= site_url('ports') ?>">Daftar Pelabuhan</a> untuk mengaktifkan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kolom Kanan: Pengguna Baru Terdaftar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Pengguna Terbaru</h6>
                    <span class="badge bg-secondary"><?= count($latestUsers) ?> Baru</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php if (!empty($latestUsers)): ?>
                            <?php foreach ($latestUsers as $user): ?>
                                <div class="list-group-item py-3">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 fw-semibold text-truncate" style="max-width: 170px;">
                                            <?= esc($user->fullname ?? $user->username) ?>
                                        </h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <?= !empty($user->created_at) ? date('d M Y', strtotime($user->created_at)) : '-' ?>
                                        </small>
                                    </div>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span><i class="bi bi-person me-1"></i><?= esc($user->username) ?></span>
                                        <span><i class="bi bi-card-text me-1"></i><?= esc($user->nik ?? '-') ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-4 text-center text-muted">Belum ada data user.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>