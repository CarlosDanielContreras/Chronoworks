<?php
// ============================================
// ARCHIVO: controlador/turno/modificar_turno.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {
        
        $id = (int)$_POST["id"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE turno SET Hora_Entrada=?, Hora_Salida=? WHERE ID_Turno=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $horaentrada, $horasalida, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Turno actualizado correctamente!</div>';
                header("Location: listaturno.php");
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