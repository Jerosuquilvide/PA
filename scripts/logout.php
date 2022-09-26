<?php

if (session_destroy()) {
     echo "Sesión destruida correctamente";
 } else {
     echo "Error al destruir la sesión";
 }

     header("Location:"."../index.php");