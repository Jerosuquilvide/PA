

<!-- Faltaria traer las notas del usuario y poder modificarlas , despues de eso mostrarlas mas lindas -->

<?php 

function tabla(){
    $u_id = $_SESSION['id'];
    $mysqli = new mysqli("");                
    $consulta = $mysqli->query("SELECT ID,CONTENIDO,TITULO,ESTADO FROM NOTA WHERE U_ID = $u_id;") ;
    
    if($consulta->num_rows > 0){
            $filas='';
                while ( $nota =  $consulta->fetch_assoc()) 
                {
                    $est0 = " Sin realizar ";
                    $est1 = " Realizada ";
                    $filas.='<tr>';
                        $filas.='<td scope="row">'.$nota["TITULO"].'</td>';
                        $filas.='<td>'.$nota["CONTENIDO"].'</td>';
                        if($nota["ESTADO"] == 0){
                            $filas.='<td>'.$est0.'</td>';    
                        }else{
                            $filas.='<td>'.$est1.'</td>';
                        }
                        $filas.='<td><a href="./editarNota.php?id='.$nota['ID'].'" class="btn btn-outline-warning btn-sm">Editar</a></td>';
                        $filas.='<td><a href="./eliminarNota.php?id='.$nota['ID'].'" class="btn btn-outline-danger btn-sm">Borrar</a></td>';
                    $filas.='</tr>';
                }
            }else{
                    $filas='<tr><td colspan="7">No existen datos que mostrar</td></tr>';
                }
                $tabla = '
                <div class="container-md p-5 my-5 border">
                    <table id="listadosNotas" class="table">
                    <thead>
                        <tr>                    
                            <th scope="col">Titulo</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>'.$filas.'</tbody>
                    </table>
                    </div>
                    ';
            $mysqli->close();
            return $tabla;
            }
            
?>

