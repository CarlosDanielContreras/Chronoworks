<?php
// NO usar session_start() aquí - la sesión ya está iniciada en la vista principal

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["ID_Empleado"]) && !empty($_POST["nombre_tarea"]) && !empty($_POST["detalles"])) {

        $id_empleado = intval($_POST["ID_Empleado"]);
        $nombre_tarea = pg_escape_string($conexion, $_POST["nombre_tarea"]);
        $detalles = pg_escape_string($conexion, $_POST["detalles"]);

        // Usar pg_query_params para mayor seguridad
        $sql = pg_query_params(
            $conexion, 
            "INSERT INTO tarea (id_empleado, nombre_tarea, detalles) VALUES ($1, $2, $3)",
            array($id_empleado, $nombre_tarea, $detalles)
        );

        if ($sql) {
            // Mensaje de éxito
            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Tarea registrada correctamente!</div>';
            }
            header("Location: listatarea.php");
            exit();
        } else {
            // Mensaje de error
            if (session_status() === PHP_SESSION_ACTIVE) {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar tarea: ' . pg_last_error($conexion) . '</div>';
            }
            header("Location: listatarea.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>