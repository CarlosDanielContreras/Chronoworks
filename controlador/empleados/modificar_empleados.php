<?php
// ============================================
// ARCHIVO: controlador/empleados/modificar_empleados.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && 
        !empty($_POST["email"]) && !empty($_POST["telefono"]) && 
        !empty($_POST["turno"]) && !empty($_POST["fechaingreso"])) {

        $id = (int)$_POST["id"];
        $nombre = escaparString($_POST["nombre"]);
        $apellido = escaparString($_POST["apellido"]);
        $correo = escaparString($_POST["email"]);
        $telefono = escaparString($_POST["telefono"]);
        $fechaingreso = $_POST["fechaingreso"];
        $turno = (int)$_POST["turno"];

        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE empleados SET Nombre=?, Apellido=?, Correo=?, Telefono=?, 
             Fecha_Ingreso=?, id_turno=? WHERE ID_Empleado=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssii", $nombre, $apellido, $correo, $telefono, 
                                   $fechaingreso, $turno, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Empleado actualizado correctamente!</div>';
                header("Location: listaempleados.php");
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