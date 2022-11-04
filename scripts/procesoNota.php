<?php 
    session_start();
    if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido'){
        if(isset($_POST['titulo']) && isset($_POST['contenido'])){
                //conecto con la bd
                $mysqli = new mysqli("localhost", "root", "", "TP"); 

                $titulo = $_POST['titulo'];
                $contenido = $_POST['contenido'];

                //Creo las variables validadas para meter a la bd
                $tbd = $mysqli->real_escape_string($titulo);
                $cbd = $mysqli->real_escape_string($contenido);
                $id_u = $_SESSION['id'];

                //Estado falso es cuando no esta realizada, true cuando si lo esta
                

                $resultado = $mysqli->query("INSERT INTO NOTA (U_ID,CONTENIDO,TITULO,ESTADO) VALUES('$id_u', '$cbd', '$tbd', FALSE);");
                if($resultado){
                    echo "se inserto ok"; //hay que mostrarlo mejor
                    die();
                }else{
                    echo "no inserto ni mierda";
                }
        }
    }else{
        header("Location:"."./login.php");   
    }
    