<?php
include_once(__DIR__ . '/../../modelo/Conexion.php');
$tipoerror = "";
if (!empty($_POST["btniniciarsesion"]) && $_POST["btniniciarsesion"] === "ok") {
    if (!empty($_POST['correo']) && !empty($_POST['contraseña'])) {

        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
        $error_message = "";

        // Consultar usuario y rol
        $sql = $conexion->prepare("SELECT Usuario, Contraseña, id_rol, ID_Empleado FROM credenciales WHERE Usuario = ?");
        $sql->bind_param("s", $correo);
        $sql->execute();
        $resultado = $sql->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $pwd = $row['Contraseña'];
            $idrol = $row['id_rol'];
            $idEmpleado = $row['ID_Empleado'];

            // Validar contraseña
            if ($contraseña === $pwd) {
                // Consulta para obtener el nombre del empleado según el ID
                $sqlEmpleado = $conexion->prepare("SELECT Nombre FROM empleados WHERE ID_Empleado = ?");
                $sqlEmpleado->bind_param("i", $idEmpleado);
                $sqlEmpleado->execute();
                $resultadoEmpleado = $sqlEmpleado->get_result();

                if ($resultadoEmpleado->num_rows > 0) {
                    $empleado = $resultadoEmpleado->fetch_assoc();
                    $nombreEmpleado = $empleado['Nombre'];

                    // Iniciar sesión y almacenar información
                    session_start();
                    $_SESSION['usuario'] = $correo; // Guardar correo
                    $_SESSION['id_rol'] = $idrol; // Guardar rol
                    $_SESSION['id_empleado'] = $idEmpleado; // Guardar id del empleado
                    $_SESSION['nombre_empleado'] = $nombreEmpleado; // Guardar nombre del empleado

                    // Redirigir según el rol
                    switch ($idrol) {
                        case 1: // Admin
                            header("Location: ../../admin.php");
                            break;
                        case 2: // Líder
                            header("Location: ../../lider.php");
                            break;
                        case 3: // Agente
                            header("Location: ../../agente.php");
                            break;
                        default:
                            $error_message = "Rol no reconocido.";
                            $tipoerror = "danger";
                            break;
                    }
                    exit();
                } else {
                    // Si no se encuentra el empleado
                    $error_message = "Empleado no encontrado.";
                    $tipoerror = "danger";
                }
            } else {
                // Si la contraseña es incorrecta
                $error_message = "Contraseña incorrecta.";
                $tipoerror = "danger";
            }
        } else {
            // Si el usuario no existe
            $error_message = "Usuario no encontrado.";
            $tipoerror = "secondary";
        }
        $sql->close();
    } else {
        // Si algún campo está vacío
        $error_message = "Alguno de los campos está vacío, por favor diligencie todos los datos.";
        $tipoerror = "warning";
    }
}
?>