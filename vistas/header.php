<?php session_start() ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link del css-->
    <link rel="stylesheet" type="text/css" href="../assets/styles.css">
    <!-- Script del captcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>


<body>
    <!-- Cabecera -->
    <div class="card-header">
        <div class="p-3 bg-primary text-white text-center">
            <h1 class="card-title ">ToDo List<span class="glyphicon glyphicon-ok"></span></h1>
        </div>
        <nav class="nav">
            <!-- <a class="nav-link active" aria-current="page" href="#">Active</a> -->
            <a class="nav-link" href="http://localhost/master-php/TP1.0/index">Incio</a>
            <a class="nav-link" href="#">Notas</a>
            <?php if(!isset($_SESSION['log']) || $_SESSION['log'] == 'invalido') : ?>
            <a class="nav-link" href="http://localhost/master-php/TP1.0/scripts/login">Iniciar Sesion</a>
            <a class="nav-link" href="#">Registrarse</a>
            <?php  endif ?>
            <?php if(isset($_SESSION['log']) && $_SESSION['log'] == 'valido') :?>
                <a class="nav-link" href="http://localhost/master-php/TP1.0/scripts/logout" >Cerrar Sesión</a>
            <?php endif?>
        </nav>
    </div>
    