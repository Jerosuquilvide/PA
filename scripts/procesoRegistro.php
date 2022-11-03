<?php 
    session_start();

    if(isset($_POST)){
           $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
           $email =  isset($_POST['email']) ? $_POST['email'] : false;
           $password =  isset($_POST['pswd']) ? $_POST['pswd'] : false;
           if($nombre && $email && $password){
                //abro la conexion a la bd
                $mysqli = new mysqli("localhost", "root", "", "TP");                

                //Creo las variables validadas para meter a la bd
                $nbd = $mysqli->real_escape_string($nombre);
                $ebd = $mysqli->real_escape_string($email);
                $ps = $mysqli->real_escape_string($password);
                $pbd = password_hash($ps, PASSWORD_BCRYPT, ['cost' => 12]);
                $user = array(
                    'nombre' => $nbd,
                    'email' => $ebd,
                    'pass' => $pbd
                );

                //Esto hay q ver como implementarlo
                // $consulta = $mysqli->prepare("INSERT INTO USUARIO (NOMBRE,EMAIL,PASS) VALUES(?,?,?);");
             
                // $consulta->bind_param('sss' , $nbd, $ebd, $pbd);
                //------

                //Esto anda


                $consulta_previa = $mysqli->query("SELECT COUNT(ID) AS CANTIDAD FROM USUARIO WHERE EMAIL = '$ebd' ; ");

                $fila = $consulta_previa->fetch_array(MYSQLI_ASSOC);    
                $cast = (int)$fila['CANTIDAD'];

                if($cast == 0){
                    $resultado = $mysqli->query("INSERT INTO USUARIO (NOMBRE,EMAIL,PASS) VALUES('$nbd', '$ebd', '$pbd');");
                    
                    if($resultado){
                        echo "se inserto correctamente !"; //notificar
                        header("Location:"."../index.php");
                    }else{ 
                        echo "NO se inserto correctamente !"; //notificar
                    }
                    
                }else{
                    echo "ya existe una cuenta con ese email"; //notificar
                    header("Location:"."./AltaUsuario.php");
                }

                $mysqli->close();
           }
    }