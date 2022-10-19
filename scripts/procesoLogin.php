<?php
    session_start();
    
    $usuario = "fcytuader";
    $pass = "programacionavanzada";

    $ip = $_SERVER["REMOTE_ADDR"];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = '6LcZ_pMiAAAAAPMFAQR5QsLilSLHCgruhND0AHls';

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

    $atributos = json_decode($response, TRUE);

    if($atributos['success']){
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