<?php

class Sesion {
    public function cerrarSesion() {
        session_start();
        $_SESSION = array();       // Vacía todas las variables de sesión
        session_destroy();         // Destruye la sesión
        header("location: index.php");
        exit;
    }
}

$sesion = new Sesion();
$sesion->cerrarSesion();
?>
