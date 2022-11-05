<?php
    require('../vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();

    session_start();
    

    //Validacion contra la base de datos
/*     if(!empty($_POST['rand_code'])
        && $_POST['rand_code'] == $_SESSION['rand_code'] 
        && $_POST['email'] 
        && $_POST['pswd']){ */

    if(!empty($_POST['rand_code'])
        && $_POST['email'] 
        && $_POST['pswd']){
    
        //$mysqli = new mysqli("localhost", "root", "", "TP");
        print_r($_ENV);
        $engine = $_ENV['DB_ENGINE'];
        $host = $_ENV['DB_HOST'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pwd =  $_ENV['DB_PWD'];
        $mbd = new PDO("$engine:host=$host;dbname=$name", $user, $pwd);
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        $sql = "
            SELECT 
                ID,NOMBRE,EMAIL,PASS 
            FROM 
                USUARIO 
            WHERE 
                EMAIL = '$email';
        ";

        //$consulta_previa = $mysqli->query("SELECT ID,NOMBRE,EMAIL,PASS FROM USUARIO WHERE EMAIL = '$email' ; ");
        $consulta = $mbd->query($sql);
        $fila = $consulta->fetch();
        print_r($consulta);
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
        
        //$mysqli->close();
        $consulta = null;
        $mbd = null;

    }else{
        $_SESSION['log'] = 'invalido';
        header("Location:"."./login.php");   
    }
    

?>