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
        $engine = $_ENV['DB_ENGINE'];
        $host = $_ENV['DB_HOST'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pwd =  $_ENV['DB_PWD'];
        $pdo = new PDO("$engine:host=$host;dbname=$name", $user, $pwd);
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        // $sql = "
        //     SELECT 
        //         ID,NOMBRE,EMAIL,PASS 
        //     FROM 
        //         USUARIO 
        //     WHERE 
        //         EMAIL = '$email';
        // ";

        //$consulta_previa = $mysqli->query("SELECT ID,NOMBRE,EMAIL,PASS FROM USUARIO WHERE EMAIL = '$email' ; ");

        // $consulta = $pdo->query($sql);
        // $fila = $consulta->fetch();

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
        
        //$mysqli->close();
        $consulta = null;
        $pdo = null;

    }else{
        $_SESSION['log'] = 'invalido';
        header("Location:"."./login.php");   
    }
    

?>