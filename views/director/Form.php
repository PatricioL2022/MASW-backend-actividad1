<?php
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">';
include('../partial/sidebar.php');
require_once('../../controllers/DirectorController.php');
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
                            $textSuccess = '';
                            $textFail = '';


                            $sendData = false;
                            $DirectorCreated = false;
                            if (isset($_POST['createBtn'])) {
                                $sendData = true;
                            }
                            if ($sendData) {
                                if (isset($_POST['DirectorName'], $_POST['DirectorLastName'], $_POST['DirectorBirthday'], $_POST['DirectorNationality'])) {
                                    if (isset($Director)) {
                                        $DirectorCreated = updateDirector(
                                            $Director->getId(),
                                            $_POST['DirectorName'],
                                            $_POST['DirectorLastName'],
                                            $_POST['DirectorBirthday'],
                                            $_POST['DirectorNationality']
                                        );
                                        if ($DirectorCreated)
                                            $textSuccess = 'Director actualizada correctamente.';
                                        else $textFail = 'La Director no se ha actualizado correctamente.';
                                    } else {
                                        $DirectorCreated = storeDirector($_POST['DirectorName'], $_POST['DirectorLastName'], $_POST['DirectorBirthday'], $_POST['DirectorNationality']);
                                        if ($DirectorCreated)
                                            $textSuccess = 'Director creada correctamente.';
                                        else $textFail = 'La Director no se ha creado correctamente.';
                                    }
                                }
                            }
                            if (!$sendData) {
                            ?>
                                <form action="" method="post" class="row g-3 needs-validation" novalidate="">
                                    <div class="col-md-4">
                                        <label class="form-label" for="DirectorName">Nombre</label>
                                        <input class="form-control" id="DirectorName" name="DirectorName" value="<?php if (isset($Director)) echo $Director->getName() ?>" type="text" required="" placeholder="Introduce el nombre del Director">
                                        <div class="invalid-feedback">Ingrese un nombre.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="DirectorLastName">Apellido</label>
                                        <input class="form-control" id="DirectorLastName" name="DirectorLastName" value="<?php if (isset($Director)) echo $Director->getLastName() ?>" type="text" required="" placeholder="Introduce el apellido del Director">
                                        <div class="invalid-feedback">Ingrese un apellido.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="DirectorBirthday">F. Nacimiento</label>
                                        <input class="form-control" id="DirectorBirthday" name="DirectorBirthday" value="<?php if (isset($Director)) echo $Director->getBirthday() ?>" type="date" required="">
                                        <div class="invalid-feedback">Ingrese una fecha de nacimiento.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="DirectorNationality">Nacionalidad</label>
                                        <input class="form-control" id="DirectorNationality" name="DirectorNationality" value="<?php if (isset($Director)) echo $Director->getNationality() ?>" type="text" required="" placeholder="Introduce la necionalidad del Director">
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