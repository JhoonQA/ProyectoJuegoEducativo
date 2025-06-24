-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-06-2025 a las 13:28:19
-- Versión del servidor: 8.4.3
-- Versión de PHP: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registros_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(27) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(33) COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `clave`) VALUES
(1, 'JhooN_7', 'jhonaklz7@gmail.com', '$2y$10$aecWsEW/lKsI.ytKDHv5.OvEB4aJnFoqbt5pU0.xqo8hhA2e16572'),
(4, 'Juan', 'juan@gmail.com', '$2y$10$I9H39dK/typUnAfxzvw54eRDxj.UgKkC8ianeLjgWsxAcRAIgdfRy'),
(5, 'Jhon Einer', 'jhonquispeapaza7@gmail.com', '$2y$10$84gSnwfv.1gujBTq4kjPP.JePwcFW2gEU3A2r5GB62RzPHqXowAf.'),
(6, 'Admin', 'admin@gmail.com', '$2y$10$2WFrKl8NaL.X7lFtuJYFxu1QBdgM2XKpPGeijznkJGX/NhENF1zdO'),
(7, 'Carlos Daniel', 'carlos@gmail.com', '$2y$10$KvWApUN5Mc5RVJgmpG.3zO9MZMvwJusjR8f6QyEms1ed5ohEcCVMC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
