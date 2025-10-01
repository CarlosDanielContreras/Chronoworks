<?php
// ============================================
// ARCHIVO: controlador/roles/eliminar_roles.php (MYSQL)
// ============================================

if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ MySQL
    $stmt = mysqli_prepare($conexion, "DELETE FROM roles WHERE ID_Rol = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Rol eliminado correctamente!</div>';
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar</div>';
        }
        
        mysqli_stmt_close($stmt);
    }
    
    header("Location: listaroles.php");
    exit();
}
?>