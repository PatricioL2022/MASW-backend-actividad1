<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 18/6/2024
 * Time: 23:25
 */

include('../partial/sidebar.php');
require_once('../../controllers/PlatformController.php');
?>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Plataforma</span>
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
                        <div class="card-header"><strong>Plataformas</strong></div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end pt-2 pe-4">
                                <a href="List.php" class="btn btn-primary text-end">Listado</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['platform'])){
                                $platFormIdParameter = $_GET['platform'];
                                $platform = getPlatformById($platFormIdParameter);
                            }
                            $textSuccess = '';
                            $textFail = '';


                            $sendData = false;
                            $platformCreated = false;
                            if(isset($_POST['createBtn']))
                            {
                                $sendData = true;
                            }
                            if($sendData)
                            {
                                if(isset($_POST['platformName']))
                                {
                                    if(isset($platform))
                                    {
                                        $platformCreated = updatePlatform($platform->getId(),$_POST['platformName']);
                                        if($platformCreated)
                                        $textSuccess = 'Plataforma actualizada correctamente.';
                                        else $textFail = 'La plataforma no se ha actualizado correctamente.';
                                    }
                                    else
                                    {
                                        $platformCreated = storePlatform($_POST['platformName']);
                                        if($platformCreated)
                                        $textSuccess = 'Plataforma creada correctamente.';
                                        else $textFail = 'La plataforma no se ha creado correctamente.';
                                    }

                                }
                            }
                            if(!$sendData) {
                            ?>
                            <form action="" method="post" class="row g-3 needs-validation" novalidate="">
                                <div class="col-md-12">
                                    <label class="form-label" for="platformName">Nombre</label>
                                    <input class="form-control" id="platformName" name="platformName" value="<?php if(isset($platform)) echo $platform->getName() ?>" type="text" required="" placeholder="Introduce el nombre de la plataforma">
                                    <div class="invalid-feedback">Ingrese un nombre.</div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" name="createBtn" id="createBtn" type="submit">Guardar</button>
                                </div>
                            </form>
                            <?php
                            } else {
                                if($platformCreated){
                            ?>
                            <div class="row">
                                <div class="alert alert-success" role="alert">
                                    <?php echo $textSuccess ?><br><a href="List.php">Volver al listado de plataformas</a>
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
