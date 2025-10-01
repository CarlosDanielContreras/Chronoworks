<?php
// ============================================
// ARCHIVO: controlador/empleados/eliminar_empleados.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    $query = "DELETE FROM empleados WHERE id_empleado = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Empleado eliminado correctamente!</div>';
        header("Location: listaempleados.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar empleado</div>';
        header("Location: listaempleados.php");
        exit();
    }
}
?>
