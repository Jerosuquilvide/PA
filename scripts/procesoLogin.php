<?php
    session_start();
    
    $usuario = "fcytuader";
    $pass = "programacionavanzada";

    if(!empty($_POST['rand_code']) && $_POST['rand_code'] == $_SESSION['rand_code']){

        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass){
            $_SESSION['log'] = 'valido';
            $_SESSION['name'] = $usuario;
            header("Location:"."./inicio.php");
        }
        
    }else{
        $_SESSION['log'] = 'invalido';
        header("Location:"."./login.php");
    }
    

?>