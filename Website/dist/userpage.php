<!-- 
/*!
 * xRayAID
 * userpage.php
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */ 
-->
<?php include('backend/userpage_server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto" />

    <title>xRayAID - Userpage</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-lungs"></i>
                </div>
                <div class="sidebar-brand-text mx-3">xRayAID</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="userpage.php">
                    <i class="fas fa-home"></i>
                    <span>Página Inicial</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="classify.php?cls">
                    <i class="fas fa-plus"></i>
                    <span>Nova Classificação</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="history.php?cls">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Histórico</span></a>
            </li>

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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="usename">Olá
                                    <?= ucfirst($_SESSION['username']); ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/profile-template.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h5 mb-0 text-gray-800 title-font">Bem Vindo(a) <?= ucfirst($_SESSION['username']); ?></h1>
                    </div>
                    <!-- Content Column -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <!-- Text Box -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-light small"> <i
                                            class="fas fa-chevron-circle-right"></i> &nbsp;E AÍ, O QUE VOCÊ QUER FAZER
                                        HOJE?
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-justify roboto">Utilize o menu lateral a sua esquerda para acessar as
                                        ferramentas disponíveis no
                                        xRayAID. </p>

                                    <p class="text-justify roboto">Abaixo listamos as funcionalidades que o sistema é capaz de
                                        realizar! Divirta-se! <i class="fas fa-smile-wink"></i> </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-light small"> <i class="fa fa-plus"
                                                    aria-hidden="true"></i> &nbsp;
                                                NOVA CLASSIFICAÇÃO</h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-justify roboto">Essa funcionalidade permite a classificação de novas
                                                radiografias. Por meio dela,
                                                você insere uma imagem em formato .png ou .jpg, recebebendo um valor de
                                                probabilidade e um mapa de
                                                calor com a possível região afetada pela pneumonia, auxiliando seu
                                                diagnóstico.
                                            </p>
                                            <p class="text-justify roboto"> Ahh, não esqueça de nos proporcionar com aquele
                                                feedback no final da classificação em!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-light small"><i class="fa fa-history"
                                                    aria-hidden="true"></i>
                                                &nbsp; HISTÓRICO
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-justify roboto">Utilize essa funcionalidade para listar todas as
                                                suas classificações já realizadas pelo xRayAID.
                                                Selecione aquela que desejar e visualize novamente os resultados! </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-light small"><i class="fas fa-laptop-code"></i> &nbsp; THIS IS XRAYAID</h6>
                                </div>
                                <div class="card-body-img black">
                                    <div class="text-center">
                                        <img class="img-fluid" src="assets/img/example.gif" style="width: 70vh;"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <a href="./">xRayAID.com.br</a> 2020</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Já vai?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">Selecione "Logout" abaixo se você realmente deseja sair da sessão.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="backend/logout_server.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>