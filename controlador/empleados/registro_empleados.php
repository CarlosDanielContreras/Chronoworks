<?php
// ============================================
// ARCHIVO: controlador/empleados/registro_empleados.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && 
        !empty($_POST["email"]) && !empty($_POST["telefono"]) && 
        !empty($_POST["turno"]) && !empty($_POST["fechaingreso"])) {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["email"];
        $telefono = $_POST["telefono"];
        $fechaingreso = $_POST["fechaingreso"];
        $turno = (int)$_POST["turno"];

        $query = "INSERT INTO empleados (nombre, apellido, correo, telefono, fecha_ingreso, id_turno)
                  VALUES ($1, $2, $3, $4, $5, $6)";
        
        $result = pg_query_params($conexion, $query, 
            array($nombre, $apellido, $correo, $telefono, $fechaingreso, $turno));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Empleado registrado correctamente!</div>';
            header("Location: listaempleados.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar empleado: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaempleados.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>