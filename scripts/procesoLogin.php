<?php
    session_start();
    
    $usuario = "fcytuader";
    $pass = "programacionavanzada";

    if(isset($_POST) && $_POST['token'] == $_SESSION['token']){

        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass){
            $_SESSION['log'] = 'valido';
            $_SESSION['name'] = $usuario;
            header("Location:"."./inicio.php");
        }else{
            $_SESSION['log'] = 'invalido';
            header("Location:"."./login.php");
        }
        
    }
    

?>