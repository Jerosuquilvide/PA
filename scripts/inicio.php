<?php require '../vistas/header.php';?>

<?php if (isset($_SESSION['log']) &&  $_SESSION['log'] == 'valido') : ?>
    <div class="container p-5 my-5 border">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success"><strong>Ingreso Correctamente!</strong>

                </div>
            </div>
        </div>
    </div>

    <?php endif ;?>


<?php require '../vistas/footer.php' ?>