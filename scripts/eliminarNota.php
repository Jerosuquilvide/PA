<?php 
    require('../vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();

    session_start();

    if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido' && isset($_GET['id'])){
        $engine = $_ENV['DB_ENGINE'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pwd =  $_ENV['DB_PWD'];
        $pdo = new PDO("$engine:host=$host;port=$port;dbname=$name", $user, $pwd);

        $id_delete = $_GET['id'];
        $consulta = $pdo->prepare("
            DELETE
            FROM 
                NOTA 
            WHERE ID = :id_delete;
        ");
        $consulta->bindValue(':id_delete', $id_delete, PDO::PARAM_INT);
        $consulta->execute();

        if($consulta){
            $_SESSION['delete'] = 'ok';
            header("Location:"."./vistaNota.php");           
        }else{
            $_SESSION['delete'] = 'fallo';
            header("Location:"."./vistaNota.php");           
        }

        $consulta = null;
        $pdo = null;
        
    }else{
        header("Location:"."./login.php");
    }
