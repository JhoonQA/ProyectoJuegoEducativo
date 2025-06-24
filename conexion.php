<?php

class Conexion {
    // Atributos privados
    private $host = 'localhost';
    private $usuario = 'root';
    private $clave = '';
    private $base_datos = 'registros_usuarios';
    private $conexion;

    // Método público para obtener conexión
    public function conectar() {
        $this->conexion = new mysqli(
            $this->host,
            $this->usuario,
            $this->clave,
            $this->base_datos
        );

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }
}

?>
