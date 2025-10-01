<?php
// ============================================
// ARCHIVO: controlador/control_acceso/modificar_controlacceso.php (MYSQL)
// ============================================

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && 
        !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && 
        !empty($_POST["observaciones"])) {

        $id = (int)$_POST["id"];
        $idempleado = (int)$_POST['idempleado'];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = escaparString($_POST["observaciones"]);

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE control_acceso SET id_Empleado=?, Fecha=?, Hora_Entrada=?, 
             Hora_Salida=?, Observacion=? WHERE ID_Control=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issssi", $idempleado, $fechaacceso, $horaentrada, 
                                   $horasalida, $observacion, $id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Acceso actualizado correctamente!</div>';
                header("Location: listacontrol.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>