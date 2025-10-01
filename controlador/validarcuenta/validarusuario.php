<?php
include_once(__DIR__ . '/../../modelo/Conexion.php');
$tipoerror = "";
$error_message = "";

if (!empty($_POST["btniniciarsesion"]) && $_POST["btniniciarsesion"] === "ok") {
    if (!empty($_POST['correo']) && !empty($_POST['contraseña'])) {

        $correo = escaparString($_POST['correo']);
        $contraseña = $_POST['contraseña'];

        // CORREGIDO: Usar nombres de columnas en minúsculas
        $query = "SELECT usuario, contrasena, id_rol, id_empleado FROM credenciales WHERE usuario = $1";
        
        $result = ejecutarQueryPreparada($query, array($correo));

        if ($result && pg_num_rows($result) > 0) {
            $row = obtenerResultado($result);
            $pwd = $row['contrasena'];
            $idrol = $row['id_rol'];
            $idEmpleado = $row['id_empleado'];

            // Validar contraseña
            if ($contraseña === $pwd) {
                // Consulta para obtener el nombre del empleado
                $queryEmpleado = "SELECT nombre FROM empleados WHERE id_empleado = $1";
                $resultEmpleado = ejecutarQueryPreparada($queryEmpleado, array($idEmpleado));

                if ($resultEmpleado && pg_num_rows($resultEmpleado) > 0) {
                    $empleado = obtenerResultado($resultEmpleado);
                    $nombreEmpleado = $empleado['nombre'];

                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario'] = $correo;
                    $_SESSION['id_rol'] = $idrol;
                    $_SESSION['id_empleado'] = $idEmpleado;
                    $_SESSION['nombre_empleado'] = $nombreEmpleado;

                    // Redirigir según el rol
                    switch ($idrol) {
                        case 1:
                            header("Location: ../../admin.php");
                            break;
                        case 2:
                            header("Location: ../../lider.php");
                            break;
                        case 3:
                            header("Location: ../../agente.php");
                            break;
                        default:
                            $error_message = "Rol no reconocido.";
                            $tipoerror = "danger";
                            break;
                    }
                    exit();
                } else {
                    $error_message = "Empleado no encontrado.";
                    $tipoerror = "danger";
                }
            } else {
                $error_message = "Contraseña incorrecta.";
                $tipoerror = "danger";
            }
        } else {
            $error_message = "Usuario no encontrado.";
            $tipoerror = "secondary";
        }
    } else {
        $error_message = "Alguno de los campos está vacío, por favor diligencie todos los datos.";
        $tipoerror = "warning";
    }
}
?>