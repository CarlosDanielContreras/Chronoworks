<?php
// ============================================
// ARCHIVO: controlador/credenciales/eliminar_credenciales.php (MYSQL)
// ============================================

if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    // ✅ MySQL
    $stmt = mysqli_prepare($conexion, "DELETE FROM credenciales WHERE ID_Credencial = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Cuenta eliminada correctamente!</div>';
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar</div>';
        }
        
        mysqli_stmt_close($stmt);
    }
    
    header("Location: listacredenciales.php");
    exit();
}
?>