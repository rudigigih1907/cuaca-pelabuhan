<?= $this->extend('template/index'); ?>
<?= $this->Section('content') ?>
<style>
    .weather-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .weather-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
    }
</style>

<body class="bg-light">

    <div class="container py-4">

        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <?= render_breadcrumb($breadcrumbs ?? []) ?>
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                    <?= esc($port['name'] ?? $port['code']) ?>
                </h2>
                <p class="text-muted mb-0">Kode Pelabuhan: <span class="badge bg-secondary"><?= esc($port['code']) ?></span></p>
            </div>
            <div>
                <a href="<?= site_url('ports/weather/sync/' . $port['code']) ?>" class="btn btn-primary">
                    <i class="bi bi-arrow-repeat"></i> Sync Data Cuaca
                </a>
            </div>
        </div>

        <!-- Alert Notifikasi -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form Filter Tanggal & Tombol Export -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <form action="<?= site_url('ports/weather/show/' . $port['code']) ?>" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label fw-semibold">
                            <i class="bi bi-calendar-check text-primary me-1"></i> Dari Tanggal
                        </label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= esc($startDate) ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label fw-semibold">
                            <i class="bi bi-calendar-x text-danger me-1"></i> Sampai Tanggal
                        </label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= esc($endDate) ?>">
                    </div>
                    <div class="col-md-6 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>

                        <?php if (!empty($startDate) || !empty($endDate)) : ?>
                            <a href="<?= site_url('ports/weather/show/' . $port['code']) ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        <?php endif; ?>

                        <!-- TOMBOL EXPORT EXCEL -->
                        <a href="<?= site_url('ports/weather/export-excel/' . $port['code'] . '?start_date=' . esc($startDate) . '&end_date=' . esc($endDate)) ?>"
                            class="btn btn-success text-nowrap">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                        </a>
                        <!-- Tombol Export PDF -->
                        <a href="<?= site_url('ports/weather/export-pdf/' . $port['code'] . '?start_date=' . esc($startDate) . '&end_date=' . esc($endDate)) ?>"
                            class="btn btn-danger text-nowrap"
                            target="_blank">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- HASIL DATA WEATHER CARDS -->
        <?php if (empty($weathers)) : ?>
            <div class="card shadow-sm text-center py-5 border-0">
                <div class="card-body">
                    <i class="bi bi-cloud-slash display-1 text-muted"></i>
                    <h4 class="mt-3">Data tidak ditemukan</h4>
                    <p class="text-muted">Tidak ada data prakiraan cuaca untuk rentang tanggal yang Anda pilih.</p>
                    <a href="<?= site_url('ports/weather/show/' . $port['code']) ?>" class="btn btn-outline-primary">
                        Tampilkan Semua Data
                    </a>
                </div>
            </div>
        <?php else : ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <small class="text-muted">Menampilkan <strong><?= count($weathers) ?></strong> hasil prakiraan cuaca</small>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($weathers as $w) : ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm weather-card">

                            <!-- Header Card -->
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-3">
                                <span class="fw-bold">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    <?= date('d M Y - H:i', strtotime($w['forecast_time'])) ?> UTC
                                </span>
                                <span class="badge bg-light text-primary fw-semibold">
                                    <?= date('H:i', strtotime($w['forecast_time'])) ?>
                                </span>
                            </div>

                            <!-- Body Card -->
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                    <div>
                                        <h5 class="card-title fw-bold text-capitalize mb-1">
                                            <?= esc($w['weather'] ?? 'Tidak Diketahui') ?>
                                        </h5>
                                        <small class="text-muted">
                                            <i class="bi bi-eye-fill me-1"></i>Jarak Pandang: <?= esc($w['visibility'] ?? '-') ?> NM
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <span class="display-6 fw-bold text-dark">
                                            <?= esc($w['temp_avg'] ?? '-') ?>°C
                                        </span>
                                        <br>
                                        <small class="text-muted">RH: <?= esc($w['rh_avg'] ?? '-') ?>%</small>
                                    </div>
                                </div>

                                <!-- Angin & Gelombang -->
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded text-center">
                                            <small class="text-muted d-block">
                                                <i class="bi bi-wind text-info me-1"></i>Angin
                                            </small>
                                            <strong class="d-block text-dark"><?= esc($w['wind_speed'] ?? 0) ?> Knot</strong>
                                            <small class="text-secondary">Dari: <?= esc($w['wind_from'] ?? '-') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded text-center">
                                            <small class="text-muted d-block">
                                                <i class="bi bi-water text-primary me-1"></i>Gelombang
                                            </small>
                                            <strong class="d-block text-dark"><?= esc($w['wave_height'] ?? 0) ?> m</strong>
                                            <small class="text-secondary"><?= esc($w['wave_cat'] ?? '-') ?></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Arus & Pasang Surut -->
                                <div class="row g-2">
                                    <div class="col-6">
                                        <small class="text-muted"><i class="bi bi-compass me-1"></i>Arus Ke:</small>
                                        <span class="fw-semibold text-dark float-end"><?= esc($w['current_to'] ?? '-') ?></span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted"><i class="bi bi-speedometer2 me-1"></i>Kecept. Arus:</small>
                                        <span class="fw-semibold text-dark float-end"><?= esc($w['current_speed'] ?? '-') ?> Knot</span>
                                    </div>
                                    <?php if (!empty($w['tides'])) : ?>
                                        <div class="col-12 mt-2 pt-2 border-top">
                                            <small class="text-muted"><i class="bi bi-arrow-down-up me-1"></i>Pasang Surut:</small>
                                            <span class="fw-semibold text-dark float-end"><?= esc($w['tides']) ?> m</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-0 text-end">
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    Updated: <?= !empty($w['updated_at']) ? date('d/m/Y H:i', strtotime($w['updated_at'])) : '-' ?>
                                </small>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?= $this->endSection() ?>