<?php 
    //session_start();
    require './vistas/header.php';
    
    // session_unset();
    // var_dump($_SESSION);
?>
<?php if (isset($_SESSION['log']) &&  $_SESSION['log'] == 'valido' ) : ?>
    <div class="container p-5 my-5 border">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-success">Bienvenido @fcytuader!</p>
            </div>
        </div>
    </div>
<?php else: ?>

    <div class="container p-5 my-5 border">
        <div class="row">
            <div class="col-sm-12">
                Una app para sencilla para organizar tu vida
            </div>
        </div>

    </div>
<?php endif; ?>
<?php require './vistas/footer.php' ?>