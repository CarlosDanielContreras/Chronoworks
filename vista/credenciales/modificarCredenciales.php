<?php
session_start();
include "../../modelo/Conexion.php";

$id = (int)$_GET['id'];

// ✅ MySQL
$stmt = mysqli_prepare($conexion, "SELECT * FROM credenciales WHERE ID_Credencial = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cuenta</title>
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
        Modificar Cuenta
    </h2>
    <div class="container">
        <div class="col-12">
            <form method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                include "../../controlador/credenciales/modificar_credenciales.php";
                
                // ✅ MySQL
                if ($result && mysqli_num_rows($result) > 0) {
                    $datos = mysqli_fetch_object($result);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="correo" placeholder="correo del empleado" name="correo" value="<?= htmlspecialchars($datos->Usuario) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="pwd" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Nueva contraseña" required>
                            <small class="text-muted">Ingrese la nueva contraseña</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="idempleado" class="form-label">Empleado:</label>
                            <select class="form-control" id="idempleado" name="idempleado" required>
                                <option value="">Seleccione un empleado</option>
                                <?php
                                // ✅ MySQL
                                $sql_empleados = mysqli_query($conexion, "SELECT ID_Empleado, Nombre, Apellido FROM empleados ORDER BY Nombre");
                                while ($emp = mysqli_fetch_object($sql_empleados)) {
                                    $selected = ($emp->ID_Empleado == $datos->ID_Empleado) ? 'selected' : '';
                                    echo "<option value='{$emp->ID_Empleado}' $selected>{$emp->Nombre} {$emp->Apellido}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="idrol" class="form-label">Rol:</label>
                            <select class="form-control" id="idrol" name="idrol" required>
                                <option value="">Seleccione un rol</option>
                                <?php
                                // ✅ MySQL
                                $sql_roles = mysqli_query($conexion, "SELECT ID_Rol, nombre FROM roles ORDER BY ID_Rol");
                                while ($rol = mysqli_fetch_object($sql_roles)) {
                                    $selected = ($rol->ID_Rol == $datos->id_rol) ? 'selected' : '';
                                    echo "<option value='{$rol->ID_Rol}' $selected>{$rol->nombre}</option>";
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
                    echo '<div class="alert alert-danger">No se encontró la cuenta</div>';
                }
                mysqli_stmt_close($stmt);
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>