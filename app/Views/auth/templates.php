<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->RenderSection('title'); ?>

    <link href="<?= base_url('sb-admin2') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('sb-admin2') ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <?= $this->renderSection('content'); ?>

    <script src="<?= base_url('sb-admin2') ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('sb-admin2') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('sb-admin2') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url('sb-admin2') ?>/js/sb-admin-2.min.js"></script>

</body>

</html>