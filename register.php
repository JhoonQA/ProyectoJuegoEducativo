<?php
  include 'code_register.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <link rel="stylesheet" href="css/styles_register.css" />
</head>
<body>

      <a class="logo-link" href="index.html" >
          Quiz & Learn++
      </a>

  <main class="login-container">
    <section class="login-box">
      <h2 class="login-title">Registro</h2>

      <form id="registerForm" class="login-form" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post" >
        <input type="text" placeholder="Nombre de usuario" required class="form-input" name="username" />
        <span class="msg-error" ><?php echo $username_err ?></span>

        <input type="email" placeholder="Correo electrónico" required class="form-input" name="email" />
        <span class="msg-error" > <?php echo $email_err ?> </span>

        <input type="password" placeholder="Contraseña" required class="form-input" name="password" />
        <span class="msg-error" > <?php echo $password_err ?> </span>

        <button type="submit" class="form-button">Registrarse</button>
      </form>

      <p class="register-link">
        ¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a>
      </p>
    </section>
  </main>

  <footer>
    Quiz&Learn - &copy; Copyright 2025
  </footer>

</body>
</html>
