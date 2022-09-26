<?php
    $usuario = "fcytuader";
    $pass = "programacionavanzada";
    
    if(isset($_POST)){
        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass){
            var_dump($_SESSION);
            $_SESSION['log'] = 'valido';
            var_dump($_SESSION);
            
            header("Location:"."../index.php");
        }else{
            $_SESSION['log'] = 'invalido';
            header("Location:"."./login.php");
        }
        
    }
    

?>