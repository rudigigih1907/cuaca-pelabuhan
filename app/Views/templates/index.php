<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->renderSection('title'); ?>

    <link href="<?= base_url('sb-admin2') ?>/tambahan/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('sb-admin2') ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('sb-admin2') ?>/tambahan/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('tempusdominus-bootstrap-4') ?>/css/tempusdominus-bootstrap-4.min.css" />
</head>

<body id="page-top">
    <div id="wrapper">
        <?= $this->include('templates/sidebar'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= $this->include('templates/topbar'); ?>
                <?= $this->renderSection('content'); ?>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT. Tresnamuda Sejati <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda yakin akan logout...?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('sb-admin2') ?>/tambahan/jquery/jquery.min.js"></script>
    <script src="<?= base_url('sb-admin2') ?>/tambahan/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('sb-admin2') ?>/tambahan/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('sb-admin2') ?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('sb-admin2') ?>/tambahan/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin2') ?>/tambahan/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('sb-admin2') ?>/js/demo/datatables-demo.js"></script>

    <script type="text/javascript" src="<?= base_url('moment') ?>/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?= base_url('tempusdominus-bootstrap-4') ?>/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- get data cuaca -->
    <script type="text/javascript">
        function pilih_data(name, issued, valid_from, valid_to, weather, temp_min, temp_max, rh_min, rh_max) {
            $("#name").val(name);
            $("#issued").val(issued);
            $("#valid_from").val(valid_from);
            $("#valid_to").val(valid_to);
            $("#weather").val(weather);
            $("#temp_min").val(temp_min);
            $("#temp_max").val(temp_max);
            $("#rh_min").val(rh_min);
            $("#rh_max").val(rh_max);
        }
    </script>

    <!-- get data cuaca -->
    <script type="text/javascript">
        function upload(id_cuaca) {
            $("#id_cuaca").val(id_cuaca);
        }
    </script>

    <!-- date time picker issued -->
    <script type="text/javascript">
        $(function() {
            $('#datetimepickerissued').datetimepicker({
                locale: 'id'
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#datetimepickervalidfrom').datetimepicker({
                locale: 'id'
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#datetimepickervalidto').datetimepicker({
                locale: 'id'
            });
        });
    </script>
</body>

</html>