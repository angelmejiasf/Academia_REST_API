-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 17:52:41
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academias`
--

CREATE TABLE `academias` (
  `idacademia` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `academias`
--

INSERT INTO `academias` (`idacademia`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'Academia Los Álamos', 'C/Avd Madrid 15, Talavera de la Reina', '654003535'),
(2, 'Estudios S.A.', 'C/Albufera 32, Talavera de la Reina', '6390009988'),
(3, 'Academia Armas', 'C/La Fragua 32, Talavera de la Reina', '675339900'),
(4, 'Primeros Pasos', 'C/Ocaña 10, Toledo', '935990088'),
(5, 'Academia Central', 'C/Gran Vía 45, Madrid', '690123456'),
(6, 'Academia del Sur', 'C/Andalucía 22, Sevilla', '691234567'),
(7, 'Academia del Norte', 'C/Santander 5, Bilbao', '692345678'),
(8, 'Academia Este', 'C/Valencia 10, Barcelona', '693456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoscursos`
--

CREATE TABLE `alumnoscursos` (
  `idalumno` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `idcurso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnoscursos`
--

INSERT INTO `alumnoscursos` (`idalumno`, `nombre`, `email`, `idcurso`) VALUES
(1, 'Ana Pérez', 'ana.perez@gmail.com', 1),
(2, 'Carlos Ruiz', 'carlos.ruiz@gmail.com', 2),
(3, 'Lucía Gómez', 'lucia.gomez@gmail.com', 3),
(4, 'Pedro Martínez', 'pedro.martinez@gmail.com', 4),
(5, 'María López', 'maria.lopez@gmail.com', 5),
(6, 'Juan García', 'juan.garcia@gmail.com', 6),
(7, 'Marta Sánchez', 'marta.sanchez@gmail.com', 7),
(8, 'David Fernández', 'david.fernandez@gmail.com', 8),
(9, 'Laura Ramírez', 'laura.ramirez@gmail.com', 1),
(10, 'Sergio Torres', 'sergio.torres@gmail.com', 2),
(11, 'Paula Morales', 'paula.morales@gmail.com', 3),
(12, 'Andrés Herrera', 'andres.herrera@gmail.com', 4),
(13, 'Elena Castillo', 'elena.castillo@gmail.com', 5),
(14, 'Jorge Martín', 'jorge.martin@gmail.com', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `fechacreacion` date DEFAULT NULL,
  `idacademia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idcurso`, `nombre`, `fechacreacion`, `idacademia`) VALUES
(1, 'Eso1 Tecno1', '2020-03-10', 1),
(2, 'Eso2 Tecno2', '2020-03-11', 1),
(3, 'Bases de datos I', '2020-03-10', 2),
(4, 'Acceso a datos II', '2020-03-14', 2),
(5, 'Redes locales I', '2020-03-10', 3),
(6, 'Servicios II', '2020-03-11', 3),
(7, 'Eso4 Mates4', '2020-03-10', 4),
(8, 'Bases de datos. Modelo Relacional', '2020-03-10', 4),
(9, 'Programación en Python', '2024-01-01', 5),
(10, 'Desarrollo Web con JavaScript', '2024-01-02', 5),
(11, 'Ciberseguridad Básica', '2024-01-03', 6),
(12, 'Introducción a la Inteligencia Arti', '2024-01-04', 6),
(13, 'Gestión de Proyectos', '2024-02-01', 7),
(14, 'Marketing Digital', '2024-02-02', 7),
(15, 'Analítica de Datos', '2024-02-03', 8),
(16, 'Desarrollo de Apps Móviles', '2024-02-04', 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academias`
--
ALTER TABLE `academias`
  ADD PRIMARY KEY (`idacademia`);

--
-- Indices de la tabla `alumnoscursos`
--
ALTER TABLE `alumnoscursos`
  ADD PRIMARY KEY (`idalumno`),
  ADD UNIQUE KEY `email` (`email`,`idcurso`),
  ADD KEY `fkalumcurso` (`idcurso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `fkcursoacademia` (`idacademia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academias`
--
ALTER TABLE `academias`
  MODIFY `idacademia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `alumnoscursos`
--
ALTER TABLE `alumnoscursos`
  MODIFY `idalumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnoscursos`
--
ALTER TABLE `alumnoscursos`
  ADD CONSTRAINT `fkalumcurso` FOREIGN KEY (`idcurso`) REFERENCES `cursos` (`idcurso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fkcursoacademia` FOREIGN KEY (`idacademia`) REFERENCES `academias` (`idacademia`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
