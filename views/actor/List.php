
<?php

require_once('../../controllers/ActorController.php');
$actorformList = listActorforms();
?>
<?php

include('../partial/sidebar.php');
?>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Actor</span>
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
                        <div class="card-header"><strong>Actor</strong></div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end pt-2 pe-4">
                                <a href="Form.php" class="btn btn-primary text-end">Nuevo+</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="example">

                                <?php
                                if(isset($_POST['actId']))
                                {
                                    $actId = $_POST['actId'];
                                    $actDeleted = deleteAct($actId);
                                    if($actDeleted)
                                    {
                                        ?>

                                        <div class="row">
                                            <div class="alert alert-success" role="alert">
                                                Actor borrado correctamente.<br><a href="List.php">Recargue la página para ver el resultado</a>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="row">
                                            <div class="alert alert-danger" role="alert">
                                                El actor no se ha borrado corectamente.
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
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Fecha Nacimiento</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($actorformList as $actformItem)
                                    {
                                        ?>
                                        <tr>
                                            <th><?php echo $actformItem->getId(); ?></th>
                                            <td><?php echo $actformItem->getName(); ?></td>
                                            <td><?php echo $actformItem->getLastname(); ?></td>
                                            <td><?php $birthday = date("d/m/Y", strtotime($actformItem->getBirthday())); echo $birthday; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <a href="Form.php?actorId=<?php echo $actformItem->getId();?>" class="btn btn-success">Editar <i class="bi bi-pencil"></i></a>
                                                    <button class="btn btn-danger ml-1" type="button" data-coreui-toggle="modal" data-coreui-target="#exampleModalCenter<?php echo $actformItem->getId();?>">Borrar <i class="bi bi-trash"></i></button>
                                                </div>
                                                <div class="row">
                                                    <div class="modal fade" id="exampleModalCenter<?php echo $actformItem->getId();?>" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmación</h5>
                                                                    <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <p>¿Estás seguro de eliminar a <strong><?php echo $actformItem->getName().' '.$actformItem->getLastName(); ?> </strong>,
                                                                                sus participaciones en series tambien se borrarán?</p>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Cancelar</button>
                                                                    <form name="delete_act" action="" method="post">
                                                                        <input name="actId" type="hidden" value="<?php echo $actformItem->getId(); ?>" />
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
include('../partial/footer.php');
?>

