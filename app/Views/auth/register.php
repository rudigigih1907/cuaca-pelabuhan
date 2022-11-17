<?= $this->extend('auth/templates'); ?>

<?= $this->Section('title'); ?>
<title>Register</title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                </div>
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
                                        <div class="col">
                                            <label for="nik">No. Induk Karyawan</label>
                                            <input type="text" name="nik" id="nik" class="form-control form-control-user" placeholder="No. Induk Karyawan" value="<?= set_value('nik') ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'nik') : '' ?></span>
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