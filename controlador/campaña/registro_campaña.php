<?php
// ============================================
// ARCHIVO: controlador/campaña/registro_campaña.php (MYSQL)
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempresa"]) && !empty($_POST["campaña"]) && 
        !empty($_POST["descripcion"]) && !empty($_POST["fechainicio"]) && 
        !empty($_POST["fechafin"])) {

        $id_empresa = (int)$_POST["idempresa"];
        $nombre_campania = escaparString($_POST["campaña"]);
        $descripcion = escaparString($_POST["descripcion"]);
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];
        
        // Validar fechas
        if (strtotime($fecha_fin) <= strtotime($fecha_inicio)) {
            echo '<div class="alert alert-warning">La fecha fin debe ser posterior a la fecha inicio</div>';
            return;
        }
        
        // ✅ MySQL
        $stmt = mysqli_prepare($conexion, 
            "INSERT INTO campania (ID_Empresa, Nombre_Campania, Descripcion, Fecha_Inicio, Fecha_Fin) 
             VALUES (?, ?, ?, ?, ?)"
        );
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issss", $id_empresa, $nombre_campania, $descripcion, $fecha_inicio, $fecha_fin);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Campaña registrada correctamente!</div>';
                header("Location: listacampaña.php");
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