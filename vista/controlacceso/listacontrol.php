<?php
// ============================================
// ARCHIVO: vista/controlacceso/listacontrol.php
// ============================================

// ✅ SOLUCIÓN: Iniciar sesión ANTES de usar $_SESSION
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id_rol'])) {
    header("Location: ../../login.php");
    exit();
}

include "../../modelo/Conexion.php";
include "../../controlador/control_acceso/registro_controlacceso.php";
include "../../controlador/control_acceso/eliminar_controlacceso.php";

$rol = $_SESSION['id_rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Accesos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/listacontrol_acceso.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>
<body class="fondo <?php echo ($_SESSION['id_rol'] === 3) ? 'agente' : ''; ?>" id="listacontrol-vista">
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
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="campanasDropdown" role="button" data-bs-toggle="dropdown">
                                        <?php echo ($_SESSION['id_rol'] === 2) ? 'Servicios' : 'Servicios 1'; ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../campaña/listacampaña.php">Campañas</a></li>
                                        <li><a class="dropdown-item" href="../asignacion/listaasignacion.php">Asignación</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 1) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                        Servicios 2
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../empleados/listaempleados.php">Empleados</a></li>
                                        <li><a class="dropdown-item" href="../empresa/listaempresa.php">Empresa</a></li>
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Roles</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                        Servicios 3
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Turnos</a></li>
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Tareas</a></li>
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Credenciales</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                        Servicios 1
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Mis Turnos</a></li>
                                        <li><a class="dropdown-item" href="../campaña/listacampaña.php">Campañas Activas</a></li>
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Mis Tareas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                        Servicios 2
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Mi Cuenta</a></li>
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Mi Rol</a></li>
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
    
    <div class="container mt-3 border border-2 p-3" style="border-radius: 15px; max-height: 150px; max-width: 50%; background: linear-gradient(180deg,rgb(185, 178, 178) 70%, #878c8d 100%);">
        <?php if ($_SESSION['id_rol'] === 3) { ?>
            <div class="col-md-6">
                <h3 class="py-2 px-4 mx-2 shadow-sm text-center" style="background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                    Agregar Acceso
                </h3>
                <a href="agregaracceso.php" class="boton d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">Agregar</a>
            </div>
        <?php } ?>
        <?php if ($_SESSION['id_rol'] != 3) { ?>
            <div class="col-md-6">
                <h3 class="py-2 px-3 mx-2 shadow-sm text-center" style="background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                    Generar Reporte
                </h3>
                <a class="boton d-flex justify-content-center align-items-center mx-auto mt-3" href="../../dompdf/reporte_pdf_acceso.php" style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">Generar</a>
            </div>
        <?php } ?>
    </div>

    <h2 class="text-center py-3 px-4 mx-auto mt-3 shadow-sm" style="background-color:rgb(185, 178, 178);color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 1rem; border-radius: 15px; border: solid 2px; border-color: white;">
        <?php echo ($_SESSION['id_rol'] === 3) ? 'Tus Accesos' : 'Lista de Accesos'; ?>
    </h2>
    
    <script>
        function eliminar() {
            return confirm("¿Desea eliminar el acceso?")
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
                <thead>
                    <tr>
                        <?php if ($_SESSION['id_rol'] != 3) { ?>
                            <th>ID Acceso</th>
                            <th>ID Empleado</th>
                            <th>Fecha</th>
                            <th>Hora Ingreso</th>
                            <th>Hora Salida</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        <?php } else { ?>
                            <th>Fecha</th>
                            <th>Hora Ingreso</th>
                            <th>Hora Salida</th>
                            <th>Observaciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta según el rol
                    if ($_SESSION['id_rol'] == 3) {
                        $idempleado = $_SESSION['id_empleado'];
                        $sql = pg_query_params($conexion, 
                            "SELECT fecha, hora_entrada, hora_salida, observacion 
                             FROM control_acceso 
                             WHERE id_empleado = $1 
                             ORDER BY fecha DESC", 
                            array($idempleado)
                        );
                    } else {
                        $sql = pg_query($conexion, 
                            "SELECT * FROM control_acceso ORDER BY id_control DESC"
                        );
                    }

                    if ($sql && pg_num_rows($sql) > 0) {
                        while ($datos = pg_fetch_object($sql)) { ?>
                            <tr>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td><?= htmlspecialchars($datos->id_control) ?></td>
                                    <td><?= htmlspecialchars($datos->id_empleado) ?></td>
                                    <td><?= date('d/m/Y', strtotime($datos->fecha)) ?></td>
                                    <td><?= htmlspecialchars($datos->hora_entrada) ?></td>
                                    <td><?= htmlspecialchars($datos->hora_salida) ?></td>
                                    <td><?= htmlspecialchars($datos->observacion) ?></td>
                                    <td>
                                        <a href="modificarControlacceso.php?id=<?= $datos->id_control ?>" class="btn btn-small btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a onclick="return eliminar()" href="listacontrol.php?id=<?= $datos->id_control ?>" class="btn btn-small btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                <?php } else { ?>
                                    <td><?= date('d/m/Y', strtotime($datos->fecha)) ?></td>
                                    <td><?= htmlspecialchars($datos->hora_entrada) ?></td>
                                    <td><?= htmlspecialchars($datos->hora_salida) ?></td>
                                    <td><?= htmlspecialchars($datos->observacion) ?></td>
                                <?php } ?>
                            </tr>
                        <?php }
                    } else {
                        $colspan = ($_SESSION['id_rol'] != 3) ? 7 : 4;
                        echo '<tr><td colspan="' . $colspan . '" class="text-center">No hay registros de acceso</td></tr>';
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