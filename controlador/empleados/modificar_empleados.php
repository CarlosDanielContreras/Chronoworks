<?php
// ============================================
// ARCHIVO: controlador/empleados/modificar_empleados.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && 
        !empty($_POST["email"]) && !empty($_POST["telefono"]) && 
        !empty($_POST["turno"]) && !empty($_POST["fechaingreso"])) {

        $id = (int)$_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["email"];
        $telefono = $_POST["telefono"];
        $fechaingreso = $_POST["fechaingreso"];
        $turno = (int)$_POST["turno"];

        $query = "UPDATE empleados SET nombre = $1, apellido = $2, correo = $3, 
                  telefono = $4, fecha_ingreso = $5, id_turno = $6 
                  WHERE id_empleado = $7";
        
        $result = pg_query_params($conexion, $query, 
            array($nombre, $apellido, $correo, $telefono, $fechaingreso, $turno, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Empleado actualizado correctamente!</div>';
            header("Location: listaempleados.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar empleado</div>';
            header("Location: listaempleados.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>
