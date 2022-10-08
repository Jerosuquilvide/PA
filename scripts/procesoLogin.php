<?php
    session_start();
    $usuario = "fcytuader";
    $pass = "programacionavanzada";
    
    if(isset($_POST)){
        //$ip = $_SERVER('REMOTE_ADDR');
        $captcha = $_POST['g-recaptcha-response'];
        $secretKey = "6LfewWYiAAAAAGfILYKF7FPjebZYI9IDtq2wHu_F";
        $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
        $attr = json_decode($respuesta,TRUE);

        if($_POST['user'] === $usuario && $_POST['pswd'] === $pass && $attr['success']){
            $_SESSION['log'] = 'valido';
            $_SESSION['name'] = $usuario;
            header("Location:"."./inicio.php");
        }else{
            $_SESSION['log'] = 'invalido';
            header("Location:"."./login.php");
        }
        
    }
    

?>