<?php
session_start();

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempresa"]) && !empty($_POST["campaña"]) && !empty($_POST["descripcion"]) && !empty($_POST["fechainicio"]) && !empty($_POST["fechafin"])) {

        $id_empresa = $_POST["idempresa"];
        $nombre_campaña = $_POST["campaña"];
        $descripcion = $_POST["descripcion"];
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];

        $sql = $conexion->query("INSERT INTO campaña (ID_Empresa, Nombre_Campaña, Descripción, Fecha_Inicio, Fecha_Fin)
                                 VALUES ('$id_empresa', '$nombre_campaña', '$descripcion', '$fecha_inicio', '$fecha_fin')");

        if ($sql == 1) {
            // Mensaje de éxito para la otra vista
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">Campaña registrada correctamente!</div>';
            header("Location: listacampaña.php"); // Redirigir a la otra vista
            exit();
        } else {
            // Mensaje de error para la otra vista
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar la campaña</div>';
            header("Location: listacampaña.php"); // Redirigir a la otra vista
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
