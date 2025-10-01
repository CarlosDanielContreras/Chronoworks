<?php
// ============================================
// ARCHIVO: controlador/asignacion/registro_asignacion.php
// ============================================
// NOTA: NO usar session_start() aquí porque ya se inicia en la vista principal

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idtarea"]) && !empty($_POST["idcampaña"]) && !empty($_POST["fechaasignacion"]) && !empty($_POST["observaciones"])) {

        $idtarea = $_POST["idtarea"];
        $idcampania = $_POST["idcampaña"];
        $fechaasignacion = $_POST["fechaasignacion"];
        $observacion = $_POST["observaciones"];

        // CORREGIDO: Usar pg_query_params en lugar de $conexion->query()
        // Nota: cambié 'idcampaña' a 'idcampania' (sin ñ)
        $sql = pg_query_params(
            $conexion, 
            "INSERT INTO asignacion (id_tarea, id_campania, fecha, observaciones) VALUES ($1, $2, $3, $4)",
            array($idtarea, $idcampania, $fechaasignacion, $observacion)
        );

        if ($sql) {
            // Mensaje de éxito
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Asignación registrada correctamente!</div>';
            header("Location: listaasignacion.php");
            exit();
        } else {
            // Mensaje de error
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar la asignación: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaasignacion.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>

<?php
// ============================================
// ARCHIVO: controlador/asignacion/modificar_asignacion.php
// ============================================

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idtarea"]) && !empty($_POST["idcampaña"]) && !empty($_POST["fechaasignacion"]) && !empty($_POST["observaciones"])) {

        $id = $_POST["id"];
        $idtarea = $_POST["idtarea"];
        $idcampania = $_POST["idcampaña"];
        $fechaasignacion = $_POST["fechaasignacion"];
        $observacion = $_POST["observaciones"];

        // CORREGIDO: Usar pg_query_params
        $sql = pg_query_params(
            $conexion,
            "UPDATE asignacion SET id_tarea = $1, id_campania = $2, fecha = $3, observaciones = $4 WHERE id_asignacion = $5",
            array($idtarea, $idcampania, $fechaasignacion, $observacion, $id)
        );

        if ($sql && pg_affected_rows($sql) > 0) {
            // Mensaje de éxito
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Asignación actualizada correctamente!</div>';
            header("Location: listaasignacion.php");
            exit();
        } else {
            // Mensaje de error
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar la asignación: ' . pg_last_error($conexion) . '</div>';
            header("Location: listaasignacion.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>

<?php
// ============================================
// ARCHIVO: controlador/asignacion/eliminar_asignacion.php
// ============================================

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    
    // CORREGIDO: Usar pg_query_params para seguridad
    $sql = pg_query_params(
        $conexion,
        "DELETE FROM asignacion WHERE id_asignacion = $1",
        array($id)
    );

    if ($sql && pg_affected_rows($sql) > 0) {
        // Mensaje de éxito
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Asignación eliminada correctamente!</div>';
        header("Location: listaasignacion.php");
        exit();
    } else {
        // Mensaje de error
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar la asignación: ' . pg_last_error($conexion) . '</div>';
        header("Location: listaasignacion.php");
        exit();
    }
}
?>