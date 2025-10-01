<?php
include "../../modelo/Conexion.php";
include "../../controlador/validarcuenta/validarusuario.php";
include "../../controlador/control_acceso/registro_controlacceso.php";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agregar Acceso </title>
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
                        <a class="navbar-brand fw-semibold text-light" href="../../index.php">Chronoworks</a>
                        <a href="<?php
                                    if ($_SESSION['id_rol'] == 3) {
                                        echo "../../agente.php"; // Para Agente
                                    } elseif ($_SESSION['id_rol'] == 1) {
                                        echo "../../admin.php"; // Para Admin
                                    } elseif ($_SESSION['id_rol'] == 2) {
                                        echo "../../lider.php"; // Para Líder
                                    }
                                    ?>" class="botoninicio me-2">Inicio</a>
                </nav>
            </div>
        </div>
    </header>
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Agregar Acceso
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <?php
                include "../../modelo/Conexion.php";
                include "../../controlador/control_acceso/eliminar_controlacceso.php";
                if ($_SESSION['id_rol'] == 3) { // Rol Agente
                    $idempleado = $_SESSION['id_empleado']; // Asumiendo que el ID de empleado está en la sesión
                } else {
                    $idempleado = ''; // En caso de no ser agente, el campo puede estar vacío
                }
                ?>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="idempleado" class="form-label">ID Empleado:</label>
                        <input type="number" class="form-control" id="idempleado" placeholder="Ingrese ID" name="idempleado" value="<?= $idempleado ?>" <?php if ($_SESSION['id_rol'] == 3) echo 'readonly'; ?>>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="fechaacceso" class="form-label">Fecha del Acceso:</label>
                        <input type="date" class="form-control" name="fechaacceso" id="fechaacceso">
                    </div>

                    <div class="mb-3 col-6">
                        <label for="horaentrada" class="form-label">Hora de Entrada:</label>
                        <input type="time" class="form-control" name="horaentrada" id="horaentrada">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="horasalida" class="form-label"> Hora de Salida:</label>
                        <input type="time" class="form-control" name="horasalida" id="horasalida">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 col-6 m-auto">
                        <label for="observaciones" class="form-label"> Observaciones:</label>
                        <textarea class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones..."></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Registrar </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>