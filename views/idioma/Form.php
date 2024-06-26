<?php
include('../partial/sidebar.php');
require_once('../../controllers/LanguageController.php');
?>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Idioma</span>
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
                        <div class="card-header"><strong>Idioma</strong></div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end pt-2 pe-4">
                                <a href="List.php" class="btn btn-primary text-end">Listado <i class="bi bi-list-ul"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['languageId'])){
                                $languageIdParameter = $_GET['languageId'];
                                $language = getLanguageById($languageIdParameter);
                            }
                            $textSuccess = '';
                            $textFail = '';
                            $textFailName = '';
                            $textFailIsoCode = '';


                            $sendData = false;
                            $invalido = true;
                            $languageCreated = false;
                            if(isset($_POST['createBtn']))
                            {
                                if(isset($language)){
                                    $language->setName($_POST['idiomaName']);
                                    $language->setIsocode($_POST['idiomaIsocode']);
                                }
                                // Validar nombre
                                if (!preg_match("/^[a-zA-Z'-]+$/",$_POST['idiomaName'])) {
                                    $textFailName = "El nombre contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen($_POST['idiomaName']) > 18) {
                                    $textFailName = "El idioma solo puede contener hasta 18 caracteres.";
                                    $invalido = false;
                                } else if (strlen($_POST['idiomaName']) < 2) {
                                    $textFailName = "El idioma debe tener al menos 2 caracteres.";
                                    $invalido = false;
                                }
                                // Validar codigo ISO
                                if (!preg_match("/^[a-zA-Z'-]+$/",$_POST['idiomaIsocode'])) {
                                    $textFailIsoCode = "El nombre contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen($_POST['idiomaIsocode']) > 5) {
                                    $textFailIsoCode = "El código ISO solo puede contener hasta 5 caracteres.";
                                    $invalido = false;
                                } else if (strlen($_POST['idiomaIsocode']) < 2) {
                                    $textFailIsoCode = "El código ISO debe tener al menos 2 caracteres.";
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
                                            if (!empty($textFailIsoCode)) {
                                                echo $textFailIsoCode  ?><br>
                                            <?php  }?>
                                        </div>
                                    </div>
                                    <?php
                                } else{
                                    $sendData = true;
                                }
                            }
                            if($sendData)
                            {
                                if(isset($_POST['idiomaName']))
                                {
                                    if(isset($language))
                                    {
                                        $languageCreated = updateLanguage($language->getId(),$_POST['idiomaName'],$_POST['idiomaIsocode']);
                                        if($languageCreated)
                                            $textSuccess = 'idioma actualizado correctamente.';
                                        else $textFail = 'El idioma no se ha actualiza correctamente.';
                                    }
                                    else
                                    {
                                        $languageCreated = insertLanguage($_POST['idiomaName'],$_POST['idiomaIsocode']);
                                        if($languageCreated)
                                            $textSuccess = 'Idioma creado correctamente.';
                                        else $textFail = 'El idioma no se ha creado correctamente.';
                                    }

                                }
                            }
                            if(!$sendData) {
                                ?>
                                <form action="" method="post" class="row g-3 needs-validation" novalidate="">
                                    <div class="col-md-6">
                                        <label class="form-label" for="idiomaName">Nombre</label>
                                        <input class="form-control" id="idiomaName" name="idiomaName" value="<?php if(isset($language)) echo $language->getName() ?>" type="text" required="true" placeholder="Introduce el nombre del idioma">
                                        <div class="invalid-feedback">Ingrese un nombre del idioma.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="idiomaIsocode">Código ISO</label>
                                        <input class="form-control" id="idiomaIsocode" name="idiomaIsocode" value="<?php if(isset($language)) echo $language->getIsocode() ?>" type="text" required="true" placeholder="Introduce el código ISO del idioma">
                                        <div class="invalid-feedback">Ingrese un código ISO.</div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="btn btn-primary" style="margin-right: 4px;" name="createBtn" id="createBtn" type="submit">Guardar</button>
                                        <a href="List.php" class="btn btn-danger" type="button">Cancelar</a>
                                    </div>
                                </form>
                                <?php
                            } else {
                                if($languageCreated){
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
