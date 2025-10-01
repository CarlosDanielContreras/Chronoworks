<?php
session_start();
include "../../modelo/Conexion.php";
include "../../controlador/campaña/registro_campaña.php";
include "../../controlador/campaña/eliminar_campaña.php";
$rol = $_SESSION['id_rol']; // Puede ser 'admin' o 'lider'
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
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if ($_SESSION['id_rol'] != 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="campanasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo ($_SESSION['id_rol'] === 2) ? 'Servicios' : 'Servicios 1'; ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="campanasDropdown">
                                        <li><a class="dropdown-item" href="../asignacion/listaasignacion.php">Asignación</a></li>
                                        <li><a class="dropdown-item" href="../controlacceso/listacontrol.php">Control Acceso</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 1) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="empleadosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Servicios 2
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="empleadosDropdown">
                                        <li><a class="dropdown-item" href="../empleados/listaempleados.php">Empleados</a></li>
                                        <li><a class="dropdown-item" href="../empresa/listaempresa.php">Empresa</a></li>
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Roles</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 1) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="contactoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Servicios 3
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="contactoDropdown">
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Turnos</a></li>
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Tareas</a></li>
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Credenciales</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] === 3) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="servicios1AgenteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Servicios 1
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="servicios1AgenteDropdown">
                                        <li><a class="dropdown-item" href="../turno/listaturno.php">Mis Turnos</a></li>
                                        <li><a class="dropdown-item" href="../tarea/listatarea.php">Mis Tareas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="servicios2AgenteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Servicios 2
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="servicios2AgenteDropdown">
                                        <li><a class="dropdown-item" href="../roles/listaroles.php">Mi Rol</a></li>
                                        <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Mi Cuenta</a></li>
                                        <li><a class="dropdown-item" href="../controlacceso/listacontrol.php">Mis Accesos</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <a href="<?php
                                    if ($_SESSION['id_rol'] == 3) {
                                        echo "../../agente.php";
                                    } elseif ($_SESSION['id_rol'] == 1) {
                                        echo "../../admin.php";
                                    } elseif ($_SESSION['id_rol'] == 2) {
                                        echo "../../lider.php";
                                    }
                                    ?>" class="botoninicio me-2">Inicio</a>
                        <a href="../../logout.php" class="botonsesion">Cerrar Sesión</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <?php if ($_SESSION['id_rol'] != 3): ?>
        <div class="container mt-3 border border-2 p-3" style="border-radius: 15px; max-height: 150px; max-width: 50%;   background: linear-gradient(180deg,rgb(185, 178, 178) 70%, #878c8d 100%);">
            <div class="col-md-6">
                <h3 class="py-2 px-4 mx-2 shadow-sm text-center"
                    style="background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                    Agregar Campaña
                </h3>
                <a href="agregarcampaña.php" class="boton d-flex justify-content-center align-items-center mx-auto mt-3"
                    style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;"> Agregar
                </a>
            </div>
        </div>
    <?php endif; ?>
    <h2 class="text-center py-3 px-3 mx-auto mt-3 shadow-sm"
        style="background-color:rgb(185, 178, 178);color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 1rem; border-radius: 15px; border: solid 2px; border-color: white;">
        <?php echo ($_SESSION['id_rol'] === 3) ? 'Campañas Activas' : 'Lista de Campañas'; ?>
    </h2>
    <script>
        function eliminar() {
            var respuesta = confirm("¿Desea eliminar la campaña?")
            return respuesta
        }
    </script>
    <?php
    // Mostrar mensaje si existe
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
                        <th>Descripcion</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <?php if ($_SESSION['id_rol'] != 3) { ?>
                            <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // CORREGIDO: Usar pg_query en lugar de $conexion->query()
                    // Consulta según el rol del usuario
                    if ($_SESSION['id_rol'] == 3) {
                        // Si es Agente, solo mostrar campañas activas (puedes agregar filtro de fechas)
                        $sql = pg_query($conexion, "SELECT * FROM campania WHERE fecha_fin >= CURRENT_DATE ORDER BY fecha_inicio DESC");
                    } else {
                        // Para Admin y Líder, mostrar todas las campañas
                        $sql = pg_query($conexion, "SELECT * FROM campania ORDER BY id_campania DESC");
                    }

                    // CORREGIDO: Usar pg_fetch_object en lugar de fetch_object()
                    if ($sql && pg_num_rows($sql) > 0) {
                        while ($datos = pg_fetch_object($sql)) { ?>
                            <tr>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td><?= $datos->id_campania ?></td>
                                    <td><?= $datos->id_empresa ?></td>
                                <?php } ?>
                                <td><?= htmlspecialchars($datos->nombre_campania) ?></td>
                                <td class="celdadescripcion">
                                    <?php
                                    $descripcion = $datos->descripcion ?? '';
                                    // Verifica si el texto tiene más de 42 caracteres
                                    if (strlen($descripcion) > 42) {
                                        // Encuentra la última posición de espacio dentro de los primeros 47 caracteres
                                        $descripcion_truncada = substr($descripcion, 0, strrpos(substr($descripcion, 0, 47), ' '));
                                        if ($descripcion_truncada === false || $descripcion_truncada === '') {
                                            $descripcion_truncada = substr($descripcion, 0, 42);
                                        }
                                    } else {
                                        // Si tiene menos de 42 caracteres, mostramos el texto completo
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
                                <td><?= date('d/m/Y', strtotime($datos->fecha_inicio)) ?></td>
                                <td><?= date('d/m/Y', strtotime($datos->fecha_fin)) ?></td>
                                <?php if ($_SESSION['id_rol'] != 3) { ?>
                                    <td>
                                        <div class="botones-acciones">
                                            <a href="modificarCampaña.php?id=<?= $datos->id_campania ?>" class="botoneditar">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="return eliminar()" href="listacampaña.php?id=<?= $datos->id_campania ?>" class="botoneliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php
                        }
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