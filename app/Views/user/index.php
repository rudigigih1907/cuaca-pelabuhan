<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src='<?= base_url('sb-admin2/img/'. $userInfo->user_image)?>' alt="Username">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4><?= $userInfo->username; ?></h4>
                        </li>
                        <li class="list-group-item"><?= $userInfo->fullname; ?></li>
                        <li class="list-group-item"><?= $userInfo->nik; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>