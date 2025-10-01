<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="fondo_menu">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand">
                            <img src="img/logo.png" alt="Logo" style="width:50px;" class="rounded-pill border border-2">
                        </a>
                        <a class="navbar-brand fw-semibold text-light me-auto">Chronoworks</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a href="Index.php#inicio" class="itemnavbar">Inicio</a>
                        <a href="Index.php#Sobre-nosotros" class="itemnavbar">Sobre Nosotros</a>
                        <a href="Index.php#vision-mision" class="itemnavbar">Visión y Misión</a>
                        <a href="index.php#servicios" class="itemnavbar">Servicios</a>
                        <a href="Index.php#contacto" class="itemnavbar">Contacto</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="fondo_login">
        <div class="login">
            <div class="d-flex justify-content-center">
                <img src="img\logo.png" class="rounded-circle border border-2" alt="logo login" style="height: 7rem">

            </div>
            <div class="text-center fs-4 fw-semibold text-light my-2"> Ingresa a Chronoworks </div>
            <?php
            include "controlador/validarcuenta/validarusuario.php" ?>
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-<?php echo $tipoerror; ?>">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="input-group mt-4">
                    <div class="input-group-text bg-secondary">
                        <img src="img\username.png" alt="username icon" style="height:1rem">
                    </div>
                    <input type="text" class="form-control" placeholder="Correo" name="correo">
                </div>
                <div class="input-group mt-4">
                    <div class="input-group-text bg-secondary">
                        <img src="img/password.png" alt="password icon" style="height:1rem">
                    </div>
                    <input type="password" class="form-control" placeholder="Contraseña" name="contraseña" id="contraseña">
                    <button type="button" class="input-group-text bg-secondary" onclick="mostrarContraseña('contraseña', 'mostrarcontraseña')">
                        <i id="mostrarcontraseña" class="fa-solid fa-eye changepassword"></i>
                    </button>
                </div>
                <div>
                    <button type="submit" class="btn btn-light fw-semibold w-100 mt-4 shadow-sm" name="btniniciarsesion" value="ok"> iniciar sesion
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>