<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agregar Empleado </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/agregar.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>

<body class="fondo">
    <header>
        <div class="fondo_menu">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="../../img/logo.png" alt="Logo" style="width:50px;" class="rounded-pill border border-2">
                        </a>
                        <a class="navbar-brand fw-semibold text-light" href="index.php">Chronoworks</a>
                        <a href="../../admin.php" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Agregar Empleado
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <?php
                include "../../modelo/Conexion.php";
                include "../../controlador/empleados/registro_empleados.php";
                include "../../controlador/empleados/eliminar_empleados.php";
                ?>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre del empleado" name="nombre">
                    </div>
                    <div class="col-6">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" placeholder="Apellido del empleado" name="apellido">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 col-6">
                        <label for="fechaingreso" class="form-label">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" name="fechaingreso" id="fechaingreso">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="email" class="form-label"> Correo del Empleado:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo del empleado">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="telefono" class="form-label"> Teléfono:</label>
                        <input type="tel" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{4}" title="Digite un teléfono válido" class="form-control" name="telefono" id="telefono" placeholder="Teléfono del empleado">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="turno" class="form-label"> Turno:</label>
                        <input type="number" class="form-control" name="turno" id="turno" placeholder="Turno del empleado">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Registrar </button>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
</body>