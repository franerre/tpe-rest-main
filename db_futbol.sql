-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2024 a las 15:56:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_futbol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `equipo` varchar(250) NOT NULL,
  `liga` varchar(250) NOT NULL,
  `pais` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `equipo`, `liga`, `pais`, `imagen`) VALUES
(0, 'Manchester City', 'Premier League', 'Inglaterra', 'city.png'),
(1, 'Real Madrid', 'La Liga', 'España', 'real.png'),
(2, 'Inter de Milán ', 'Serie A', 'Italia', 'inter.png'),
(3, 'Napoli', 'Serie A', 'Italia', 'napolii.png'),
(4, 'Atletico Madrid', 'La Liga', 'España', 'atletico.png'),
(5, 'La Roma', 'Serie A', 'Italia', 'roma.png'),
(6, 'Bayern de Múnich', 'Bundesliga', 'Alemania', 'bayern.png'),
(7, 'Liverpool', 'Premier League', 'Inglaterra', 'liverpol.png'),
(8, 'Juventus', 'Serie A', 'Italia', 'juventus.png'),
(9, 'Barcelona', 'LaLiga', 'España', 'barcelona.png'),
(10, 'Manchester United', 'Premier League', 'Inglaterra', 'united.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `imagen_jugador` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre`, `apellido`, `id_equipo`, `imagen_jugador`) VALUES
(1, 'Phil', 'Foden', 0, 'foden.png'),
(2, 'Kevin', 'De Bruyne', 0, 'De Bruyne.png'),
(3, 'Earling', 'Haaland', 0, 'Haaland.png'),
(4, 'Robert ', 'Lewandowski', 9, 'Lewandowski.png'),
(5, 'Ferran ', 'Torres', 9, 'Torres.png'),
(6, 'Ronald ', 'Araujo', 9, 'araujo.png'),
(7, 'Jude ', 'Bellingham', 1, 'Bellingham.png'),
(8, 'Federico ', 'Valverde', 1, 'valverde.png'),
(9, 'Kylian ', 'Mbappé', 1, 'Mbappé.png'),
(10, 'Lautaro', 'Martinez', 2, 'martinez.png'),
(11, 'Hakan ', 'Calhanoglu', 2, 'Calhanoglu.png'),
(12, 'Benjamin ', 'Pavard', 2, 'Pavard.png'),
(13, 'Rafa ', 'Marín', 3, 'Marín.png'),
(14, 'Matteo', 'Politano', 3, 'Politano.png'),
(15, 'Romelu ', 'Lukaku', 3, 'lukaku.png'),
(16, 'Julian', 'Alvarez', 4, 'araña.png'),
(17, 'Rodrigo ', 'De Paul', 4, 'de paul.png'),
(18, 'Antoine ', 'Griezmann', 4, 'Griezmann.png'),
(19, 'Leandro ', 'Paredes', 5, 'paredes.png'),
(20, 'Lorenzo ', 'Pellegrini', 5, 'Pellegrini.png'),
(21, 'Paulo ', 'Dybala', 5, 'Dybala.png'),
(22, 'Harry ', 'Kane', 6, 'kane.png'),
(23, 'Leroy ', 'Sané', 6, 'Sané.png'),
(24, 'Jamal ', 'Musiala', 6, 'Musiala.png'),
(25, 'Luis ', 'Díaz', 7, 'Díaz.png'),
(26, 'Alisson ', 'Becker', 7, 'Becker.png'),
(27, 'Virgil ', 'van Dijk', 7, 'van Dijk.png'),
(28, 'Mattia ', 'Perin', 8, 'Mattia Perin.png'),
(29, 'Paul ', 'Pogba', 8, 'Pogba.png'),
(30, 'Manuel ', 'Locatelli', 8, 'Manuel Locatelli.png'),
(31, 'Bruno ', 'Fernandes', 10, 'fernandes.png'),
(32, 'Marcus ', 'Rashford', 10, 'Marcus Rashford.png'),
(33, 'Alejandro ', 'Garnacho ', 10, 'garnacho.png'),
(153, 'fran', 'Errezarret', 0, 'araña.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(50) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'webadmin', '$2a$12$t9H0dO/9JIks9pUOsUjVbOajSJq9Ww.oajDGfrngRQ6DQbwiJxjaa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
