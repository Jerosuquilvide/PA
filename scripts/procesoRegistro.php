<?php
    require('../vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();

    session_start();

    if(isset($_POST)){
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $email =  isset($_POST['email']) ? $_POST['email'] : false;
        $password =  isset($_POST['pswd']) ? $_POST['pswd'] : false;
        if($nombre && $email && $password){
            $engine = $_ENV['DB_ENGINE'];
            $host = $_ENV['DB_HOST'];
            $name = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pwd =  $_ENV['DB_PWD'];
            $pdo = new PDO("$engine:host=$host;dbname=$name", $user, $pwd);

            // $mysqli = new mysqli("localhost", "root", "", "TP");

            //Creo las variables validadas para meter a la bd
            // $nbd = $mysqli->real_escape_string($nombre);
            // $ebd = $mysqli->real_escape_string($email);
            // $ps = $mysqli->real_escape_string($password);
            // $pwd = password_hash($ps, PASSWORD_BCRYPT, ['cost' => 12]);

            
            $pwd = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $user = array(
                // 'nombre' => $nbd,
                // 'email' => $ebd,
                // 'pass' => $pwd
                'nombre' => $nombre,
                'email' => $email,
                'pass' => $pwd
            );

            //Esto hay q ver como implementarlo
            // $consulta = $mysqli->prepare("INSERT INTO USUARIO (NOMBRE,EMAIL,PASS) VALUES(?,?,?);");
            
            // $consulta->bind_param('sss' , $nbd, $ebd, $pwd);
            //------

            //Esto anda

            // $sql = "
            //     SELECT
            //         COUNT(ID) AS CANTIDAD
            //     FROM
            //         USUARIO
            //     WHERE
            //         EMAIL = '$ebd';
            // ";

            // $consulta_previa = $mysqli->query("SELECT COUNT(ID) AS CANTIDAD FROM USUARIO WHERE EMAIL = '$ebd' ; ");
            // $fila = $consulta_previa->fetch_array(MYSQLI_ASSOC);    
            
            // $consulta = $pdo->query($sql);
            // $fila = $consulta->fetch();

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
                // $resultado = $mysqli->query("INSERT INTO USUARIO (NOMBRE,EMAIL,PASS) VALUES('$nbd', '$ebd', '$pwd');");
                
                $consulta = $pdo->prepare("
                    INSERT INTO 
                        USUARIO (NOMBRE,EMAIL,PASS)
                    VALUES(:nombre, :email, :pwd)
                ");
                $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                $consulta->bindValue(':email', $email, PDO::PARAM_STR);
                $consulta->bindValue(':pwd', $pwd, PDO::PARAM_STR);
                $consulta->execute();

                // if($resultado){
                if($consulta){
                    echo "se inserto correctamente !"; //notificar
                    header("Location:"."../index.php");
                }else{ 
                    echo "NO se inserto correctamente !"; //notificar
                }
                
            }else{
                echo "ya existe una cuenta con ese email"; //notificar
                header("Location:"."./AltaUsuario.php");
            }
            
            //$mysqli->close();
            $pdo = null;
            $consulta = null;
        }
    }