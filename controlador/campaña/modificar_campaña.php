<?php
// ============================================
// ARCHIVO: controlador/campaña/modificar_campaña.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempresa"]) && !empty($_POST["campaña"]) && 
        !empty($_POST["descripcion"]) && !empty($_POST["fechainicio"]) && 
        !empty($_POST["fechafin"])) {

        $id = (int)$_POST["id"];
        $id_empresa = (int)$_POST["idempresa"];
        $nombre_campania = escaparString($_POST["campaña"]);
        $descripcion = escaparString($_POST["descripcion"]);
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];
        
        // Validar fechas
        if (strtotime($fecha_fin) <= strtotime($fecha_inicio)) {
            $_SESSION['mensaje'] = '<div class="alert alert-warning">La fecha fin debe ser posterior</div>';
            header("Location: modificarCampaña.php?id=" . $id);
            exit();
        }
        
        // ✅ MySQL
        $stmt = mysqli_prepare($conexion,
            "UPDATE campania SET ID_Empresa=?, Nombre_Campania=?, Descripcion=?, 
             Fecha_Inicio=?, Fecha_Fin=? WHERE ID_Campania=?"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issssi", $id_empresa, $nombre_campania, $descripcion, 
                                   $fecha_inicio, $fecha_fin, $id);
            
            if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Campaña actualizada correctamente!</div>';
                header("Location: listacampaña.php");
                exit();
            } else {
                $_SESSION['mensaje'] = '<div class="alert alert-warning">No se realizaron cambios</div>';
            }
            
            mysqli_stmt_close($stmt);
        }
    }
}
?>