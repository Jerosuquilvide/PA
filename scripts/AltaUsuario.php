<?php require '../vistas/header.php'; ?>

<div class="container p-5 my-5 border">
    <div class="row">
        <div class="col-sm-12">

             <!-- Comprobacion de la concexion de bd-->
             <?php       
            $conn = mysqli_connect('localhost', 'root', '', 'TP');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }else{
                echo "<script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Base de datos corriendo correctamente', 'success');
                         }
                           
                </script>";
            }
            ;?>
            
            <?php if(isset($_SESSION['alta_user']) && $_SESSION['alta_user'] == 'duplicado') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Ya existe una cuenta con ese email', 'info');
                         }
                  </script>
                  <?php unset($_SESSION['alta_user'])?>
            <?php endif ; ?>

            <form action="./procesoRegistro.php" class="was-validated" method="POST">
                <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token']; ?>">
                <div class="mb-3 mt-3">
                   <!-- A form that is asking for a name. -->
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Tu nombre" name="nombre" required pattern="[A-Za-z0-9_-]{1,20}">
                    <div class="valid-feedback">Valido.</div>
                    <div class="invalid-feedback">Por favor rellena este campo correctamente.</div>
                </div>

                <div class="mb-3 mt-3">
                   <!-- A form that is asking for a email. -->
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Tu email" name="email" required">
                    <div class="valid-feedback">Valido.</div>
                    <div class="invalid-feedback">Por favor rellena este campo correctamente.</div>
                </div>

                <div class="mb-3">
                    <!-- A form that is asking for a password. -->
                    <label for="pwd" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Tu contraseña, minimo ocho caracteres" name="pswd" required pattern="[A-Za-z0-9_-]{8,20}">
                    <div class="valid-feedback">Valido.</div>
                    <div class="invalid-feedback">Por favor rellena este campo correctamente.</div>
                </div>
                <!-- Esto si no se implementa hay que fletarlo-->
                <?php if (isset($_SESSION['errores'])) : ?>
                    <?php $errores = $_SESSION['errores'] ;?>
                    <?php foreach($e as $errores): ?>
                    <div class="alert alert-danger"><strong>Complete correctamente <?php $e ?></strong></div>
                    <?php endforeach;?>
                <?php endif; ?>

        </div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-evenly">
            <div class="col-8">
                <button type="submit" value="Submit" class="btn btn-primary  btn-lg">Registrarse</button>
            </div>
        </div>
    </div>

    </form>

</div>
</div>

</div>

<!-- Incluir JS -->
    <script src="../lib/jquery-3.5.1.min.js" ></script>
    <script src="../lib/notify.min.js" ></script>
    <script src="../lib/bootstrap.min.js" ></script>

<?php require '../vistas/footer.php' ?>