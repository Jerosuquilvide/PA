<?php 

    if(isset($_GET)){
        $id = $_GET['id'];
        echo " Hay que : conectarse a BD, crear UI para editar, pedir datos con el ID, guardar los cambios y redireccionar a la vista de las notas";
        die();
    }