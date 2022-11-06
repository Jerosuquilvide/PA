<?php session_start() ; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <title>ToDoList</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery 3.6.1 -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf5BeEiAAAAAMg9OYHNrWDDjGc_hOUil4z9WSqH"></script>
    <script>
			$(document).ready(function() {
				$('#entrar').click(function() {
					grecaptcha.ready(function() {
						grecaptcha.execute('6Lf5BeEiAAAAAMg9OYHNrWDDjGc_hOUil4z9WSqH', {
							action: 'validarUsuario'
							}).then(function(token) {
                            $('#recaptcha-token').val(token);
							$('#form-login').submit();
						});
					});
				});
			});
	</script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link del css-->
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">

</head>


<body>
    <!-- Cabecera -->
    <div class="card-header">
        <div class="p-3  text-white text-center" style="background:#304CE1 ;">
            <h1 class="card-title ">ToDo List<span class="glyphicon glyphicon-ok"></span></h1>
            
            <?php if( @$_SESSION['log'] == 'valido') : ?>
                <?php $nombre = $_SESSION['name'] ; ?>
                <div class="callout-info text-end"> <p class="fs-5"> Bienvenido @<?php echo $nombre ?> </p></div>
                <?php else: ?>

            <?php endif ; ?>
        </div>
   
        <nav class="nav text-white text-decoration-none" style="background: #142061;">
            <!-- Renderizado condicional para el Inicio-->      
            <?php if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido') : ?>      
                <a class="nav-link " href="./inicio.php">Inicio</a>
                <a class="nav-link" href="./vistaNota.php">Notas</a>
            <?php endif ;?>
            <!-- Renderizado condicional para el Inicio sin autenticar-->  
            <?php if(is_bool(strpos($_SERVER['REQUEST_URI'],'login.php')) && is_bool(strpos($_SERVER['REQUEST_URI'],'AltaUsuario.php'))): ?>
                    
            <a class="nav-link" href="./scripts/login.php">Iniciar Sesion</a>
            <a class="nav-link" href="./scripts/AltaUsuario.php">Registrarse</a>
            <?php endif ;?>

            <!-- Renderizado condicional para el Iniciar Sesion-->        
            <?php if( is_int(strpos($_SERVER['REQUEST_URI'],'login.php'))): ?>
                    
            <a class="nav-link" href="../index.php">Inicio</a>
            <a class="nav-link" href="./AltaUsuario.php">Registrarse</a>

            <?php endif ;?>
            
            <!-- Renderizado condicional para registrarse-->   
            <?php if(is_int(strpos($_SERVER['REQUEST_URI'],'AltaUsuario.php'))): ?>
                <a class="nav-link" href="../index.php">Inicio</a>
                <a class="nav-link" href="./login.php">Iniciar Sesion</a>
            <?php  endif ?>


            <!-- Renderizado condicional para Cerrar Sesion-->        
            <?php if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido') :?>
                <a class="nav-link" href="./logout.php" >Cerrar Sesión</a>
            <?php endif?>
        </nav>
    </div>
    