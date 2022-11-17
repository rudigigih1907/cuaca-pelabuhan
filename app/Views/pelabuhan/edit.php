<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title>Edit Data Pelabuhan</title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">
    <div class="col">
        <form action="<?= base_url('pelabuhan/update/' . $pelabuhan->id_pelabuhan) ?>" method="POST" enctype='multipart/form-data'>
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group col-md">
                <label for="nama_pelabuhan">Nama Pelabuhan</label>
                <input type="text" class="form-control" value="<?= $pelabuhan->nama_pelabuhan ?>" id="nama_pelabuhan" name="nama_pelabuhan" required>
            </div>
            <div class="form-group col-md">
                <label for="link_api">Link API</label>
                <input type="text" class="form-control" id="link_api" value="<?= $pelabuhan->link_api ?>" name="link_api" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>