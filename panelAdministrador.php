<?php
// Aquí puedes agregar cualquier lógica PHP que necesites, como iniciar una sesión, comprobar permisos, etc.
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="Css/Diseño Panel de administrador.css">

</head>

<body>
    <header class="header">
        <div class="menu container">
            <a href="#" class="logo">Logo</a>
            <input type="checkbox" name="menu" id="menu">
            <label for="menu">
                <img src="menu-icon.png" alt="Menú" class="menu-icono">
            </label>
            <nav class="navbar">
                <ul>
                    <li><a href="Index.php">Inicio</a></li> <!-- Cambié Index.html a Index.php -->
                    <li><a href="#Sobre-nosotros">Nosotros</a></li>
                    <li><a href="#Servicios">Servicios</a></li>
                    <li><a href="#Contacto">Contacto</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-content container" id="Inicio">
            <h1>Panel de Administración</h1>
            <p>Descripción del sitio web con imágenes relacionadas a la administración.</p>
        </div>
    </header>

    <section class="portafolio">
        <div>
            <br>
            <h2>Portafolio</h2><br>
            <p class="Porta-h1">¿Qué quieres hacer?</p><br>
            <div class="galeria-port">
                <div class="imagen-port" id="asignacion">
                    <img src="">
                    <div class="hover-galeria">
                        <p>Gestión de Asignacion</p>
                    </div>
                </div>
                <div class="imagen-port" id="campañas">
                    <img src="">
                    <div class="hover-galeria">
                        <p>Gestión de campañas</p>
                    </div>
                </div>
                <div class="imagen-port" id="turnos">
                    <img src="webapp.png">
                    <div class="hover-galeria">
                        <p>Gestión de turnos</p>
                    </div>
                </div>
                <div class="imagen-port" id="empleados">
                    <img src="webapp.png">
                    <div class="hover-galeria">
                        <p>Gestión de empleados</p>
                    </div>
                </div>
                <div class="imagen-port" id="controlacceso">
                    <img src="">
                    <div class="hover-galeria">
                        <p>Gestión de Control de Acceso</p>
                    </div>
                </div>
                <div class="imagen-port" id="credenciales">
                    <img src="">
                    <div class="hover-galeria">
                        <p>Gestión de Cuentas</p>
                    </div>
                </div>
                <div class="imagen-port" id="roles">
                    <img src="webapp.png">
                    <div class="hover-galeria">
                        <p>Gestión de Roles</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Función de redirección con JavaScript para manejar las acciones de cada sección
        document.getElementById("asignacion").addEventListener("click", function() {
            window.location.href = "vista/asignacion/asignacion.php"; // Redirige a la página de gestión de usuarios en PHP
        });
        document.getElementById("campañas").addEventListener("click", function() {
            window.location.href = "vista/campaña/campaña.php"; // Redirige a la página de gestión de campañas en PHP
        });
        document.getElementById("turnos").addEventListener("click", function() {
            window.location.href = "vista/turno/turno.php"; // Redirige a la página de gestión de horarios en PHP
        });
        document.getElementById("empleados").addEventListener("click", function() {
            window.location.href = "vista/empleados/empleados.php"; // Redirige a la página de gestión de agentes en PHP
        });
        document.getElementById("controlacceso").addEventListener("click", function() {
            window.location.href = "vista/controlacceso/controlacceso.php"; // Redirige a la página de gestión de agentes en PHP
        });
        document.getElementById("credenciales").addEventListener("click", function() {
            window.location.href = "vista/credenciales/credenciales.php"; // Redirige a la página de gestión de agentes en PHP
        });
        document.getElementById("roles").addEventListener("click", function() {
            window.location.href = "vista/roles/roles.php"; // Redirige a la página de gestión de agentes en PHP
        });
    </script>

</body>

</html>