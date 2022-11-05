<?php 
    session_start();
    if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido'){
        //conecto con la bd
        $mysqli = new mysqli("localhost", "root", "", "TP"); 
        if(isset($_POST['titulo']) && isset($_POST['contenido']) && !isset($_POST['estado']) && !isset($_POST['id'])){
                
                $titulo = $_POST['titulo'];
                $contenido = $_POST['contenido'];

                //Creo las variables validadas para meter a la bd
                $tbd = $mysqli->real_escape_string($titulo);
                $cbd = $mysqli->real_escape_string($contenido);
                $id_u = $_SESSION['id'];

                //Estado falso es cuando no esta realizada, true cuando si lo esta
                

                $resultado = $mysqli->query("INSERT INTO NOTA (U_ID,CONTENIDO,TITULO,ESTADO) VALUES('$id_u', '$cbd', '$tbd', FALSE);");
                if($resultado){
                    $_SESSION['alta_nota'] = 'ok';
                    header("Location:"."./vistaNota.php");
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

            settype($cont , "string");
            settype($estado, "int");
            settype($tit , "string");
            settype($id , "int");
            

            $sql = "UPDATE NOTA SET CONTENIDO = '$cont',TITULO = '$tit', ESTADO = $estado WHERE ID = $id ; ";

            $resultado_modif = $mysqli->query($sql);
            if($resultado_modif){
                $_SESSION['modif'] = 'ok';
                header("Location:"."./vistaNota.php");           
            }else{
                $_SESSION['modif'] = 'fallo';
                header("Location:"."./vistaNota.php");           
            }
        }
        
        $mysqli->close();

    }else{
        header("Location:"."./login.php");   
    }
    