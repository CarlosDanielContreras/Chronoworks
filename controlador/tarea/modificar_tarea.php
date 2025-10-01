<?php
// ============================================
// ARCHIVO: controlador/tarea/modificar_tarea.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["ID_Empleado"]) && !empty($_POST["nombre_tarea"]) && 
        !empty($_POST["detalles"])) {

        $id = (int)$_POST["id"];
        $id_empleado = (int)$_POST["ID_Empleado"];
        $nombre_tarea = escaparString($_POST["nombre_tarea"]);
        $detalles = escaparString($_POST["detalles"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE tarea SET ID_Empleado=?, nombre_tarea=?, detalles=? WHERE ID_Tarea=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issi", $id_empleado, $nombre_tarea, $detalles, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Tarea actualizada correctamente!</div>';
                header("Location: listatarea.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-warning">No se realizaron cambios</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>