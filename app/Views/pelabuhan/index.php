<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pelabuhan</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success</b>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Error</b>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- DataTables Pelabuhan's List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="mt-2 font-weight-bold text-primary">Daftar Pelabuhan</h6>
                </div>
                <?php if (userLogin()->role == 'Admin') : ?>
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-pelabuhan-new-modal-lg">Tambah Pelabuhan</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body text-nowrap">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelabuhan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($pelabuhans as $pelabuhan) : ?>
                            <tr>
                                <td width=6%><?= $i++ ?></td>
                                <td><?= $pelabuhan->nama_pelabuhan; ?></td>
                                <td width=17% class="text-center text-nowrap">
                                    <a href="<?= site_url('cuaca/get-cuaca/' . $pelabuhan->id_pelabuhan) ?>" class="btn btn-sm btn-outline-primary mr-2 center-block">Cek Cuaca</a>
                                    <?php if (userLogin()->role == 'Admin') : ?>
                                        <a href="<?= site_url('pelabuhan/edit/' . $pelabuhan->id_pelabuhan) ?>" class=" btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i></a>
                                        <form action="<?= site_url('pelabuhan/' . $pelabuhan->id_pelabuhan) ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ?')">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal New Data -->
<div class="modal fade bd-pelabuhan-new-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pelabuhan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <form action="<?= base_url() ?>" method="POST" enctype='multipart/form-data'>
                        <?= csrf_field() ?>
                        <div class="form-group col-md">
                            <label for="nama_pelabuhan">Nama Pelabuhan</label>
                            <input type="text" class="form-control" id="nama_pelabuhan" name="nama_pelabuhan" required>
                        </div>
                        <div class="form-group col-md">
                            <label for="link_api">Link API</label>
                            <input type="text" class="form-control" id="link_api" name="link_api" required>
                        </div>
                        <div class="col-md p-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>