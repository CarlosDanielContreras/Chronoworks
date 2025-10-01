<?php
// ============================================
// ARCHIVO: controlador/roles/registro_roles.php
// ============================================
// ✅ ELIMINADO session_start()

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"])) {

        $nombre = $_POST["nombre"];

        $query = "INSERT INTO roles (nombre) VALUES ($1)";
        $result = pg_query_params($conexion, $query, array($nombre));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Rol registrado correctamente!</div>';
            header("Location: listaroles.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar rol: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaroles.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">El campo nombre está vacío.</div>';
    }
}
?>