<?php
// ============================================
// ARCHIVO: vista/tarea/modificarTarea.php (CORREGIDO)
// ============================================
session_start();
include "../../modelo/Conexion.php";

$id = (int)$_GET['id'];
// ✅ CORREGIDO: Usar pg_query_params
$sql = pg_query_params($conexion, "SELECT * FROM tarea WHERE id_tarea = $1", array($id));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Tarea</title>
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
                        <a href="../../admin.php" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm"
        style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Tarea
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                include "../../controlador/tarea/modificar_tarea.php";
                
                // ✅ CORREGIDO: Usar pg_fetch_object
                if ($sql && pg_num_rows($sql) > 0) {
                    $datos = pg_fetch_object($sql);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="ID_Empleado" class="form-label">Empleado:</label>
                            <select class="form-control" id="ID_Empleado" name="ID_Empleado" required>
                                <option value="">Seleccione un empleado</option>
                                <?php
                                $sql_empleados = pg_query($conexion, "SELECT id_empleado, nombre, apellido FROM empleados ORDER BY nombre");
                                while ($emp = pg_fetch_object($sql_empleados)) {
                                    $selected = ($emp->id_empleado == $datos->id_empleado) ? 'selected' : '';
                                    echo "<option value='{$emp->id_empleado}' $selected>{$emp->nombre} {$emp->apellido}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="nombre_tarea" class="form-label">Nombre de tarea:</label>
                            <input type="text" class="form-control" name="nombre_tarea" id="nombre_tarea" value="<?= htmlspecialchars($datos->nombre_tarea) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-12">
                            <label for="detalles" class="form-label">Detalles:</label>
                            <textarea class="form-control" name="detalles" id="detalles" rows="4" required><?= htmlspecialchars($datos->detalles) ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Actualizar</button>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger">No se encontró la tarea</div>';
                }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>