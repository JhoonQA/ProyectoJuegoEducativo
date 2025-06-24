<?php
session_start();

class Sesion {
    public function verificarAcceso() {
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            header("location: index.php");
            exit;
        }
    }
}

$sesion = new Sesion();
$sesion->verificarAcceso();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Principal</title>
  <link rel="stylesheet" href="css/styles_menu.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <a class="logo-link" href="#">Quiz & Learn++</a>
  </header>

  <main>
    <section class="menu-box">
      <h2 class="menu-title">MENÚ</h2>
      <div class="menu-options">
        <a href="1_inicio/index.html" class="menu-button">Iniciar juego</a>
        <a href="1_inicio/editor.html" class="menu-button">Crear quiz</a>
        <a href="cerrar_sesion.php" class="close-sesion">Salir</a>
      </div>
    </section>
  </main>

  <footer>
    Quiz&Learn - &copy; Copyright 2025
  </footer>

</body>
</html>
