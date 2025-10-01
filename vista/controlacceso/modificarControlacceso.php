<?php
session_start();
include "../../modelo/Conexion.php";

$id = (int)$_GET['id'];

// ✅ MySQL: Usar mysqli_prepare
$stmt = mysqli_prepare($conexion, "SELECT * FROM control_acceso WHERE ID_Control = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
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
    
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm" style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Acceso
    </h2>
    
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                include "../../controlador/control_acceso/modificar_controlacceso.php";
                
                // ✅ MySQL: Usar mysqli_num_rows y mysqli_fetch_object
                if ($result && mysqli_num_rows($result) > 0) {
                    $datos = mysqli_fetch_object($result);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="idempleado" class="form-label">Empleado:</label>
                            <select class="form-control" id="idempleado" name="idempleado" required>
                                <option value="">Seleccione un empleado</option>
                                <?php
                                $sql_empleados = mysqli_query($conexion, "SELECT ID_Empleado, Nombre, Apellido FROM empleados ORDER BY Nombre");
                                while ($emp = mysqli_fetch_object($sql_empleados)) {
                                    $selected = ($emp->ID_Empleado == $datos->id_Empleado) ? 'selected' : '';
                                    echo "<option value='{$emp->ID_Empleado}' $selected>{$emp->Nombre} {$emp->Apellido}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="fechaacceso" class="form-label">Fecha del Acceso:</label>
                            <input type="date" class="form-control" name="fechaacceso" id="fechaacceso" value="<?= htmlspecialchars($datos->Fecha) ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="horaentrada" class="form-label">Hora de Entrada:</label>
                            <input type="time" class="form-control" name="horaentrada" id="horaentrada" value="<?= htmlspecialchars($datos->Hora_Entrada) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="horasalida" class="form-label">Hora de Salida:</label>
                            <input type="time" class="form-control" name="horasalida" id="horasalida" value="<?= htmlspecialchars($datos->Hora_Salida) ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="mb-3 col-12">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" rows="3" required><?= htmlspecialchars($datos->Observacion) ?></textarea>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Actualizar</button>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger">No se encontró el registro de acceso</div>';
                }
                mysqli_stmt_close($stmt);
                ?>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>