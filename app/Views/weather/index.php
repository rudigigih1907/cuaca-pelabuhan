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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/pelabuhan">Pelabuhan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cuaca</li>
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="mt-2 font-weight-bold text-primary">DOKUMENTASI CUACA PELABUHAN DI INDONESIA</h6>
                </div>
                <div class="col text-right">
                    <a href="<?= site_url('pelabuhan') ?>" class="btn btn-primary btn-sm">Cuaca BMKG</a>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-input-manual-cuaca-modal-lg">Input Manual</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelabuhan</th>
                            <th>Issued</th>
                            <th>Valid</th>
                            <th>Weather</th>
                            <th>Suhu &deg;C</th>
                            <th>Lembab %</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($cuaca as $value) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i++ ?></td>
                                <td class="align-middle"><?= $value->name; ?></td>
                                <td class="align-middle">
                                    <?php $rilis = $value->issued;
                                    echo date("d/M/Y H:i", strtotime($rilis)); ?>
                                </td>
                                <td width=19%>
                                    <?php $validFrom = $value->valid_from;
                                    echo date("d/M/Y H:i", strtotime($validFrom)); ?> -
                                    <?php $validTo = $value->valid_to;
                                    echo date("d/M/Y H:i", strtotime($validTo)); ?>
                                </td>
                                <td class="align-middle"><?= $value->weather; ?></td>
                                <td class="text-center align-middle"><?= $value->temp_min; ?> - <?= $value->temp_max; ?></td>
                                <td class="text-center align-middle"><?= $value->rh_min; ?> - <?= $value->rh_max; ?></td>
                                <td class="text-center align-middle" width=13%>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-folder"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= site_url('berkas/' . $value->id_cuaca) ?>"><i class="fas fa-info-circle"></i> Detail</a>
                                            <a type="button" class="dropdown-item" data-toggle="modal" data-target=".bd-uploads-modal-lg" data-dismiss="modal" onclick="upload('<?= $value->id_cuaca ?>')"><i class="fas fa-upload"></i> Upload</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" target="_blank" href="<?= site_url('generate-pdf/' . $value->id_cuaca) ?>"><i class="fas fa-print"></i> Laporan(.pdf)</a>
                                        </div>
                                    </div>
                                    <a href="<?= site_url('cuaca/edit/' . $value->id_cuaca) ?>" class=" btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?= site_url('cuaca/' . $value->id_cuaca) ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
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
<!-- Modal Input Manual -->
<div class="modal fade bd-input-manual-cuaca-modal-lg" id="bd-input-manual-cuaca-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card shadow">
                    <div class="card-header h-1">
                        <h6 class="m-0 font-weight-bold text-primary">Input Data Cuaca</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            <form action="<?= site_url('cuaca/manual') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="form-group col-md">
                                        <label for="name">Pelabuhan</label>
                                        <input type="text" class="form-control" id="name" name="name" onfocus="load()">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <label for="issued">Issued</label>
                                        <div class="input-group date" id="datetimepickerissued" data-target-input="nearest">
                                            <input type="text" id="issued" name="issued" class="form-control datetimepicker-input" data-target="#datetimepickerissued" />
                                            <div class="input-group-append" data-target="#datetimepickerissued" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="valid_from">valid_from</label>
                                        <div class="input-group date" id="datetimepickervalidfrom" data-target-input="nearest">
                                            <input type="text" id="valid_from" name="valid_from" class="form-control datetimepicker-input" data-target="#datetimepickervalidfrom" />
                                            <div class="input-group-append" data-target="#datetimepickervalidfrom" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="valid_to">valid_to</label>
                                        <div class="input-group date" id="datetimepickervalidto" data-target-input="nearest">
                                            <input type="text" id="valid_to" name="valid_to" class="form-control datetimepicker-input" data-target="#datetimepickervalidto" />
                                            <div class="input-group-append" data-target="#datetimepickervalidto" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-row">
                                    <div class="form-group col-md">
                                        <label for="weather">Weather</label>
                                        <input type="text" class="form-control" id="weather" name="weather" onfocus="load()">
                                    </div>
                                    <div class=" form-group col-md">
                                        <label for="temp_min">Temp_Min</label>
                                        <input type="text" class="form-control" id="temp_min" name="temp_min" onfocus="load()">
                                    </div>
                                    <div class=" form-group col-md">
                                        <label for="temp_max">temp_max</label>
                                        <input type="text" class="form-control" id="temp_max" name="temp_max" onfocus="load()">
                                    </div>
                                    <div class=" form-group col-md">
                                        <label for="rh_min">Lembab Min</label>
                                        <input type="text" class="form-control" id="rh_min" name="rh_min" onfocus="load()">
                                    </div>
                                    <div class=" form-group col-md">
                                        <label for="rh_max">Lembab max</label>
                                        <input type="text" class="form-control" id="rh_max" name="rh_max" onfocus="load()">
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