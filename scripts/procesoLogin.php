<?php
    require('../vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();

    session_start();
	$clave = $_ENV['CAPTCHA_SECRET'];
    $token = $_POST['recaptcha-token'];
	$cu = curl_init();
    curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($cu, CURLOPT_POST, 1);
	curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $clave, 'response' => $token)));
	curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($cu);
	curl_close($cu);
	
	$datos = json_decode($response, true);

    //Validacion contra la base de datos
    if($datos['success'] == 1 && $datos['score'] >= 0.5 && $_POST['email'] && $_POST['pswd']){    
        $engine = $_ENV['DB_ENGINE'];
        $host = $_ENV['DB_HOST'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pwd =  $_ENV['DB_PWD'];
        $pdo = new PDO("$engine:host=$host;dbname=$name", $user, $pwd);
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        $consulta = $pdo->prepare("
            SELECT
                ID,NOMBRE,EMAIL,PASS 
            FROM
                USUARIO
            WHERE
                EMAIL = :email;
        ");
        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->execute();
        $fila = $consulta->fetch();

        $passwordHash = $fila['PASS'];
        $verificar = password_verify($password,$passwordHash);
        if($verificar){                
            $_SESSION['log'] = 'valido';
            $_SESSION['name'] = $fila['NOMBRE'];
            $_SESSION['id'] = $fila['ID'];
            header("Location:"."./inicio.php");
        }else{
            $_SESSION['log'] = 'invalido';
            header("Location:"."./login.php");        
        }
        
        $consulta = null;
        $pdo = null;

    }else{
        $_SESSION['log'] = 'invalido';
        header("Location:"."./login.php");   
    }
    

?>