<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">

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
    <div class="card">
        <div class="card-header">Form Upload</div>
        <div class="card-body">
            <form method="POST" action="<?= site_url('berkas/upload') ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="berkas">Upload File</label>
                    <input type="file" class="form-control" id="berkas" name="berkas" value="berkas">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="2"></textarea>
                </div>
                <input type="hidden" name="cuaca_id" id="cuaca_id" value="<?= $berkas->id_cuaca ?>">
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>