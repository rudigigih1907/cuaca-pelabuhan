<?= $this->extend('template/index'); ?>

<?= $this->section('title'); ?>
<title><?= esc($title); ?></title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4 py-4">
    <h3 class="fw-bold mb-4">Profil Saya</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-1"><?= esc($userInfo->fullname ?? $userInfo->username) ?></h5>
                <p class="text-muted small mb-2">@<?= esc($userInfo->username) ?></p>
                <div>
                    <span class="badge <?= ($userInfo->role ?? '') === 'Admin' ? 'bg-danger' : 'bg-primary' ?>">
                        <?= esc($userInfo->role ?? 'User') ?>
                    </span>
                </div>
                <hr class="my-3">
                <div class="text-start small text-muted">
                    <div><strong>NIK:</strong> <?= esc($userInfo->nik ?? '-') ?></div>
                    <div class="mt-1"><strong>Terdaftar:</strong> <?= !empty($userInfo->created_at) ? date('d M Y', strtotime($userInfo->created_at)) : '-' ?></div>
                </div>
            </div>
        </div>

        <!-- Kolom Formulir Edit & Ganti Password -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button">Edit Profil</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#change-password" type="button">Ganti Kata Sandi</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4 tab-content">
                    <div class="tab-pane fade show active" id="edit-profile">
                        <form action="<?= site_url('user/update-profile') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" value="<?= esc($userInfo->username) ?>" disabled>
                                <small class="text-muted">Username tidak dapat diubah.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="fullname" class="form-control" value="<?= old('fullname', $userInfo->fullname) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIK (Nomor Induk Karyawan)</label>
                                <input type="text" name="nik" class="form-control" value="<?= old('nik', $userInfo->nik) ?>" maxlength="6" placeholder="NIK">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="change-password">
                        <form action="<?= site_url('user/change-password') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kata Sandi Baru</label>
                                <input type="password" name="new_password" class="form-control" required minlength="6">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="confirm_password" class="form-control" required minlength="6">
                            </div>
                            <button type="submit" class="btn btn-warning">Ganti Kata Sandi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>