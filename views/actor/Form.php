<?php
include('../partial/sidebar.php');
require_once('../../controllers/ActorController.php');
require_once('../../controllers/Utils/Validation.php');
?>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Actor</span>
                    </li>
                    <li class="breadcrumb-item active"><span>Nuevo</span></li>
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
                                <a href="List.php" class="btn btn-primary text-end">Listado <i class="bi bi-list-ul"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['actorId'])){
                                $actorIdParameter = $_GET['actorId'];
                                $actor = getActorformById($actorIdParameter);
                            }


                            $today = date("Y-m-d");
                            $textSuccess = '';
                            $textFail = '';
                            $textFailName = '';
                            $textFailLastName = '';
                            $textFailBirthday = '';
                            $edad = 1;

                            $sendData = false;
                            $invalido = true;
                            $platformCreated = false;
                            if(isset($_POST['createBtn']))
                            {
                                if(isset($actor)){
                                    $actor->setName($_POST['actorName']);
                                    $actor->setLastname($_POST['actorLastname']);
                                    $actor->setBirthday($_POST['actorBirthday']);
                                }
                                // Validar nombre
                                if (!preg_match("/^[a-zA-ZÁ-ÿ' -]+$/",trim($_POST['actorName']))) {
                                    $textFailName = "El nombre contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen( trim($_POST['actorName'])) > 50) {
                                    $textFailName = "El nombre solo puede contener hasta 50 caracteres.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['actorName'])) < 3) {
                                    $textFailName = "El nombre debe tener al menos 3 caracteres.";
                                    $invalido = false;
                                }

                                // Validar apellido
                                if (!preg_match("/^[a-zA-ZÁ-ÿ' -]+$/",trim($_POST['actorLastname']))) {
                                    $textFailLastName = "El apellido contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['actorLastname'])) > 50) {
                                    $textFailLastName = "El apellido solo puede contener hasta 50 caracteres.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['actorLastname'])) < 3) {
                                    $textFailLastName = "El apellido debe tener al menos 3 caracteres.";
                                    $invalido = false;
                                }

                                $edad =edad($_POST['actorBirthday']);
                                if ($edad > 150) {
                                    $textFailBirthday = "La fecha ingresada es superior a la edad máxima. Edad:";
                                    $invalido = false;
                                } else if ($edad < 10) {
                                    $textFailBirthday = "La fecha ingresada es inferior a la edad permitida. Edad:";
                                    $invalido = false;
                                }

                                if(!$invalido)
                                {
                                    ?>
                                    <div class="row p-2">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>RESPUESTA DEL SISTEMA:</strong><br>
                                            <?php if (!empty($textFailName)) {?>
                                                <?php echo $textFailName  ?><br>
                                             <?php  }
                                            if (!empty($textFailLastName)) {
                                            echo $textFailLastName  ?><br>
                                            <?php  }
                                            if (!empty($textFailBirthday)) {
                                            echo $textFailBirthday  ?>
                                            <?=edad($_POST['actorBirthday']);
                                            }?>
                                        </div>
                                    </div>
                                    <?php
                                } else{
                                    $sendData = true;
                                }
                            }
                            if($sendData)
                            {
                                if(isset($_POST['actorName']))
                                {
                                    if(isset($actor))
                                    {
                                        $actorCreated = updateActor($actor->getId(),$_POST['actorName'],$_POST['actorLastname'],$_POST['actorBirthday']);
                                        if($actorCreated)
                                            $textSuccess = 'actor actualizado correctamente.';
                                        else $textFail = 'El actor no se ha actualiza correctamente.';
                                    }
                                    else
                                    {
                                        $actorCreated = insertActor($_POST['actorName'],$_POST['actorLastname'],$_POST['actorBirthday']);
                                        if($actorCreated)
                                            $textSuccess = 'Actor creado correctamente.';
                                        else $textFail = 'El actor no se ha creado correctamente.';
                                    }

                                }
                            }
                            if(!$sendData) {
                                ?>
                                <form action="" method="post" class="row g-3 needs-validation" novalidate="">
                                    <div class="col-md-6">
                                        <label class="form-label" for="actorName">Nombre <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="actorName" name="actorName" value="<?php if(isset($actor)) echo $actor->getName() ?>" type="text" maxlength="50" minlength="3" required="true" placeholder="Introduce el nombre del actor">
                                        <div class="invalid-feedback">Ingrese un nombre.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="actorLastname">Apellido <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="actorLastname" name="actorLastname" value="<?php if(isset($actor)) echo $actor->getLastname() ?>" type="text" maxlength="50" minlength="3" required="true" placeholder="Introduce el apellido del actor">
                                        <div class="invalid-feedback">Ingrese un apellido.</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="actorBirthday">Fecha Nacimiento <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="actorBirthday" name="actorBirthday" value="<?php if(isset($actor)) echo $actor->getBirthday() ?>" type="date"  max="<?php echo $today?>"  required="true" placeholder="Introduce la fecha de nacimiento del actor">
                                        <div class="invalid-feedback">Ingrese la fecha de nacimiento.</div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="btn btn-primary" style="margin-right: 4px;" name="createBtn" id="createBtn" type="submit">Guardar</button>
                                        <a href="List.php" class="btn btn-danger" type="button">Cancelar</a>
                                    </div>
                                </form>
                                <?php
                            } else {
                                if($actorCreated){
                                    ?>
                                    <div class="row">
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $textSuccess ?><br><a href="List.php">Volver al listado de actores</a>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="row">
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $textFail ?><br><a href="Form.php">Volver a intentarlo</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
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
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
