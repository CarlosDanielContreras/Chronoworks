<?php
// ============================================
// ARCHIVO: controlador/tarea/registro_tarea.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["ID_Empleado"]) && !empty($_POST["nombre_tarea"]) && 
        !empty($_POST["detalles"])) {

        $id_empleado = (int)$_POST["ID_Empleado"];
        $nombre_tarea = escaparString($_POST["nombre_tarea"]);
        $detalles = escaparString($_POST["detalles"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO tarea (ID_Empleado, nombre_tarea, detalles) VALUES (?, ?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iss", $id_empleado, $nombre_tarea, $detalles);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Tarea registrada correctamente!</div>';
                header("Location: listatarea.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error: ' . mysqli_error($conexion) . '</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>