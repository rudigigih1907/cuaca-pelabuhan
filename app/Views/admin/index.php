<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Admin Page - User's List</h1>

    <div class="row p-0">
        <div class="col col-sm-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User's List</li>
                </ol>
            </nav>
        </div>
        <div class="col text-right">
            <a href="<?= base_url('register') ?>" type="button" class="btn btn-primary">Tambah User</a>
        </div>
    </div>
    <!-- DataTables User's List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tables User's List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>