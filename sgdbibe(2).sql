-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-12-2021 a las 07:59:17
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgdbibe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE `Alumnos` (
  `Matricula` varchar(30) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Contraseña` varchar(32) NOT NULL,
  `Carrera` varchar(60) NOT NULL,
  `Grado` varchar(10) NOT NULL,
  `Grupo` varchar(10) NOT NULL,
  `Becado` int(2) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `Cuatrimestre` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `AlumnosBecados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `AlumnosBecados` (
`Matricula` varchar(30)
,`Nombre` varchar(20)
,`Apellidos` varchar(50)
,`Cuatrimestre` varchar(50)
,`Carrera` varchar(60)
,`Grado` varchar(10)
,`Grupo` varchar(10)
,`Beca` varchar(30)
,`IdBeca` int(11)
,`estado` varchar(25)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Becas`
--

CREATE TABLE `Becas` (
  `ID_beca` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `ID_Tipo` int(11) NOT NULL,
  `IMG_portado` varchar(300) NOT NULL,
  `fecha_de_inicio` varchar(50) NOT NULL,
  `Fecha_De_Expiracion` varchar(50) NOT NULL,
  `estado` varchar(25) NOT NULL,
  `Link` varchar(500) NOT NULL,
  `cuatrimestre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Becas_Requisistos`
--

CREATE TABLE `Becas_Requisistos` (
  `ID_requisito` int(11) NOT NULL,
  `ID_beca` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado`
--

CREATE TABLE `Estado` (
  `ID_estado` int(11) NOT NULL,
  `Valor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Estado`
--

INSERT INTO `Estado` (`ID_estado`, `Valor`) VALUES
(1, 'Aceptado'),
(2, 'En espera'),
(3, 'Denegada'),
(4, 'Cancelada'),
(5, 'Revisada');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `requisitosByNombre`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `requisitosByNombre` (
`ID_ruta` int(11)
,`Ruta` varchar(250)
,`ID_solicitud` varchar(30)
,`Nombre` varchar(30)
,`ID_requisito` int(11)
,`ID_beca` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `ID_rol` varchar(30) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(150) NOT NULL,
  `permisos` varchar(20) NOT NULL,
  `codigoDePermisos` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`ID_rol`, `Nombre`, `Descripcion`, `permisos`, `codigoDePermisos`) VALUES
('Rol_UTSEM_175026', 'Administradorr', 'Este es el super roles', '1234', 'Solicitudes,Alumnos Becados,Usuarios,Becas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rutas_archivos`
--

CREATE TABLE `Rutas_archivos` (
  `ID_ruta` int(11) NOT NULL,
  `ID_solicitud` varchar(30) NOT NULL,
  `Ruta` varchar(250) NOT NULL,
  `ID_requisito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Solicitudes`
--

CREATE TABLE `Solicitudes` (
  `ID_solicitud` varchar(30) NOT NULL,
  `Matricula` varchar(30) NOT NULL,
  `ID_beca` int(11) NOT NULL,
  `ID_estado` int(11) NOT NULL,
  `Comentarios` varchar(2500) NOT NULL,
  `fecha_de_solicitud` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `solicitudesV`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `solicitudesV` (
`NombreAlumno` varchar(20)
,`Apellidos` varchar(50)
,`Grado` varchar(10)
,`Grupo` varchar(10)
,`Carrera` varchar(60)
,`Cuatrimestre` varchar(50)
,`Email` varchar(150)
,`ID_solicitud` varchar(30)
,`Matricula` varchar(30)
,`ID_beca` int(11)
,`ID_estado` int(11)
,`Comentarios` varchar(2500)
,`fecha_de_solicitud` date
,`Nombre` varchar(30)
,`IMG_portado` varchar(300)
,`Fecha_De_Expiracion` varchar(50)
,`Valor` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo_de_becas`
--

CREATE TABLE `Tipo_de_becas` (
  `ID_Tipo` int(11) NOT NULL,
  `Tipo_de_beca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `ID_usuario` varchar(20) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Cargo` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `ID_rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`ID_usuario`, `Nombre`, `Apellidos`, `Cargo`, `Email`, `Password`, `Nivel`, `ID_rol`) VALUES
('1', 'chay3', 'w12', '12345', 'isaacchay3@gmail.com', '123', 0, 'Rol_UTSEM_175026');

-- --------------------------------------------------------

--
-- Estructura para la vista `AlumnosBecados`
--
DROP TABLE IF EXISTS `AlumnosBecados`;

CREATE VIEW `AlumnosBecados`  AS SELECT `Alumnos`.`Matricula` AS `Matricula`, `Alumnos`.`Nombre` AS `Nombre`, `Alumnos`.`Apellidos` AS `Apellidos`, `Alumnos`.`Cuatrimestre` AS `Cuatrimestre`, `Alumnos`.`Carrera` AS `Carrera`, `Alumnos`.`Grado` AS `Grado`, `Alumnos`.`Grupo` AS `Grupo`, `Becas`.`Nombre` AS `Beca`, `Becas`.`ID_beca` AS `IdBeca`, `Becas`.`estado` AS `estado` FROM ((`Solicitudes` join `Alumnos` on(`Alumnos`.`Matricula` = `Solicitudes`.`Matricula`)) join `Becas` on(`Becas`.`ID_beca` = `Solicitudes`.`ID_beca`)) WHERE `Solicitudes`.`ID_estado` = 1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `requisitosByNombre`
--
DROP TABLE IF EXISTS `requisitosByNombre`;

CREATE VIEW `requisitosByNombre`  AS SELECT `Rutas_archivos`.`ID_ruta` AS `ID_ruta`, `Rutas_archivos`.`Ruta` AS `Ruta`, `Rutas_archivos`.`ID_solicitud` AS `ID_solicitud`, `Becas_Requisistos`.`Nombre` AS `Nombre`, `Becas_Requisistos`.`ID_requisito` AS `ID_requisito`, `Becas_Requisistos`.`ID_beca` AS `ID_beca` FROM (`Rutas_archivos` join `Becas_Requisistos` on(`Rutas_archivos`.`ID_requisito` = `Becas_Requisistos`.`ID_requisito`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `solicitudesV`
--
DROP TABLE IF EXISTS `solicitudesV`;

CREATE VIEW `solicitudesV`  AS SELECT `Alumnos`.`Nombre` AS `NombreAlumno`, `Alumnos`.`Apellidos` AS `Apellidos`, `Alumnos`.`Grado` AS `Grado`, `Alumnos`.`Grupo` AS `Grupo`, `Alumnos`.`Carrera` AS `Carrera`, `Alumnos`.`Cuatrimestre` AS `Cuatrimestre`, `Alumnos`.`Email` AS `Email`, `Solicitudes`.`ID_solicitud` AS `ID_solicitud`, `Solicitudes`.`Matricula` AS `Matricula`, `Solicitudes`.`ID_beca` AS `ID_beca`, `Solicitudes`.`ID_estado` AS `ID_estado`, `Solicitudes`.`Comentarios` AS `Comentarios`, `Solicitudes`.`fecha_de_solicitud` AS `fecha_de_solicitud`, `Becas`.`Nombre` AS `Nombre`, `Becas`.`IMG_portado` AS `IMG_portado`, `Becas`.`Fecha_De_Expiracion` AS `Fecha_De_Expiracion`, `Estado`.`Valor` AS `Valor` FROM (((`Solicitudes` join `Becas` on(`Solicitudes`.`ID_beca` = `Becas`.`ID_beca`)) join `Estado` on(`Solicitudes`.`ID_estado` = `Estado`.`ID_estado`)) join `Alumnos` on(`Alumnos`.`Matricula` = `Solicitudes`.`Matricula`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  ADD PRIMARY KEY (`Matricula`);

--
-- Indices de la tabla `Becas`
--
ALTER TABLE `Becas`
  ADD PRIMARY KEY (`ID_beca`),
  ADD KEY `ID_Tipo` (`ID_Tipo`);

--
-- Indices de la tabla `Becas_Requisistos`
--
ALTER TABLE `Becas_Requisistos`
  ADD PRIMARY KEY (`ID_requisito`),
  ADD KEY `ID_beca` (`ID_beca`);

--
-- Indices de la tabla `Estado`
--
ALTER TABLE `Estado`
  ADD PRIMARY KEY (`ID_estado`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`ID_rol`);

--
-- Indices de la tabla `Rutas_archivos`
--
ALTER TABLE `Rutas_archivos`
  ADD PRIMARY KEY (`ID_ruta`),
  ADD KEY `ID_solicitud` (`ID_solicitud`);

--
-- Indices de la tabla `Solicitudes`
--
ALTER TABLE `Solicitudes`
  ADD PRIMARY KEY (`ID_solicitud`),
  ADD KEY `Matricula` (`Matricula`,`ID_beca`,`ID_estado`),
  ADD KEY `ID_estado` (`ID_estado`),
  ADD KEY `ID_beca` (`ID_beca`);

--
-- Indices de la tabla `Tipo_de_becas`
--
ALTER TABLE `Tipo_de_becas`
  ADD PRIMARY KEY (`ID_Tipo`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`ID_usuario`),
  ADD KEY `ID_rol` (`ID_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Becas`
--
ALTER TABLE `Becas`
  MODIFY `ID_beca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12312313;

--
-- AUTO_INCREMENT de la tabla `Becas_Requisistos`
--
ALTER TABLE `Becas_Requisistos`
  MODIFY `ID_requisito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `Estado`
--
ALTER TABLE `Estado`
  MODIFY `ID_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Rutas_archivos`
--
ALTER TABLE `Rutas_archivos`
  MODIFY `ID_ruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipo_de_becas`
--
ALTER TABLE `Tipo_de_becas`
  MODIFY `ID_Tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142587;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Becas`
--
ALTER TABLE `Becas`
  ADD CONSTRAINT `Becas_ibfk_1` FOREIGN KEY (`ID_Tipo`) REFERENCES `Tipo_de_becas` (`ID_Tipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Becas_Requisistos`
--
ALTER TABLE `Becas_Requisistos`
  ADD CONSTRAINT `Becas_Requisistos_ibfk_1` FOREIGN KEY (`ID_beca`) REFERENCES `Becas` (`ID_beca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Rutas_archivos`
--
ALTER TABLE `Rutas_archivos`
  ADD CONSTRAINT `Rutas_archivos_ibfk_1` FOREIGN KEY (`ID_solicitud`) REFERENCES `Solicitudes` (`ID_solicitud`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Solicitudes`
--
ALTER TABLE `Solicitudes`
  ADD CONSTRAINT `Solicitudes_ibfk_1` FOREIGN KEY (`Matricula`) REFERENCES `Alumnos` (`Matricula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Solicitudes_ibfk_3` FOREIGN KEY (`ID_estado`) REFERENCES `Estado` (`ID_estado`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
