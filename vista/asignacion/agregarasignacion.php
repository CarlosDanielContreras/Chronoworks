<?php
// ============================================
// ARCHIVO: vista/asignacion/agregarasignacion.php (MEJORADO)
// ============================================
session_start();
include "../../modelo/Conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Asignación</title>
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
                        <a href="<?php echo ($_SESSION['id_rol'] === 1) ? '../../admin.php' : '../../lider.php'; ?>" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Agregar Asignación
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <?php include "../../controlador/asignacion/registro_asignacion.php"; ?>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="idtarea" class="form-label">Tarea:</label>
                        <select class="form-control" id="idtarea" name="idtarea" required>
                            <option value="">Seleccione una tarea</option>
                            <?php
                            $sql_tareas = pg_query($conexion, "SELECT t.id_tarea, t.nombre_tarea, e.nombre, e.apellido 
                                                                FROM tarea t 
                                                                JOIN empleados e ON t.id_empleado = e.id_empleado 
                                                                ORDER BY t.nombre_tarea");
                            while ($tarea = pg_fetch_object($sql_tareas)) {
                                echo "<option value='{$tarea->id_tarea}'>{$tarea->nombre_tarea} - {$tarea->nombre} {$tarea->apellido}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="idcampaña" class="form-label">Campaña:</label>
                        <select class="form-control" id="idcampaña" name="idcampaña" required>
                            <option value="">Seleccione una campaña</option>
                            <?php
                            $sql_campanias = pg_query($conexion, "SELECT c.id_campania, c.nombre_campania, e.nombre_empresa 
                                                                   FROM campania c 
                                                                   JOIN empresa e ON c.id_empresa = e.id_empresa 
                                                                   ORDER BY c.nombre_campania");
                            while ($campania = pg_fetch_object($sql_campanias)) {
                                echo "<option value='{$campania->id_campania}'>{$campania->nombre_campania} - {$campania->nombre_empresa}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 col-6">
                        <label for="fechaasignacion" class="form-label">Fecha de Asignación:</label>
                        <input type="date" class="form-control" name="fechaasignacion" id="fechaasignacion" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="observaciones" class="form-label">Observaciones:</label>
                        <textarea class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones..." required></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-light fw-semibold w-100 mt-4 shadow-sm mb-4" name="btnregistrar" value="ok">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>