<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="pelabuhan">Pelabuhan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cuaca Pelabuhan <?= $cuaca['name']; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header h-1">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-2 font-weight-bold text-primary">Simpan Data Cuaca Pelabuhan <?= $cuaca['name']; ?></h6>
                </div>
                <div class="col text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tampilDataModal">Cek Cuaca</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <form action="<?= site_url('cuaca') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label for="name">Pelabuhan</label>
                            <input type="text" class="form-control" id="name" name="name" onfocus="load()" readonly>
                        </div>
                        <div class="form-group col-md">
                            <label for="issued">Issued</label>
                            <input type="text" class="form-control" id="issued" name="issued" onfocus="load()" readonly>
                        </div>
                        <div class="form-group col-md">
                            <label for="valid_from">Valid From</label>
                            <input type="text" class="form-control" id="valid_from" name="valid_from" onfocus="load()" readonly>
                        </div>
                        <div class=" form-group col-md">
                            <label for="valid_to">Valid To</label>
                            <input type="text" class="form-control" id="valid_to" name="valid_to" onfocus="load()" readonly>
                        </div>
                    </div>
                    <div class=" form-row">
                        <div class="form-group col-md">
                            <label for="weather">Weather</label>
                            <input type="text" class="form-control" id="weather" name="weather" onfocus="load()" readonly>
                        </div>
                        <div class=" form-group col-md">
                            <label for="temp_min">Temp_Min</label>
                            <input type="text" class="form-control" id="temp_min" name="temp_min" onfocus="load()" readonly>
                        </div>
                        <div class=" form-group col-md">
                            <label for="temp_max">temp_max</label>
                            <input type="text" class="form-control" id="temp_max" name="temp_max" onfocus="load()" readonly>
                        </div>
                        <div class=" form-group col-md">
                            <label for="rh_min">Lembab Min</label>
                            <input type="text" class="form-control" id="rh_min" name="rh_min" onfocus="load()" readonly>
                        </div>
                        <div class=" form-group col-md">
                            <label for="rh_max">Lembab max</label>
                            <input type="text" class="form-control" id="rh_max" name="rh_max" onfocus="load()" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ket_tambahan">Keterangan Tambahan</label>
                        <textarea class="form-control" name="ket_tambahan" id="ket_tambahan" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tampilkan Data -->
<div class="modal fade bd-example-modal-xl" id="tampilDataModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Data Cuaca BMKG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small class="form-text text-muted">Format waktu dari BMKG : Y-M-D H:M:S</small>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cuaca Pelabuhan <?= $cuaca['name']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Pelabuhan</th>
                                        <th>Issued</th>
                                        <th>Valid</th>
                                        <th>Weather</th>
                                        <th>Temp</th>
                                        <th>Lembab</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($cuaca['data'] as $key => $value) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $cuaca['name']; ?></td>
                                            <td><?php $sub_issued = substr($value['issued'], 0, 16);
                                                echo waktu_UTC($sub_issued) ?></td>
                                            <td><?php $sub_vFrom = substr($value['valid_from'], 0, 16);
                                                echo waktu_UTC($sub_vFrom) ?>
                                                - <?php $sub_vTo = substr($value['valid_to'], 0, 16);
                                                    echo waktu_UTC($sub_vTo) ?>
                                            </td>
                                            <td><?= $value['weather']; ?></td>
                                            <td><?= @$value['temp_min']; ?> - <?= @$value['temp_max']; ?></td>
                                            <td><?= @$value['rh_min']; ?> - <?= @$value['rh_max']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary mr-2 btn-sm" onclick="pilih_data('<?= $cuaca['name'] ?>',
                                                '<?php $sub_issued = substr($value['issued'], 0, 16);
                                                    echo waktu_UTC($sub_issued) ?>', 
                                                '<?php $sub_vFrom = substr($value['valid_from'], 0, 16);
                                                    echo waktu_UTC($sub_vFrom) ?>', 
                                                '<?php $sub_vTo = substr($value['valid_to'], 0, 16);
                                                    echo waktu_UTC($sub_vTo) ?>', 
                                                '<?= $value['weather'] ?>', 
                                                '<?= @$value['temp_min'] ?>', 
                                                '<?= @$value['temp_max'] ?>', 
                                                '<?= @$value['rh_min'] ?>', 
                                                '<?= @$value['rh_max'] ?>')" data-dismiss="modal">Tampilkan</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>