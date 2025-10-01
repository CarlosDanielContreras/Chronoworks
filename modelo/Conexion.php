<?php
// ============================================
// ARCHIVO: modelo/Conexion.php (VERSIÓN CORREGIDA PARA SUPABASE)
// ============================================

// ✅ CRÍTICO: Evitar redeclaraciones múltiples
if (defined('CONEXION_INCLUIDO')) {
    return; // Si ya se incluyó, salir inmediatamente
}
define('CONEXION_INCLUIDO', true);

// ✅ Iniciar sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// CONFIGURACIÓN DE CONEXIÓN A SUPABASE
// ============================================

$host = "aws-1-us-east-2.pooler.supabase.com";
$port = "6543";
$dbname = "postgres";
$user = "postgres.wtqupyxvjmytmebbiazv";
$password = "Cronoworks123456";

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password sslmode=require";

// Conectar con manejo de errores
$conexion = @pg_connect($conn_string);

if (!$conexion) {
    $error = pg_last_error();
    error_log("❌ Error en la conexión a Supabase: " . $error);
    die("Error: No se pudo conectar a la base de datos. Por favor, contacte al administrador.");
}

// Configurar codificación
pg_set_client_encoding($conexion, "UTF8");

// Log de conexión exitosa
error_log("✅ Conexión a Supabase establecida correctamente");

// ============================================
// FUNCIONES AUXILIARES (Protegidas contra redeclaración)
// ============================================

/**
 * Ejecuta una consulta simple (NO recomendado - usar ejecutarQueryPreparada)
 */
if (!function_exists('ejecutarQuery')) {
    function ejecutarQuery($query) {
        global $conexion;
        $result = pg_query($conexion, $query);
        
        if (!$result) {
            error_log("❌ Error en query: " . pg_last_error($conexion));
            error_log("Query: " . $query);
            return false;
        }
        
        return $result;
    }
}

/**
 * Ejecuta una consulta preparada (RECOMENDADO - Seguro contra SQL Injection)
 */
if (!function_exists('ejecutarQueryPreparada')) {
    function ejecutarQueryPreparada($query, $params = array()) {
        global $conexion;
        
        // Usar pg_query_params directamente (más eficiente)
        $result = pg_query_params($conexion, $query, $params);
        
        if (!$result) {
            error_log("❌ Error ejecutando query preparada: " . pg_last_error($conexion));
            error_log("Query: " . $query);
            error_log("Params: " . print_r($params, true));
            return false;
        }
        
        return $result;
    }
}

/**
 * Obtiene un solo resultado como array asociativo
 */
if (!function_exists('obtenerResultado')) {
    function obtenerResultado($result) {
        if ($result && pg_num_rows($result) > 0) {
            return pg_fetch_assoc($result);
        }
        return false;
    }
}

/**
 * Obtiene todos los resultados como array
 */
if (!function_exists('obtenerTodosLosResultados')) {
    function obtenerTodosLosResultados($result) {
        if ($result) {
            return pg_fetch_all($result);
        }
        return array();
    }
}

/**
 * Obtiene el número de filas de un resultado
 */
if (!function_exists('obtenerNumeroFilas')) {
    function obtenerNumeroFilas($result) {
        if ($result) {
            return pg_num_rows($result);
        }
        return 0;
    }
}

/**
 * Obtiene el número de filas afectadas
 */
if (!function_exists('obtenerFilasAfectadas')) {
    function obtenerFilasAfectadas($result) {
        if ($result) {
            return pg_affected_rows($result);
        }
        return 0;
    }
}

/**
 * Escapa una cadena para prevenir SQL Injection
 */
if (!function_exists('escaparString')) {
    function escaparString($string) {
        global $conexion;
        return pg_escape_string($conexion, trim($string));
    }
}

/**
 * Cierra la conexión a la base de datos
 */
if (!function_exists('cerrarConexion')) {
    function cerrarConexion() {
        global $conexion;
        if ($conexion) {
            pg_close($conexion);
            error_log("🔒 Conexión a Supabase cerrada");
        }
    }
}

// ============================================
// WRAPPER PARA COMPATIBILIDAD (Opcional)
// ============================================

if (!class_exists('ConexionWrapper')) {
    class ConexionWrapper {
        private $conexion;
        
        public function __construct($conn) {
            $this->conexion = $conn;
        }
        
        /**
         * Simula mysqli->query() 
         * ⚠️ ADVERTENCIA: No usar directamente - migrar a pg_query_params
         */
        public function query($sql) {
            error_log("⚠️ Advertencia: usando query() sin preparar en línea " . 
                     debug_backtrace()[0]['line'] . 
                     ". Migrar a pg_query_params");
            return pg_query($this->conexion, $sql);
        }
        
        /**
         * Obtiene el último error
         */
        public function getLastError() {
            return pg_last_error($this->conexion);
        }
    }
}

$conexion_wrapper = new ConexionWrapper($conexion);

// ============================================
// FUNCIONES DE UTILIDAD ADICIONALES
// ============================================

/**
 * Inicia una transacción
 */
if (!function_exists('iniciarTransaccion')) {
    function iniciarTransaccion() {
        global $conexion;
        return pg_query($conexion, "BEGIN");
    }
}

/**
 * Confirma una transacción
 */
if (!function_exists('confirmarTransaccion')) {
    function confirmarTransaccion() {
        global $conexion;
        return pg_query($conexion, "COMMIT");
    }
}

/**
 * Revierte una transacción
 */
if (!function_exists('revertirTransaccion')) {
    function revertirTransaccion() {
        global $conexion;
        return pg_query($conexion, "ROLLBACK");
    }
}

/**
 * Verifica si una tabla existe
 */
if (!function_exists('tablaExiste')) {
    function tablaExiste($nombre_tabla) {
        global $conexion;
        $query = "SELECT EXISTS (
                    SELECT FROM information_schema.tables 
                    WHERE table_schema = 'public' 
                    AND table_name = $1
                  )";
        $result = pg_query_params($conexion, $query, array($nombre_tabla));
        
        if ($result) {
            $row = pg_fetch_row($result);
            return $row[0] === 't';
        }
        return false;
    }
}

/**
 * Obtiene el último ID insertado (para tablas con SERIAL)
 */
if (!function_exists('obtenerUltimoId')) {
    function obtenerUltimoId($nombre_tabla, $columna_id) {
        global $conexion;
        $query = "SELECT currval(pg_get_serial_sequence($1, $2))";
        $result = pg_query_params($conexion, $query, array($nombre_tabla, $columna_id));
        
        if ($result) {
            $row = pg_fetch_row($result);
            return $row[0];
        }
        return false;
    }
}

// ============================================
// REGISTRO DE CONEXIÓN
// ============================================
error_log("📊 Conexión a Supabase lista - Base de datos: $dbname");
?>