<?php require '../vistas/header.php';?>

<?php

// if (!empty($_SESSION['rand_code'])) {
//     unset($_SESSION['rand_code']);
// }
// $token = "";

// $a = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

// $length = 20;

// for ($i = 0; $i < $length; $i++) {
//     $token .= $a[rand(0, 61)];
// }

// $_SESSION['token'] = $token;

// ?>

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
            <form action="./procesoLogin.php" class="was-validated" method="POST">
                <input type="hidden" id="token" name="token" value="<?php echo $_SESSION['token']; ?>">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Tu email" name="email" required>
                    <div class="valid-feedback">Valido.</div>
                    <div class="invalid-feedback">Por favor rellena este campo correctamente.</div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Tu contraseña" name="pswd" required pattern="[A-Za-z0-9_-]{8,20}">
                    <div class="valid-feedback">Valido.</div>
                    <div class="invalid-feedback">Por favor rellena este campo correctamente.</div>
                </div>

                <?php if (isset($_SESSION['log']) == 'invalido') : ?>

                    <div class="alert alert-danger"><strong>Complete correctamente el formulario</strong></div>

                <?php endif; ?>

        </div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-evenly">
<!-- 
            <div class="col-4">
                <label for="captcha">
                    <img src="./random.php">
                    <input type="text" name="rand_code" value="" required>
                </label>
            </div> -->

            <div class="col-4">
                <div class="g-recaptcha"
                    data-sitekey="6LcZ_pMiAAAAAF1NtLdWn9dGwmtK4jOZfuk_VlEx"> 
                </div>
            </div>

            <div class="col-8">
                <button
                class="btn btn-primary  btn-lg"
                value="Submit"
                type="submit">
                    Entrar
                </button>
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