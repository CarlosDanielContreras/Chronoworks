<?php
session_start();

if (!isset($_SESSION['id_rol'])) {
    header("Location: ../../login.php");
    exit();
}

include "../../modelo/Conexion.php";
include "../../controlador/tarea/registro_tarea.php";
include "../../controlador/tarea/eliminar_tarea.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/listatarea.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>
<body class="fondo <?php echo ($_SESSION['id_rol'] === 3) ? 'agente' : ''; ?>" id="listatarea-vista">
    <header>
        <div class="fondo_menu">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand">
                            <img src="../../img/logo.png" alt="Logo" style="width:50px;" class="rounded-pill border border-2">
                        </a>
                        <a class="navbar-brand fw-semibold text-light">Chronoworks</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if ($_SESSION['id_rol'] != 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../campaña/listacampaña.php">Campaña</a></li>
                                        <li><a class="dropdown-item" href="../asignacion/listaasignacion.php">Asignación</a></li>
                                        <li><a class="dropdown-item" href="../controlacceso/listacontrol.php">Control Acceso</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 1) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 2</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../empleados/listaempleados.php">Empleados</a></li>
                                        <li><a class="dropdown-item" href="../empresa/listaempresa.php">Empresa</a></li>
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Roles</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 3</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Credenciales</a></li>
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Turnos</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Mis Turnos</a></li>
                                        <li><a class="dropdown-item" href="../campaña/listacampaña.php">Campañas Activas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 2</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Mi Rol</a></li>
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Mi Cuenta</a></li>
                                        <li><a class="dropdown-item" href="../controlacceso/listacontrol.php">Mis Accesos</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <a href="<?php
                            if ($_SESSION['id_rol'] == 3) echo "../../agente.php";
                            elseif ($_SESSION['id_rol'] == 1) echo "../../admin.php";
                            elseif ($_SESSION['id_rol'] == 2) echo "../../lider.php";
                        ?>" class="botoninicio me-2">Inicio</a>
                        <a href="../../logout.php" class="botonsesion">Cerrar Sesión</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <?php if ($_SESSION['id_rol'] != 3): ?>
        <div class="container mt-3 border border-2 p-3" style="border-radius: 15px; max-height: 150px; max-width: 50%; background: linear-gradient(180deg,rgb(185, 178, 178) 70%, #878c8d 100%);">
            <div class="col-md-6">
                <h3 class="py-2 px-4 mx-2 shadow-sm text-center" style="background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                    Agregar Tarea
                </h3>
                <a href="agregartarea.php" class="boton d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">Agregar</a>
            </div>
            <div class="col-md-6">
                <h3 class="py-2 px-3 mx-2 shadow-sm text-center" style="background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                    Generar Reporte
                </h3>
                <button class="boton d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">Generar</button>
            </div>
        </div>
    <?php endif; ?>

    <h2 class="text-center py-3 px-4 mx-auto mt-3 shadow-sm" style="background-color:rgb(185, 178, 178);color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 1rem; border-radius: 15px; border: solid 2px; border-color: white;">
        <?php echo ($_SESSION['id_rol'] === 3) ? 'Mis Tareas' : 'Lista de Tareas'; ?>
    </h2>

    <script>
        function eliminar() {
            return confirm("¿Desea eliminar la tarea?")
        }
    </script>

    <?php
    if (isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
    ?>

    <div class="container mt-3">
        <div class="estilo-tabla">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <?php if ($_SESSION['id_rol'] != 3) { ?>
                            <th>ID Tarea</th>
                        <?php } ?>
                        <th>Empleado</th>
                        <th>Nombre Tarea</th>
                        <th>Detalles</th>
                        <?php if ($_SESSION['id_rol'] != 3) { ?>
                            <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ✅ MySQL: Consulta con JOIN
                    if ($_SESSION['id_rol'] == 3) {
                        // Para agentes, solo sus tareas
                        $idempleado = (int)$_SESSION['id_empleado'];
                        $stmt = mysqli_prepare($conexion, 
                            "SELECT t.ID_Tarea, t.nombre_tarea, t.detalles, CONCAT(e.Nombre, ' ', e.Apellido) as empleado
                             FROM tarea t
                             JOIN empleados e ON t.ID_Empleado = e.ID_Empleado
                             WHERE t.ID_Empleado = ?
                             ORDER BY t.ID_Tarea DESC"
                        );
                        mysqli_stmt_bind_param($stmt, "i", $idempleado);
                        mysqli_stmt_execute($stmt);
                        $sql = mysqli_stmt_get_result($stmt);
                    } else {
                        // Para admin/líder, todas las tareas
                        $sql = mysqli_query($conexion, 
                            "SELECT t.ID_Tarea, t.ID_Empleado, t.nombre_tarea, t.detalles, CONCAT(e.Nombre, ' ', e.Apellido) as empleado
                             FROM tarea t
                             JOIN empleados e ON t.ID_Empleado = e.ID_Empleado
                             ORDER BY t.ID_Tarea DESC"
                        );
                    }

                    // ✅ MySQL: Iteración
                    if ($sql && mysqli_num_rows($sql) > 0) {
                        while ($datos = mysqli_fetch_object($sql)) { ?>
                            <tr>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td><?= htmlspecialchars($datos->ID_Tarea) ?></td>
                                <?php } ?>
                                <td><?= htmlspecialchars($datos->empleado) ?></td>
                                <td><?= htmlspecialchars($datos->nombre_tarea) ?></td>
                                <td class="celdadetalles">
                                    <?php
                                    $detalles = $datos->detalles ?? '';
                                    if (strlen($detalles) > 50) {
                                        echo htmlspecialchars(substr($detalles, 0, 50)) . '...';
                                    } else {
                                        echo htmlspecialchars($detalles);
                                    }
                                    ?>
                                </td>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td>
                                        <div class="botones-acciones">
                                            <a href="modificarTarea.php?id=<?= $datos->ID_Tarea ?>" class="botoneditar">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="return eliminar()" href="listatarea.php?id=<?= $datos->ID_Tarea ?>" class="botoneliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }
                        if ($_SESSION['id_rol'] == 3 && isset($stmt)) {
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        $colspan = ($_SESSION['id_rol'] != 3) ? 5 : 3;
                        echo '<tr><td colspan="' . $colspan . '" class="text-center">No hay tareas registradas</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>