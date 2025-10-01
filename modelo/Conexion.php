<?php
// ============================================
// ARCHIVO: modelo/Conexion.php (VERSIÓN MYSQL FINAL)
// ============================================

if (defined('CONEXION_INCLUIDO')) {
    return;
}
define('CONEXION_INCLUIDO', true);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// CONFIGURACIÓN - AJUSTA ESTOS VALORES
// ============================================
$host = "sql207.infinityfree.com";        // Tu servidor MySQL
$dbname = "if0_40069980_chronoworks";    // Nombre de tu base de datos
$user = "if0_40069980";             // Tu usuario MySQL
$password = "rwfSGA4mto4kl";             // Tu contraseña MySQL
$port = 3306;

// Conectar con mysqli
$conexion = @mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conexion) {
    error_log("❌ Error: " . mysqli_connect_error());
    die("Error: No se pudo conectar a la base de datos.");
}

mysqli_set_charset($conexion, "utf8mb4");
error_log("✅ Conexión a MySQL establecida");

// Funciones auxiliares
if (!function_exists('escaparString')) {
    function escaparString($string) {
        global $conexion;
        return mysqli_real_escape_string($conexion, trim($string));
    }
}

if (!function_exists('cerrarConexion')) {
    function cerrarConexion() {
        global $conexion;
        if ($conexion) {
            mysqli_close($conexion);
        }
    }
}

if (!function_exists('obtenerUltimoId')) {
    function obtenerUltimoId() {
        global $conexion;
        return mysqli_insert_id($conexion);
    }
}
?>