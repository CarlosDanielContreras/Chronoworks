<?php
// ============================================
// ARCHIVO 1: controlador/campaña/modificar_campaña.php (CON DEPURACIÓN)
// ============================================

// Verificar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    
    // DEPURACIÓN: Ver qué datos llegan
    error_log("=== INICIO MODIFICAR CAMPAÑA ===");
    error_log("POST recibido: " . print_r($_POST, true));
    
    // Validar que todos los campos existan
    $campos_requeridos = ["id", "idempresa", "campaña", "descripcion", "fechainicio", "fechafin"];
    $campos_faltantes = [];
    
    foreach ($campos_requeridos as $campo) {
        if (empty($_POST[$campo])) {
            $campos_faltantes[] = $campo;
        }
    }
    
    if (!empty($campos_faltantes)) {
        error_log("Campos faltantes: " . implode(", ", $campos_faltantes));
        $_SESSION['mensaje'] = '<div class="alert alert-warning">Campos faltantes: ' . implode(", ", $campos_faltantes) . '</div>';
        header("Location: modificarCampaña.php?id=" . ($_POST['id'] ?? ''));
        exit();
    }
    
    // Limpiar y validar datos
    $id = (int)$_POST["id"];
    $id_empresa = (int)$_POST["idempresa"];
    $nombre_campania = trim($_POST["campaña"]);
    $descripcion = trim($_POST["descripcion"]);
    $fecha_inicio = $_POST["fechainicio"];
    $fecha_fin = $_POST["fechafin"];
    
    error_log("ID: $id");
    error_log("ID Empresa: $id_empresa");
    error_log("Nombre: $nombre_campania");
    error_log("Descripción: $descripcion");
    error_log("Fecha inicio: $fecha_inicio");
    error_log("Fecha fin: $fecha_fin");
    
    // Validar que fecha fin sea mayor que fecha inicio
    if (strtotime($fecha_fin) < strtotime($fecha_inicio)) {
        error_log("Error: Fecha fin menor que fecha inicio");
        $_SESSION['mensaje'] = '<div class="alert alert-warning">La fecha fin debe ser posterior a la fecha inicio</div>';
        header("Location: modificarCampaña.php?id=" . $id);
        exit();
    }
    
    // Verificar que la campaña existe
    $check_query = "SELECT id_campania FROM campania WHERE id_campania = $1";
    $check_result = pg_query_params($conexion, $check_query, array($id));
    
    if (!$check_result || pg_num_rows($check_result) == 0) {
        error_log("Error: Campaña con ID $id no existe");
        $_SESSION['mensaje'] = '<div class="alert alert-danger">La campaña no existe</div>';
        header("Location: listacampaña.php");
        exit();
    }
    
    // Preparar consulta de actualización
    $query = "UPDATE campania 
              SET id_empresa = $1, 
                  nombre_campania = $2, 
                  descripcion = $3, 
                  fecha_inicio = $4, 
                  fecha_fin = $5 
              WHERE id_campania = $6";
    
    error_log("Query: $query");
    error_log("Parámetros: [" . implode(", ", [$id_empresa, $nombre_campania, $descripcion, $fecha_inicio, $fecha_fin, $id]) . "]");
    
    // Ejecutar actualización
    $result = pg_query_params($conexion, $query, 
        array($id_empresa, $nombre_campania, $descripcion, $fecha_inicio, $fecha_fin, $id));
    
    if ($result) {
        $affected = pg_affected_rows($result);
        error_log("Filas afectadas: $affected");
        
        if ($affected > 0) {
            error_log("✅ Actualización exitosa");
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Campaña actualizada correctamente!</div>';
            header("Location: listacampaña.php");
            exit();
        } else {
            error_log("⚠️ No se actualizó ninguna fila");
            $_SESSION['mensaje'] = '<div class="alert alert-warning">No se realizaron cambios</div>';
            header("Location: modificarCampaña.php?id=" . $id);
            exit();
        }
    } else {
        $error = pg_last_error($conexion);
        error_log("❌ Error en query: $error");
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar: ' . htmlspecialchars($error) . '</div>';
        header("Location: modificarCampaña.php?id=" . $id);
        exit();
    }
}
?>

