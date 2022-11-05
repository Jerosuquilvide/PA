<?php require '../vistas/header.php'; ?>

<?php if (isset($_SESSION['log']) && $_SESSION['log'] == 'valido') : ?>
      <!-- Alertas para la creacion de una nota -->
      <?php if(isset($_SESSION['alta_nota']) && $_SESSION['alta_nota'] == 'ok') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Nota agregada correctamente', 'success');
                         }
                  </script>
                  <?php unset($_SESSION['alta_nota'])?>
        <?php endif ; ?>


        <?php if(isset($_SESSION['alta_nota']) && $_SESSION['alta_nota'] == 'fallo') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Error al insertar la nota', 'error');
                         }
                  </script>
                  <?php unset($_SESSION['alta_nota']) ?>
        <?php endif ; ?>

        <!-- Alertas para la modificacion de una nota -->
        <?php if(isset($_SESSION['modif']) && $_SESSION['modif'] == 'ok') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Nota modificada correctamente', 'success');
                         }
                  </script>
                  <?php unset($_SESSION['modif']) ?>
        <?php endif ; ?>

        <?php if(isset($_SESSION['modif']) && $_SESSION['modif'] == 'fallo') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Error al modificar la nota', 'error');
                         }
                  </script>
                  <?php unset($_SESSION['modif']) ?>
        <?php endif ; ?>

        <!-- Alertas para la eliminacion de una nota -->

        <?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'ok') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Nota eliminada correctamente', 'success');
                         }
                  </script>
                  <?php unset($_SESSION['delete']) ?>
        <?php endif ; ?>

        <?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'fallo') : ?>
                  <script type='text/javascript'>
                         window.onload = function(){
                            $.notify('Error al eliminar la nota', 'error');
                         }
                  </script>
                  <?php unset($_SESSION['delete']) ?>
        <?php endif ; ?>


 <!-- Modal para crear una nota-->   
<div class="modal fade" id="crearNota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Nota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="./procesoNota.php" method="POST">
          <div class="mb-3">
            <label for="titulo" class="col-form-label">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required pattern="[A-Za-z0-9_- ]{1,25}">
          </div>
          <div class="mb-3">
            <label for="contenido" class="col-form-label">Contenido:</label>
            <textarea class="form-control" id="contenido" name="contenido" required pattern="[A-Za-z0-9_- ]{1,225}" ></textarea>
          </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>
      </div>
      
    </div>
  </div>
</div>



<!--Se carga el listado. -->
<div id="contenedor"> 
        <div class="p-3  text-white text-center bg-opacity-75" style="background:#7586E6;">
            <h3 class="card-title ">Lista de notas<span class="glyphicon glyphicon-ok"></span></h3>
        </div>
         <?php include "./Notas.php"; echo tabla() ?>;         
      </div>
      

    <!-- Incluir JS -->
    <script src="../lib/jquery-3.5.1.min.js" ></script>
    <script src="../lib/notify.min.js" ></script>
    <script src="../lib/bootstrap.min.js" ></script>


        <!-- Button trigger modal -->
        <div class="d-grid gap-2" style="position: fixed; bottom: 25px; width: 100%; height: 50px; padding-top:10px ;background:#7586E6; opacity: 0.75;" >
            <button type="button" class="btn  p-2 text-white " style="background:#7586E6;bottom: 15px" data-bs-toggle="modal" data-bs-target="#crearNota">
                Agregar una nueva nota
            </button>
        </div>
        <!--Scripts para la tabla-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

        <script type="text/javascript" > 
          $(document).ready( function () {
              $('#listadosNotas').DataTable();
              } );
        </script>

<?php endif; ?>

<?php require '../vistas/footer.php' ?>