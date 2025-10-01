<?php
// ============================================
// ARCHIVO: vista/credenciales/listacredenciales.php (VERSIÓN CORREGIDA COMPLETA)
// ============================================
session_start();

// Verificar si hay sesión activa
if (!isset($_SESSION['id_rol'])) {
    header("Location: ../../login.php");
    exit();
}

include "../../modelo/Conexion.php";
include "../../controlador/credenciales/registro_credenciales.php";
include "../../controlador/credenciales/eliminar_credenciales.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Cuentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/listacredenciales.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>
<body class="fondo <?php echo ($_SESSION['id_rol'] === 3) ? 'agente' : ''; ?>">
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
                                        <li><a class="dropdown-item" href="../asignacion/listaasignacion.php">Asignación</a></li>
                                        <li><a class="dropdown-item" href="../campaña/listacampaña.php">Campaña</a></li>
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
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Tareas</a></li>
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
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Mis Tareas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 2</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Mi Rol</a></li>
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
                    Agregar Cuenta
                </h3>
                <a href="agregarcredenciales.php" class="boton d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">Agregar</a>
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
        <?php echo ($_SESSION['id_rol'] === 3) ? 'Tu Cuenta' : 'Lista de Cuentas'; ?>
    </h2>
    
    <script>
        function eliminar() {
            return confirm("¿Desea eliminar la cuenta?")
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
            <table>
                <thead>
                    <tr>
                        <?php if ($_SESSION['id_rol'] != 3) { ?>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Empleado</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        <?php } else { ?>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ✅ CORREGIDO: Consulta PostgreSQL con validación completa
                    if ($_SESSION['id_rol'] == 3) {
                        // Para agentes, solo su cuenta
                        $idempleado = (int)$_SESSION['id_empleado'];
                        $sql = pg_query_params($conexion, 
                            "SELECT usuario, contrasena FROM credenciales WHERE id_empleado = $1", 
                            array($idempleado)
                        );
                    } else {
                        // Para admin/líder, todas las cuentas con JOIN
                        $sql = pg_query($conexion, 
                            "SELECT c.id_credencial, c.usuario, c.contrasena, 
                                    COALESCE(e.nombre, 'Sin asignar') AS empleado, 
                                    COALESCE(r.nombre, 'Sin rol') AS rol
                             FROM credenciales c
                             LEFT JOIN empleados e ON e.id_empleado = c.id_empleado
                             LEFT JOIN roles r ON r.id_rol = c.id_rol
                             ORDER BY c.id_credencial DESC"
                        );
                    }

                    // ✅ Verificación completa antes de iterar
                    if ($sql && pg_num_rows($sql) > 0) {
                        while ($datos = pg_fetch_object($sql)) { 
                            // ✅ Validar que $datos no sea null
                            if ($datos === false) {
                                continue; // Saltar esta iteración si hay error
                            }
                            ?>
                            <tr>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td><?= htmlspecialchars($datos->usuario ?? '') ?></td>
                                    <td><?= str_repeat('*', 8) ?></td>
                                    <td><?= htmlspecialchars($datos->empleado ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($datos->rol ?? 'N/A') ?></td>
                                    <td>
                                        <div class="botones-acciones">
                                            <a href="modificarCredenciales.php?id=<?= $datos->id_credencial ?>" class="botoneditar">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="return eliminar()" href="listacredenciales.php?id=<?= $datos->id_credencial ?>" class="botoneliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php } else { ?>
                                    <td><?= htmlspecialchars($datos->usuario ?? '') ?></td>
                                    <td><?= str_repeat('*', 8) ?></td>
                                <?php } ?>
                            </tr>
                        <?php }
                    } else {
                        $colspan = ($_SESSION['id_rol'] != 3) ? 5 : 2;
                        echo '<tr><td colspan="' . $colspan . '" class="text-center">No hay cuentas registradas</td></tr>';
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