<?php
session_start();
include "../../modelo/Conexion.php";
include "../../controlador/campaña/registro_campaña.php";
include "../../controlador/campaña/eliminar_campaña.php";
$rol = $_SESSION['id_rol'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Campañas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/listacampaña.css">
    <link rel="stylesheet" href="../../css/header.css">
</head>
<body class="fondo <?php echo ($_SESSION['id_rol'] === 3) ? 'agente' : ''; ?>" id="listacampaña-vista">
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
                        <!-- Menú navegación según rol -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if ($_SESSION['id_rol'] != 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                        <?php echo ($_SESSION['id_rol'] === 2) ? 'Servicios' : 'Servicios 1'; ?>
                                    </a>
                                    <ul class="dropdown-menu">
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
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Turnos</a></li>
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Tareas</a></li>
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Credenciales</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            
                            <?php if ($_SESSION['id_rol'] === 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Servicios 1</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Mis Turnos</a></li>
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Mis Tareas</a></li>
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
                    Agregar Campaña
                </h3>
                <a href="agregarcampaña.php" class="boton d-flex justify-content-center align-items-center mx-auto mt-3" style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">Agregar</a>
            </div>
        </div>
    <?php endif; ?>
    
    <h2 class="text-center py-3 px-3 mx-auto mt-3 shadow-sm" style="background-color:rgb(185, 178, 178);color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 1rem; border-radius: 15px; border: solid 2px; border-color: white;">
        <?php echo ($_SESSION['id_rol'] === 3) ? 'Campañas Activas' : 'Lista de Campañas'; ?>
    </h2>
    
    <script>
        function eliminar() {
            return confirm("¿Desea eliminar la campaña?")
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
                            <th>ID Campaña</th>
                            <th>ID Empresa</th>
                        <?php } ?>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <?php if ($_SESSION['id_rol'] != 3) { ?>
                            <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ✅ MySQL: Usar mysqli_query
                    if ($_SESSION['id_rol'] == 3) {
                        $sql = mysqli_query($conexion, "SELECT * FROM campania WHERE Fecha_Fin >= CURDATE() ORDER BY Fecha_Inicio DESC");
                    } else {
                        $sql = mysqli_query($conexion, "SELECT * FROM campania ORDER BY ID_Campania DESC");
                    }

                    // ✅ MySQL: Usar mysqli_fetch_object
                    if ($sql && mysqli_num_rows($sql) > 0) {
                        while ($datos = mysqli_fetch_object($sql)) { ?>
                            <tr>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td><?= $datos->ID_Campania ?></td>
                                    <td><?= $datos->ID_Empresa ?></td>
                                <?php } ?>
                                <td><?= htmlspecialchars($datos->Nombre_Campania) ?></td>
                                <td class="celdadescripcion">
                                    <?php
                                    $descripcion = $datos->Descripcion ?? '';
                                    if (strlen($descripcion) > 42) {
                                        $descripcion_truncada = substr($descripcion, 0, strrpos(substr($descripcion, 0, 47), ' '));
                                        if ($descripcion_truncada === false || $descripcion_truncada === '') {
                                            $descripcion_truncada = substr($descripcion, 0, 42);
                                        }
                                    } else {
                                        $descripcion_truncada = $descripcion;
                                    }
                                    ?>
                                    <div class="observaciones-text" data-collapsed="true">
                                        <?= htmlspecialchars($descripcion_truncada) ?>
                                        <span class="extra-text">
                                            <?= strlen($descripcion) > 42 ? htmlspecialchars(substr($descripcion, strlen($descripcion_truncada))) : '' ?>
                                        </span>
                                    </div>
                                    <?php if (strlen($descripcion) > 42) { ?>
                                        <button class="ver-mas">Ver más</button>
                                    <?php } ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($datos->Fecha_Inicio)) ?></td>
                                <td><?= date('d/m/Y', strtotime($datos->Fecha_Fin)) ?></td>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td>
                                        <div class="botones-acciones">
                                            <a href="modificarCampaña.php?id=<?= $datos->ID_Campania ?>" class="botoneditar">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="return eliminar()" href="listacampaña.php?id=<?= $datos->ID_Campania ?>" class="botoneliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }
                    } else {
                        echo '<tr><td colspan="' . ($_SESSION['id_rol'] != 3 ? '7' : '4') . '" class="text-center">No hay campañas registradas</td></tr>';
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