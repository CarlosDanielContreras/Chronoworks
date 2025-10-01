<?php
// ============================================
// ARCHIVO: vista/credenciales/modificarCredenciales.php
// ============================================
session_start();
include "../../modelo/Conexion.php";

$id = (int)$_GET['id'];
// ✅ CORREGIDO: Usar pg_query_params
$sql = pg_query_params($conexion, "SELECT * FROM credenciales WHERE id_credencial = $1", array($id));
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
                
                // ✅ CORREGIDO: Usar pg_fetch_object
                if ($sql && pg_num_rows($sql) > 0) {
                    $datos = pg_fetch_object($sql);
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="correo" placeholder="correo del empleado" name="correo" value="<?= htmlspecialchars($datos->usuario) ?>" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="pwd" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Nueva contraseña" required>
                            <small class="text-muted">Deja en blanco para mantener la contraseña actual</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="idempleado" class="form-label">Empleado:</label>
                            <select class="form-control" id="idempleado" name="idempleado" required>
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
                        <div class="mb-3 col-6">
                            <label for="idrol" class="form-label">Rol:</label>
                            <select class="form-control" id="idrol" name="idrol" required>
                                <option value="">Seleccione un rol</option>
                                <?php
                                $sql_roles = pg_query($conexion, "SELECT id_rol, nombre FROM roles ORDER BY id_rol");
                                while ($rol = pg_fetch_object($sql_roles)) {
                                    $selected = ($rol->id_rol == $datos->id_rol) ? 'selected' : '';
                                    echo "<option value='{$rol->id_rol}' $selected>{$rol->nombre}</option>";
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
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>