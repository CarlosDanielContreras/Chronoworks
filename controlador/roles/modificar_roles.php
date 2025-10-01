<?php
// ============================================
// ARCHIVO: controlador/roles/modificar_roles.php (MYSQL)
// ============================================

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"])) {

        $id = (int)$_POST["id"];
        $nombre = escaparString($_POST['nombre']);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion, "UPDATE roles SET nombre = ? WHERE ID_Rol = ?");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $nombre, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Rol actualizado correctamente!</div>';
                header("Location: listaroles.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-warning">No se realizaron cambios</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">El campo nombre es obligatorio</div>';
    }
}
?>