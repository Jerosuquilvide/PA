<?php
    $usuario = "fcytuader";
    $pass = "aa";
    
    if(isset($_POST)){
        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass){ 
            $_SESSION['log'] = 'valido';
        }else{
            $_SESSION['log'] = 'invalido';
        }
        
    }
    header("Location:"."http://localhost/master-php/TP1.0/index.php");

?>