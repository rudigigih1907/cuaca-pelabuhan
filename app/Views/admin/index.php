<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title><?= $title; ?></title>
<?= $this->endSection(); ?>

<?= $this->Section('content') ?>
<div class="container-fluid">

    <div class="row p-0">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User's List</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col mt-2">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tables User's List</h6>
                </div>
                <div class="col text-right">
                    <a href="<?= base_url('register') ?>" type="button" class="btn btn-primary btn-sm">Tambah User</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>NIK</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $user->username; ?></td>
                                <td><?= $user->fullname; ?></td>
                                <td><?= $user->nik; ?></td>
                                <td><?= $user->role; ?></td>
                                <td>
                                    <a href="<?= site_url('admin/user/edit/' . $user->id) ?>" class=" btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i></a>
                                    <form action="<?= site_url('admin/user/' . $user->id) ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ?')">
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
<?= $this->endSection(); ?>