<?php require '../vistas/header.php'; ?>


<script src="https://www.google.com/recaptcha/api.js?render=6LfnqWYiAAAAAOxg6GoLlUFVUxpc7mXXgoLCHtik"></script>

<div class="container p-5 my-5 border">
    <div class="row">
        <div class="col-sm-12">

            <form action="../scripts/procesoLogin.php" class="was-validated" method="post">
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

                <?php if (isset($_SESSION['log']) == 'invalido') : ?>

                    <div class="alert alert-danger"><strong>Complete correctamente el formulario</strong></div>

                <?php endif; ?>

        </div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-evenly">

            <div class="col-4">

                <div class="g-recaptcha" data-sitekey="6LfewWYiAAAAAMdXCF4UL3Ssofzoxv4gi6FGMzKm"></div>
            </div>
        

        <div class="col-8">

            <button type="submit" value="submit" class="btn btn-primary  btn-lg">Entrar</button>
        </div>
        </div>
    </div>



    </form>

</div>
</div>

</div>

<?php require '../vistas/footer.php' ?>