<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">
    <h3>Edit Data Cuaca</h3>
    <div class="card-body">
        <div>
            <form action="<?= site_url('cuaca/update/' . $cuaca->id_cuaca) ?>" method="POST" enctype='multipart/form-data'>
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="name">Pelabuhan</label>
                        <input type="text" class="form-control" value="<?= $cuaca->name ?>" id="name" name="name" onfocus="load()" readonly>
                    </div>
                    <div class="form-group col-md">
                        <label for="issued">Issued</label>
                        <input type="text" class="form-control" id="issued" value="<?= $cuaca->issued ?>" name="issued" onfocus="load()" readonly>
                    </div>
                    <div class="form-group col-md">
                        <label for="valid_from">Valid From</label>
                        <input type="text" class="form-control" id="valid_from" value="<?= $cuaca->valid_from ?>" name="valid_from" onfocus="load()" readonly>
                    </div>
                    <div class=" form-group col-md">
                        <label for="valid_to">Valid To</label>
                        <input type="text" class="form-control" id="valid_to" value="<?= $cuaca->valid_to ?>" name="valid_to" onfocus="load()" readonly>
                    </div>
                </div>
                <div class=" form-row">
                    <div class="form-group col-md">
                        <label for="weather">Weather</label>
                        <input type="text" class="form-control" id="weather" value="<?= $cuaca->weather ?>" name="weather" onfocus="load()" readonly>
                    </div>
                    <div class=" form-group col-md">
                        <label for="temp_min">Temp_Min</label>
                        <input type="text" class="form-control" id="temp_min" value="<?= $cuaca->temp_min ?>" name="temp_min" onfocus="load()" readonly>
                    </div>
                    <div class=" form-group col-md">
                        <label for="temp_max">temp_max</label>
                        <input type="text" class="form-control" id="temp_max" value="<?= $cuaca->temp_max ?>" name="temp_max" onfocus="load()" readonly>
                    </div>
                    <div class=" form-group col-md">
                        <label for="rh_min">Lembab Min</label>
                        <input type="text" class="form-control" id="rh_min" name="rh_min" value="<?= $cuaca->rh_min ?>" onfocus="load()" readonly>
                    </div>
                    <div class=" form-group col-md">
                        <label for="rh_max">Lembab max</label>
                        <input type="text" class="form-control" id="rh_max" name="rh_max" value="<?= $cuaca->rh_max ?>" onfocus="load()" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ket_tambahan">Keterangan Tambahan</label>
                    <textarea class="form-control" name="ket_tambahan" id="ket_tambahan" rows="2"><?= $cuaca->ket_tambahan ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>