<?= $this->extend('template/index'); ?>

<?= $this->section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<meta name="csrf-token" content="<?= csrf_token() ?>">
<meta name="csrf-hash" content="<?= csrf_hash() ?>">

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2>Data Pelabuhan BMKG</h2>
        <?php if (userLogin() && userLogin()->role == 'Admin') : ?>
            <a href="<?= site_url('ports/sync') ?>" class="btn btn-primary">
                Sync Data Pelabuhan
            </a>
        <?php endif; ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Toast Notifikasi AJAX -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <div id="liveToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    Pesan notifikasi
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="card-body text-nowrap">
        <div class="table-responsive">
            <form action="<?= site_url('ports/weather/sync-selected') ?>" method="POST">
                <?= csrf_field() ?>

                <?php if (userLogin() && userLogin()->role == 'Admin') : ?>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cloud-arrow-down"></i> Sync Pelabuhan Terpilih
                        </button>
                    </div>
                <?php endif ?>

                <table class="table table-bordered text-nowrap" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <?php if (userLogin() && userLogin()->role == 'Admin') : ?>
                                <th><input type="checkbox" id="checkAll"></th>
                            <?php endif ?>
                            <th>Kode Pelabuhan</th>
                            <th>Nama Pelabuhan</th>
                            <th>Provinsi</th>
                            <?php if (userLogin() && userLogin()->role == 'Admin') : ?>
                                <th class="text-center" style="width: 140px;">Pantau (3 Jam)</th>
                            <?php endif ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ports)): ?>
                            <?php foreach ($ports as $index => $port): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <?php if (userLogin() && userLogin()->role == 'Admin') : ?>
                                        <td><input type="checkbox" name="codes[]" value="<?= esc($port['code']) ?>"></td>
                                    <?php endif ?>
                                    <td><code><?= esc($port['code']) ?></code></td>
                                    <td><?= esc($port['name']) ?></td>
                                    <td><?= esc($port['province']) ?></td>
                                    <?php if (userLogin() && userLogin()->role == 'Admin') : ?>
                                        <td class="text-center">
                                            <!-- Bootstrap Toggle Switch -->
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input toggle-monitored"
                                                    type="checkbox"
                                                    role="switch"
                                                    data-code="<?= esc($port['code']) ?>"
                                                    id="switch_<?= esc($port['code']) ?>"
                                                    <?= !empty($port['is_monitored']) ? 'checked' : '' ?>>
                                            </div>
                                        </td>
                                    <?php endif ?>
                                    <td>
                                        <a href="<?= site_url('ports/weather/sync/' . $port['code']) ?>" class="btn btn-sm btn-info text-white">
                                            Sync Cuaca
                                        </a>
                                        <a href="<?= site_url('ports/weather/show/' . $port['code']) ?>" class="btn btn-sm btn-info text-white">
                                            Lihat Cuaca
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data. Klik tombol <strong>Sync Data dari API</strong> untuk mengunduh data.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toastEl = document.getElementById('liveToast');
        const toastMessage = document.getElementById('toastMessage');
        const toast = new bootstrap.Toast(toastEl, {
            delay: 2500
        });

        function showToast(message, isSuccess = true) {
            toastMessage.textContent = message;
            toastEl.className = `toast align-items-center text-white border-0 ${isSuccess ? 'bg-success' : 'bg-danger'}`;
            toast.show();
        }

        // Check All Checkbox
        const checkAll = document.getElementById('checkAll');
        if (checkAll) {
            checkAll.addEventListener('change', function() {
                document.querySelectorAll('input[name="codes[]"]').forEach(cb => cb.checked = checkAll.checked);
            });
        }

        // Event Listener untuk semua toggle switch
        // Gunakan event delegation agar tetap berfungsi jika tabel memakai DataTables (pagination/search)
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('toggle-monitored')) {
                const switchElement = e.target;
                const portCode = switchElement.getAttribute('data-code');
                const isChecked = switchElement.checked ? 1 : 0;

                switchElement.disabled = true;

                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfHashMeta = document.querySelector('meta[name="csrf-hash"]');

                const csrfTokenName = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '<?= csrf_token() ?>';
                let csrfHash = csrfHashMeta ? csrfHashMeta.getAttribute('content') : '<?= csrf_hash() ?>';

                fetch('<?= site_url('ports/toggle-monitored') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfHash
                        },
                        body: JSON.stringify({
                            code: portCode,
                            status: isChecked,
                            [csrfTokenName]: csrfHash
                        })
                    })
                    .then(response => response.json().then(data => ({
                        status: response.status,
                        body: data
                    })))
                    .then(({
                        status,
                        body
                    }) => {
                        switchElement.disabled = false;

                        if (body.csrfHash && csrfHashMeta) {
                            csrfHashMeta.setAttribute('content', body.csrfHash);
                        }

                        if (status === 200 && body.success) {
                            const statusText = isChecked ? 'ditambahkan ke' : 'dihapus dari';
                            showToast(`[${portCode}] Berhasil ${statusText} jadwal pantau.`, true);
                        } else {
                            switchElement.checked = !isChecked;
                            showToast(body.message || 'Gagal mengubah status.', false);
                        }
                    })
                    .catch(error => {
                        switchElement.disabled = false;
                        switchElement.checked = !isChecked;
                        showToast('Koneksi terputus atau server error.', false);
                        console.error('AJAX Error:', error);
                    });
            }
        });
    });
</script>
<?= $this->endSection(); ?>