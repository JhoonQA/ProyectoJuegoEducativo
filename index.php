<?php

  require "code_login.php";

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/styles_login.css" />
</head>
<body>

      <a class="logo-link" href="#" >
          Quiz & Learn++
      </a>
  <main class="login-container">
    <section class="login-box">
      <h2 class="login-title">Iniciar sesión</h2>
      

      <form id="loginForm" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <input type="email" placeholder="Email" required class="form-input" name="email" /> <span class="msg-error" > <?php echo $email_err; ?> </span>
  
          <input type="password" placeholder="Contraseña" required class="form-input" name="password" /> <span class="msg-error" > <?php echo $password_err; ?> </span>
  
  
          <button type="submit" class="form-button">INICIAR</button>
      </form>

      <p class="register-link">
        ¿No tienes cuenta? <a href="register.php">Regístrate</a>
      </p>
      <a href="1_inicio/index.html" class="invitado" >
        <span>Jugar como invitado</span>
      </a>

    </section>
  </main>

  <footer>
    Quiz&Learn - &copy; Copyright 2025
  </footer>
  
</body>
</html>
