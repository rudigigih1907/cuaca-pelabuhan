<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Data Cuaca</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lampiran</li>
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

    <!-- Data File Upload -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col mt-2">
                    <h6 class="m-0 font-weight-bold text-primary">Lampiran Cuaca dari
                        <?php $valFrom = $berkas[0]->valid_from;
                        echo date('d-M-Y H:i:s', strtotime($valFrom)) ?> -
                        <?php $valTo = $berkas[0]->valid_to;
                        echo date('d-M-Y H:i:s', strtotime($valTo)) ?>
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=6%>#</th>
                            <th>Pelabuhan</th>
                            <th>Lampiran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($berkas as $value) : ?>
                            <tr>
                                <td width=6%><?= $i++ ?></td>
                                <td><?= $value->name; ?></td>
                                <td><?= $value->keterangan; ?></td>
                                <td width=19% class="text-center">
                                    <a class="btn btn-primary btn-sm" href="<?= site_url('berkas/downloads/' . $value->id_berkas) ?>"><i class="fas fa-download"></i> Download</a>
                                    <form action="<?= site_url('berkas/delete/' . $value->id_berkas) ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE"> 
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Uploads -->
<div class="modal fade bd-uploads-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Lampiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            Form Upload
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('berkas/upload'); ?>" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="berkas" class="form-label">Berkas</label>
                                    <input type="file" class="form-control" id="berkas" name="berkas">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan'); ?></textarea>
                                </div>
                                <input type="hidden" name="id_cuaca" id="id_cuaca">
                                <div class="mb-3 text-right">
                                    <input type="submit" class="btn btn-info" value="Upload" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>