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

    if(isset($_POST)){
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $email =  isset($_POST['email']) ? $_POST['email'] : false;
        $password =  isset($_POST['pswd']) ? $_POST['pswd'] : false;
        
        if($nombre && $email && $password && $datos['success'] == 1 && $datos['score'] >= 0.5 ){
            $engine = $_ENV['DB_ENGINE'];
            $host = $_ENV['DB_HOST'];
            $name = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pwd =  $_ENV['DB_PWD'];
            $pdo = new PDO("$engine:host=$host;dbname=$name", $user, $pwd);
            
            $pwd = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $user = array(
                'nombre' => $nombre,
                'email' => $email,
                'pass' => $pwd
            );

            $consulta = $pdo->prepare("
                SELECT
                    COUNT(ID) AS CANTIDAD
                FROM
                    USUARIO
                WHERE
                    EMAIL = :email;
            ");
            $consulta->bindValue(':email', $email);
            $consulta->execute();
            $fila = $consulta->fetch();

            $cast = (int)$fila['CANTIDAD'];

            if($cast == 0){                
                $consulta = $pdo->prepare("
                    INSERT INTO 
                        USUARIO (NOMBRE,EMAIL,PASS)
                    VALUES(:nombre, :email, :pwd)
                ");
                $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                $consulta->bindValue(':email', $email, PDO::PARAM_STR);
                $consulta->bindValue(':pwd', $pwd, PDO::PARAM_STR);
                $consulta->execute();

                if($consulta){
                    header("Location:"."../index.php");
                }else{ 
                    echo "NO se inserto correctamente !"; //notificar
                }
                
                $pdo = null;
                $consulta = null;
                
            }else{
                echo "ya existe una cuenta con ese email"; //notificar
                header("Location:"."./AltaUsuario.php");
            }
            

        }
    }