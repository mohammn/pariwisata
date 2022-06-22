<!DOCTYPE html>
<html lang="en">
<?php $url = current_url(true); ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Parisiwata | <?= $url->getSegment(3) ?></title>

    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>/public/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pariwisata</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php if (session()->get('rule') == 2) { ?>
                <div class="sidebar-heading">
                    Operator
                </div>
                <!-- Nav Item - Charts -->
                <li class="nav-item <?php if ($url->getSegment(3) == 'pengunjung') echo "active" ?>">
                    <a class="nav-link" href="pengunjung">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pengunjung</span></a>
                </li>
            <?php
            } ?>
            <?php if (session()->get('rule') == 1) {
            ?>
                <div class="sidebar-heading">
                    Admin
                </div>

                <li class="nav-item <?php if ($url->getSegment(3) == 'wisata') echo "active" ?>">
                    <a class="nav-link" href="wisata">
                        <i class="fas fa-fw fa-tree"></i>
                        <span>Wisata</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item <?php if ($url->getSegment(3) == 'user') echo "active" ?>">
                    <a class="nav-link" href="user">
                        <i class="fas fa-user"></i>
                        <span>User</span></a>
                </li>

            <?php
            } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nama') ?></span>
                                <img class="img-profile rounded-circle" src="public/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalUbahPass">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php $this->renderSection('content') ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="modalUbahPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="tempatError" class="p-2 text-center"></div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-lg-3 col-form-label">Password Lama</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="passLama" name="passLama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-lg-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="passBaru" name="passBaru">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-lg-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="konfPass" name="konfPass">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" onclick="ubahPassword()">Ubah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>

</body>

<script>
    function ubahPassword() {
        $("#tempatError").html('');
        if ($("#passLama").val() == "") {
            $("#passLama").focus();
        } else if ($("#passBaru").val() == "") {
            $("#passBaru").focus();
        } else if ($("#konfPass").val() == "") {
            $("#konfPass").focus();
        } else if ($("#konfPass").val() != $("#passBaru").val()) {
            $("#tempatError").html("<i class='badge badge-danger'>Password Baru dan Konfirmasi Password tidak sama.</i>");
        } else {
            $.ajax({
                type: 'POST',
                data: '&passLama=' + $("#passLama").val(),
                url: '<?= base_url() ?>/login/ubahPassword',
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    if (data == 0) {
                        $("#tempatError").html('<span class="badge badge-danger">Password Lama Salah :(</span>');
                    } else {
                        $("#tempatError").html('<span class="badge badge-success">Password Berhasil Diubah :)</span>');
                        $("#passBaru").val("")
                        $("#passLama").val("")
                        $("#konfPass").val("")
                    }
                }
            });
        }
    }
</script>

</html>