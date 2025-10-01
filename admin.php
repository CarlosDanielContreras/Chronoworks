<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión y si tiene el rol adecuado
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Si no está logueado o el rol no es admin (id_rol == 1), redirigir al login o a una página de acceso no autorizado
    header("Location: login.php");
    exit();
}

// Si el rol es el adecuado, mostrar el contenido de admin.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://kit.fontawesome.com/8eb65f8551.js" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>

<body>
    <div class="fondo">
        <header>
            <div class="fondo_menu">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand">
                                <img src="img/logo.png" alt="Logo" style="width:50px;" class="rounded-pill border border-2">
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
                                        <li><a class="dropdown-item" href="vista/asignacion/listaasignacion.php">Asignación</a></li>
                                        <li><a class="dropdown-item" href="vista/campaña/listacampaña.php">Campaña</a></li>
                                        <li><a class="dropdown-item" href="vista/controlacceso/listacontrol.php">Control Acceso</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="empleadosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Servicios 2
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="empleadosDropdown">
                                        <li><a class="dropdown-item" href="vista/empleados/listaempleados.php">Empleados</a></li>
                                        <li><a class="dropdown-item" href="vista/empresa/listaempresa.php">Empresa</a></li>
                                        <li><a class="dropdown-item" href="vista/roles/listaroles.php">Roles</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" id="contactoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Servicios 3
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="contactoDropdown">
                                        <li><a class="dropdown-item" href="vista/tarea/listatarea.php">Tareas</a></li>
                                        <li><a class="dropdown-item" href="vista/credenciales/listacredenciales.php">Credenciales</a></li>
                                        <li><a class="dropdown-item" href="vista/turno/listaturno.php">Turnos</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <a href="logout.php" class="botonsesion">Cerrar Sesión</a>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <h2 class="text-center py-3 px-3 mx-auto mt-4 shadow-sm"
            style="background: linear-gradient(180deg, #cbe5f0 0%, #a09090 100%);color: black; max-width: 400px; margin-top: 2rem; margin-bottom: 1rem; border-radius: 15px; border: solid 3px; border-color: white;">
            ¡Bienvenido, Administrador <?php echo $_SESSION['nombre_empleado']; ?>!
        </h2>
        <div class="fondo-cards">

            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/asignacion.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">ASIGNACIÓN</h4>
                                <p class="card-text">Gestiona las tareas asignadas a cada campaña.</p>
                                <a href="vista/asignacion/listaasignacion.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/campaña.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">CAMPAÑA</h4>
                                <p class="card-text">Gestiona las campañas asociadas a las empresas.</p>
                                <a href="vista/campaña/listacampaña.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/control_acceso.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">CONTROL DE ACCESO</h4>
                                <p class="card-text">Gestiona el acceso de los empleados.</p>
                                <a href="vista/controlacceso/listacontrol.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/empleados.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">EMPLEADOS</h4>
                                <p class="card-text">Gestiona los empleados.</p>
                                <a href="vista/empleados/listaempleados.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/empresa.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">EMPRESA</h4>
                                <p class="card-text">Gestiona las empresas.</p>
                                <a href="vista/empresa/listaempresa.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/roles.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">ROLES</h4>
                                <p class="card-text">Gestiona los roles de las cuentas.</p>
                                <a href="vista/roles/listaroles.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/tarea.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">TAREAS</h4>
                                <p class="card-text">Gestiona las tareas de los empleados.</p>
                                <a href="vista/tarea/listatarea.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/credenciales.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">CREDENCIALES</h4>
                                <p class="card-text">Gestiona las cuentas de los empleados.</p>
                                <a href="vista/credenciales/listacredenciales.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 d-flex justify-content-center align-items-center">
                        <div class="card tarjeta">
                            <img class="card-img-top" src="img/turnos.png" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title">TURNOS</h4>
                                <p class="card-text">Gestiona los turnos laborales de los empleados.</p>
                                <a href="vista/turno/listaturno.php" class="boton">GESTIÓN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>