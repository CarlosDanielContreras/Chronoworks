<?php
// ============================================
// ARCHIVO: controlador/campaña/registro_campaña.php
// ============================================

// ✅ NO iniciar sesión aquí (ya se inició en la vista)

// ✅ Verificar que existe la conexión
if (!isset($conexion)) {
    die("Error: Variable de conexión no definida");
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    
    // Validar que todos los campos llegaron
    if (!empty($_POST["idempresa"]) && !empty($_POST["campaña"]) && 
        !empty($_POST["descripcion"]) && !empty($_POST["fechainicio"]) && 
        !empty($_POST["fechafin"])) {

        // Limpiar y validar datos
        $id_empresa = (int)$_POST["idempresa"];
        $nombre_campania = trim($_POST["campaña"]);
        $descripcion = trim($_POST["descripcion"]);
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];
        
        // Validaciones básicas
        if ($id_empresa <= 0) {
            echo '<div class="alert alert-danger">Debe seleccionar una empresa válida</div>';
            return;
        }
        
        if (strlen($nombre_campania) < 3) {
            echo '<div class="alert alert-warning">El nombre debe tener al menos 3 caracteres</div>';
            return;
        }
        
        if (strlen($descripcion) < 10) {
            echo '<div class="alert alert-warning">La descripción debe tener al menos 10 caracteres</div>';
            return;
        }
        
        // Validar fechas
        if (strtotime($fecha_fin) <= strtotime($fecha_inicio)) {
            echo '<div class="alert alert-warning">La fecha fin debe ser posterior a la fecha inicio</div>';
            return;
        }
        
        // Verificar que la empresa existe
        $check_empresa = pg_query_params($conexion, 
            "SELECT id_empresa FROM empresa WHERE id_empresa = $1", 
            array($id_empresa));
        
        if (!$check_empresa || pg_num_rows($check_empresa) == 0) {
            echo '<div class="alert alert-danger">La empresa seleccionada no existe</div>';
            return;
        }
        
        // Insertar campaña
        $query = "INSERT INTO campania (id_empresa, nombre_campania, descripcion, fecha_inicio, fecha_fin) 
                  VALUES ($1, $2, $3, $4, $5)";
        
        $result = pg_query_params($conexion, $query, 
            array($id_empresa, $nombre_campania, $descripcion, $fecha_inicio, $fecha_fin));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert alert-success">¡Campaña registrada correctamente!</div>';
            header("Location: listacampaña.php");
            exit();
        } else {
            $error = pg_last_error($conexion);
            echo '<div class="alert alert-danger">Error al registrar campaña: ' . htmlspecialchars($error) . '</div>';
        }
    } else {
        // Identificar campos faltantes
        $faltantes = [];
        if (empty($_POST["idempresa"])) $faltantes[] = "Empresa";
        if (empty($_POST["campaña"])) $faltantes[] = "Nombre";
        if (empty($_POST["descripcion"])) $faltantes[] = "Descripción";
        if (empty($_POST["fechainicio"])) $faltantes[] = "Fecha inicio";
        if (empty($_POST["fechafin"])) $faltantes[] = "Fecha fin";
        
        echo '<div class="alert alert-warning">Campos faltantes: ' . implode(', ', $faltantes) . '</div>';
    }
}
?>