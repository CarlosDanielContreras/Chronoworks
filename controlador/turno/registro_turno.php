<?php
// ============================================
// ARCHIVO: controlador/turno/registro_turno.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {

        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        
        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO turno (Hora_Entrada, Hora_Salida) VALUES (?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $horaentrada, $horasalida);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Turno registrado correctamente!</div>';
                header("Location: listaturno.php");
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