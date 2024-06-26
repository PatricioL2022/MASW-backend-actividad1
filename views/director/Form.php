<?php
include('../partial/sidebar.php');
require_once('../../controllers/DirectorController.php');
require_once('../../controllers/Utils/Validation.php');
?>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <span>Director</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <span>Nuevo</span>
                    </li>
                </ol>
            </nav>
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Director</strong></div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end pt-2 pe-4">
                                <a href="List.php" class="btn btn-primary text-end">Listado&nbsp;<i class="bi bi-list-ul"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['director'])) {
                                $DirectorIdParameter = $_GET['director'];
                                $Director = getDirectorById($DirectorIdParameter);
                            }
                            $today = date("Y-m-d");
                            $textSuccess = '';
                            $textFail = '';
                            $textFailName = '';
                            $textFailLastName = '';
                            $textFailBirthday = '';
                            $textFailNationality = '';
                            $edad = 1;

                            $sendData = false;
                            $invalido = true;
                            $DirectorCreated = false;
                            if (isset($_POST['createBtn']))
                            {
                                if(isset($Director))
                                {
                                    $Director->setName($_POST['DirectorName']);
                                    $Director->setLastname($_POST['DirectorLastName']);
                                    $Director->setBirthday($_POST['DirectorBirthday']);
                                    $Director->setNationality($_POST['DirectorNationality']);
                                }
                                // Validar nombre
                                if (!preg_match("/^[a-zA-ZÁ-ÿ' -]+$/",trim($_POST['DirectorName']))) {
                                    $textFailName = "El nombre contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen( trim($_POST['DirectorName'])) > 50) {
                                    $textFailName = "El nombre solo puede contener hasta 50 caracteres.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['DirectorName'])) < 3) {
                                    $textFailName = "El nombre debe tener al menos 3 caracteres.";
                                    $invalido = false;
                                }

                                // Validar apellido
                                if (!preg_match("/^[a-zA-ZÁ-ÿ' -]+$/",trim($_POST['DirectorLastName']))) {
                                    $textFailLastName = "El apellido contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['DirectorLastName'])) > 50) {
                                    $textFailLastName = "El apellido solo puede contener hasta 50 caracteres.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['DirectorLastName'])) < 3) {
                                    $textFailLastName = "El apellido debe tener al menos 3 caracteres.";
                                    $invalido = false;
                                }

                                $edad =edad($_POST['DirectorBirthday']);
                                if ($edad > 150) {
                                    $textFailBirthday = "La fecha ingresada es superior a la edad máxima. Edad:";
                                    $invalido = false;
                                } else if ($edad < 10) {
                                    $textFailBirthday = "La fecha ingresada es inferior a la edad permitida. Edad:";
                                    $invalido = false;
                                }

                                // Validar nacionalidad
                                if (!preg_match("/^[a-zA-ZÁ-ÿ'-]+$/",trim($_POST['DirectorNationality']))) {
                                    $textFailNationality = "La nacionalidad contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['DirectorNationality'])) > 50) {
                                    $textFailNationality = "La nacionalidad solo puede contener hasta 50 caracteres.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['DirectorNationality'])) < 3) {
                                    $textFailNationality = "La nacionalidad debe tener al menos 3 caracteres.";
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
                                            <?=edad($_POST['DirectorBirthday']);
                                        }?><br>
                                        <?php
                                        if (!empty($textFailNationality))
                                        echo $textFailNationality  ?><br>
                                    </div>
                                </div>
                                            <?php
                                        } else{
                                            $sendData = true;
                                        }
                            }
                            if($sendData)
                            {
                                if (isset($_POST['DirectorName'], $_POST['DirectorLastName'], $_POST['DirectorBirthday'], $_POST['DirectorNationality']))
                                {
                                    if (isset($Director)) {
                                        $DirectorCreated = updateDirector(
                                            $Director->getId(),
                                            $_POST['DirectorName'],
                                            $_POST['DirectorLastName'],
                                            $_POST['DirectorBirthday'],
                                            $_POST['DirectorNationality']
                                        );
                                        if ($DirectorCreated)
                                            $textSuccess = 'Director actualizado correctamente.';
                                        else $textFail = 'La Director no se ha actualizado correctamente.';
                                    } else {
                                        $DirectorCreated = storeDirector($_POST['DirectorName'], $_POST['DirectorLastName'], $_POST['DirectorBirthday'], $_POST['DirectorNationality']);
                                        if ($DirectorCreated)
                                            $textSuccess = 'Director creado correctamente.';
                                        else $textFail = 'La Director no se ha creado correctamente.';
                                    }
                                }
                            }
                            if(!$sendData) {
                                ?>
                                <form action="" method="post" class="row g-3 needs-validation" novalidate="">
                                    <div class="col-md-6">
                                        <label class="form-label" for="DirectorName">Nombre <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="DirectorName" name="DirectorName" value="<?php if (isset($Director)) echo $Director->getName() ?>" type="text" required="" maxlength="50" placeholder="Introduce el nombre del Director">
                                        <div class="invalid-feedback">Ingrese un nombre.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="DirectorLastName">Apellido <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="DirectorLastName" name="DirectorLastName" value="<?php if (isset($Director)) echo $Director->getLastName() ?>" type="text" required="" maxlength="50" placeholder="Introduce el apellido del Director">
                                        <div class="invalid-feedback">Ingrese un apellido.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="DirectorBirthday">F. Nacimiento <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="DirectorBirthday" name="DirectorBirthday" value="<?php if (isset($Director)) echo $Director->getBirthday() ?>" type="date" required="">
                                        <div class="invalid-feedback">Ingrese una fecha de nacimiento.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="DirectorNationality">Nacionalidad <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="DirectorNationality" name="DirectorNationality" value="<?php if (isset($Director)) echo $Director->getNationality() ?>" type="text" required="" maxlength="50" placeholder="Introduce la nacionalidad del Director">
                                        <div class="invalid-feedback">Ingrese una nacionalidad.</div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="btn btn-primary" style="margin-right: 4px;" name="createBtn" id="createBtn" type="submit">Guardar</button>
                                        <a href="List.php" class="btn btn-danger" type="button">Cancelar</a>
                                    </div>
                                </form>
                                <?php
                            } else {
                                if ($DirectorCreated) {
                                ?>
                                    <div class="row">
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $textSuccess ?><br><a href="List.php">Volver al listado de Directors</a>
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