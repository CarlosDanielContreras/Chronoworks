<?php
include_once('modelo/Conexion.php');

echo "<h2>🔌 Prueba de Conexión a Supabase</h2>";

if ($conexion) {
    echo "✅ <strong>Conexión exitosa!</strong><br><br>";
    echo "📍 Host: $host<br>";
    echo "📍 Puerto: $port<br>";
    echo "📍 Base de datos: $dbname<br>";
    echo "📍 Usuario: $user<br><br>";
    
    // Probar una consulta
    $result = pg_query($conexion, "SELECT version()");
    if ($result) {
        $row = pg_fetch_row($result);
        echo "🐘 Versión PostgreSQL: <code>" . $row[0] . "</code><br><br>";
    }
    
    // Probar si existen las tablas
    $result = pg_query($conexion, "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
    echo "📊 Tablas en la base de datos:<br>";
    while ($row = pg_fetch_assoc($result)) {
        echo "- " . $row['table_name'] . "<br>";
    }
    
} else {
    echo "❌ <strong>Error en la conexión</strong><br>";
    echo "Error: " . pg_last_error();
}
?>