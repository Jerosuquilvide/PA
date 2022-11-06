<?php
    require('../vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();

    session_start();
    if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido'){
        $engine = $_ENV['DB_ENGINE'];
        $host = $_ENV['DB_HOST'];
        $name = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pwd =  $_ENV['DB_PWD'];
        $pdo = new PDO("$engine:host=$host;dbname=$name", $user, $pwd);

        // $mysqli = new mysqli("localhost", "root", "", "TP");

        if(isset($_POST['titulo']) && isset($_POST['contenido']) && !isset($_POST['estado']) && !isset($_POST['id'])){
            //agregar nota
            $id_u = $_SESSION['id'];
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $estado = 'FALSE';
            $sqli_titulo = strpos($titulo, "script");
            $sqli_titulo_com = strpos($titulo, " ' ");
            $sqli_contenido = strpos($contenido, "script");
            $sqli_contenido_com = strpos($contenido, " ' ");

            //Creo las variables validadas para meter a la bd
            // $tbd = $mysqli->real_escape_string($titulo);
            // $cbd = $mysqli->real_escape_string($contenido);
            
            if($sqli_contenido == false && $sqli_titulo == false && $sqli_titulo_com == false && $sqli_contenido_com == false){
                // $resultado = $mysqli->query("INSERT INTO NOTA (U_ID,CONTENIDO,TITULO,ESTADO) VALUES('$id_u', '$cbd', '$tbd', FALSE);");
                
                $consulta = $pdo->prepare("
                    INSERT INTO 
                        NOTA (U_ID,CONTENIDO,TITULO,ESTADO) 
                        VALUES(:id_u, :contenido, :titulo, :estado);
                ");
                $consulta->bindValue(':id_u', $id_u, PDO::PARAM_INT);
                $consulta->bindValue(':contenido', $contenido, PDO::PARAM_STR);
                $consulta->bindValue(':titulo', $titulo, PDO::PARAM_STR);
                $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
                $resultado = $consulta->execute();

                if($resultado){
                    $_SESSION['alta_nota'] = 'ok';
                    header("Location:"."./vistaNota.php");
                }else{
                    $_SESSION['alta_nota'] = 'fallo';
                    header("Location:"."./vistaNota.php");
                }
            }else{
                $_SESSION['alta_nota'] = 'fallo';
                header("Location:"."./vistaNota.php");
            }
            
                
        }

        if(isset($_POST['titulo']) && isset($_POST['contenido']) && isset($_POST['estado']) && isset($_POST['id'])){
            //editar nota
            $cont = $_POST['contenido'];
            $estado = $_POST['estado'];
            $tit = $_POST['titulo'];
            $id = $_POST['id'];
            // $cont = $mysqli->real_escape_string($cont);
            // $estado = $mysqli->real_escape_string($estado);
            // $tit = $mysqli->real_escape_string($tit);
            
            settype($cont , "string");
            settype($estado, "int");
            settype($tit , "string");
            settype($id , "int");
            
            $sqli_tit = strpos($tit, "script");
            $sqli_tit_com = strpos($tit, "'");
            $sqli_cont = strpos($cont, "script");
            $sqli_cont_com = strpos($cont, "'");

            if($sqli_tit == false && $sqli_tit_com == false && $sqli_cont == false && $sqli_cont_com == false){
                // $sql = "UPDATE NOTA SET CONTENIDO = '$cont',TITULO = '$tit', ESTADO = $estado WHERE ID = $id ; ";

                // $resultado_modif = $mysqli->query($sql);

                $consulta = $pdo->prepare("
                    UPDATE
                        NOTA 
                    SET 
                        CONTENIDO = :cont,TITULO = :tit, ESTADO = :estado
                    WHERE ID = :id;
                ");
                $consulta->bindValue(':cont', $cont, PDO::PARAM_STR);
                $consulta->bindValue(':tit', $tit, PDO::PARAM_STR);
                $consulta->bindValue(':estado', $estado, PDO::PARAM_INT);
                $consulta->bindValue(':id', $id, PDO::PARAM_INT);
                $resultado_modif = $consulta->execute();

                if($resultado_modif){
                    $_SESSION['modif'] = 'ok';
                    header("Location:"."./vistaNota.php");           
                }else{
                    $_SESSION['modif'] = 'fallo';
                    header("Location:"."./vistaNota.php");           
                }
            }else{
                $_SESSION['modif'] = 'fallo';
                header("Location:"."./vistaNota.php");   
            }
        }
        
        // $mysqli->close();

        $pdo = null;
        $consulta = null;

    }else{
        header("Location:"."./login.php");   
    }
    