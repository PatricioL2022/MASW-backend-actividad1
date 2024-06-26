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
require_once('../../controllers/DirectorController.php');
require_once('../../controllers/ActorController.php');
require_once('../../controllers/LanguageController.php');
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
                            $platformList= listPlatforms();
                            $directorList = listDirector();
                            $actorList = listActorforms();
                            $languageList = listLanguage();
                            $objectId = getSerieLastId();

                            $actorListEdit = null;
                            $audioListEdit = null;
                            $languageListEdit = null;
                            $serie = null;
                            if(isset($_GET['serie'])){
                                $SerieIdParameter = $_GET['serie'];
                                $serie = getSerieById($SerieIdParameter);
                                if(isset($serie))
                                {
                                    $actorListEdit = getActorsBySerie($serie->getId());
                                    $audioListEdit = getAudiosBySerie($serie->getId());
                                    $languageListEdit = getLanguagesBySerie($serie->getId());
                                }
                            }
                            $textSuccess = '';
                            $textFail = '';
                            $textFailTitle='';
                            $textFailPlatform='';
                            $textFailDirector='';
                            $textFailActor='';
                            $textFailAudio='';
                            $textFailSubtitulo='';
                            $sendData = false;
                            $invalido = true;
                            $serieCreated = false;
                            if(isset($_POST['createBtn']))
                            {
                                // Validar nombre
                                if (!preg_match("/^[a-zA-Z0-9Á-ÿ' -]+$/",trim($_POST['title']))) {
                                    $textFailTitle = "El título contiene caracteres inválidos.";
                                    $invalido = false;
                                } else if (strlen( trim($_POST['title'])) > 250) {
                                    $textFailTitle = "El título solo puede contener hasta 250 caracteres.";
                                    $invalido = false;
                                } else if (strlen(trim($_POST['title'])) < 3) {
                                    $textFailTitle = "El título debe tener al menos 3 caracteres.";
                                    $invalido = false;
                                }

                                // Validar plataforma
                               if (!isset($_POST['platformId']))
                               {
                                    $textFailPlatform = "Debe seleccionar una plataforma.";
                                    $invalido = false;
                               }
                                // Validar director
                                if (!isset($_POST['directorId']))
                                {
                                    $textFailDirector = "Debe seleccionar un director.";
                                    $invalido = false;
                                }
                                // Validar actor
                                if (!isset($_POST['actorId']))
                                {
                                    $textFailActor = "Debe seleccionar uno o varios actores.";
                                    $invalido = false;
                                }
                                // Validar audio
                                if (!isset($_POST['languageAudioId']))
                                {
                                    $textFailAudio = "Debe seleccionar uno o varios audios.";
                                    $invalido = false;
                                }
                                // Validar subtitulo
                                if (!isset($_POST['languageSubtituloId']))
                                {
                                    $textFailSubtitulo = "Debe seleccionar uno o varios subtitulos.";
                                    $invalido = false;
                                }

                            if(!$invalido)
                            {
                                ?>
                                <div class="row p-2">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <strong>RESPUESTA DEL SISTEMA:</strong><br>
                                        <?php if (!empty($textFailTitle)) echo $textFailTitle ?><br>
                                        <?php if (!empty($textFailPlatform)) echo $textFailPlatform ?><br>
                                        <?php if (!empty($textFailDirector)) echo $textFailDirector ?><br>
                                        <?php if (!empty($textFailActor)) echo $textFailActor ?><br>
                                        <?php if (!empty($textFailAudio)) echo $textFailAudio ?><br>
                                        <?php if (!empty($textFailSubtitulo)) echo $textFailSubtitulo ?><br>

                                    </div>
                                </div>
                                <?php
                            } else{
                                $sendData = true;
                            }
                            }

                            if($sendData)
                            {
                                if(isset($_POST['title']) && isset($_POST['directorId']) && isset($_POST['platformId']) && isset($_POST['actorId'])
                                && isset($_POST['languageAudioId']) && isset($_POST['languageSubtituloId']))
                                {
                                    $title = $_POST['title'];
                                    $directorId = $_POST['directorId'];
                                    $platformId = $_POST['platformId'];
                                    $arrayActorsId = $_POST['actorId'];
                                    $arrayLanguageAudioId = $_POST['languageAudioId'];
                                    $arrayLanguageSubtituloId = $_POST['languageSubtituloId'];
                                    if(isset($serie))
                                    {
                                        $serieCreated = updateSerie($serie->getId(),$title,$platformId,$directorId,$arrayActorsId,$arrayLanguageAudioId, $arrayLanguageSubtituloId);
                                        if($serieCreated)
                                            $textSuccess = 'Serie actualizada correctamente.';
                                        else $textFail = 'La serie no se ha actualizado correctamente.';
                                    }
                                    else
                                    {
                                        $serieCreated = storeSerie($title,$platformId,$directorId,$arrayActorsId,$arrayLanguageAudioId, $arrayLanguageSubtituloId);
                                        if($serieCreated)
                                            $textSuccess = 'Serie creada correctamente.';
                                        else $textFail = 'La serie no se ha creado correctamente.';
                                    }

                                }
                                else{
                                    $textFail = 'Por favor ingrese todos los campos requeridos.';
                                }
                            }
                            if(!$sendData) {
                                ?>
                                <form action="" method="post" class="row g-3 needs-validation" novalidate="">


                                    <div class="col-md-12">
                                        <label class="form-label" for="title">Título <span class="campoRequerido">*</span></label>
                                        <input class="form-control" id="title" name="title" value="<?php if(isset($serie)) echo $serie->getTitle() ?>" type="text" required=""
                                               placeholder="Introduce el título" maxlength="250">
                                        <div class="invalid-feedback">Ingrese un título.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="platformId">Plataforma <span class="campoRequerido">*</span></label>
                                        <input type="hidden" id="platformArray" value="<?php
                                        if(isset($serie))
                                        {
                                            echo $serie->getPlatformid();
                                        }
                                        ?>"/>
                                        <select id="platformId" name="platformId" class="js-example-basic-single form-control" required="">
                                            <?php
                                                foreach($platformList as $platform){
                                                        echo  "<option value='".$platform->getId()."'>".$platform->getName()."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Escoja una plataforma.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="directorId">Director <span class="campoRequerido">*</span></label>
                                        <input type="hidden" id="directorArray" value="<?php
                                        if(isset($serie))
                                        {
                                            echo $serie->getDirectorid();
                                        }
                                        ?>"/>
                                        <select id="directorId" name="directorId" class="js-example-basic-single form-control" required="">
                                            <?php
                                            foreach($directorList as $director){
                                               echo  "<option value='".$director->getId()."'>".$director->getName().' '.$director->getLastName()."</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Escoja un director.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="actorId">Actores <span class="campoRequerido">*</span></label>
                                        <input type="hidden" id="actorArray" value="<?php
                                        if(isset($actorListEdit))
                                        {
                                            $actorArrayId = [];
                                            foreach($actorListEdit as $serieActorItem)
                                            {
                                                array_push($actorArrayId,$serieActorItem->getActorid());
                                            }
                                            echo join(",",$actorArrayId);
                                        }
                                        ?>"/>
                                        <select id="actorId" name="actorId[]" multiple="multiple" class="js-example-basic-single form-control" required="">
                                            <?php
                                                foreach($actorList as $actor)
                                                {
                                                    echo  "<option value='".$actor->getId()."'>".$actor->getName().' '.$actor->getLastname()."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Escoja uno o varios actores.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="languageAudioId">Audios <span class="campoRequerido">*</span></label>
                                        <input type="hidden" id="audioArray" value="<?php
                                        if(isset($audioListEdit))
                                        {
                                            $audioArrayId = [];
                                            foreach($audioListEdit as $audioItem)
                                            {
                                                array_push($audioArrayId,$audioItem->getLanguageId());
                                            }
                                            echo join(",",$audioArrayId);
                                        }
                                        ?>"/>
                                        <select id="languageAudioId" name="languageAudioId[]" multiple="multiple" class="js-example-basic-single form-control" required="">
                                            <?php
                                            foreach($languageList as $language){
                                                echo  "<option value='".$language->getId()."'>".$language->getName()."</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Escoja uno a varios audios.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="languageSubtituloId">Subtítulos <span class="campoRequerido">*</span></label>
                                        <input type="hidden" id="subtitleArray" value="<?php
                                        if(isset($languageListEdit))
                                        {
                                            $subtitleArrayId = [];
                                            foreach($languageListEdit as $languageItem)
                                            {
                                                array_push($subtitleArrayId,$languageItem->getLanguageId());
                                            }
                                            echo join(",",$subtitleArrayId);
                                        }
                                        ?>"/>
                                        <select id="languageSubtituloId" name="languageSubtituloId[]" multiple="multiple" class="js-example-basic-single form-control" required="">
                                            <?php
                                            foreach($languageList as $language){
                                                echo  "<option value='".$language->getId()."'>".$language->getName()."</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Escoja uno o varios idiomas.</div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="btn btn-primary" style="margin-right: 4px;" name="createBtn" id="createBtn" type="submit">Guardar</button>
                                        <a href="List.php" class="btn btn-danger" type="button">Cancelar</a>
                                    </div>
                                </form>
                                <?php
                            } else {
                                if($serieCreated){
                                    ?>
                                    <div class="row">
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $textSuccess ?><br><a href="List.php">Volver al listado de series</a>
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
                var title = $('#title').val().trim();
                console.log(title.length);
                if (!form.checkValidity() && title.length<=0) {

                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    $(document).ready(function() {

        try {
            var actors = $('#actorArray').val();
            const arrayActor = actors.split(",");
            $('#actorId').val(arrayActor);

            var audios = $('#audioArray').val();
            const arrayAudio = audios.split(",");
            $('#languageAudioId').val(arrayAudio);

            var subtitles = $('#subtitleArray').val();
            const arraySubtitle = subtitles.split(",");
            $('#languageSubtituloId').val(arraySubtitle);

            var platform = $('#platformArray').val();
            $('#platformId').val(platform);

            var director = $('#directorArray').val();
            $('#directorId').val(director);


        }catch (e) {

        }
        $('#platformId').select2({
            placeholder: "Seleccione una plataforma",
            allowClear: true
        });
        $('#directorId').select2({
            placeholder: "Seleccione un director",
            allowClear: true
        });
        $('#actorId').select2({
            placeholder: "Seleccione un actor",
            allowClear: true
        });

        $('#languageAudioId').select2({
            placeholder: "Seleccione un idioma",
            allowClear: true
        });

        $('#languageSubtituloId').select2({
            placeholder: "Seleccione un idioma",
            allowClear: true
        });
    });
</script>
