<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Admin Page - User Detail</h1>

    <div class="row p-0">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/admin">User's List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src='' alt="">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4>Test</h4>
                        </li>
                        
                        <li class="list-group-item">Fullname</li>
                        <li class="list-group-item"><span class="badge badge-success">username</span></li>
                        <li class="list-group-item">
                            <a href="<?= base_url('admin') ?>">&laquo; back to user list</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>