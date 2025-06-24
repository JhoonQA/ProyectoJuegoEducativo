<?php

session_start();

// Redirigir si ya hay sesión activa
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index_menu.php");
    exit;
}

class LoginUsuario {
    private $link;
    private $email;
    private $password;

    public $email_err = '';
    public $password_err = '';

    public function __construct() {
        $this->conectarBD();
    }

    private function conectarBD() {
        $this->link = mysqli_connect("localhost", "root", "", "registros_usuarios");
        if ($this->link === false) {
            die("ERROR: No se pudo conectar. " . mysqli_connect_error());
        }
    }

    public function procesarFormulario($post) {
        // Validar email
        if (empty(trim($post["email"]))) {
            $this->email_err = "Por favor ingrese su correo electrónico";
        } else {
            $this->email = trim($post["email"]);
        }

        // Validar contraseña
        if (empty(trim($post["password"]))) {
            $this->password_err = "Por favor ingrese una contraseña";
        } else {
            $this->password = trim($post["password"]);
        }

        // Verificar credenciales
        if (empty($this->email_err) && empty($this->password_err)) {
            $sql = "SELECT id_usuario, nombre, email, clave FROM usuarios WHERE email = ?";
            if ($stmt = mysqli_prepare($this->link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = $this->email;

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id_usuario, $nombre, $email, $hashed_password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($this->password, $hashed_password)) {
                                // Iniciar sesión
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id_usuario"] = $id_usuario;
                                $_SESSION["email"] = $email;

                                header("location: index_menu.php");
                                exit;
                            } else {
                                $this->password_err = "La contraseña introducida no es válida";
                            }
                        }
                    } else {
                        $this->email_err = "No se encontró ninguna cuenta con ese correo electrónico";
                    }
                } else {
                    echo "Algo salió mal, inténtalo más tarde.";
                }
                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($this->link);
    }
}

// Variables para el formulario HTML
$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = new LoginUsuario();
    $login->procesarFormulario($_POST);

    // Exponer errores para la vista
    $email_err = $login->email_err;
    $password_err = $login->password_err;
}
?>
