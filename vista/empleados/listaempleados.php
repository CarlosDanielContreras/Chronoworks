<?php
include "../../modelo/Conexion.php";
include "../../controlador/empleados/registro_empleados.php";
include "../../controlador/empleados/eliminar_empleados.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Lista Empleados </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/listaempleados.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
</head>

<body class="fondo">
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="campanasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Servicios 1
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="campanasDropdown">
                                    <li><a class="dropdown-item" href="../campaña/listacampaña.php">Campaña</a></li>
                                    <li><a class="dropdown-item" href="../asignacion/listaasignacion.php">Asignación</a></li>
                                    <li><a class="dropdown-item" href="../controlacceso/listacontrol.php">Control Acceso</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="empleadosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Servicios 2
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="empleadosDropdown">
                                    <li><a class="dropdown-item" href="../empresa/listaempresa.php">Empresa</a></li>
                                    <li><a class="dropdown-item" href="../roles/listaroles.php">Roles</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="contactoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Servicios 3
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="contactoDropdown">
                                    <li><a class="dropdown-item" href="../tarea/listatarea.php">Tareas</a></li>
                                    <li><a class="dropdown-item" href="../credenciales/listacredenciales.php">Credenciales</a></li>
                                    <li><a class="dropdown-item" href="../turno/listaturno.php">Turnos</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a href="../../admin.php" class="botoninicio me-2">Inicio</a>
                        <a href="../../logout.php" class="botonsesion">Cerrar Sesión</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="container mt-3 border border-2 p-3" style="border-radius: 15px; max-height: 150px; max-width: 50%;   background: linear-gradient(180deg,rgb(185, 178, 178) 70%, #878c8d 100%);">
        <div class="col-md-6">
            <h3 class="py-2 px-4 mx-2 shadow-sm text-center"
                style=" background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                Agregar Empleado
            </h3>
            <a href="agregarempleados.php" class="boton d-flex justify-content-center align-items-center mx-auto mt-3"
                style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;"> Agregar
            </a>

        </div>
        <div class="col-md-6">
            <h3 class="py-2 px-3 mx-2 shadow-sm text-center"
                style=" background: linear-gradient(180deg, #4caed4 0%, #5d8ea1 100%);color: black; max-width: 300px; border-radius: 15px; border: 2px solid white; font-size: 1.2rem;">
                Generar Reporte
            </h3>
            <button class="boton d-flex justify-content-center align-items-center mx-auto mt-3"
                style="width: 150px; height: 40px; border-radius: 10px; font-size: 1rem;">
                Generar
            </button>
        </div>
    </div>
    <h2 class="text-center py-3 px-4 mx-auto mt-3 shadow-sm"
        style="background-color:rgb(185, 178, 178);color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 1rem; border-radius: 15px; border: solid 2px; border-color: white;">
        Lista de Empleados
    </h2>
    <script>
        function eliminar() {
            var respuesta = confirm("¿Desea eliminar el empleado?")
            return respuesta
        }
    </script>
    <?php
    // Mostrar mensaje si existe
    if (isset($_SESSION['mensaje'])) { ?>
        <?php
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']); // Elimina el mensaje tras mostrarlo
        ?>
    <?php } ?>
    <div class="container mt-3">
        <div class="estilo-tabla">
            <table>
                <thead>
                    <tr>
                        <th>ID Empleado</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Fecha Ingreso</th>
                        <th>Teléfono</th>
                        <th>Turno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ✅ CORREGIDO: Usar pg_query en lugar de mysqli_query
                    $sql = pg_query($conexion, "SELECT * FROM empleados ORDER BY id_empleado DESC");
                    
                    // ✅ CORREGIDO: Usar pg_fetch_object en lugar de mysqli_fetch_object
                    if ($sql && pg_num_rows($sql) > 0) {
                        while ($datos = pg_fetch_object($sql)) { ?>
                            <tr>
                                <td><?= htmlspecialchars($datos->id_empleado) ?></td>
                                <td><?= htmlspecialchars($datos->nombre) ?></td>
                                <td><?= htmlspecialchars($datos->apellido) ?></td>
                                <td><?= htmlspecialchars($datos->correo) ?></td>
                                <td><?= date('d/m/Y', strtotime($datos->fecha_ingreso)) ?></td>
                                <td><?= htmlspecialchars($datos->telefono) ?></td>
                                <td><?= htmlspecialchars($datos->id_turno) ?></td>
                                <td>
                                    <div class="botones-acciones">
                                        <a href="modificarempleados.php?id=<?= $datos->id_empleado ?>" class="botoneditar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a onclick="return eliminar()" href="listaempleados.php?id=<?= $datos->id_empleado ?>" class="botoneliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">No hay empleados registrados</td></tr>';
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