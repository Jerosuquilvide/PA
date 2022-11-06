<?php 
    session_start();
    if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido'){
        //conecto con la bd
        $mysqli = new mysqli("localhost", "root", "", "TP"); 
        if(isset($_POST['titulo']) && isset($_POST['contenido']) && !isset($_POST['estado']) && !isset($_POST['id'])){
                
                $titulo = $_POST['titulo'];
                $contenido = $_POST['contenido'];
                $sqli_titulo = strpos($titulo, "script");
                $sqli_titulo_com = strpos($titulo, " ' ");
                $sqli_contenido = strpos($contenido, "script");
                $sqli_contenido_com = strpos($contenido, " ' ");
                //Creo las variables validadas para meter a la bd
                $tbd = $mysqli->real_escape_string($titulo);
                $cbd = $mysqli->real_escape_string($contenido);
                $id_u = $_SESSION['id'];

                //Estado falso es cuando no esta realizada, true cuando si lo esta
                
                if($sqli_contenido == false && $sqli_titulo == false && $sqli_titulo_com == false && $sqli_contenido_com == false){
                    $resultado = $mysqli->query("INSERT INTO NOTA (U_ID,CONTENIDO,TITULO,ESTADO) VALUES('$id_u', '$cbd', '$tbd', FALSE);");
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
            //modificacion de la nota
            $cont = $_POST['contenido'];
            $estado = $_POST['estado'];
            $tit = $_POST['titulo'];
            $id = $_POST['id'];
            $cont = $mysqli->real_escape_string($cont);
            $estado = $mysqli->real_escape_string($estado);
            $tit = $mysqli->real_escape_string($tit);
            
            settype($cont , "string");
            settype($estado, "int");
            settype($tit , "string");
            settype($id , "int");
            
            $sqli_tit = strpos($tit, "script");
            $sqli_tit_com = strpos($tit, "'");
            $sqli_cont = strpos($cont, "script");
            $sqli_cont_com = strpos($cont, "'");
            if($sqli_tit == false && $sqli_tit_com == false && $sqli_cont == false && $sqli_cont_com == false){
                $sql = "UPDATE NOTA SET CONTENIDO = '$cont',TITULO = '$tit', ESTADO = $estado WHERE ID = $id ; ";

                $resultado_modif = $mysqli->query($sql);

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
        
        $mysqli->close();

    }else{
        header("Location:"."./login.php");   
    }
    