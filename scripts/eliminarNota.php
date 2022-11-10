<?php 
    session_start();
    if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido' && isset($_GET['id'])){
        
        $mysqli = new mysqli("");                
            $id_delete = $_GET['id'];
            
            $eliminar_sql = "DELETE  FROM NOTA WHERE ID = $id_delete ; ";
            $eliminar_sql = $mysqli->real_escape_string($eliminar_sql);
            $resultado_delete = $mysqli->query($eliminar_sql);

            if($resultado_delete){
                $_SESSION['delete'] = 'ok';
                header("Location:"."./vistaNota.php");           
            }else{
                $_SESSION['delete'] = 'fallo';
                header("Location:"."./vistaNota.php");           
            }
            $mysqli->close();
    }else{
        header("Location:"."./login.php");
    }