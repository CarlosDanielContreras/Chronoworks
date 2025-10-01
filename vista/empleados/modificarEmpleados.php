<?php
// ============================================
// ARCHIVO: vista/empleados/modificarEmpleados.php (CORREGIDO)
// ============================================
session_start();
include_once __DIR__ . "/../../modelo/Conexion.php";

$id = (int)$_GET["id"];

// ✅ CORREGIDO: Usar pg_query_params en lugar de $conexion->query()
$sql = pg_query_params($conexion, "SELECT * FROM empleados WHERE id_empleado = $1", array($id));

if (!$sql) {
    die("Error en la consulta: " . pg_last_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Empleado</title>
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
        Modificar Empleado
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <?php
                include_once __DIR__ . "/../../controlador/empleados/modificar_empleados.php";
                
                // ✅ CORREGIDO: Usar pg_fetch_object en lugar de fetch_object()
                if ($sql && pg_num_rows($sql) > 0) {
                    $datos = pg_fetch_object($sql);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre del empleado" name="nombre" value="<?= htmlspecialchars($datos->nombre) ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" placeholder="Apellido del empleado" name="apellido" value="<?= htmlspecialchars($datos->apellido) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="fechaingreso" class="form-label">Fecha de Ingreso:</label>
                            <input type="date" class="form-control" name="fechaingreso" id="fechaingreso" value="<?= $datos->fecha_ingreso ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="email" class="form-label">Correo del Empleado:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo del empleado" value="<?= htmlspecialchars($datos->correo) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="tel" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{4}" title="Digite un teléfono válido" class="form-control" name="telefono" id="telefono" placeholder="Teléfono del empleado" value="<?= htmlspecialchars($datos->telefono) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="turno" class="form-label">Turno:</label>
                            <select class="form-control" name="turno" id="turno" required>
                                <option value="">Seleccione un turno</option>
                                <?php
                                // ✅ CORREGIDO: Usar pg_query para obtener turnos
                                $sql_turnos = pg_query($conexion, "SELECT id_turno, hora_entrada, hora_salida FROM turno ORDER BY id_turno");
                                while ($turno = pg_fetch_object($sql_turnos)) {
                                    $selected = ($turno->id_turno == $datos->id_turno) ? 'selected' : '';
                                    echo "<option value='{$turno->id_turno}' $selected>Turno {$turno->id_turno}: {$turno->hora_entrada} - {$turno->hora_salida}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Actualizar</button>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger">No se encontró el empleado</div>';
                    echo '<div class="text-center mt-3"><a href="listaempleados.php" class="btn btn-secondary">Volver a la lista</a></div>';
                }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>