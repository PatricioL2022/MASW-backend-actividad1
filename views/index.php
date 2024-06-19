<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 19/6/2024
 * Time: 2:04
 */
echo '<link href="partial/vendors/simplebar/css/simplebar.css" media="screen" rel="stylesheet" type="text/css" />';
echo '<link href="partial/css/vendors/simplebar.css" media="screen" rel="stylesheet" type="text/css" />';
echo '<link href="partial/css/style.css" media="screen" rel="stylesheet" type="text/css" />';
echo '<link href="partial/css/examples.css" media="screen" rel="stylesheet" type="text/css" />';
include('./partial/sidebar.php');
?>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <!-- if breadcrumb is single--><span>Inicio</span>
                        </li>
                        <li class="breadcrumb-item active"><span>Principal</span></li>
                    </ol>
                </nav>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <div class="row">
                    <a href="platform/List.php" class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>

                                    <div style="font-size: 30px">Plataformas</div>
                                </div>

                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">

                            </div>
                        </div>
                    </a>
                    <!-- /.col-->
                    <a href="#" class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-info">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="font-size: 30px">Directores</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            </div>
                        </div>
                    </a>
                    <!-- /.col-->
                    <a href="#" class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-warning">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="font-size: 30px">Actores</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:70px;">
                            </div>
                        </div>
                    </a>
                    <!-- /.col-->
                    <a href="#" class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-danger">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="font-size: 30px">Idiomas</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            </div>
                        </div>
                    </a>
                    <!-- /.col-->
                    <!-- /.col-->
                    <a href="#" class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-success">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div style="font-size: 30px">Series</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            </div>
                        </div>
                    </a>
                    <!-- /.col-->
                </div>
            </div>
        </div>

    </div>
<?php
echo '<script src="partial/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>';
echo '<script src="partial/vendors/simplebar/js/simplebar.min.js"></script>';
include('./partial/footer.php');
?>