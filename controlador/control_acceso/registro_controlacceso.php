<?php
// ============================================
// ARCHIVO: controlador/control_acceso/registro_controlacceso.php (MYSQL)
// ============================================

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && 
        !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && 
        !empty($_POST["observaciones"])) {

        $idempleado = (int)$_POST["idempleado"];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = escaparString($_POST["observaciones"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO control_acceso (id_Empleado, Fecha, Hora_Entrada, Hora_Salida, Observacion)
             VALUES (?, ?, ?, ?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issss", $idempleado, $fechaacceso, $horaentrada, $horasalida, $observacion);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Acceso registrado correctamente!</div>';
                header("Location: listacontrol.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>