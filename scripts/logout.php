<?php

if (session_destroy()) {
     echo "Sesión destruida correctamente";
 } else {
     echo "Error al destruir la sesión";
 }
     //    if(isset($_SESSION['succes']) && $_SESSION['succes'] == true){
     //        echo("Paso el if");
     //        unset($_SESSION['succes']);
     //        var_dump($_SESSION);
     //        die();
     //    }elseif (!isset($_SESSION['succes']) || $_SESSION['succes'] == false){
     //        echo('ya no existe tal sesion');
     //        $_SESSION['succes'] = false;
     //      //   die();
     //        header("Location:"."http://localhost/master-php/TP1.0/index.php");
     //    }
        
     header("Location:"."http://localhost/master-php/TP1.0/index.php");