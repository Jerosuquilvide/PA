<?php

if (session_destroy()) {
     echo "Sesión destruida correctamente";
 } else {
     echo "Error al destruir la sesión";
 }

     header("Location:"."http://localhost/master-php/TP1.0/index.php");