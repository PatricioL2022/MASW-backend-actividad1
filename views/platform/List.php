
<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 17/6/2024
 * Time: 23:58
 */

require_once('../../controllers/PlatformController.php');
$platformList = listPlatforms();
?>
<?php
echo '<link href="../partial/vendors/simplebar/css/simplebar.css" media="screen" rel="stylesheet" type="text/css" />';
echo '<link href="../partial/css/vendors/simplebar.css" media="screen" rel="stylesheet" type="text/css" />';
echo '<link href="../partial/css/style.css" media="screen" rel="stylesheet" type="text/css" />';
echo '<link href="../partial/css/examples.css" media="screen" rel="stylesheet" type="text/css" />';
include('../partial/sidebar.php');
?>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Plataforma</span>
                    </li>
                    <li class="breadcrumb-item active"><span>Listado</span></li>
                </ol>
            </nav>
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Plataformas</strong></div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end pt-2 pe-4">
                                <a href="Form.php" class="btn btn-primary text-end">Nuevo+</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="example">
                                <?php
                                if(isset($_POST['platformId']))
                                {
                                    $platformId = $_POST['platformId'];
                                    $platformDeleted = deletePlatform($platformId);
                                    if($platformDeleted)
                                    {
                                        ?>

                                        <div class="row">
                                            <div class="alert alert-success" role="alert">
                                                Plataforma borrado correctamente.<br><a href="List.php">Recargue la página para ver el resultado</a>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="row">
                                            <div class="alert alert-danger" role="alert">
                                                La plataforma no se ha borrado corectamente.
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }

                                ?>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($platformList as $platformItem)
                                            {
                                             ?>
                                                <tr>
                                                    <th><?php echo $platformItem->getId(); ?></th>
                                                    <td><?php echo $platformItem->getName(); ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="Form.php?platform=<?php echo $platformItem->getId();?>" class="btn btn-success">Editar</a>
                                                            <button class="btn btn-danger" type="button" data-coreui-toggle="modal" data-coreui-target="#exampleModalCenter<?php echo $platformItem->getId();?>">Borrar</button>
                                                        </div>
                                                        <div class="row">
                                                            <div class="modal fade" id="exampleModalCenter<?php echo $platformItem->getId();?>" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Confirmación</h5>
                                                                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>¿Estás seguro de eliminar esta plataforma?</p>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Cancelar</button>
                                                                            <form name="delete_platform" action="" method="post">
                                                                                <input name="platformId" type="hidden" value="<?php echo $platformItem->getId(); ?>" />
                                                                                <button type="submit" class="btn btn-danger">Si, Borrar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                             <?php
                                             }
                                            ?>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo '<script src="../partial/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>';
echo '<script src="../partial/vendors/simplebar/js/simplebar.min.js"></script>';
include('../partial/footer.php');
?>

