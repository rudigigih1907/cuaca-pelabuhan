<?= $this->extend('auth/templates'); ?>

<?= $this->Section('title'); ?>
<title>Login</title>
<?= $this->endSection(); ?>

<?= $this->Section('content'); ?>

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form action="<?= base_url('auth') ?>" method="post" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control form-control-user" placeholder="Username" value="<?= set_value('username') ?>">
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '' ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password">
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                                    </div>

                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
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