-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 28-11-2013 a las 21:40:57
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `inventario`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asignacion`
-- 

CREATE TABLE `asignacion` (
  `id` int(11) NOT NULL auto_increment,
  `cant_asig` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `equipo_id` int(6) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `asignacion`
-- 

INSERT INTO `asignacion` VALUES (1, 6, '2009-09-20', 1, '15841684');
INSERT INTO `asignacion` VALUES (2, 1, '2009-09-20', 2, '15841684');
INSERT INTO `asignacion` VALUES (3, 1, '2009-09-20', 1, '18348465');
INSERT INTO `asignacion` VALUES (4, 1, '2009-09-20', 3, '18348465');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `categoria`
-- 

CREATE TABLE `categoria` (
  `id` int(6) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Volcar la base de datos para la tabla `categoria`
-- 

INSERT INTO `categoria` VALUES (1, 'PC');
INSERT INTO `categoria` VALUES (2, 'MONITOR');
INSERT INTO `categoria` VALUES (5, 'SWITCH');
INSERT INTO `categoria` VALUES (4, 'RADIO TELECOMUNICACIONES');
INSERT INTO `categoria` VALUES (6, 'IMPRESORA');
INSERT INTO `categoria` VALUES (7, 'SCANER');
INSERT INTO `categoria` VALUES (10, 'FOTOCOPIADORA');
INSERT INTO `categoria` VALUES (11, 'DOKING');
INSERT INTO `categoria` VALUES (12, 'CABLES USB');
INSERT INTO `categoria` VALUES (13, 'TECLADO');
INSERT INTO `categoria` VALUES (14, 'ROUTER');
INSERT INTO `categoria` VALUES (15, 'PENDRIVE');
INSERT INTO `categoria` VALUES (16, 'TARJETA INALAMBRICA');
INSERT INTO `categoria` VALUES (17, 'NOSE');
INSERT INTO `categoria` VALUES (18, 'ROUTER');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `equipo`
-- 

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL auto_increment,
  `serial` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `marcas_id` int(6) NOT NULL,
  `categoria_id` int(6) NOT NULL,
  `estado` enum('DISPONIBLE','ASIGNADO','DAÑADO','REPARACION') NOT NULL,
  `ubicacion_id` int(6) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `serial` (`serial`,`modelo`,`marcas_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `equipo`
-- 

INSERT INTO `equipo` VALUES (1, 'S/N', 'PENDRIVE DE 1GB', 'SONY C35', 10, 15, 'DISPONIBLE', 2);
INSERT INTO `equipo` VALUES (2, '123456', 'PC DE ESCRITORIO', 'EVO', 2, 1, 'ASIGNADO', 2);
INSERT INTO `equipo` VALUES (3, '147', 'EEEE', 'EVO', 1, 2, 'ASIGNADO', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `existencia`
-- 

CREATE TABLE `existencia` (
  `id` int(6) NOT NULL auto_increment,
  `equipo_id` int(11) NOT NULL,
  `cant_total` int(4) NOT NULL,
  `cant_disp` int(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `existencia`
-- 

INSERT INTO `existencia` VALUES (1, 1, 20, 13);
INSERT INTO `existencia` VALUES (2, 2, 1, 0);
INSERT INTO `existencia` VALUES (3, 3, 1, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `factura`
-- 

CREATE TABLE `factura` (
  `id` int(11) NOT NULL auto_increment,
  `equipo_id` int(6) NOT NULL,
  `factura` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `proveedores_id` int(6) NOT NULL,
  `costo` int(12) NOT NULL,
  `cantidad` int(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `factura`
-- 

INSERT INTO `factura` VALUES (1, 1, '', '2009-09-20', 12, 0, 20);
INSERT INTO `factura` VALUES (2, 2, '', '2009-09-20', 12, 0, 1);
INSERT INTO `factura` VALUES (3, 3, '', '2009-09-20', 12, 0, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `gerencia`
-- 

CREATE TABLE `gerencia` (
  `id` int(6) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- 
-- Volcar la base de datos para la tabla `gerencia`
-- 

INSERT INTO `gerencia` VALUES (1, 'PCP');
INSERT INTO `gerencia` VALUES (2, 'FINANZAS');
INSERT INTO `gerencia` VALUES (3, 'AIT');
INSERT INTO `gerencia` VALUES (4, 'OPERACIONES');
INSERT INTO `gerencia` VALUES (5, 'TECNICA');
INSERT INTO `gerencia` VALUES (6, 'RECURSOS HUMANO');
INSERT INTO `gerencia` VALUES (7, 'DESARROLLO SOCIAL');
INSERT INTO `gerencia` VALUES (8, 'SIAHO');
INSERT INTO `gerencia` VALUES (9, 'ASUNTOS PUBLICO');
INSERT INTO `gerencia` VALUES (12, 'LEGAL');
INSERT INTO `gerencia` VALUES (46, 'URRA');
INSERT INTO `gerencia` VALUES (45, 'YA ESTA');
INSERT INTO `gerencia` VALUES (44, 'NOME DOY');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `historico_equipo`
-- 

CREATE TABLE `historico_equipo` (
  `id` int(6) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `observaciones` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `historico_equipo`
-- 

INSERT INTO `historico_equipo` VALUES (1, '2009-09-20', 1, 'REGISTRADO', 'EQUIPO AGREGADO CORRECTAMENTE AL SISTEMA DE TIPO: PENDRIVE MARCA: SONY  MODELO: SONY C35 ( LA CANTIDAD DE: 20)');
INSERT INTO `historico_equipo` VALUES (2, '2009-09-20', 1, 'ASIGNADO', 'EQUIPO ASIGNADO AL USUARIO:IRAN DAVID MEDINA REYES DE TIPO: PENDRIVE MARCA: SONY  MODELO: SONY C35 CANTIDAD: 5');
INSERT INTO `historico_equipo` VALUES (3, '2009-09-20', 1, 'ASIGNADO', 'EQUIPO ASIGNADO AL USUARIO:IRAN DAVID MEDINA REYES DE TIPO: PENDRIVE MARCA: SONY  MODELO: SONY C35 CANTIDAD: 1');
INSERT INTO `historico_equipo` VALUES (4, '2009-09-20', 2, 'REGISTRADO', 'EQUIPO AGREGADO CORRECTAMENTE AL SISTEMA DE TIPO: PC MARCA: COMPAQ  MODELO: EVO ( LA CANTIDAD DE: 1)');
INSERT INTO `historico_equipo` VALUES (5, '2009-09-20', 2, 'ASIGNADO', 'EQUIPO ASIGNADO AL USUARIO:IRAN DAVID MEDINA REYES DE TIPO: PC MARCA: COMPAQ  MODELO: EVO CANTIDAD: 1');
INSERT INTO `historico_equipo` VALUES (6, '2009-09-20', 2, 'AGOTADO', 'EQUIPO AGOTADO EN EXISTENCIA');
INSERT INTO `historico_equipo` VALUES (7, '2009-09-20', 1, 'ASIGNADO', 'EQUIPO ASIGNADO AL USUARIO:JUAN CARLOS  MONTILLA SEGOVIA DE TIPO: PENDRIVE MARCA: SONY  MODELO: SONY C35 CANTIDAD: 1');
INSERT INTO `historico_equipo` VALUES (8, '2009-09-20', 3, 'REGISTRADO', 'EQUIPO AGREGADO CORRECTAMENTE AL SISTEMA DE TIPO: MONITOR MARCA: IBM  MODELO: EVO ( LA CANTIDAD DE: 1)');
INSERT INTO `historico_equipo` VALUES (9, '2009-09-20', 3, 'ASIGNADO', 'EQUIPO ASIGNADO AL USUARIO:JUAN CARLOS  MONTILLA SEGOVIA DE TIPO: MONITOR MARCA: IBM  MODELO: EVO CANTIDAD: 1');
INSERT INTO `historico_equipo` VALUES (10, '2009-09-20', 3, 'AGOTADO', 'EQUIPO AGOTADO EN EXISTENCIA');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `historico_usuario`
-- 

CREATE TABLE `historico_usuario` (
  `id` int(11) NOT NULL auto_increment,
  `historico_equipo_id` int(11) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `historico_usuario`
-- 

INSERT INTO `historico_usuario` VALUES (1, 2, '15841684');
INSERT INTO `historico_usuario` VALUES (2, 3, '15841684');
INSERT INTO `historico_usuario` VALUES (3, 5, '15841684');
INSERT INTO `historico_usuario` VALUES (4, 7, '18348465');
INSERT INTO `historico_usuario` VALUES (5, 9, '18348465');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `marcas`
-- 

CREATE TABLE `marcas` (
  `id` int(6) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Volcar la base de datos para la tabla `marcas`
-- 

INSERT INTO `marcas` VALUES (1, 'IBM');
INSERT INTO `marcas` VALUES (2, 'COMPAQ');
INSERT INTO `marcas` VALUES (3, 'VIT');
INSERT INTO `marcas` VALUES (4, 'HP');
INSERT INTO `marcas` VALUES (9, 'GENIUS');
INSERT INTO `marcas` VALUES (10, 'SONY');
INSERT INTO `marcas` VALUES (11, 'PANASONY');
INSERT INTO `marcas` VALUES (12, 'ELG');
INSERT INTO `marcas` VALUES (13, 'VIT');
INSERT INTO `marcas` VALUES (14, 'NOKIA');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `niveles`
-- 

CREATE TABLE `niveles` (
  `id` int(6) NOT NULL auto_increment,
  `nombre` varchar(255) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `niveles`
-- 

INSERT INTO `niveles` VALUES (1, 'ADMINISTRADOR');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `personal`
-- 

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) collate utf8_spanish_ci NOT NULL,
  `apellido` varchar(35) collate utf8_spanish_ci NOT NULL,
  `login` varchar(30) collate utf8_spanish_ci NOT NULL,
  `clave` varchar(32) collate utf8_spanish_ci NOT NULL,
  `nivel_id` int(6) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- 
-- Volcar la base de datos para la tabla `personal`
-- 

INSERT INTO `personal` VALUES (18348465, 'JUAN', 'MONTILLA', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'ACTIVO');
INSERT INTO `personal` VALUES (16356987, 'CARLOS', 'GARCIAS', 'carlos', '25f9e794323b453885f5181f1b624d0b', 1, 'ACTIVO');
INSERT INTO `personal` VALUES (1, 'marcos', 'torrealba', 'marcos', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'ACTIVO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `personal_datos`
-- 

CREATE TABLE `personal_datos` (
  `personal_id` int(11) NOT NULL,
  `direccion` varchar(255) collate utf8_spanish_ci NOT NULL,
  `tlf_fijo` varchar(11) collate utf8_spanish_ci default NULL,
  `tlf_movil` varchar(11) collate utf8_spanish_ci default NULL,
  `correo` varchar(50) collate utf8_spanish_ci default NULL,
  `foto` varchar(255) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`personal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- 
-- Volcar la base de datos para la tabla `personal_datos`
-- 

INSERT INTO `personal_datos` VALUES (18348465, 'VALERA EDO.TRUJILLO', '02712351719', '04263749578', 'jcms_523@hotmail.com', 'juan.bmp');
INSERT INTO `personal_datos` VALUES (16356987, 'MARACAIBO,AVENIDA 5 DE JULIO', '', '', 'carlos@gmail.com', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `privilegios`
-- 

CREATE TABLE `privilegios` (
  `id` int(6) NOT NULL auto_increment,
  `pagina` varchar(255) collate utf8_spanish_ci NOT NULL,
  `nivel_id` int(6) NOT NULL,
  `acceso` enum('CONCEDER','DENEGAR') collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=47 ;

-- 
-- Volcar la base de datos para la tabla `privilegios`
-- 

INSERT INTO `privilegios` VALUES (1, 'consmod_facilitador.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (2, 'registrar_personal.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (3, 'asignacion_equipo.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (4, 'asignacion_usuario.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (5, 'cambiar_clave.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (6, 'cambiar_clave2.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (7, 'categoria.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (8, 'consmod_equipo.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (9, 'consmod_personal.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (10, 'consmod_proveedores.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (11, 'consmod_usuario.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (12, 'correcto.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (13, 'eliminar_recordatorio.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (14, 'ficha_equipo.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (15, 'ficha_personal.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (16, 'ficha_proveedores.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (17, 'ficha_usuario.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (18, 'gerencia.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (19, 'index.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (20, 'marcas.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (21, 'modificar_equipo.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (22, 'modificar_personal.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (23, 'modificar_proveedores.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (24, 'modificar_usuario.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (25, 'niveles.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (26, 'principal.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (27, 'privilegios.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (28, 'proveedores.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (29, 'registrar_asignacion.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (30, 'registrar_equipo.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (31, 'registrar_proveedores.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (32, 'registrar_recordatorio.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (33, 'registrar_usuarios.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (34, 'retirar_personal.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (35, 'retirar_personal2.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (36, 'retirar_usuario.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (37, 'retirar_usuario2.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (38, 'ubicacion.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (39, 'rp_listado_usuario.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (40, 'consultar_asignacion.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (41, 'usuario_asignados.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (42, 'ventana_ubicacion.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (43, 'ventana_categoria.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (44, 'recordatorio.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (45, 'bitacora.php', 1, 'CONCEDER');
INSERT INTO `privilegios` VALUES (46, 'ventana_marcas.php', 1, 'CONCEDER');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proveedores`
-- 

CREATE TABLE `proveedores` (
  `id` int(6) NOT NULL auto_increment,
  `rif` varchar(30) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `fax` varchar(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `persona_contacto` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

-- 
-- Volcar la base de datos para la tabla `proveedores`
-- 

INSERT INTO `proveedores` VALUES (12, 'J308005452', 'SOLUTIONS SYSTEMS 2526, C.A.', 'MARACAIBO', '02712351719', '02612351720', 's@gmail.com', 'ALFONZO RIVERA');
INSERT INTO `proveedores` VALUES (77, 'J-23232323-3', 'SERVICIOS DE SOPORTE EN VENEZUELA', 'MARACAIBO', '02129074777', '', 'customercarecenter@slb.com', 'HTT://SUPPORT.SLB.COM');
INSERT INTO `proveedores` VALUES (75, 'J-18348465', 'PC SISTEMA', 'VALERA', '', '', '', 'JUAN CARLOS');
INSERT INTO `proveedores` VALUES (76, 'J-1111111111', 'GLOBAL PC', 'VALERA', '', '', '', 'JUAN CARLOS');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `recordatorios_personal`
-- 

CREATE TABLE `recordatorios_personal` (
  `id` int(6) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `estado` enum('PENDIENTE','FINALIZADO') NOT NULL,
  `hora` time NOT NULL,
  `tipo` enum('PUBLICO','PRIVADO') NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Volcar la base de datos para la tabla `recordatorios_personal`
-- 

INSERT INTO `recordatorios_personal` VALUES (11, '2009-08-05', 'Modulo de Incluir en PRUEBA', 18348465, 'FINALIZADO', '16:07:45', 'PRIVADO');
INSERT INTO `recordatorios_personal` VALUES (10, '2009-08-05', 'Modulo de Asignacion de Equipos en PRUEBA....', 18348465, 'PENDIENTE', '16:07:25', 'PUBLICO');
INSERT INTO `recordatorios_personal` VALUES (6, '2009-08-05', 'Modulo de Usuario Login finalizado..............', 18348465, 'PENDIENTE', '15:37:42', 'PUBLICO');
INSERT INTO `recordatorios_personal` VALUES (7, '2009-08-05', 'Modulo de Personal Finalizado.............', 18348465, 'PENDIENTE', '15:38:15', 'PUBLICO');
INSERT INTO `recordatorios_personal` VALUES (8, '2009-08-05', 'Modulo Utilidades Finalizado.......', 18348465, 'PENDIENTE', '15:39:53', 'PUBLICO');
INSERT INTO `recordatorios_personal` VALUES (9, '2009-08-05', 'Modulo de AdminBD finalizado...', 18348465, 'PENDIENTE', '15:40:19', 'PUBLICO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ubicacion`
-- 

CREATE TABLE `ubicacion` (
  `id` int(6) NOT NULL auto_increment,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `ubicacion`
-- 

INSERT INTO `ubicacion` VALUES (1, 'CIUDAD OJEDA');
INSERT INTO `ubicacion` VALUES (2, 'MARACAIBO');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `ubicacion_id` int(6) NOT NULL,
  `gerencia_id` int(6) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL,
  `cedula` varchar(12) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18348476 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (18348468, 'ENMANUEL JOSE', 'QUINTERO CARROZ', 2, 3, '', 'enmanuelquintero@gmail.com', 'ACTIVO', '15981028');
INSERT INTO `usuarios` VALUES (18348467, 'IRAN DAVID', 'MEDINA REYES', 2, 2, '', 'iranmedina82@hotmail.com', 'INACTIVO', '15841684');
INSERT INTO `usuarios` VALUES (18348469, 'JUAN CARLOS ', 'MONTILLA SEGOVIA', 2, 3, 'juan.bmp', 'jcms_523@hotmail.com', 'ACTIVO', '18348465');
INSERT INTO `usuarios` VALUES (18348471, 'JUAN CARLOS', 'MONTILLA SAAVEDRA', 1, 3, '', 'montilla.jc@g.com', 'ACTIVO', '18097726');
INSERT INTO `usuarios` VALUES (18348472, 'GEORGINA', 'MONTILLA', 1, 1, '', 'g@gmail.com', 'ACTIVO', '19609457');
INSERT INTO `usuarios` VALUES (18348473, 'JOHNNY', 'CANCHICA', 2, 3, '', '', 'INACTIVO', '10601456');
INSERT INTO `usuarios` VALUES (18348474, 'GABRIELA', 'BRICEÑO', 1, 1, '', '', 'INACTIVO', '11345876');
INSERT INTO `usuarios` VALUES (18348475, 'MIRIAN', 'ZAMBRANO', 2, 3, '', 'm@mail.com', 'ACTIVO', '17832751');
