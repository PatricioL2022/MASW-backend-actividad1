<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 22/6/2024
 * Time: 18:24
 */
include('../partial/sidebar.php');
require_once('../../controllers/SerieController.php');
require_once('../../controllers/PlatformController.php');
?>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class="breadcrumb-item">
                        <!-- if breadcrumb is single--><span>Serie</span>
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
                        <div class="card-header"><strong>Series</strong></div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end pt-2 pe-4">
                                <a href="List.php" class="btn btn-primary text-end">Listado</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $platforms= listPlatforms();
                            if(isset($_GET['serie'])){
                                $SerieIdParameter = $_GET['serie'];
                                $serie = getSerieById($SerieIdParameter);
                            }
                            $textSuccess = '';
                            $textFail = '';


                            /**$sendData = false;
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
                            if(!$sendData) {*/
                                ?>
                                <form action="" method="post" class="row g-3 needs-validation" novalidate="">


                                    <div class="col-md-12">
                                        <label class="form-label" for="title">Título</label>
                                        <input class="form-control" id="title" name="platformName" value="<?php if(isset($serie)) echo $serie->getTitle() ?>" type="text" required="" placeholder="Introduce el título">
                                        <div class="invalid-feedback">Ingrese un título.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="platformId">Plataforma</label>
                                        <select class="js-example-basic-single js-states form-control" name="state">
                                            <?php
                                                foreach($platforms as $platform){
                                                    echo  "<option value='$platform->getId()'>".$platform->getName()."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Ingrese un nombre.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="platformName">Director</label>
                                        <input class="form-control" id="platformName" name="platformName" value="<?php if(isset($serie)) echo $serie->getTitle() ?>" type="text" required="" placeholder="Introduce el nombre de la plataforma">
                                        <div class="invalid-feedback">Ingrese un nombre.</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" name="createBtn" id="createBtn" type="submit">Guardar</button>
                                    </div>
                                </form>
                                <?php
                            /**} else {
                                if($platformCreated){*/
                                    ?>
                                    <div class="row">
                                        <div class="alert alert-success" role="alert">
                                            <?php //echo $textSuccess ?><br><a href="List.php">Volver al listado de plataformas</a>
                                        </div>
                                    </div>
                                    <?php
                               // } else {
                                    ?>
                                    <div class="row">
                                        <div class="alert alert-danger" role="alert">
                                            <?php //echo $textFail ?><br><a href="Form.php">Volver a intentarlo</a>
                                        </div>
                                    </div>
                                    <?php
                               // }
                            //}
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
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Seleccione una plataforma",
            allowClear: true
        });
    });
</script>
