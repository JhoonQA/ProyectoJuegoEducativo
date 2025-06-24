<?php

class RegistroUsuario {
    private $link;
    public $username = '';
    public $email = '';
    public $password = '';

    public $username_err = '';
    public $email_err = '';
    public $password_err = '';

    public function __construct() {
        $this->conectarBD();
    }

    private function conectarBD() {
        $this->link = mysqli_connect('localhost', 'root', '', 'registros_usuarios');
        if ($this->link === false) {
            die("ERROR: No se pudo conectar. " . mysqli_connect_error());
        }
    }

    public function procesarFormulario($post) {
        // Validar nombre de usuario
        if (empty(trim($post["username"]))) {
            $this->username_err = "Por favor ingrese un nombre de usuario";
        } else {
            $sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
            if ($stmt = mysqli_prepare($this->link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = trim($post["username"]);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $this->username_err = "Este nombre de usuario ya existe";
                    } else {
                        $this->username = $param_username;
                    }
                } else {
                    echo "Ocurrió un error, inténtalo más tarde";
                }
                mysqli_stmt_close($stmt);
            }
        }

        // Validar email
        if (empty(trim($post["email"]))) {
            $this->email_err = "Por favor ingrese un email";
        } else {
            $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
            if ($stmt = mysqli_prepare($this->link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = trim($post["email"]);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $this->email_err = "Este email ya existe";
                    } else {
                        $this->email = $param_email;
                    }
                } else {
                    echo "Ocurrió un error, inténtalo más tarde";
                }
                mysqli_stmt_close($stmt);
            }
        }

        // Validar contraseña
        if (empty(trim($post["password"]))) {
            $this->password_err = "Por favor ingrese una contraseña";
        } elseif (strlen(trim($post["password"])) < 4) {
            $this->password_err = "La contraseña debe tener al menos 4 caracteres";
        } else {
            $this->password = trim($post["password"]);
        }

        // Insertar en la base de datos si no hay errores
        if (empty($this->username_err) && empty($this->email_err) && empty($this->password_err)) {
            $sql = "INSERT INTO usuarios (nombre, email, clave) VALUES (?, ?, ?)";
            if ($stmt = mysqli_prepare($this->link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $this->username, $this->email, $param_password);
                $param_password = password_hash($this->password, PASSWORD_DEFAULT);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Ocurrió un error, inténtalo más tarde";
                }
                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($this->link);
    }
}

// Crear instancia y procesar
$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registro = new RegistroUsuario();
    $registro->procesarFormulario($_POST);

    // Para que los errores y datos puedan ser usados en register.php
    $username = $registro->username;
    $email = $registro->email;
    $password = $registro->password;

    $username_err = $registro->username_err;
    $email_err = $registro->email_err;
    $password_err = $registro->password_err;
}
?>