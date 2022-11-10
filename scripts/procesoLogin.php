<?php
    session_start();
    

    //Validacion contra la base de datos
    if(!empty($_POST['rand_code']) && $_POST['rand_code'] == $_SESSION['rand_code'] && $_POST['email'] && $_POST['pswd']){

        $mysqli = new mysqli("");                
            $email = $_POST['email'];
            $password = $_POST['pswd'];
            $consulta_previa = $mysqli->query("SELECT ID,NOMBRE,EMAIL,PASS FROM USUARIO WHERE EMAIL = '$email' ; ");
            $fila = mysqli_fetch_assoc($consulta_previa);
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
            
            $mysqli->close();
            
        
        
    }else{
        $_SESSION['log'] = 'invalido';
        header("Location:"."./login.php");   
    }
    

?>