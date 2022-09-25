<?php
    $usuario = "fcytuader";
    $pass = "programacionavanzada";
    
    if(isset($_POST)){
        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass){
            var_dump($_SESSION);
            $_SESSION['log'] = 'valido';
            var_dump($_SESSION);
            
            header("Location:"."http://localhost/master-php/TP1.0/index.php");
        }else{
            $_SESSION['log'] = 'invalido';
            header("Location:"."http://localhost/master-php/TP1.0/scripts/login.php");
        }
        
    }
    

?>