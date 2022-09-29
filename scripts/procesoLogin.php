<?php
    session_start();
    $usuario = "fcytuader";
    $pass = "programacionavanzada";
    
    if(isset($_POST)){
        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass){
            $_SESSION['log'] = 'valido';
            header("Location:"."../index.php");
        }else{
            $_SESSION['log'] = 'invalido';
            header("Location:"."./login.php");
        }
        
    }
    

?>