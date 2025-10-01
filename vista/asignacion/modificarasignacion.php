<?php
session_start();
include_once "../../modelo/Conexion.php";

$id = (int)$_GET['id'];

// ✅ MySQL: Usar mysqli_prepare
$stmt = mysqli_prepare($conexion, "SELECT * FROM asignacion WHERE id_Asignacion = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$sql = $result; // Para compatibilidad con el código siguiente
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Asignación</title>
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
                        <a href="<?php echo ($_SESSION['id_rol'] === 1) ? '../../admin.php' : '../../lider.php'; ?>" class="botoninicio">Inicio</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    
    <h2 class="text-center py-3 px-4 mx-auto shadow-sm" style="color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 2rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Modificar Asignación
    </h2>
    
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                include "../../controlador/asignacion/modificar_asignacion.php";
                
                // ✅ MySQL: Usar mysqli_num_rows y mysqli_fetch_object
                if ($sql && mysqli_num_rows($sql) > 0) {
                    $datos = mysqli_fetch_object($sql);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="idtarea" class="form-label">Tarea:</label>
                            <select class="form-control" id="idtarea" name="idtarea" required>
                                <option value="">Seleccione una tarea</option>
                                <?php
                                $sql_tareas = mysqli_query($conexion, 
                                    "SELECT t.ID_Tarea, t.nombre_tarea, e.Nombre, e.Apellido 
                                     FROM tarea t 
                                     JOIN empleados e ON t.ID_Empleado = e.ID_Empleado 
                                     ORDER BY t.nombre_tarea"
                                );
                                while ($tarea = mysqli_fetch_object($sql_tareas)) {
                                    $selected = ($tarea->ID_Tarea == $datos->Id_tarea) ? 'selected' : '';
                                    echo "<option value='{$tarea->ID_Tarea}' $selected>{$tarea->nombre_tarea} - {$tarea->Nombre} {$tarea->Apellido}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="idcampaña" class="form-label">Campaña:</label>
                            <select class="form-control" id="idcampaña" name="idcampaña" required>
                                <option value="">Seleccione una campaña</option>
                                <?php
                                $sql_campanias = mysqli_query($conexion, 
                                    "SELECT c.ID_Campania, c.Nombre_Campania, e.Nombre_Empresa 
                                     FROM campania c 
                                     JOIN empresa e ON c.ID_Empresa = e.ID_Empresa 
                                     ORDER BY c.Nombre_Campania"
                                );
                                while ($campania = mysqli_fetch_object($sql_campanias)) {
                                    $selected = ($campania->ID_Campania == $datos->Id_campania) ? 'selected' : '';
                                    echo "<option value='{$campania->ID_Campania}' $selected>{$campania->Nombre_Campania} - {$campania->Nombre_Empresa}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="mb-3 col-6">
                            <label for="fechaasignacion" class="form-label">Fecha de Asignación:</label>
                            <input type="datetime-local" class="form-control" name="fechaasignacion" id="fechaasignacion" 
                                   value="<?= date('Y-m-d\TH:i', strtotime($datos->fecha)) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones..." rows="3" required><?= htmlspecialchars($datos->observaciones) ?></textarea>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary shadow py-2 px-4 fw-bold col-5" name="btnregistrar" value="ok">Actualizar</button>
                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger">No se encontró la asignación</div>';
                }
                mysqli_stmt_close($stmt);
                ?>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>