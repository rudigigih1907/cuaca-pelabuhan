<?= $this->extend('templates/index'); ?>

<?= $this->Section('title'); ?>
<title>Register</title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row p-0">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin">User's List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New User</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <form action="<?= base_url('register') ?>" method="post" class="user" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                    <?php endif; ?>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control form-control-user" placeholder="Username" value="<?= set_value('username') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '' ?></span>
                                        </div>
                                        <div class="col">
                                            <label for="fullname">Nama Lengkap</label>
                                            <input type="text" name="fullname" id="fullname" class="form-control form-control-user" placeholder="Fullname" value="<?= set_value('fullname') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'fullname') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="username">NIK</label>
                                            <input type="text" name="nik" id="nik" class="form-control form-control-user" placeholder="No.induk Karyawan" value="<?= set_value('nik') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'role') : '' ?></span>
                                        </div>
                                        <div class="col">
                                            <label for="role">Role</label>
                                            <input type="text" name="role" id="role" class="form-control form-control-user" placeholder="Admin atau User" value="<?= set_value('role') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'role') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password" value="<?= set_value('password') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                                        </div>
                                        <div class="col">
                                            <input type="password" name="cpassword" class="form-control form-control-user" placeholder="Confirm Password" value="<?= set_value('cpassword') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                                        </div>
                                    </div>
                                    <br />
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>