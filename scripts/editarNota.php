<?php require '../vistas/header.php'; ?>

<?php if (isset($_SESSION['log']) && $_SESSION['log'] == 'valido' && isset($_GET)) : ?>
    <?php
    $id = $_GET['id'];
    $mysqli = new mysqli("");                
    $sql = "SELECT TITULO,CONTENIDO,ESTADO FROM NOTA WHERE ID = $id";
    $consulta = $mysqli->query($sql);
    $nota = $consulta->fetch_array(MYSQLI_ASSOC);
    
    $mysqli->close();
    ?>
        <div class="container p-5 my-5 border">
    <div class="row">
        <div class="col-sm-12">
             
            <form action="./procesoNota.php" class="was-validated" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"> 
                <div class="mb-3 mt-3">
                    <label for="titulo" class="form-label">Titulo:</label>
                    <input type="text" class="form-control" id="titulo" value="<?php echo $nota['TITULO'] ?>" name="titulo" required pattern="[A-Za-z0-9_- ]{1,25}">
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido:</label>
                    <input type="text" class="form-control" id="contenido" value="<?php echo $nota['CONTENIDO']?>" name="contenido" required pattern="[A-Za-z0-9_- ]{1,225}">
                </div>

                <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="estado" id="estado">
                    <?php if($nota['ESTADO'] == '0'): ?>
                        <option selected value="0" >Sin realizar</option>
                        <option value="1" >Realizada</option>
                    <?php else: ?>
                        <option selected value="1" >Realizada</option>
                        <option value="0" >Sin realizar</option>
                    <?php endif ;?>

                </select>
                </div>


        </div>
    </div>
    <div class="container text-center">
        <div class="row justify-content-evenly">



            <div class="col-8">

                <button type="submit" value="Submit" class="btn btn-primary  btn-lg">Editar</button>

            </div>


        </div>
    </div>



    </form>

</div>



<?php endif; ?>


<?php require '../vistas/footer.php' ?>