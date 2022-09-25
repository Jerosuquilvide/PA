<?php require '../vistas/header.php' ;
    
?>
<div class="container p-5 my-5 border">
    <div class="row">
        <div class="col-sm-12">
        
            <form action="http://localhost/master-php/TP1.0/scripts/procesoLogin.php" class="was-validated" method="POST">
                <div class="mb-3 mt-3">
                    <label for="user" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" id="user" placeholder="Tu usuario" name="user" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Tu contraseña" name="pswd" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <!-- <div class="form-check mb-3">
                    <div class="g-recaptcha" data-sitekey="6Ld7aR4iAAAAAPesU0eISDqKhFYcsbQNRJMDFtmw"></div>
                </div> -->
                <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require '../vistas/footer.php'?>