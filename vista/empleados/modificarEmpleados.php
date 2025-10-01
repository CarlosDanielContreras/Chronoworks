<?php
session_start();
include_once __DIR__ . "/../../modelo/Conexion.php";

$id = (int)$_GET["id"];

// ✅ MySQL: Usar mysqli_prepare
$stmt = mysqli_prepare($conexion, "SELECT * FROM empleados WHERE ID_Empleado = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
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
    
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm" style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Empleado
    </h2>
    
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <?php
                include_once __DIR__ . "/../../controlador/empleados/modificar_empleados.php";
                
                // ✅ MySQL: Usar mysqli_num_rows y mysqli_fetch_object
                if ($result && mysqli_num_rows($result) > 0) {
                    $datos = mysqli_fetch_object($result);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre del empleado" name="nombre" value="<?= htmlspecialchars($datos->Nombre) ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" placeholder="Apellido del empleado" name="apellido" value="<?= htmlspecialchars($datos->Apellido) ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="fechaingreso" class="form-label">Fecha de Ingreso:</label>
                            <input type="date" class="form-control" name="fechaingreso" id="fechaingreso" value="<?= $datos->Fecha_Ingreso ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="email" class="form-label">Correo del Empleado:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo del empleado" value="<?= htmlspecialchars($datos->Correo) ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="tel" pattern="\d{3}[-\s]?\d{3}[-\s]?\d{4}" title="Digite un teléfono válido" class="form-control" name="telefono" id="telefono" placeholder="Teléfono del empleado" value="<?= htmlspecialchars($datos->Telefono) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="turno" class="form-label">Turno:</label>
                            <select class="form-control" name="turno" id="turno" required>
                                <option value="">Seleccione un turno</option>
                                <?php
                                // ✅ MySQL: Usar mysqli_query para obtener turnos
                                $sql_turnos = mysqli_query($conexion, "SELECT ID_Turno, Hora_Entrada, Hora_Salida FROM turno ORDER BY ID_Turno");
                                while ($turno = mysqli_fetch_object($sql_turnos)) {
                                    $selected = ($turno->ID_Turno == $datos->id_turno) ? 'selected' : '';
                                    echo "<option value='{$turno->ID_Turno}' $selected>Turno {$turno->ID_Turno}: {$turno->Hora_Entrada} - {$turno->Hora_Salida}</option>";
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
                mysqli_stmt_close($stmt);
                ?>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>