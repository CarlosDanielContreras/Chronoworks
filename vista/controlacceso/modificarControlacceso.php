<?php
// ============================================
// ARCHIVO: vista/controlacceso/modificarControlacceso.php (VERSIÓN CORREGIDA FINAL)
// ============================================
session_start();
include "../../modelo/Conexion.php";

$id = (int)$_GET['id'];
$sql = pg_query_params($conexion, "SELECT * FROM control_acceso WHERE id_control = $1", array($id));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/modificar.css">
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
                        <a href="<?php echo ($_SESSION['id_rol'] === 1) ? '../../admin.php' : (($_SESSION['id_rol'] === 2) ? '../../lider.php' : '../../agente.php'); ?>" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Acceso
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                include "../../controlador/control_acceso/modificar_controlacceso.php";
                
                if ($sql && pg_num_rows($sql) > 0) {
                    $datos = pg_fetch_object($sql);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="idempleado" class="form-label">Empleado:</label>
                            <select class="form-control" id="idempleado" name="idempleado" required>
                                <option value="">Seleccione un empleado</option>
                                <?php
                                $sql_empleados = pg_query($conexion, "SELECT id_empleado, nombre, apellido FROM empleados ORDER BY nombre");
                                while ($empleado = pg_fetch_object($sql_empleados)) {
                                    $selected = ($empleado->id_empleado == $datos->id_empleado) ? 'selected' : '';
                                    echo "<option value='{$empleado->id_empleado}' $selected>{$empleado->nombre} {$empleado->apellido}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="fechaacceso" class="form-label">Fecha del Acceso:</label>
                            <input type="date" class="form-control" name="fechaacceso" id="fechaacceso" value="<?= htmlspecialchars($datos->fecha) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="horaentrada" class="form-label">Hora de Entrada:</label>
                            <input type="time" class="form-control" name="horaentrada" id="horaentrada" value="<?= htmlspecialchars($datos->hora_entrada) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="horasalida" class="form-label">Hora de Salida:</label>
                            <input type="time" class="form-control" name="horasalida" id="horasalida" value="<?= htmlspecialchars($datos->hora_salida) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-12">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" rows="3" required><?= htmlspecialchars($datos->observacion) ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Actualizar</button>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger">No se encontró el registro de acceso</div>';
                }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>