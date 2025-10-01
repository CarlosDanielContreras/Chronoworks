<?php
session_start(); 

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["idempresa"]) and !empty($_POST["campaña"]) and !empty($_POST["descripcion"]) and !empty($_POST["fechainicio"]) and !empty($_POST["fechafin"])) {

        $id = $_POST["id"];
        $id_empresa = $_POST["idempresa"];
        $nombre_campaña = $_POST["campaña"];
        $descripcion = $_POST["descripcion"];
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];
        $sql = $conexion->query("update campaña set ID_Empresa=$id_empresa, Nombre_Campaña='$nombre_campaña', Descripción='$descripcion', Fecha_Inicio='$fecha_inicio', Fecha_Fin='$fecha_fin' where ID_Campaña=$id ");
        
        
        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Campaña actualizada correctamente!</div>';
            header("Location: listacampaña.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar la campaña</div>';
            header("Location: listacampaña.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
