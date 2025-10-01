<?php
// ============================================
// ARCHIVO: controlador/roles/registro_roles.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"])) {

        $nombre = escaparString($_POST["nombre"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion, "INSERT INTO roles (nombre) VALUES (?)");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $nombre);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Rol registrado correctamente!</div>';
                header("Location: listaroles.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error: ' . mysqli_error($conexion) . '</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">El campo nombre es obligatorio</div>';
    }
}
?>