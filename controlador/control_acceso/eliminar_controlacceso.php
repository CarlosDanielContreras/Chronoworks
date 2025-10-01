<?php
// ============================================
// ARCHIVO: controlador/control_acceso/eliminar_controlacceso.php (MYSQL)
// ============================================

if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ MySQL
    $stmt = mysqli_prepare($conexion, "DELETE FROM control_acceso WHERE ID_Control = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Acceso eliminado correctamente!</div>';
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar</div>';
        }
        
        mysqli_stmt_close($stmt);
    }
    
    header("Location: listacontrol.php");
    exit();
}
?>