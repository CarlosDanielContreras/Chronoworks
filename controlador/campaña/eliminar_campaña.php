<?php
// ============================================
// CAMPAÑA - eliminar_campana.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    $query = "DELETE FROM campania WHERE id_campania = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Campaña eliminada correctamente!</div>';
        header("Location: listacampaña.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar campaña: ' . pg_last_error($conexion) . '</div>';
        header("Location: listacampaña.php");
        exit();
    }
}
?>
<?php
// ============================================
// CAMPAÑA - modificar_campana.php
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
        $nombre_campania = $_POST["campaña"];
        $descripcion = $_POST["descripcion"];
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];

        $query = "UPDATE campania SET id_empresa = $1, nombre_campania = $2, descripcion = $3, 
                  fecha_inicio = $4, fecha_fin = $5 WHERE id_campania = $6";
        
        $result = pg_query_params($conexion, $query, 
            array($id_empresa, $nombre_campania, $descripcion, $fecha_inicio, $fecha_fin, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Campaña actualizada correctamente!</div>';
            header("Location: listacampaña.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar campaña</div>';
            header("Location: listacampaña.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>

<?php
// ============================================
// CAMPAÑA - registro_campana.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempresa"]) && !empty($_POST["campaña"]) && 
        !empty($_POST["descripcion"]) && !empty($_POST["fechainicio"]) && 
        !empty($_POST["fechafin"])) {

        $id_empresa = (int)$_POST["idempresa"];
        $nombre_campania = $_POST["campaña"];
        $descripcion = $_POST["descripcion"];
        $fecha_inicio = $_POST["fechainicio"];
        $fecha_fin = $_POST["fechafin"];

        $query = "INSERT INTO campania (id_empresa, nombre_campania, descripcion, fecha_inicio, fecha_fin) 
                  VALUES ($1, $2, $3, $4, $5)";
        
        $result = pg_query_params($conexion, $query, 
            array($id_empresa, $nombre_campania, $descripcion, $fecha_inicio, $fecha_fin));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Campaña registrada correctamente!</div>';
            header("Location: listacampaña.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar campaña: ' . pg_last_error($conexion) . '</div>';
            header("Location: listacampaña.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>
<?php
// ============================================
// CONTROL ACCESO - eliminar_controlacceso.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    $query = "DELETE FROM control_acceso WHERE id_control = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Acceso eliminado correctamente!</div>';
        header("Location: listacontrol.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar acceso</div>';
        header("Location: listacontrol.php");
        exit();
    }
}
?>

<?php
// ============================================
// CONTROL ACCESO - modificar_controlacceso.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && 
        !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && 
        !empty($_POST["observaciones"])) {

        $id = (int)$_POST["id"];
        $idempleado = (int)$_POST['idempleado'];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = $_POST["observaciones"];

        $query = "UPDATE control_acceso SET id_empleado = $1, fecha = $2, hora_entrada = $3, 
                  hora_salida = $4, observacion = $5 WHERE id_control = $6";
        
        $result = pg_query_params($conexion, $query, 
            array($idempleado, $fechaacceso, $horaentrada, $horasalida, $observacion, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Acceso actualizado correctamente!</div>';
            header("Location: listacontrol.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar acceso</div>';
            header("Location: listacontrol.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>
<?php
// ============================================
// CONTROL ACCESO - registro_controlacceso.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["fechaacceso"]) && 
        !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"]) && 
        !empty($_POST["observaciones"])) {

        $idempleado = (int)$_POST["idempleado"];
        $fechaacceso = $_POST["fechaacceso"];
        $horaentrada = $_POST["horaentrada"];
        $horasalida = $_POST["horasalida"];
        $observacion = $_POST["observaciones"];

        $query = "INSERT INTO control_acceso (id_empleado, fecha, hora_entrada, hora_salida, observacion)
                  VALUES ($1, $2, $3, $4, $5)";
        
        $result = pg_query_params($conexion, $query, 
            array($idempleado, $fechaacceso, $horaentrada, $horasalida, $observacion));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Acceso registrado correctamente!</div>';
            header("Location: listacontrol.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar acceso</div>';
            header("Location: listacontrol.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>

<?php
// ============================================
// CREDENCIALES - eliminar_credenciales.php
// ============================================
if (!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    
    $query = "DELETE FROM credenciales WHERE id_credencial = $1";
    $result = pg_query_params($conexion, $query, array($id));
    
    if ($result && pg_affected_rows($result) > 0) {
        $_SESSION['mensaje'] = '<div class="alert-message alert-eliminar">¡Cuenta eliminada correctamente!</div>';
        header("Location: listacredenciales.php");
        exit();
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar cuenta</div>';
        header("Location: listacredenciales.php");
        exit();
    }
}
?>

<?php
// ============================================
// CREDENCIALES - modificar_credenciales.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && 
        !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $id = (int)$_POST["id"];
        $idempleado = (int)$_POST["idempleado"];
        $correo = $_POST["correo"];
        $contrasena = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $id_rol = (int)$_POST["idrol"];

        $query = "UPDATE credenciales SET id_empleado = $1, usuario = $2, contrasena = $3, id_rol = $4 
                  WHERE id_credencial = $5";
        
        $result = pg_query_params($conexion, $query, 
            array($idempleado, $correo, $contrasena, $id_rol, $id));

        if ($result && pg_affected_rows($result) > 0) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-actualizar">¡Cuenta actualizada correctamente!</div>';
            header("Location: listacredenciales.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al actualizar cuenta</div>';
            header("Location: listacredenciales.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>
<?php
// ============================================
// CREDENCIALES - registro_credenciales.php
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnregistrar"]) && $_POST["btnregistrar"] === "ok") {
    if (!empty($_POST["idempleado"]) && !empty($_POST["correo"]) && 
        !empty($_POST["pwd"]) && !empty($_POST["idrol"])) {

        $idempleado = (int)$_POST["idempleado"];
        $correo = $_POST["correo"];
        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        $idrol = (int)$_POST["idrol"];

        $query = "INSERT INTO credenciales (id_empleado, usuario, contrasena, id_rol) 
                  VALUES ($1, $2, $3, $4)";
        
        $result = pg_query_params($conexion, $query, 
            array($idempleado, $correo, $pwd, $idrol));

        if ($result) {
            $_SESSION['mensaje'] = '<div class="alert-message alert-registro">¡Cuenta registrada correctamente!</div>';
            header("Location: listacredenciales.php");
            exit();
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar cuenta</div>';
            header("Location: listacredenciales.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío, por favor diligencie todos los datos.</div>';
    }
}
?>