--
-- Estructura de tabla para la tabla `viga_atributo_frecuencia`
--
CREATE TABLE `viga_atributo_frecuencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `puntaje` decimal(10,2) NOT NULL DEFAULT '0.00',
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_atributo_frecuencia`
--

INSERT INTO `viga_atributo_frecuencia` (`id`, `nombre`, `descripcion`, `puntaje`, `visible`, `fecha_creacion`) VALUES
(1, 'Una sola vez', '', '33.00', 1, '2019-05-09 00:29:10'),
(2, 'Temporal', '', '66.00', 1, '2019-05-09 00:29:10'),
(3, 'Permanente', '', '100.00', 1, '2019-05-09 00:29:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_atributo_mecanismo`
--

CREATE TABLE `viga_atributo_mecanismo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `puntaje` decimal(10,2) NOT NULL DEFAULT '0.00',
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_atributo_mecanismo`
--

INSERT INTO `viga_atributo_mecanismo` (`id`, `nombre`, `descripcion`, `puntaje`, `visible`, `fecha_creacion`) VALUES
(1, 'Extensión', '', '35.00', 1, '2019-05-08 20:29:10'),
(2, 'Actividades extracurriculares', '', '40.00', 1, '2019-05-08 20:29:10'),
(3, 'Voluntariado', '', '45.00', 1, '2019-05-08 20:29:10'),
(4, 'Taller', '', '50.00', 1, '2019-05-08 20:29:10'),
(5, 'Curso', '', '55.00', 1, '2019-05-08 20:29:10'),
(6, 'Divulgación', '', '60.00', 1, '2019-09-23 11:58:38'),
(7, 'Capacitación', '', '65.00', 1, '2019-05-08 20:29:10'),
(8, 'Prácticas', '', '70.00', 1, '2019-05-08 20:29:10'),
(9, 'Aprendizaje + Servicio', '', '75.00', 1, '2019-05-08 20:29:10'),
(10, 'Asistencia Técnica', '', '80.00', 1, '2019-05-08 20:29:10'),
(11, 'Asesoría', '', '85.00', 1, '2019-05-08 20:29:10'),
(12, 'Transferencia Tecnológica', '', '100.00', 1, '2019-05-08 20:29:10'),
(13, 'Participación Directorio Publico Privado', '', '95.00', 1, '2019-05-08 20:29:10'),
(14, 'Investigación de impacto', '', '90.00', 1, '2019-05-08 20:29:10'),
(15, 'Convenios y alianzas', '', '0.00', 0, '2021-08-16 11:35:09'),
(16, 'Otro', '', '0.00', 1, '2021-08-16 11:35:09');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `viga_atributo_mecanismo_actividad`
--

CREATE TABLE `viga_atributo_mecanismo_actividad` (
  `id` int(11) NOT NULL,
  `id_mecanismo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `viga_carreras`
--

CREATE TABLE `viga_carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(100) NOT NULL DEFAULT '',
  `id_facultad` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_concepto_pertinente`
--

CREATE TABLE `viga_concepto_pertinente` (
  `id` int(11) NOT NULL,
  `id_meta` varchar(100) NOT NULL,
  `concepto` varchar(500) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_concepto_pertinente`
--

INSERT INTO `viga_concepto_pertinente` (`id`, `id_meta`, `concepto`, `fecha_creacion`) VALUES
(1, '1.1', 'Pobreza extrema', '2019-11-28 03:28:21'),
(2, '1.1', 'Hogar de cristo', '2019-11-28 03:28:21'),
(3, '1.1', 'María Ayuda', '2019-11-28 03:28:21'),
(4, '1.1', 'Situación de calle', '2019-11-28 03:28:21'),
(5, '1.1', 'Indigentes', '2019-11-28 03:28:21'),
(6, '1.1', 'Mendigos', '2019-11-28 03:28:21'),
(7, '1.1', 'Mendigar', '2019-11-28 03:28:21'),
(8, '1.2', 'Fundación para la superación de la pobreza', '2019-11-28 03:28:21'),
(9, '1.2', 'fondo esperanza', '2019-11-28 03:28:21'),
(10, '1.2', 'Condiciones de vida', '2019-11-28 03:28:21'),
(11, '1.2', 'Pobreza', '2019-11-28 03:28:21'),
(12, '1.3', 'Protección social', '2019-11-28 03:28:21'),
(13, '1.4', 'Banco Comunal', '2019-11-28 03:28:21'),
(14, '1.4', 'Fundación Techo', '2019-11-28 03:28:21'),
(15, '1.4', 'Derecho a la vivienda', '2019-11-28 03:28:21'),
(16, '1.4', 'Micro financiación', '2019-11-28 03:28:21'),
(17, '1.4', 'Micro financiamiento', '2019-11-28 03:28:21'),
(18, '1.4', 'Derecho al agua', '2019-11-28 03:28:21'),
(19, '1.4', 'Acceso al agua', '2019-11-28 03:28:21'),
(20, '1.4', 'Acceso a la electricidad', '2019-11-28 03:28:21'),
(21, '1.4', 'Acceso a la luz', '2019-11-28 03:28:21'),
(22, '1.4', 'Acceso a energía eléctrica', '2019-11-28 03:28:21'),
(23, '1.5', 'Ropero solidario', '2019-11-28 03:28:21'),
(24, '1.5', 'ropa a indigentes', '2019-11-28 03:28:21'),
(25, '1.5', 'Vestimenta a personas en situación de calle', '2019-11-28 03:28:21'),
(26, '1.5', 'Viviendas de emergencia', '2019-11-28 03:28:21'),
(27, '1.5', 'Reconstrucción viviendas', '2019-11-28 03:28:21'),
(28, '1.5', 'Incendio', '2019-11-28 03:28:21'),
(29, '1.5', 'Salidas de emergencia', '2019-11-28 03:28:21'),
(30, '2.1', 'Acceso a alimentos', '2019-11-28 03:28:21'),
(31, '2.2', 'Proceso de alimentación', '2019-11-28 03:28:21'),
(32, '2.2', 'Lactancia', '2019-11-28 03:28:21'),
(33, '2.2', 'Efecto positivo del consumo de', '2019-11-28 03:28:21'),
(34, '2.2', 'Recomendaciones nutricionales', '2019-11-28 03:28:21'),
(35, '2.2', 'alimentación sana', '2019-11-28 03:28:21'),
(36, '2.2', 'alimentación saludable', '2019-11-28 03:28:21'),
(37, '2.2', 'hábitos saludables en alimentación', '2019-11-28 03:28:21'),
(38, '2.2', 'Malnutrición', '2019-11-28 03:28:21'),
(39, '2.2', 'sobrepeso', '2019-11-28 03:28:21'),
(40, '2.2', 'obesidad', '2019-11-28 03:28:21'),
(41, '2.2', 'Consultoría nutricional', '2019-11-28 03:28:21'),
(42, '2.2', 'colaciones saludables', '2019-11-28 03:28:21'),
(43, '2.2', 'Hábitos alimenticios', '2019-11-28 03:28:21'),
(44, '2.2', 'Mal nutrición', '2019-11-28 03:28:21'),
(45, '2.2', 'Alimentario nutricional', '2019-11-28 03:28:21'),
(46, '2.2', 'estado nutricional', '2019-11-28 03:28:21'),
(47, '2.2', 'conducta alimentaria', '2019-11-28 03:28:21'),
(48, '2.2', 'educación nutricional', '2019-11-28 03:28:21'),
(49, '2.2', 'insumos vegetales', '2019-11-28 03:28:21'),
(50, '2.2', 'preparaciones saludables', '2019-11-28 03:28:21'),
(51, '2.2', 'evaluaciones nutricionales', '2019-11-28 03:28:21'),
(52, '2.2', 'evaluación nutricional', '2019-11-28 03:28:21'),
(53, '2.2', 'Diagnostico nutricional', '2019-11-28 03:28:21'),
(54, '2.2', 'Intervención educativa y nutricional', '2019-11-28 03:28:21'),
(55, '2.2', 'situación nutricional', '2019-11-28 03:28:21'),
(56, '2.2', 'recomendaciones alimentarias', '2019-11-28 03:28:21'),
(57, '2.2', 'alimentos saludables', '2019-11-28 03:28:21'),
(58, '2.2', 'alimentos sanos', '2019-11-28 03:28:21'),
(59, '2.2', 'colaciones sanas', '2019-11-28 03:28:21'),
(60, '2.2', 'consumo de comida chatarra', '2019-11-28 03:28:21'),
(61, '2.2', 'Nutricuentos', '2019-11-28 03:28:21'),
(62, '2.2', 'Alimentación balanceada', '2019-11-28 03:28:21'),
(63, '2.2', 'Nutrición de los escolares', '2019-11-28 03:28:21'),
(64, '2.2', 'Nutrición de escolares', '2019-11-28 03:28:21'),
(65, '2.2', 'Nutrición escolar', '2019-11-28 03:28:21'),
(66, '2.2', 'Necesidades nutricionales', '2019-11-28 03:28:21'),
(67, '2.2', 'feria saludable', '2019-11-28 03:28:21'),
(68, '2.2', 'Ingesta de nutrientes', '2019-11-28 03:28:21'),
(69, '2.2', 'Propiedades nutricionales', '2019-11-28 03:28:21'),
(70, '2.2', 'comida saludable', '2019-11-28 03:28:21'),
(71, '2.3', 'Transferencia tecnológica en los siguientes cultivos', '2019-11-28 03:28:21'),
(72, '2.3', 'Producción agropecuaria', '2019-11-28 03:28:21'),
(73, '2.3', 'Agricultura familiar campesina', '2019-11-28 03:28:21'),
(74, '2.3', 'Cooperativa agrícola', '2019-11-28 03:28:21'),
(75, '2.3', 'Cooperativa campesina', '2019-11-28 03:28:21'),
(76, '2.3', 'Cooperativa agrícola', '2019-11-28 03:28:21'),
(77, '2.3', 'Manejo de frutales caseros', '2019-11-28 03:28:21'),
(78, '2.3', 'Implementación de hierbas medicinales', '2019-11-28 03:28:21'),
(79, '2.3', 'Frutos de mejor calidad', '2019-11-28 03:28:21'),
(80, '2.3', 'Poda', '2019-11-28 03:28:21'),
(81, '2.3', 'Riego', '2019-11-28 03:28:21'),
(82, '2.3', 'Buenas prácticas agrícolas', '2019-11-28 03:28:21'),
(83, '2.3', 'Producción agrícola', '2019-11-28 03:28:21'),
(84, '2.3', 'Huerto orgánico', '2019-11-28 03:28:21'),
(85, '2.3', 'Productos regionales', '2019-11-28 03:28:21'),
(86, '2.3', 'Alimentos cultivados', '2019-11-28 03:28:21'),
(87, '2.3', 'Invernaderos', '2019-11-28 03:28:21'),
(88, '2.3', 'Manejo de cultivos y hortalizas', '2019-11-28 03:28:22'),
(89, '2.3', 'Producción hortícola', '2019-11-28 03:28:22'),
(90, '2.3', 'Prodesal', '2019-11-28 03:28:22'),
(91, '2.3', 'agricultura regional', '2019-11-28 03:28:22'),
(92, '2.3', 'huertas familiares', '2019-11-28 03:28:22'),
(93, '2.3', 'Cultivos', '2019-11-28 03:28:22'),
(94, '2.3', 'Frutales', '2019-11-28 03:28:22'),
(95, '2.4', 'Frutos de mejor calidad', '2019-11-28 03:28:22'),
(96, '2.4', 'Poda', '2019-11-28 03:28:22'),
(97, '2.4', 'Riego', '2019-11-28 03:28:22'),
(98, '2.4', 'Buenas prácticas agrícolas', '2019-11-28 03:28:22'),
(99, '2.4', 'gestión agropecuaria', '2019-11-28 03:28:22'),
(100, '2.4', 'Plaguicidas', '2019-11-28 03:28:22'),
(101, '2.a', 'Transferencia tecnológica en los siguientes cultivos', '2019-11-28 03:28:22'),
(102, '2.a', 'Técnicas para elaboración', '2019-11-28 03:28:22'),
(103, '2.a', 'Tecnologías de manejo', '2019-11-28 03:28:22'),
(104, '2.a', 'Prodesal', '2019-11-28 03:28:22'),
(105, '2.a', 'PDTI', '2019-11-28 03:28:22'),
(106, '2.a', 'Apoyo técnico', '2019-11-28 03:28:22'),
(107, '2.a', 'Visitas', '2019-11-28 03:28:22'),
(108, '2.a', 'Conocimientos y habilidades del área de la producción hortícola', '2019-11-28 03:28:22'),
(109, '2.a', 'Manejo de cultivos y hortaliza', '2019-11-28 03:28:22'),
(110, '2.a', 'Aspectos productivos potencialmente mejorables', '2019-11-28 03:28:22'),
(111, '2.a', 'Seminario agrícola', '2019-11-28 03:28:22'),
(112, '2.a', 'Profesionales del ámbito agrícola', '2019-11-28 03:28:22'),
(113, '2.a', 'Asistencia técnica ganadera', '2019-11-28 03:28:22'),
(114, '2.a', 'competencias relacionadas con la producción ganadera', '2019-11-28 03:28:22'),
(115, '2.c', 'Valor comercial actual de la palta', '2019-11-28 03:28:22'),
(116, '2.c', 'Valor de los alimentos', '2019-11-28 03:28:22'),
(117, '2.c', 'Precio de alimentos', '2019-11-28 03:28:22'),
(118, '2.c', 'valor de la palta', '2019-11-28 03:28:22'),
(119, '3.1', 'Aborto terapéutico', '2019-11-28 03:28:22'),
(120, '3.1', 'Embarazadas portadoras', '2019-11-28 03:28:22'),
(121, '3.2', 'Soporte vital básico pediátrico', '2019-11-28 03:28:22'),
(122, '3.2', 'Técnicas de reanimación básica pediátrica', '2019-11-28 03:28:22'),
(123, '3.3', 'tuberculosis', '2019-11-28 03:28:22'),
(124, '3.3', 'malaria', '2019-11-28 03:28:22'),
(125, '3.3', 'Enfermedades de transmisión sexual', '2019-11-28 03:28:22'),
(126, '3.3', 'VIH', '2019-11-28 03:28:22'),
(127, '3.3', 'Sistema inmunológico', '2019-11-28 03:28:22'),
(128, '3.3', 'Enfermedades Transmisibles', '2019-11-28 03:28:22'),
(129, '3.3', 'Educación sexual', '2019-11-28 03:28:22'),
(130, '3.3', 'Mosquitos', '2019-11-28 03:28:22'),
(131, '3.3', 'Zika', '2019-11-28 03:28:22'),
(132, '3.3', 'Fiebre amarilla', '2019-11-28 03:28:22'),
(133, '3.3', 'Dengue', '2019-11-28 03:28:22'),
(134, '3.3', 'Anticonceptivos', '2019-11-28 03:28:22'),
(135, '3.3', 'Sexualidad responsable', '2019-11-28 03:28:22'),
(136, '3.3', 'Enfermedades infectocontagiosas', '2019-11-28 03:28:22'),
(137, '3.3', 'Infecciones de transmisión sexual', '2019-11-28 03:28:22'),
(138, '3.3', 'Sida', '2019-11-28 03:28:22'),
(139, '3.3', 'Preservativo', '2019-11-28 03:28:22'),
(140, '3.3', 'Sexualidad y autocuidado', '2019-11-28 03:28:22'),
(141, '3.3', 'prevención del embarazo', '2019-11-28 03:28:22'),
(142, '3.3', 'ETS', '2019-11-28 03:28:22'),
(143, '3.3', 'Salud sexual', '2019-11-28 03:28:22'),
(144, '3.3', 'VIH/SIDA', '2019-11-28 03:28:22'),
(145, '3.3', 'ITS', '2019-11-28 03:28:22'),
(146, '3.3', 'IAAS', '2019-11-28 03:28:22'),
(147, '3.3', 'REAS', '2019-11-28 03:28:22'),
(148, '3.3', 'Residuos de salud', '2019-11-28 03:28:22'),
(149, '3.3', 'Conductas sexuales seguras', '2019-11-28 03:28:22'),
(150, '3.3', 'Enfermedad viral', '2019-11-28 03:28:22'),
(151, '3.3', 'Rabia', '2019-11-28 03:28:22'),
(152, '3.3', 'Influenza', '2019-11-28 03:28:22'),
(153, '3.4', 'Flúor', '2019-11-28 03:28:22'),
(154, '3.4', 'Cardiovascular', '2019-11-28 03:28:22'),
(155, '3.4', 'Examen clínicos', '2019-11-28 03:28:22'),
(156, '3.4', 'Salud bucal', '2019-11-28 03:28:22'),
(157, '3.4', 'Técnica de cepillado', '2019-11-28 03:28:22'),
(158, '3.4', 'Alimentos cardiogénicos', '2019-11-28 03:28:22'),
(159, '3.4', 'Hilo dental', '2019-11-28 03:28:22'),
(160, '3.4', 'Podológico', '2019-11-28 03:28:22'),
(161, '3.4', 'Podológica', '2019-11-28 03:28:22'),
(162, '3.4', 'Colecta de sangre', '2019-11-28 03:28:22'),
(163, '3.4', 'Donantes', '2019-11-28 03:28:22'),
(164, '3.4', 'Enfermedades autoinmunes', '2019-11-28 03:28:22'),
(165, '3.4', 'Diagnóstico de enfermedades', '2019-11-28 03:28:22'),
(166, '3.4', 'Desarrollo físico', '2019-11-28 03:28:22'),
(167, '3.4', 'Ortodoncia', '2019-11-28 03:28:22'),
(168, '3.4', 'Actividad física', '2019-11-28 03:28:22'),
(169, '3.4', 'Cardiología', '2019-11-28 03:28:22'),
(170, '3.4', 'Dentistas', '2019-11-28 03:28:22'),
(171, '3.4', 'Fonoaudiología', '2019-11-28 03:28:22'),
(172, '3.4', 'Trastorno Neurocognitivo', '2019-11-28 03:28:22'),
(173, '3.4', 'Síndrome de Down', '2019-11-28 03:28:22'),
(174, '3.4', 'Diagnostico', '2019-11-28 03:28:22'),
(175, '3.4', 'Tratamiento', '2019-11-28 03:28:22'),
(176, '3.4', 'Promoción de salud', '2019-11-28 03:28:22'),
(177, '3.4', 'Medicina preventiva', '2019-11-28 03:28:22'),
(178, '3.4', 'Banco de sangre', '2019-11-28 03:28:22'),
(179, '3.4', 'Evaluación funcional al adulto mayor', '2019-11-28 03:28:22'),
(180, '3.4', 'Caries', '2019-11-28 03:28:22'),
(181, '3.4', 'riesgo cardiogénico', '2019-11-28 03:28:22'),
(182, '3.4', 'Higiene bucal', '2019-11-28 03:28:22'),
(183, '3.4', 'Apoyo Terapéutico', '2019-11-28 03:28:22'),
(184, '3.4', 'Manejo clínico', '2019-11-28 03:28:22'),
(185, '3.4', 'Patologías', '2019-11-28 03:28:22'),
(186, '3.4', 'Celiaca', '2019-11-28 03:28:22'),
(187, '3.4', 'Tratamiento kinésico', '2019-11-28 03:28:22'),
(188, '3.4', 'Prevención de lesiones', '2019-11-28 03:28:22'),
(189, '3.4', 'Actividades motrices', '2019-11-28 03:28:22'),
(190, '3.4', 'Ejercicios motores', '2019-11-28 03:28:22'),
(191, '3.4', 'Rehabilitación', '2019-11-28 03:28:22'),
(192, '3.4', 'Discapacidad', '2019-11-28 03:28:22'),
(193, '3.4', 'Módulos dentales', '2019-11-28 03:28:22'),
(194, '3.4', 'Odontopediatría', '2019-11-28 03:28:22'),
(195, '3.4', 'Bucodental', '2019-11-28 03:28:22'),
(196, '3.4', 'Salud primaria', '2019-11-28 03:28:22'),
(197, '3.4', 'Cardiovascular', '2019-11-28 03:28:22'),
(198, '3.4', 'Cuidados odontológicos', '2019-11-28 03:28:22'),
(199, '3.4', 'Cepillar sus dientes', '2019-11-28 03:28:22'),
(200, '3.4', 'Atención de pacientes', '2019-11-28 03:28:22'),
(201, '3.4', 'Respiratorias', '2019-11-28 03:28:22'),
(202, '3.4', 'Musculo esquelético', '2019-11-28 03:28:22'),
(203, '3.4', 'Atender pacientes', '2019-11-28 03:28:22'),
(204, '3.4', 'Servicio de salud', '2019-11-28 03:28:22'),
(205, '3.4', 'Clínica kinésica', '2019-11-28 03:28:22'),
(206, '3.4', 'Patologías', '2019-11-28 03:28:22'),
(207, '3.4', 'Musculo esquelética', '2019-11-28 03:28:22'),
(208, '3.4', 'Neurologías', '2019-11-28 03:28:22'),
(209, '3.4', 'Enfermedades crónica no transmisibles', '2019-11-28 03:28:22'),
(210, '3.4', 'Clínica higienista dental', '2019-11-28 03:28:22'),
(211, '3.4', 'clínica odontológica', '2019-11-28 03:28:22'),
(212, '3.4', 'Servicios psicológicos', '2019-11-28 03:28:22'),
(213, '3.4', 'psicodiagnóstico', '2019-11-28 03:28:22'),
(214, '3.4', 'psicoterapia', '2019-11-28 03:28:22'),
(215, '3.4', 'Brinda atención', '2019-11-28 03:28:22'),
(216, '3.4', 'indicación médica', '2019-11-28 03:28:22'),
(217, '3.4', 'Clínica psicológica', '2019-11-28 03:28:22'),
(218, '3.4', 'fonoaudiológicos', '2019-11-28 03:28:22'),
(219, '3.4', 'Patologías', '2019-11-28 03:28:22'),
(220, '3.4', 'Neuro', '2019-11-28 03:28:22'),
(221, '3.4', 'Sellantes', '2019-11-28 03:28:22'),
(222, '3.4', 'Teletón', '2019-11-28 03:28:22'),
(223, '3.4', 'Hogares de adultos mayores', '2019-11-28 03:28:22'),
(224, '3.4', 'Pacientes', '2019-11-28 03:28:22'),
(225, '3.4', 'Neuropsicología', '2019-11-28 03:28:22'),
(226, '3.4', 'Neuropsicológica', '2019-11-28 03:28:22'),
(227, '3.4', 'Red pública de atención sanitaria', '2019-11-28 03:28:22'),
(228, '3.4', 'Coffe saludable', '2019-11-28 03:28:22'),
(229, '3.4', 'Salud mental', '2019-11-28 03:28:22'),
(230, '3.4', 'Alteración motora', '2019-11-28 03:28:22'),
(231, '3.4', 'Cesfam', '2019-11-28 03:28:22'),
(232, '3.4', 'Importancia de la vacunación', '2019-11-28 03:28:22'),
(233, '3.4', 'Campaña de vacunación', '2019-11-28 03:28:22'),
(234, '3.4', 'depresión', '2019-11-28 03:28:22'),
(235, '3.4', 'stress', '2019-11-28 03:28:22'),
(236, '3.4', 'Heridas', '2019-11-28 03:28:22'),
(237, '3.4', 'Traumatismos', '2019-11-28 03:28:22'),
(238, '3.4', 'Mordeduras Quemaduras', '2019-11-28 03:28:22'),
(239, '3.4', 'Conclusiones', '2019-11-28 03:28:22'),
(240, '3.4', 'Tratamientos de lesiones', '2019-11-28 03:28:22'),
(241, '3.4', 'Picaduras', '2019-11-28 03:28:22'),
(242, '3.4', 'Diabéticos', '2019-11-28 03:28:22'),
(243, '3.4', 'Diabetes', '2019-11-28 03:28:22'),
(244, '3.4', 'Hipertensión', '2019-11-28 03:28:22'),
(245, '3.4', 'Hipertensos', '2019-11-28 03:28:22'),
(246, '3.4', 'Operativo medico', '2019-11-28 03:28:22'),
(247, '3.4', 'Atención de salud', '2019-11-28 03:28:22'),
(248, '3.4', 'Campaña de PAP', '2019-11-28 03:28:22'),
(249, '3.4', 'Salud preventiva', '2019-11-28 03:28:22'),
(250, '3.4', 'Prevención de salud', '2019-11-28 03:28:22'),
(251, '3.4', 'Evaluación de condición física', '2019-11-28 03:28:22'),
(252, '3.4', 'Atención de enfermería', '2019-11-28 03:28:22'),
(253, '3.4', 'Desarrollo psicomotriz', '2019-11-28 03:28:22'),
(254, '3.4', 'Operativo preventivo en salud', '2019-11-28 03:28:22'),
(255, '3.4', 'Cáncer', '2019-11-28 03:28:22'),
(256, '3.4', 'terapias biológicas', '2019-11-28 03:28:22'),
(257, '3.4', 'Nutrición oncológica', '2019-11-28 03:28:22'),
(258, '3.4', 'Enfermedad metabólica', '2019-11-28 03:28:22'),
(259, '3.4', 'Fisiopatológicos', '2019-11-28 03:28:22'),
(260, '3.4', 'Salud buco dentario', '2019-11-28 03:28:22'),
(261, '3.4', 'Lavado de dientes', '2019-11-28 03:28:22'),
(262, '3.4', 'Rayos ultravioletas', '2019-11-28 03:28:22'),
(263, '3.4', 'Rayos UV', '2019-11-28 03:28:22'),
(264, '3.4', 'Técnicas de higiene', '2019-11-28 03:28:22'),
(265, '3.4', 'Prótesis dentales', '2019-11-28 03:28:22'),
(266, '3.4', 'Atención psicológica', '2019-11-28 03:28:22'),
(267, '3.4', 'Atenciones psicológicas', '2019-11-28 03:28:22'),
(268, '3.4', 'Habilidades motrices', '2019-11-28 03:28:22'),
(269, '3.4', 'Cuidados del adulto mayor', '2019-11-28 03:28:22'),
(270, '3.4', 'Intervenciones educativas en salud', '2019-11-28 03:28:22'),
(271, '3.4', 'Salud bucodental', '2019-11-28 03:28:22'),
(272, '3.4', 'Examen de mini mental', '2019-11-28 03:28:22'),
(273, '3.4', 'Ulcera', '2019-11-28 03:28:22'),
(274, '3.4', 'Recolección de sangre', '2019-11-28 03:28:22'),
(275, '3.4', 'Automedicación', '2019-11-28 03:28:22'),
(276, '3.4', 'RCP', '2019-11-28 03:28:22'),
(277, '3.4', 'Reanimación cardio vascular', '2019-11-28 03:28:22'),
(278, '3.4', 'Maniobra de Heimlich', '2019-11-28 03:28:22'),
(279, '3.4', 'Examen PAP', '2019-11-28 03:28:22'),
(280, '3.4', 'Tumores', '2019-11-28 03:28:22'),
(281, '3.4', 'Buen trato del adulto mayor', '2019-11-28 03:28:22'),
(282, '3.4', 'Higiene Oral', '2019-11-28 03:28:22'),
(283, '3.4', 'Enfermedades periodontales', '2019-11-28 03:28:22'),
(284, '3.4', 'Envejecimiento saludable', '2019-11-28 03:28:22'),
(285, '3.4', 'Examen Preventivo', '2019-11-28 03:28:22'),
(286, '3.4', 'Espina bífida, pacientes', '2019-11-28 03:28:22'),
(287, '3.4', 'Atención fonoaudiológica', '2019-11-28 03:28:22'),
(288, '3.4', 'Trastornos mentales', '2019-11-28 03:28:22'),
(289, '3.4', 'Enfermedades respiratorias', '2019-11-28 03:28:22'),
(290, '3.4', 'Mejorar el estado de salud', '2019-11-28 03:28:22'),
(291, '3.4', 'Perfil lípido y glicémico', '2019-11-28 03:28:22'),
(292, '3.4', 'Desarrollo psicomotriz', '2019-11-28 03:28:22'),
(293, '3.4', 'Evaluación psicomotriz', '2019-11-28 03:28:22'),
(294, '3.4', 'Déficits auditivos', '2019-11-28 03:28:22'),
(295, '3.4', 'Evaluación física', '2019-11-28 03:28:22'),
(296, '3.4', 'Fomento del autocuidado', '2019-11-28 03:28:22'),
(297, '3.4', 'Demencias', '2019-11-28 03:28:22'),
(298, '3.4', 'Autoexamen de mamas', '2019-11-28 03:28:22'),
(299, '3.4', 'Psicoanálisis', '2019-11-28 03:28:22'),
(300, '3.4', 'epilepsia', '2019-11-28 03:28:22'),
(301, '3.4', 'artritis, enfermedad desconocida', '2019-11-28 03:28:22'),
(302, '3.4', 'Promoción de la salud', '2019-11-28 03:28:22'),
(303, '3.4', 'gingivitis', '2019-11-28 03:28:22'),
(304, '3.4', 'trastornos emocionales', '2019-11-28 03:28:22'),
(305, '3.4', 'glicemia capilar', '2019-11-28 03:28:22'),
(306, '3.4', 'prevención del suicidio', '2019-11-28 03:28:22'),
(307, '3.4', 'Protección a la radiación', '2019-11-28 03:28:22'),
(308, '3.4', 'uso racional de los medicamentos', '2019-11-28 03:28:22'),
(309, '3.4', 'Tratamientos farmacológicos', '2019-11-28 03:28:22'),
(310, '3.4', 'Operativo medico', '2019-11-28 03:28:22'),
(311, '3.4', 'Papanicolau', '2019-11-28 03:28:22'),
(312, '3.4', 'Enfermedades crónicas', '2019-11-28 03:28:22'),
(313, '3.4', 'prótesis dentales', '2019-11-28 03:28:22'),
(314, '3.5', 'Alcohol', '2019-11-28 03:28:22'),
(315, '3.5', 'Droga', '2019-11-28 03:28:22'),
(316, '3.5', 'Senda', '2019-11-28 03:28:22'),
(317, '3.5', 'Marihuana', '2019-11-28 03:28:22'),
(318, '3.5', 'Cocaína', '2019-11-28 03:28:22'),
(319, '3.5', 'Pasta Base', '2019-11-28 03:28:22'),
(320, '3.5', 'LCD', '2019-11-28 03:28:22'),
(321, '3.5', 'Metanfetamina', '2019-11-28 03:28:22'),
(322, '3.5', 'Éxtasis', '2019-11-28 03:28:22'),
(323, '3.7', 'Sexualidad responsable', '2019-11-28 03:28:22'),
(324, '3.7', 'Embarazo adolescente', '2019-11-28 03:28:22'),
(325, '3.7', 'Métodos anticonceptivos', '2019-11-28 03:28:22'),
(326, '3.7', 'Sexualidad sana', '2019-11-28 03:28:22'),
(327, '3.7', 'Educación sexual', '2019-11-28 03:28:22'),
(328, '3.7', 'derechos sexuales', '2019-11-28 03:28:22'),
(329, '3.7', 'derechos reproductivos', '2019-11-28 03:28:22'),
(330, '3.7', 'Deberes sexuales', '2019-11-28 03:28:22'),
(331, '3.7', 'Deberes reproductivos', '2019-11-28 03:28:22'),
(332, '3.7', 'Sexualidad en el adulto mayor', '2019-11-28 03:28:22'),
(333, '3.7', 'Calidad de vida sexual', '2019-11-28 03:28:22'),
(334, '3.7', 'Planificación familiar', '2019-11-28 03:28:22'),
(335, '3.7', 'Conductas responsables de sexualidad', '2019-11-28 03:28:22'),
(336, '3.7', 'Autocuidado en sexualidad', '2019-11-28 03:28:22'),
(337, '3.7', 'Educación en sexualidad', '2019-11-28 03:28:22'),
(338, '3.7', 'Preservativo', '2019-11-28 03:28:22'),
(339, '3.7', 'Prevención del embarazo', '2019-11-28 03:28:22'),
(340, '3.7', 'salud sexual', '2019-11-28 03:28:22'),
(341, '3.7', 'Conductas sexuales responsables', '2019-11-28 03:28:22'),
(342, '3.a', 'Tabaquismo', '2019-11-28 03:28:22'),
(343, '3.a', 'Tabaco', '2019-11-28 03:28:22'),
(344, '3.a', 'Fumar', '2019-11-28 03:28:22'),
(345, '3.b', 'Vacunación', '2019-11-28 03:28:22'),
(346, '3.c', 'Actualizar conocimientos en la interpretación básico de imágenes torácicas', '2019-11-28 03:28:22'),
(347, '3.c', 'Curso dirigido a profesionales kinesiólogos', '2019-11-28 03:28:22'),
(348, '3.c', 'Actualización en manejo de heridas', '2019-11-28 03:28:22'),
(349, '3.c', 'Nuevas técnicas inmunológicas', '2019-11-28 03:28:22'),
(350, '3.c', 'Jornada de inmunología', '2019-11-28 03:28:22'),
(351, '3.c', 'Actualizar en las técnicas inmunológicas', '2019-11-28 03:28:22'),
(352, '3.c', 'Capacitación de profesionales de la salud', '2019-11-28 03:28:22'),
(353, '3.c', 'Seminario de rehabilitación', '2019-11-28 03:28:22'),
(354, '3.c', 'Capacitación pre y postgrado en imagenología', '2019-11-28 03:28:22'),
(355, '3.c', 'Charla salud mental', '2019-11-28 03:28:22'),
(356, '3.c', 'Conocer la musicoterapia', '2019-11-28 03:28:22'),
(357, '3.c', 'Actualización para laboratoristas', '2019-11-28 03:28:22'),
(358, '3.c', 'Jornada de área odontológica', '2019-11-28 03:28:22'),
(359, '3.c', 'Nuevas técnicas de rehabilitación', '2019-11-28 03:28:22'),
(360, '3.c', 'Actualización en nutrición', '2019-11-28 03:28:22'),
(361, '3.c', 'Investigación e innovación en salud', '2019-11-28 03:28:22'),
(362, '3.c', 'Curso de educación continua IAAS', '2019-11-28 03:28:22'),
(363, '3.c', 'Curso de automatización en microbiología', '2019-11-28 03:28:22'),
(364, '3.c', 'Seminario: Introducción a la medicina', '2019-11-28 03:28:22'),
(365, '3.c', 'Actualización en enfermedad', '2019-11-28 03:28:22'),
(366, '3.c', 'Actualización en trastorno', '2019-11-28 03:28:22'),
(367, '3.c', 'Información actualizada respecto del diagnóstico', '2019-11-28 03:28:22'),
(368, '3.c', 'Taller profesiones sanitarias', '2019-11-28 03:28:22'),
(369, '3.d', 'Seguridad y salud ocupacional', '2019-11-28 03:28:22'),
(370, '3.d', 'Reducción de riesgos', '2019-11-28 03:28:22'),
(371, '3.d', 'Primeros auxilios', '2019-11-28 03:28:22'),
(372, '3.d', 'Condiciones de seguridad', '2019-11-28 03:28:22'),
(373, '3.d', 'Heimlich', '2019-11-28 03:28:22'),
(374, '3.d', 'Técnicas de reanimación', '2019-11-28 03:28:22'),
(375, '3.d', 'Primeros Auxilios', '2019-11-28 03:28:22'),
(376, '3.d', 'RCP', '2019-11-28 03:28:22'),
(377, '3.d', 'Simulacro de evacuación', '2019-11-28 03:28:22'),
(378, '3.d', 'Planes de emergencia', '2019-11-28 03:28:22'),
(379, '3.d', 'Capacitación de prevención  de riesgo', '2019-11-28 03:28:22'),
(380, '3.d', 'Prevención de accidentes', '2019-11-28 03:28:22'),
(381, '3.d', 'Reanimación cardiopulmonar', '2019-11-28 03:28:22'),
(382, '3.d', 'Situación de emergencia', '2019-11-28 03:28:22'),
(383, '3.d', 'Accidentes escolares', '2019-11-28 03:28:22'),
(384, '3.d', 'Manejo de una emergencia', '2019-11-28 03:28:22'),
(385, '3.d', 'Zona de seguridad', '2019-11-28 03:28:22'),
(386, '3.d', 'Plan emergencias', '2019-11-28 03:28:22'),
(387, '3.d', 'Simulacro de accidentes', '2019-11-28 03:28:22'),
(388, '4.2', 'Jardín infantil', '2019-11-28 03:28:22'),
(389, '4.2', 'Educación inicial', '2019-11-28 03:28:22'),
(390, '4.2', 'Primer ciclo', '2019-11-28 03:28:22'),
(391, '4.2', 'Segundo ciclo', '2019-11-28 03:28:22'),
(392, '4.2', 'Educación parvularia', '2019-11-28 03:28:22'),
(393, '4.2', 'Preescolar', '2019-11-28 03:28:22'),
(394, '4.2', 'Jardines infantiles', '2019-11-28 03:28:22'),
(395, '4.2', 'Confeccionar cuentos infantiles', '2019-11-28 03:28:22'),
(396, '4.2', 'Matemáticas en niños', '2019-11-28 03:28:22'),
(397, '4.2', 'Nivel prebásico', '2019-11-28 03:28:22'),
(398, '4.2', 'párvulos', '2019-11-28 03:28:22'),
(399, '4.2', 'Prekínder', '2019-11-28 03:28:22'),
(400, '4.2', 'Kínder', '2019-11-28 03:28:22'),
(401, '4.2', 'Enseñanza primaria', '2019-11-28 03:28:22'),
(402, '4.2', 'sala cuna', '2019-11-28 03:28:22'),
(403, '4.3', 'Deserción en estudiantes', '2019-11-28 03:28:22'),
(404, '4.3', 'Deserción académica', '2019-11-28 03:28:22'),
(405, '4.3', 'Deserción de estudiantes', '2019-11-28 03:28:22'),
(406, '4.3', 'Charla vocacional', '2019-11-28 03:28:22'),
(407, '4.3', 'Preuniversitario', '2019-11-28 03:28:22'),
(408, '4.3', 'Experiencia en la educación superior', '2019-11-28 03:28:22'),
(409, '4.3', 'Baja Matricula', '2019-11-28 03:28:22'),
(410, '4.3', 'Postulación a beneficios de educación superior', '2019-11-28 03:28:22'),
(411, '4.4', 'Construir argumentos', '2019-11-28 03:28:22'),
(412, '4.4', 'Mejorar la oratoria', '2019-11-28 03:28:22'),
(413, '4.4', 'Generar sentido crítico', '2019-11-28 03:28:22'),
(414, '4.4', 'Complementar las competencias', '2019-11-28 03:28:22'),
(415, '4.4', 'Mejorar competencias técnicas', '2019-11-28 03:28:22'),
(416, '4.4', 'acercar a los alumnos', '2019-11-28 03:28:22'),
(417, '4.4', 'Acercar a los estudiantes', '2019-11-28 03:28:22'),
(418, '4.4', 'Acercar y dar a conocer la ingeniería e innovación a los colegios', '2019-11-28 03:28:22'),
(419, '4.4', 'Formación de los alumnos', '2019-11-28 03:28:22'),
(420, '4.4', 'Capacitación a alumnos', '2019-11-28 03:28:22'),
(421, '4.4', 'Conocimientos de las ciencias', '2019-11-28 03:28:22'),
(422, '4.4', 'Evaluación de proyectos científicos de educación', '2019-11-28 03:28:22'),
(423, '4.4', 'Aprendizaje continuo', '2019-11-28 03:28:22'),
(424, '4.4', 'Presentación efectiva', '2019-11-28 03:28:22'),
(425, '4.4', 'Inserción laboral', '2019-11-28 03:28:22'),
(426, '4.4', 'Mundo laboral', '2019-11-28 03:28:22'),
(427, '4.4', 'Desarrollar conocimientos', '2019-11-28 03:28:22'),
(428, '4.4', 'Educación económica', '2019-11-28 03:28:22'),
(429, '4.4', 'Educación financiera', '2019-11-28 03:28:22'),
(430, '4.4', 'Desarrollar en los alumnos', '2019-11-28 03:28:22'),
(431, '4.4', 'Capacidades de emprendimiento', '2019-11-28 03:28:22'),
(432, '4.4', 'Desarrollar y fortalecer en estudiantes', '2019-11-28 03:28:22'),
(433, '4.4', 'Importancia de las matemáticas', '2019-11-28 03:28:22'),
(434, '4.4', 'Apoyar la formación', '2019-11-28 03:28:22'),
(435, '4.4', 'Desarrollo de habilidades', '2019-11-28 03:28:22'),
(436, '4.4', 'Entregar conocimientos', '2019-11-28 03:28:22'),
(437, '4.4', 'Entregar herramientas básicas', '2019-11-28 03:28:22'),
(438, '4.4', 'Talleres escolares', '2019-11-28 03:28:22'),
(439, '4.4', 'Taller de emprendimiento', '2019-11-28 03:28:22'),
(440, '4.4', 'Mostrar a los estudiantes', '2019-11-28 03:28:22'),
(441, '4.4', 'Fortalecer competencias técnicas', '2019-11-28 03:28:22'),
(442, '4.4', 'Fortalecer competencias profesionales', '2019-11-28 03:28:22'),
(443, '4.4', 'Clase de simulación', '2019-11-28 03:28:22'),
(444, '4.4', 'Desarrollan y ponen en prácticas competencias adquiridas', '2019-11-28 03:28:22'),
(445, '4.4', 'investigación a una pyme', '2019-11-28 03:28:22'),
(446, '4.4', 'Mostrar a los alumnos', '2019-11-28 03:28:22'),
(447, '4.4', 'Mostrar los estudiantes', '2019-11-28 03:28:22'),
(448, '4.5', 'Lectoescritura en jardines infantiles, hogares de menores', '2019-11-28 03:28:22'),
(449, '4.5', 'Discapacidad visual y su abordaje pedagógico', '2019-11-28 03:28:22'),
(450, '4.5', 'Psicoeducativa agrupación asperger', '2019-11-28 03:28:22'),
(451, '4.5', 'psicoeducación al grupo de padres y apoderados pertenecientes a la agrupación asperger', '2019-11-28 03:28:22'),
(452, '4.5', 'Enseñanza inclusiva', '2019-11-28 03:28:22'),
(453, '4.5', 'Educación parvularia en los niños/as de las escuelas de lenguaje', '2019-11-28 03:28:22'),
(454, '4.5', 'recursos pedagógicos a niños y niñas con trastornos del lenguaje', '2019-11-28 03:28:22'),
(455, '4.5', 'Taller socioeducativo a 21 internos condenados', '2019-11-28 03:28:22'),
(456, '4.5', 'Actividades recreativas en la escuela especial', '2019-11-28 03:28:22'),
(457, '4.5', 'psicomotriz según las necesidades educativas especiales', '2019-11-28 03:28:22'),
(458, '4.5', 'centros educativos que atienden a niños con NEE', '2019-11-28 03:28:22'),
(459, '4.5', 'Juegos Niveles del lenguaje', '2019-11-28 03:28:22'),
(460, '4.5', 'Inclusión educativa', '2019-11-28 03:28:22'),
(461, '4.5', 'Inclusión escolar', '2019-11-28 03:28:22'),
(462, '4.5', 'Educativo para adulto mayor', '2019-11-28 03:28:22'),
(463, '4.5', 'Juegos didácticos para escuelas de lenguaje', '2019-11-28 03:28:22'),
(464, '4.5', 'Alto porcentaje de vulnerabilidad social', '2019-11-28 03:28:22'),
(465, '4.5', 'que en alto Bio Bio supera el 90%. Con establecimientos que no dispongan de laboratorios de ciencias', '2019-11-28 03:28:22'),
(466, '4.5', 'Audición de niños de prekínder', '2019-11-28 03:28:22'),
(467, '4.5', 'Audición de niños preescolares', '2019-11-28 03:28:22'),
(468, '4.5', 'Lenguaje en adultos mayores', '2019-11-28 03:28:22'),
(469, '4.5', 'Lenguaje en niños de escasos recursos', '2019-11-28 03:28:22'),
(470, '4.5', 'NEE', '2019-11-28 03:28:22'),
(471, '4.5', 'Necesidades educativas espaciales', '2019-11-28 03:28:22'),
(472, '4.5', 'Educación: Discapacidad', '2019-11-28 03:28:22'),
(473, '4.5', 'Educación con niños y familiares inmigrantes', '2019-11-28 03:28:22'),
(474, '4.5', 'Epilepsia', '2019-11-28 03:28:22'),
(475, '4.5', 'Institución privada sin fines de lucro junto con el área de educación', '2019-11-28 03:28:22'),
(476, '4.5', 'Autista y como abordarlo en la primera infancia para educadoras', '2019-11-28 03:28:22'),
(477, '4.5', 'Necesidades educativas transitorias', '2019-11-28 03:28:22'),
(478, '4.5', 'Socioeducativas en la población penal', '2019-11-28 03:28:22'),
(479, '4.6', 'Biblioteca campamento', '2019-11-28 03:28:22'),
(480, '4.6', 'Biblioteca del campamento', '2019-11-28 03:28:22'),
(481, '4.6', 'Capacitación de voluntario CreceChile', '2019-11-28 03:28:22'),
(482, '4.7', 'Series animadas por el medio ambiente', '2019-11-28 03:28:22'),
(483, '4.a', 'Abuso escolar', '2019-11-28 03:28:22'),
(484, '4.a', 'Convivencia escolar', '2019-11-28 03:28:22'),
(485, '4.a', 'Jardines infantiles en maniobras de primeros auxilios', '2019-11-28 03:28:22'),
(486, '4.a', 'transgénero en los jardines', '2019-11-28 03:28:22'),
(487, '4.a', 'Convivencia escolar', '2019-11-28 03:28:22'),
(488, '4.a', 'Prevención de accidentes preescolares', '2019-11-28 03:28:22'),
(489, '4.a', 'Accidentes escolares', '2019-11-28 03:28:22'),
(490, '4.a', 'Bulling', '2019-11-28 03:28:22'),
(491, '4.a', 'RCP Básico a escolares', '2019-11-28 03:28:22'),
(492, '4.a', 'Bullying', '2019-11-28 03:28:22'),
(493, '4.b', 'Becas', '2019-11-28 03:28:22'),
(494, '4.c', 'Practicas pedagógicas de los docentes', '2019-11-28 03:28:22'),
(495, '4.c', 'Taller de pedagogía', '2019-11-28 03:28:22'),
(496, '4.c', 'Manejo conductual en el aula', '2019-11-28 03:28:22'),
(497, '4.c', 'Capacitación del instrumento psicopedagógico', '2019-11-28 03:28:22'),
(498, '4.c', 'Taller: Pedagogía', '2019-11-28 03:28:22'),
(499, '4.c', 'Estrategias e implementación de la pedagogía', '2019-11-28 03:28:22'),
(500, '4.c', 'Prueba para profesores', '2019-11-28 03:28:22'),
(501, '4.c', 'Evaluación docente', '2019-11-28 03:28:22'),
(502, '4.c', 'Herramientas a docentes', '2019-11-28 03:28:22'),
(503, '4.c', 'Profesores puedan desarrollar conocimiento', '2019-11-28 03:28:22'),
(504, '4.c', 'Entrenamiento y certificación de docente', '2019-11-28 03:28:22'),
(505, '4.c', 'Buenas prácticas de enseñanza', '2019-11-28 03:28:22'),
(506, '4.c', 'Buenas prácticas en la enseñanza', '2019-11-28 03:28:22'),
(507, '4.c', 'Evaluación pedagógica', '2019-11-28 03:28:22'),
(508, '5.1', 'Género y derechos ciudadanos', '2019-11-28 03:28:22'),
(509, '5.1', 'Derechos ciudadanos de las mujeres', '2019-11-28 03:28:22'),
(510, '5.1', 'Equidad de género', '2019-11-28 03:28:22'),
(511, '5.1', 'Enfoque de género', '2019-11-28 03:28:22'),
(512, '5.1', 'Feminización de la pobreza', '2019-11-28 03:28:22'),
(513, '5.1', 'Enfoque de genero', '2019-11-28 03:28:22'),
(514, '5.2', 'Abuso sexual', '2019-11-28 03:28:22'),
(515, '5.2', 'Violencia intrafamiliar hacia a mujer', '2019-11-28 03:28:22'),
(516, '5.2', 'Violencia de género', '2019-11-28 03:28:22'),
(517, '5.2', 'Violencia contra la mujer', '2019-11-28 03:28:22'),
(518, '5.2', 'Violencia contra las mujeres', '2019-11-28 03:28:22'),
(519, '5.2', 'Genero y violencia', '2019-11-28 03:28:22'),
(520, '5.2', 'Agresor sexual', '2019-11-28 03:28:22'),
(521, '5.2', 'Acoso sexual callejero', '2019-11-28 03:28:22'),
(522, '5.2', 'Violencia en el pololeo', '2019-11-28 03:28:22'),
(523, '5.2', 'Violencia sexual', '2019-11-28 03:28:22'),
(524, '5.2', 'Violencia intrafamiliar', '2019-11-28 03:28:22'),
(525, '5.2', 'Violencia en relaciones de pareja', '2019-11-28 03:28:22'),
(526, '5.2', 'Maltrato sexual', '2019-11-28 03:28:22'),
(527, '5.5', 'Género y derechos ciudadanos', '2019-11-28 03:28:22'),
(528, '5.5', 'Derechos ciudadanos de las mujeres', '2019-11-28 03:28:22'),
(529, '5.5', 'Rol de la mujer en la vida moderna', '2019-11-28 03:28:22'),
(530, '5.5', 'Mujer y el derecho', '2019-11-28 03:28:22'),
(531, '5.5', 'Emprendimiento con mujeres', '2019-11-28 03:28:22'),
(532, '5.5', 'Emprendedores, Pequeñas productoras', '2019-11-28 03:28:22'),
(533, '5.5', 'Capacitar Mujeres', '2019-11-28 03:28:22'),
(534, '5.5', 'Mujer en la minería', '2019-11-28 03:28:22'),
(535, '5.6', 'Sexualidad responsable', '2019-11-28 03:28:22'),
(536, '5.6', 'Derechos sexuales', '2019-11-28 03:28:22'),
(537, '5.6', 'Derechos reproductivos', '2019-11-28 03:28:22'),
(538, '5.6', 'Deberes sexuales', '2019-11-28 03:28:22'),
(539, '5.6', 'Deberes reproductivos', '2019-11-28 03:28:22'),
(540, '5.a', 'Mujer y el derecho', '2019-11-28 03:28:22'),
(541, '5.b', 'Niñas TIC', '2019-11-28 03:28:22'),
(542, '5.b', 'Brechas de género en el área de informática', '2019-11-28 03:28:22'),
(543, '5.b', 'Brecha digital de género', '2019-11-28 03:28:22'),
(544, '5.b', 'Vocaciones tecnológicas en las niñas', '2019-11-28 03:28:22'),
(545, '6.2', 'Código sanitario', '2019-11-28 03:28:22'),
(546, '6.4', 'Importancia del agua', '2019-11-28 03:28:22'),
(547, '6.b', 'Agua potable rural', '2019-11-28 03:28:22'),
(548, '7.2', 'Generación energética con residuos sólidos', '2019-11-28 03:28:22'),
(549, '7.2', 'Energía a través del tratamiento de residuos solidos', '2019-11-28 03:28:22'),
(550, '7.3', 'Eficiencia energética', '2019-11-28 03:28:22'),
(551, '7.3', 'Ahorrar energía', '2019-11-28 03:28:22'),
(552, '7.3', 'Ahorrar el gasto de energía', '2019-11-28 03:28:22'),
(553, '7.3', 'Energía inútil en casa', '2019-11-28 03:28:22'),
(554, '7.3', 'gasto innecesario en electricidad', '2019-11-28 03:28:22'),
(555, '7.3', 'Equipos enchufados', '2019-11-28 03:28:22'),
(556, '7.3', 'Ahorros energéticos', '2019-11-28 03:28:22'),
(557, '7.3', 'Uso eficiente de la energía', '2019-11-28 03:28:23'),
(558, '7.3', 'Uso responsable de la energía', '2019-11-28 03:28:23'),
(559, '8.1', 'Desempeño de la economía chilena', '2019-11-28 03:28:23'),
(560, '8.1', 'Nuevos mercados internacionales', '2019-11-28 03:28:23'),
(561, '8.1', 'Política comercial', '2019-11-28 03:28:23'),
(562, '8.1', 'Tendencia global', '2019-11-28 03:28:23'),
(563, '8.1', 'Negocios entre China y Chile, Negocio entre Chile y China', '2019-11-28 03:28:23'),
(564, '8.2', 'Actividad minera', '2019-11-28 03:28:23'),
(565, '8.2', 'Comercio electrónico', '2019-11-28 03:28:23'),
(566, '8.2', 'ERP', '2019-11-28 03:28:23'),
(567, '8.2', 'Explotación minera', '2019-11-28 03:28:23'),
(568, '8.2', 'Automatización de procesos', '2019-11-28 03:28:23'),
(569, '8.2', 'Avances de la cadena de abastecimiento mediante la tecnología', '2019-11-28 03:28:23'),
(570, '8.2', 'Comunidad minera', '2019-11-28 03:28:23'),
(571, '8.2', 'Desarrollo industrial', '2019-11-28 03:28:23'),
(572, '8.2', 'Desarrollo minero', '2019-11-28 03:28:23'),
(573, '8.2', 'Desarrollo Agrícola', '2019-11-28 03:28:23'),
(574, '8.2', 'Sector Minero', '2019-11-28 03:28:23'),
(575, '8.2', 'Temas importantes de minería', '2019-11-28 03:28:23'),
(576, '8.2', 'Empresa tecnológica', '2019-11-28 03:28:23'),
(577, '8.2', 'Nuevas tecnologías para gestión de riesgos corporativos, mundo productivo', '2019-11-28 03:28:23'),
(578, '8.3', 'Favorecer el emprendimiento', '2019-11-28 03:28:23'),
(579, '8.3', 'Emprendimiento e la innovación', '2019-11-28 03:28:23'),
(580, '8.3', 'Emprendimiento e innovación', '2019-11-28 03:28:23'),
(581, '8.3', 'Ecosistema de emprendimiento', '2019-11-28 03:28:23'),
(582, '8.3', 'emprendimientos tecnológico', '2019-11-28 03:28:23'),
(583, '8.3', 'gestión Pyme', '2019-11-28 03:28:23'),
(584, '8.3', 'Empresas Pyme', '2019-11-28 03:28:23'),
(585, '8.3', 'Emprendimiento Dinámico', '2019-11-28 03:28:23'),
(586, '8.3', 'Mercado Laboral', '2019-11-28 03:28:23'),
(587, '8.3', 'Proyecto la Barra', '2019-11-28 03:28:23'),
(588, '8.3', 'Mundo Laboral', '2019-11-28 03:28:23'),
(589, '8.3', 'Conformación de empresas', '2019-11-28 03:28:23'),
(590, '8.3', 'emprendedores', '2019-11-28 03:28:23'),
(591, '8.3', 'Caleta la Barra', '2019-11-28 03:28:23'),
(592, '8.3', 'Emprendimiento y asociatividad', '2019-11-28 03:28:23'),
(593, '8.3', 'Cooperativa', '2019-11-28 03:28:23'),
(594, '8.3', 'Innovación social', '2019-11-28 03:28:23'),
(595, '8.3', 'Centro de desarrollo de negocios', '2019-11-28 03:28:23'),
(596, '8.3', 'Presentación efectiva para presentación de emprendimientos, obtención de financiamiento de un proyecto', '2019-11-28 03:28:23'),
(597, '8.3', 'Sercotec', '2019-11-28 03:28:23'),
(598, '8.3', 'Corfo', '2019-11-28 03:28:23'),
(599, '8.3', 'Fosis', '2019-11-28 03:28:23'),
(600, '8.3', 'Pequeñas y medianas empresas', '2019-11-28 03:28:23'),
(601, '8.3', 'Cumbre de emprendedores', '2019-11-28 03:28:23'),
(602, '8.3', 'Situación laboral', '2019-11-28 03:28:23'),
(603, '8.3', 'Estrategia para emprendedores', '2019-11-28 03:28:23'),
(604, '8.3', 'Emprendimiento con mujeres', '2019-11-28 03:28:23'),
(605, '8.3', 'Taller de emprendimiento', '2019-11-28 03:28:23'),
(606, '8.3', 'Omil', '2019-11-28 03:28:23'),
(607, '8.3', 'Formalización de empresas', '2019-11-28 03:28:23'),
(608, '8.3', 'Impacto sobre el empleo', '2019-11-28 03:28:23'),
(609, '8.3', 'Feria de emprendimiento', '2019-11-28 03:28:23'),
(610, '8.3', 'Asociación de emprendedores', '2019-11-28 03:28:23'),
(611, '8.3', 'Modelación de negocios', '2019-11-28 03:28:23'),
(612, '8.3', 'Innovación y emprendimiento', '2019-11-28 03:28:23'),
(613, '8.3', 'Ideas de proyectos, Plan de negocios', '2019-11-28 03:28:23'),
(614, '8.3', 'Investigación de mercados', '2019-11-28 03:28:23'),
(615, '8.3', 'Asech', '2019-11-28 03:28:23'),
(616, '8.3', 'Feria emprendimiento', '2019-11-28 03:28:23'),
(617, '8.3', 'Economías colaborativas', '2019-11-28 03:28:23'),
(618, '8.3', 'Nuevas Formas de hacer negocios Desarrollo económico y social', '2019-11-28 03:28:23'),
(619, '8.3', 'Comercio Justo', '2019-11-28 03:28:23'),
(620, '8.3', 'Rueda de negocio', '2019-11-28 03:28:23'),
(621, '8.3', 'Modelo de negocio', '2019-11-28 03:28:23'),
(622, '8.3', 'Prochile', '2019-11-28 03:28:23'),
(623, '8.3', 'Nodo de artesanos', '2019-11-28 03:28:23'),
(624, '8.3', 'Centro desarrollo de negocios', '2019-11-28 03:28:23'),
(625, '8.3', 'Pequeños empresarios', '2019-11-28 03:28:23'),
(626, '8.3', 'Redes sociales para emprendedores', '2019-11-28 03:28:23'),
(627, '8.3', 'Emprendimiento y desarrollo', '2019-11-28 03:28:23'),
(628, '8.3', 'Fortalecimiento de las habilidades empresariales', '2019-11-28 03:28:23'),
(629, '8.3', 'Talento emprendedor', '2019-11-28 03:28:23'),
(630, '8.3', 'Desafíos emprendedor', '2019-11-28 03:28:23'),
(631, '8.3', 'Equipo de emprendedores', '2019-11-28 03:28:23'),
(632, '8.3', 'Oportunidad para emprender', '2019-11-28 03:28:23'),
(633, '8.3', 'Aprender y Emprender', '2019-11-28 03:28:23'),
(634, '8.3', 'Herramientas de emprendimientos', '2019-11-28 03:28:23'),
(635, '8.3', 'Herramientas innovadoras en marketing digital', '2019-11-28 03:28:23'),
(636, '8.3', 'Asesoría empresarial', '2019-11-28 03:28:23'),
(637, '8.3', 'Emprendimiento innovador', '2019-11-28 03:28:23'),
(638, '8.3', 'Dinámicas de emprendimiento', '2019-11-28 03:28:23'),
(639, '8.3', 'Talento emprendedor', '2019-11-28 03:28:23'),
(640, '8.3', 'Pymes y emprendedores', '2019-11-28 03:28:23'),
(641, '8.3', 'Emprendimientos innovadores', '2019-11-28 03:28:23'),
(642, '8.3', 'Espacio para que emprendedores', '2019-11-28 03:28:23'),
(643, '8.3', 'Emprendimiento exitoso', '2019-11-28 03:28:23'),
(644, '8.3', 'Visión de emprendimiento', '2019-11-28 03:28:23'),
(645, '8.3', 'Gestión a Pymes', '2019-11-28 03:28:23'),
(646, '8.3', 'Emprendimiento de nuevos negocios', '2019-11-28 03:28:23'),
(647, '8.5', 'Consumo e inclusión', '2019-11-28 03:28:23'),
(648, '8.5', 'Mercado laboral', '2019-11-28 03:28:23'),
(649, '8.5', 'Empleabilidad, Ámbito laboral', '2019-11-28 03:28:23'),
(650, '8.5', 'Vinculación laboral', '2019-11-28 03:28:23'),
(651, '8.5', 'Demanda laboral', '2019-11-28 03:28:23'),
(652, '8.5', 'Capacitar Mujeres', '2019-11-28 03:28:23'),
(653, '8.5', 'Buenas prácticas laborales', '2019-11-28 03:28:23'),
(654, '8.5', 'Campo laboral', '2019-11-28 03:28:23'),
(655, '8.5', 'Mundo Laboral', '2019-11-28 03:28:23'),
(656, '8.5', 'Necesidades laborales', '2019-11-28 03:28:23'),
(657, '8.5', 'Empleadores', '2019-11-28 03:28:23'),
(658, '8.5', 'rol laboral, Inserción laboral', '2019-11-28 03:28:23'),
(659, '8.5', 'Inclusión laboral, Perfiles organizacionales', '2019-11-28 03:28:23'),
(660, '8.5', 'Mujer en la minería', '2019-11-28 03:28:23'),
(661, '8.5', 'Prácticas laborales', '2019-11-28 03:28:23'),
(662, '8.5', 'Prácticas profesionales', '2019-11-28 03:28:23'),
(663, '8.5', 'Mercado de trabajo, Mercado del trabajo', '2019-11-28 03:28:23'),
(664, '8.5', 'Oficios que se desarrollan, rol laboral', '2019-11-28 03:28:23'),
(665, '8.5', 'Visita técnica a faena', '2019-11-28 03:28:23'),
(666, '8.5', 'Medio laboral', '2019-11-28 03:28:23'),
(667, '8.5', 'Desempeño laboral', '2019-11-28 03:28:23'),
(668, '8.5', 'Tabla de sueldos', '2019-11-28 03:28:23'),
(669, '8.5', 'Asesoría laboral', '2019-11-28 03:28:23'),
(670, '8.5', 'Competencias laborales', '2019-11-28 03:28:23'),
(671, '8.5', 'Vida laboral', '2019-11-28 03:28:23'),
(672, '8.5', 'Asesoría Organizacional', '2019-11-28 03:28:23'),
(673, '8.5', 'Practica laboral', '2019-11-28 03:28:23'),
(674, '8.5', 'Vínculo laboral', '2019-11-28 03:28:23'),
(675, '8.5', 'experiencias laborales', '2019-11-28 03:28:23'),
(676, '8.5', 'Ambiente laboral', '2019-11-28 03:28:23'),
(677, '8.5', 'Estudiantes con empresas', '2019-11-28 03:28:23'),
(678, '8.5', 'Campos laborales', '2019-11-28 03:28:23'),
(679, '8.5', 'Realidad laboral', '2019-11-28 03:28:23'),
(680, '8.5', 'Plazas laborales', '2019-11-28 03:28:23'),
(681, '8.7', 'Trabajo infantil', '2019-11-28 03:28:23'),
(682, '8.8', 'Pausa laboral', '2019-11-28 03:28:23'),
(683, '8.8', 'Tensiones laborales', '2019-11-28 03:28:23'),
(684, '8.8', 'Derecho laboral', '2019-11-28 03:28:23'),
(685, '8.8', 'Libertad sindical', '2019-11-28 03:28:23'),
(686, '8.8', 'Defensoría laboral', '2019-11-28 03:28:23'),
(687, '8.8', 'Derecho de los trabajadores', '2019-11-28 03:28:23'),
(688, '8.8', 'Inspección del trabajo', '2019-11-28 03:28:23'),
(689, '8.8', 'Derechos laborales', '2019-11-28 03:28:23'),
(690, '8.8', 'Legislación laboral', '2019-11-28 03:28:23'),
(691, '8.8', 'Ley laboral', '2019-11-28 03:28:23'),
(692, '8.8', 'Seguridad y salud en el trabajo', '2019-11-28 03:28:23'),
(693, '8.8', 'Salud de los trabajadores', '2019-11-28 03:28:23'),
(694, '8.8', 'Riesgos presentes en el lugar de trabajo', '2019-11-28 03:28:23'),
(695, '8.8', 'Clima laboral', '2019-11-28 03:28:23'),
(696, '8.8', 'Reforma laboral', '2019-11-28 03:28:23'),
(697, '8.9', 'Turismo', '2019-11-28 03:28:23'),
(698, '8.9', 'Industria turística', '2019-11-28 03:28:23'),
(699, '8.9', 'Productos locales', '2019-11-28 03:28:23'),
(700, '8.9', 'Actividad económica turística', '2019-11-28 03:28:23'),
(701, '8.9', 'Identidad local', '2019-11-28 03:28:23'),
(702, '8.9', 'Productos producidos en la zona', '2019-11-28 03:28:23'),
(703, '8.9', 'Desarrollo gastronómico de la región', '2019-11-28 03:28:23'),
(704, '8.10', 'Educación financiera', '2019-11-28 03:28:23'),
(705, '8.b', 'Estatuto laboral para jovenes', '2019-11-28 03:28:23'),
(706, '9.4', 'Generación energética con residuos sólidos', '2019-11-28 03:28:23'),
(707, '9.4', 'Energía a través del tratamiento de residuos solidos', '2019-11-28 03:28:23'),
(708, '9.5', 'Fiesta de la ciencia', '2019-11-28 03:28:23'),
(709, '9.5', 'Ciencia y la tecnología', '2019-11-28 03:28:23'),
(710, '9.5', 'Talleres de ciencias', '2019-11-28 03:28:23'),
(711, '9.5', 'Semana de la ciencia', '2019-11-28 03:28:23'),
(712, '9.5', 'Últimos avances sobre el cosmos, Científico e investigativo', '2019-11-28 03:28:23'),
(713, '9.5', 'Investigación de interés', '2019-11-28 03:28:23'),
(714, '9.5', 'Charla titulada resistencia antibiótica', '2019-11-28 03:28:23'),
(715, '9.5', 'Información sobre investigación', '2019-11-28 03:28:23'),
(716, '9.5', 'Proyectos de innovación investigados', '2019-11-28 03:28:23'),
(717, '9.5', 'Innovación y tecnología', '2019-11-28 03:28:23'),
(718, '9.5', 'Investigación aplicada', '2019-11-28 03:28:23'),
(719, '9.5', 'Ciencia y tecnología', '2019-11-28 03:28:23'),
(720, '9.b', 'Exposición de proyectos de innovación', '2019-11-28 03:28:23'),
(721, '9.b', 'Estudio de cobertura para señales inalámbricas', '2019-11-28 03:28:23'),
(722, '9.b', 'Innovación tecnológica', '2019-11-28 03:28:23'),
(723, '9.b', 'Vinculación tecnológica', '2019-11-28 03:28:23'),
(724, '9.b', 'Sistema de automatización', '2019-11-28 03:28:23'),
(725, '9.b', 'Capacitar en robótica', '2019-11-28 03:28:23'),
(726, '9.b', 'Feria tecnológica', '2019-11-28 03:28:23'),
(727, '10.2', 'Juegos regionales de inclusión, situación de discapacidad, en una actividad deportiva', '2019-11-28 03:28:23'),
(728, '10.2', 'Discriminación y derechos humanos', '2019-11-28 03:28:23'),
(729, '10.2', 'No discriminación', '2019-11-28 03:28:23'),
(730, '10.2', 'Lucha contra la discriminación', '2019-11-28 03:28:23'),
(731, '10.2', 'Temáticas de discriminación', '2019-11-28 03:28:23'),
(732, '10.2', 'Rehabilitación', '2019-11-28 03:28:23'),
(733, '10.2', 'Capacitar a personas mayores', '2019-11-28 03:28:23'),
(734, '10.2', 'Inserción', '2019-11-28 03:28:23'),
(735, '10.2', 'Inclusión', '2019-11-28 03:28:23'),
(736, '10.2', 'Discriminación en educación', '2019-11-28 03:28:23'),
(737, '10.2', 'Educación e inclusión', '2019-11-28 03:28:23'),
(738, '10.2', 'Genero e inclusión', '2019-11-28 03:28:23'),
(739, '10.2', 'Cultura inclusiva', '2019-11-28 03:28:23'),
(740, '10.2', 'Racismo', '2019-11-28 03:28:23'),
(741, '10.2', 'Enfoque inclusivo', '2019-11-28 03:28:23'),
(742, '10.2', 'Ideología de género', '2019-11-28 03:28:23'),
(743, '10.2', 'Interacción con personas con discapacidad', '2019-11-28 03:28:23'),
(744, '10.2', 'Habilidades laborales con gendarmería', '2019-11-28 03:28:23'),
(745, '10.2', 'Inclusión de los estudiantes', '2019-11-28 03:28:23'),
(746, '10.2', 'Charla inclusión', '2019-11-28 03:28:23'),
(747, '10.2', 'Inclusión laboral de las personas en situación de discapacidad', '2019-11-28 03:28:23'),
(748, '10.2', 'Inserción de inmigrantes', '2019-11-28 03:28:23'),
(749, '10.2', 'Empleabilidad en inclusión', '2019-11-28 03:28:23'),
(750, '10.2', 'Emprendimientos para inmigrantes', '2019-11-28 03:28:23'),
(751, '10.2', 'Senderos interpretativos Inclusivo', '2019-11-28 03:28:23'),
(752, '10.2', 'Examen de medicina de salud (EMP) a la población haitiana', '2019-11-28 03:28:23'),
(753, '10.2', 'Encuentro intercultural', '2019-11-28 03:28:23'),
(754, '10.2', 'formar a líderes mayores', '2019-11-28 03:28:23'),
(755, '10.2', 'Taller adulto mayor', '2019-11-28 03:28:23'),
(756, '10.2', 'Intervención dirigido a menores de edad', '2019-11-28 03:28:23'),
(757, '10.2', 'Vinculando a la comunidad migrante', '2019-11-28 03:28:23'),
(758, '10.2', 'Servicios municipales a los cuales pueden acceder las personas migrantes', '2019-11-28 03:28:23'),
(759, '10.2', 'Redes Inclusivas', '2019-11-28 03:28:23'),
(760, '10.2', 'Instancias inclusivas', '2019-11-28 03:28:23'),
(761, '10.2', 'Enfoque de género en inmigración', '2019-11-28 03:28:23'),
(762, '10.2', 'Inclusión social', '2019-11-28 03:28:23'),
(763, '10.2', 'Inclusión de alumnos con discapacidad', '2019-11-28 03:28:23'),
(764, '10.2', 'Ley de identidad de género', '2019-11-28 03:28:23'),
(765, '10.2', 'Derecho de la infancia trans.', '2019-11-28 03:28:23'),
(766, '10.2', 'Monitores comunitarios en la población penal', '2019-11-28 03:28:23'),
(767, '10.2', 'Actividades de inclusión', '2019-11-28 03:28:23'),
(768, '10.2', 'Promoción de la inclusión', '2019-11-28 03:28:23'),
(769, '10.2', 'Feria para personas con discapacidad', '2019-11-28 03:28:23'),
(770, '10.2', 'Inclusión y diversidad', '2019-11-28 03:28:23'),
(771, '10.2', 'Intervención en la comunidad inmigrante', '2019-11-28 03:28:23'),
(772, '10.3', 'Cooperativa', '2019-11-28 03:28:23'),
(773, '10.3', 'Cooperativismo', '2019-11-28 03:28:23'),
(774, '10.7', 'Desafíos de la migración', '2019-11-28 03:28:23'),
(775, '10.7', 'Trata sobre inmigración', '2019-11-28 03:28:23'),
(776, '10.7', 'Ley de inmigración', '2019-11-28 03:28:23'),
(777, '10.7', 'Oficina de inmigraciones', '2019-11-28 03:28:23'),
(778, '10.7', 'Información a la población migrante', '2019-11-28 03:28:23'),
(779, '10.7', 'Racismo y las migraciones', '2019-11-28 03:28:23'),
(780, '10.7', 'Racismo y migraciones', '2019-11-28 03:28:23'),
(781, '10.7', 'Alumnos inmigrantes', '2019-11-28 03:28:23'),
(782, '10.7', 'Vinculando a la comunidad migrante', '2019-11-28 03:28:23'),
(783, '10.7', 'Inserción de inmigrantes', '2019-11-28 03:28:23'),
(784, '10.7', 'Inmigración en Chile', '2019-11-28 03:28:23'),
(785, '10.7', 'Desafíos socio culturales de la migración', '2019-11-28 03:28:23'),
(786, '10.7', 'Problemáticas sociales de la comunidad inmigrante', '2019-11-28 03:28:23'),
(787, '11.1', 'Construcción de 3 viviendas', '2019-11-28 03:28:23'),
(788, '11.1', 'Fundación TECHO', '2019-11-28 03:28:23'),
(789, '11.1', 'Viviendas de emergencia', '2019-11-28 03:28:23'),
(790, '11.3', 'Senderos interpretativos inclusivos', '2019-11-28 03:28:23'),
(791, '11.3', 'Infraestructura de seguridad', '2019-11-28 03:28:23'),
(792, '11.4', 'Rescatando el patrimonio', '2019-11-28 03:28:23'),
(793, '11.4', 'Restaurar el patrimonio', '2019-11-28 03:28:23'),
(794, '11.5', 'Plan de emergencia', '2019-11-28 03:28:23'),
(795, '11.5', 'Peligros y riesgos', '2019-11-28 03:28:23'),
(796, '11.5', 'Simulacro de accidentes', '2019-11-28 03:28:23'),
(797, '11.5', 'Seguridad ciudadana', '2019-11-28 03:28:23'),
(798, '11.5', 'Plan emergencia', '2019-11-28 03:28:23'),
(799, '11.5', 'Control emergencias', '2019-11-28 03:28:23'),
(800, '11.5', 'Situaciones de emergencia', '2019-11-28 03:28:23'),
(801, '11.5', 'Simulacro sismo', '2019-11-28 03:28:23'),
(802, '11.5', 'Situación de emergencia', '2019-11-28 03:28:23'),
(803, '11.b', 'Ahorrar energía en el hogar', '2019-11-28 03:28:23'),
(804, '12.2', 'Ahorrar energía', '2019-11-28 03:28:23'),
(805, '12.2', 'Ahorrar el gasto de energía', '2019-11-28 03:28:23'),
(806, '12.2', 'Energía inútil en casa Gasto innecesario en electricidad', '2019-11-28 03:28:23'),
(807, '12.2', 'Equipos enchufados', '2019-11-28 03:28:23'),
(808, '12.3', 'Desperdicios de alimentos', '2019-11-28 03:28:23'),
(809, '12.5', 'Limpieza de playa', '2019-11-28 03:28:23'),
(810, '12.5', 'Reciclaje', '2019-11-28 03:28:23'),
(811, '12.5', 'Reciclar', '2019-11-28 03:28:23');
INSERT INTO `viga_concepto_pertinente` (`id`, `id_meta`, `concepto`, `fecha_creacion`) VALUES
(812, '12.8', 'Concejo y alternativas para ahorrar el gasto de energía', '2019-11-28 03:28:23'),
(813, '12.8', 'Dar a conocer a la comunidad el gasto que se origina por tener algunos equipos enchufados', '2019-11-28 03:28:23'),
(814, '12.8', 'Concejos sencillos para ahorrar energía', '2019-11-28 03:28:23'),
(815, '13.2', 'Uso de bolsas plásticas', '2019-11-28 03:28:23'),
(816, '13.2', 'Limpieza de microbasurales', '2019-11-28 03:28:23'),
(817, '13.2', 'Tribunal ambiental', '2019-11-28 03:28:23'),
(818, '13.2', 'Impacto del macro y micro plásticos', '2019-11-28 03:28:23'),
(819, '13.2', 'Reducir las emisiones de gases de efecto invernadero', '2019-11-28 03:28:23'),
(820, '13.2', 'Control de la contaminación', '2019-11-28 03:28:23'),
(821, '13.2', 'Plantación de árboles nativos', '2019-11-28 03:28:23'),
(822, '13.2', 'Limpieza de playas', '2019-11-28 03:28:23'),
(823, '13.2', 'Preservación de la biodiversidad', '2019-11-28 03:28:23'),
(824, '13.2', 'Brigada verde', '2019-11-28 03:28:23'),
(825, '13.2', 'Limpieza de parque', '2019-11-28 03:28:23'),
(826, '13.3', 'Aprender sobre contaminación, qué es la contaminación', '2019-11-28 03:28:23'),
(827, '13.3', 'Enseñarles lúdicamente sobre el reciclaje, Taller de material reciclado', '2019-11-28 03:28:23'),
(828, '13.3', 'Aprendiendo a reciclar', '2019-11-28 03:28:23'),
(829, '13.3', 'Qué es reciclar', '2019-11-28 03:28:23'),
(830, '13.3', 'Educar a la comunidad sobre os impactos ambientales', '2019-11-28 03:28:23'),
(831, '13.3', 'Conocimientos-medioambientales', '2019-11-28 03:28:23'),
(832, '13.3', 'Series animadas por el medio ambiente', '2019-11-28 03:28:23'),
(833, '14.2', 'Limpieza de playas', '2019-11-28 03:28:23'),
(834, '14.2', 'Limpieza de costa', '2019-11-28 03:28:23'),
(835, '14.2', 'Conservación y manejo de hábitat de las aves playeras', '2019-11-28 03:28:23'),
(836, '15.1', 'Limpieza de microbasurales', '2019-11-28 03:28:23'),
(837, '15.1', 'Preservación de la biodiversidad', '2019-11-28 03:28:23'),
(838, '15.1', 'Brigada verde', '2019-11-28 03:28:23'),
(839, '15.1', 'Limpieza de parque', '2019-11-28 03:28:23'),
(840, '15.2', 'Plantación de árboles nativos', '2019-11-28 03:28:23'),
(841, '16.1', 'Violencia', '2019-11-28 03:28:23'),
(842, '16.1', 'Violencias', '2019-11-28 03:28:23'),
(843, '16.2', 'Violencia infantil', '2019-11-28 03:28:23'),
(844, '16.2', 'Violencia contra niños', '2019-11-28 03:28:23'),
(845, '16.2', 'Maltrato sexual infantil', '2019-11-28 03:28:23'),
(846, '16.3', 'Espacio informativo para toda la comunidad estudiantil sobre temáticas legales', '2019-11-28 03:28:23'),
(847, '16.3', 'Defensoría penal publica', '2019-11-28 03:28:23'),
(848, '16.3', 'Asesoría jurídica', '2019-11-28 03:28:23'),
(849, '16.3', 'revisión casos para comunidad en general', '2019-11-28 03:28:23'),
(850, '16.3', 'Atención jurídica', '2019-11-28 03:28:23'),
(851, '16.3', 'Audiencias judiciales', '2019-11-28 03:28:23'),
(852, '16.3', 'Ciudad democrática', '2019-11-28 03:28:23'),
(853, '16.3', 'Defensoría laboral', '2019-11-28 03:28:23'),
(854, '16.3', 'Legislación laboral', '2019-11-28 03:28:23'),
(855, '16.3', 'Defensa deudores', '2019-11-28 03:28:23'),
(856, '16.3', 'Asesoría laboral', '2019-11-28 03:28:23'),
(857, '16.3', 'Peritaje judicial', '2019-11-28 03:28:23'),
(858, '16.3', 'Clínica jurídica', '2019-11-28 03:28:23'),
(859, '16.3', 'Derechos constitucionales', '2019-11-28 03:28:23'),
(860, '16.3', 'Charlas jurídicas', '2019-11-28 03:28:23'),
(861, '16.3', 'Derecho civil', '2019-11-28 03:28:23'),
(862, '17.1', 'SII', '2019-11-28 03:28:23'),
(863, '17.1', 'Servicio de impuestos internos', '2019-11-28 03:28:23'),
(864, '17.1', 'Operación renta', '2019-11-28 03:28:23'),
(865, '17.1', 'Recaudación de impuestos', '2019-11-28 03:28:23'),
(866, '17.1', 'Recaudación fiscal', '2019-11-28 03:28:23'),
(867, '17.6', 'Emprendimientos tecnológicos globales', '2019-11-28 03:28:23'),
(868, '17.7', 'Científico', '2019-11-28 03:28:23'),
(869, '17.7', 'Descubrimiento la vida en el océano', '2019-11-28 03:28:23'),
(870, '17.9', 'Embajada de China y la UST. El curso', '2019-11-28 03:28:23'),
(871, '17.9', 'Taller de negociación a estudiantes del MBA de la Universidad de Palermo', '2019-11-28 03:28:23'),
(872, '17.9', 'Universidad de Monterrey, Universidad autónoma', '2019-11-28 03:28:23'),
(873, '17.9', 'Certificar a 20 docentes de la universidad de Lima', '2019-11-28 03:28:23'),
(874, '17.9', 'Chile-Guatemala', '2019-11-28 03:28:23'),
(875, '17.10', 'Comercio Justo', '2019-11-28 03:28:23'),
(876, '17.10', 'Escenarios cooperativos', '2019-11-28 03:28:23'),
(877, '17.10', 'Cooperativas', '2019-11-28 03:28:23'),
(878, '4.3', 'Educación superior', '2019-11-28 03:28:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_convenios`
--

CREATE TABLE `viga_convenios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_convenios_docs`
--

CREATE TABLE `viga_convenios_docs` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `archivo` varchar(500) NOT NULL,
  `id_convenio` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `viga_entornos_significativos`
--

CREATE TABLE `viga_entornos_significativos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_entornos_significativos`
--

INSERT INTO `viga_entornos_significativos` (`id`, `nombre`, `visible`, `fecha_creacion`) VALUES
(1, 'Sociedad civil', 1, '2019-09-16 14:13:36'),
(2, 'Instituciones de educación', 1, '2019-09-16 14:13:36'),
(3, 'Egresados ', 1, '2019-09-16 14:13:36'),
(4, 'Empresa y producción', 1, '2019-09-16 14:13:36'),
(5, 'Gobierno y entidades públicas', 1, '2019-09-16 14:13:36'),
(6, 'Gobierno otros países', 1, '2022-06-24 04:15:05'),
(7, 'Internos', 1, '2022-06-24 04:15:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_entornos_significativos_detalle`
--

CREATE TABLE `viga_entornos_significativos_detalle` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_entornos_significativos_detalle`
--

INSERT INTO `viga_entornos_significativos_detalle` (`id`, `nombre`, `visible`, `fecha_creacion`) VALUES
(1, 'Municipalidad', 1, '2022-06-19 13:59:53'),
(2, 'Colegio', 1, '2022-06-19 13:59:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_entornos_significativos_sub`
--

CREATE TABLE `viga_entornos_significativos_sub` (
  `id` int(11) NOT NULL,
  `id_entorno` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_entornos_significativos_sub`
--

INSERT INTO `viga_entornos_significativos_sub` (`id`, `id_entorno`, `nombre`, `visible`, `fecha_creacion`) VALUES
(1, 1, 'Grupo de hecho', 1, '2021-07-17 07:44:33'),
(2, 1, 'Comités', 1, '2021-07-17 07:44:33'),
(3, 1, 'Junta de vecinos', 1, '2021-07-17 07:45:28'),
(4, 1, 'Unión comunal', 1, '2021-07-17 07:45:28'),
(5, 1, 'Asociación', 1, '2021-07-17 07:45:28'),
(6, 1, 'Comunidad', 1, '2021-07-17 07:45:28'),
(7, 1, 'Cooperativa', 1, '2021-07-17 07:45:28'),
(8, 1, 'Sindicato', 1, '2021-07-17 07:56:22'),
(9, 1, 'Federación', 1, '2021-07-17 07:56:22'),
(10, 1, 'Confederación', 1, '2021-07-17 07:56:22'),
(11, 1, 'Corporación', 1, '2021-07-17 07:56:22'),
(12, 1, 'Fundación', 1, '2021-07-17 07:56:22'),
(13, 1, 'Asociación gremial', 1, '2021-07-17 07:56:22'),
(14, 2, 'Pre escolar', 1, '2021-07-17 07:56:22'),
(15, 2, 'Básica', 1, '2021-07-17 07:56:22'),
(16, 2, 'Media CH', 1, '2021-07-17 07:56:22'),
(17, 2, 'Media TP', 1, '2021-07-17 07:56:22'),
(18, 2, 'Educación de adultos', 1, '2021-07-17 07:56:22'),
(19, 2, 'Técnico Profesional', 1, '2021-07-17 07:56:22'),
(20, 2, 'Universitaria', 1, '2021-07-17 07:56:22'),
(21, 4, 'Emprendedores (no formalizado)', 1, '2021-07-17 07:56:22'),
(22, 4, 'Microempresa', 1, '2021-07-17 07:56:22'),
(23, 4, 'Pequeña empresa', 1, '2021-07-17 07:56:22'),
(24, 4, 'Mediana empresa', 1, '2021-07-17 07:56:22'),
(25, 4, 'Gran empresa', 1, '2021-07-17 07:56:22'),
(26, 5, 'Municipalidad', 1, '2021-07-17 07:56:22'),
(27, 5, 'Dirección regional', 1, '2021-07-17 07:56:22'),
(28, 5, 'Dirección provincial', 1, '2021-07-17 07:56:22'),
(29, 5, 'Seremi', 1, '2021-07-17 07:56:22'),
(30, 5, 'Sub secretaría', 1, '2021-07-17 07:56:22'),
(31, 5, 'Ministerio', 1, '2021-07-17 07:56:22'),
(32, 5, 'Presidencia', 1, '2021-07-17 07:56:22'),
(33, 5, 'Gobierno Regional', 1, '2021-07-17 07:56:22'),
(34, 3, 'Titulados', 1, '2022-06-24 04:10:17'),
(35, 6, 'Embajadas', 1, '2022-06-24 04:15:41'),
(36, 7, 'Rectoría', 1, '2022-06-24 04:16:08'),
(37, 7, 'Vicerrectoría', 1, '2022-06-24 04:16:08'),
(38, 7, 'Secretaría', 1, '2022-06-24 04:20:00'),
(39, 7, 'Dirección', 1, '2022-06-24 04:20:00'),
(40, 7, 'Sub dirección', 1, '2022-06-24 04:20:00'),
(41, 7, 'Unidad', 1, '2022-06-24 04:20:00'),
(42, 7, 'Jefatura', 1, '2022-06-24 04:20:00'),
(43, 7, 'Consejero/a', 1, '2022-06-24 04:20:00'),
(44, 7, 'Docentes / profesores', 1, '2022-06-24 04:20:00'),
(45, 7, 'Estudiantes / alumnos', 1, '2022-06-24 04:20:00'),
(46, 7, 'Administrativos', 1, '2022-06-24 04:20:00'),
(47, 7, 'Auxiliares', 1, '2022-06-24 04:20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_competencias_pregunta`
--

CREATE TABLE `viga_evaluacion_competencias_pregunta` (
  `id` int(11) NOT NULL,
  `tipo_evaluador` varchar(100) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `orden_visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_competencias_pregunta`
--

INSERT INTO `viga_evaluacion_competencias_pregunta` (`id`, `tipo_evaluador`, `texto`, `orden_visible`) VALUES
(1, 'Evaluador interno - Estudiante', 'Te sirvió la actividad para desarrollar algunas de las siguientes dimensiones de las competencias comprometidas?', 1),
(2, 'Evaluador interno - Docente', 'Con qué nota evalúa usted la competencia de los y las estudiantes en la ejecución de la actividad, en las siguientes dimensiones:', 1),
(3, 'Evaluador externo', 'Con qué nota evalúa usted la competencia de los y las estudiantes en la ejecución de la actividad, en las siguientes dimensiones:', 1),
(4, 'Evaluador interno - Jefatura', 'Con qué nota evalúa usted la competencia de los y las estudiantes en la ejecución de la actividad, en las siguientes dimensiones:', 1),
(5, 'Evaluador interno - Directivo', 'Con qué nota evalúa usted la competencia de los y las estudiantes en la ejecución de la actividad, en las siguientes dimensiones:', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_conocimiento_ori_pregunta`
--

CREATE TABLE `viga_evaluacion_conocimiento_ori_pregunta` (
  `id` int(11) NOT NULL,
  `tipo_evaluador` varchar(100) NOT NULL,
  `texto` varchar(100) NOT NULL,
  `orden_visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_conocimiento_ori_pregunta`
--

INSERT INTO `viga_evaluacion_conocimiento_ori_pregunta` (`id`, `tipo_evaluador`, `texto`, `orden_visible`) VALUES
(1, 'Evaluador interno - Estudiante', '¿Sabía usted que el objetivo de la actividad era?', 1),
(2, 'Evaluador interno - Estudiante', '¿Sabía usted que los resultados esperados de la actividad eran?', 2),
(3, 'Evaluador interno - Estudiante', '¿Sabía usted que los impactos esperados de la actividad eran?', 3),
(4, 'Evaluador interno - Docente', '¿Sabía usted que el objetivo de la actividad era?', 1),
(5, 'Evaluador interno - Docente', '¿Sabía usted que los resultados esperados de la actividad eran?', 2),
(6, 'Evaluador interno - Docente', '¿Sabía usted que los impactos esperados de la actividad eran?', 3),
(7, 'Evaluador externo', '¿Sabía usted que el objetivo de la actividad era?', 1),
(8, 'Evaluador externo', '¿Sabía usted que los resultados esperados de la actividad eran?', 2),
(9, 'Evaluador externo', '¿Sabía usted que los impactos esperados de la actividad eran?', 3),
(10, 'Evaluador interno - Jefatura', '¿Sabía usted que el objetivo de la actividad era?', 1),
(11, 'Evaluador interno - Jefatura', '¿Sabía usted que los resultados esperados de la actividad eran?', 2),
(12, 'Evaluador interno - Jefatura', '¿Sabía usted que los impactos esperados de la actividad eran?', 3),
(13, 'Evaluador interno - Directivo', '¿Sabía usted que el objetivo de la actividad era?', 1),
(14, 'Evaluador interno - Directivo', '¿Sabía usted que los resultados esperados de la actividad eran?', 2),
(15, 'Evaluador interno - Directivo', '¿Sabía usted que los impactos esperados de la actividad eran?', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_cumplimiento_ori_pregunta`
--

CREATE TABLE `viga_evaluacion_cumplimiento_ori_pregunta` (
  `id` int(11) NOT NULL,
  `tipo_evaluador` varchar(100) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `orden_visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_cumplimiento_ori_pregunta`
--

INSERT INTO `viga_evaluacion_cumplimiento_ori_pregunta` (`id`, `tipo_evaluador`, `texto`, `orden_visible`) VALUES
(1, 'Evaluador interno - Estudiante', '¿En qué % cree usted que se cumplió el objetivo?', 1),
(2, 'Evaluador interno - Estudiante', '¿En qué % cree usted que se cumplieron los resultados esperados?', 2),
(3, 'Evaluador interno - Estudiante', '¿En qué % cree usted que se cumplirán los impactos esperados en los próximos meses?', 3),
(4, 'Evaluador interno - Docente', '¿En qué % cree usted que se cumplió el objetivo?', 1),
(5, 'Evaluador interno - Docente', '¿En qué % cree usted que se cumplieron los resultados esperados?', 2),
(6, 'Evaluador interno - Docente', '¿En qué % cree usted que se cumplirán los impactos esperados en los próximos meses?', 3),
(7, 'Evaluador externo', '¿En qué % cree usted que se cumplió el objetivo?', 1),
(8, 'Evaluador externo', '¿En qué % cree usted que se cumplieron los resultados esperados?', 2),
(9, 'Evaluador externo', '¿En qué % cree usted que se cumplirán los impactos esperados en los próximos meses?', 3),
(10, 'Evaluador interno - Jefatura', '¿En qué % cree usted que se cumplió el objetivo?', 1),
(11, 'Evaluador interno - Jefatura', '¿En qué % cree usted que se cumplieron los resultados esperados?', 2),
(12, 'Evaluador interno - Jefatura', '¿En qué % cree usted que se cumplirán los impactos esperados en los próximos meses?', 3),
(13, 'Evaluador interno - Directivo', '¿En qué % cree usted que se cumplió el objetivo?', 1),
(14, 'Evaluador interno - Directivo', '¿En qué % cree usted que se cumplieron los resultados esperados?', 2),
(15, 'Evaluador interno - Directivo', '¿En qué % cree usted que se cumplirán los impactos esperados en los próximos meses?', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_detalle_respuesta`
--

CREATE TABLE `viga_evaluacion_detalle_respuesta` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_evaluacion` int(11) NOT NULL,
  `correo_evaluador` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL DEFAULT '',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_detalle_respuesta`
--

INSERT INTO `viga_evaluacion_detalle_respuesta` (`id`, `id_iniciativa`, `id_evaluacion`, `correo_evaluador`, `clave`, `valor`, `autor`, `fecha_creacion`) VALUES
(117, 1, 20, 'crecontr@gmail.com', 'CONOCIMIENTO_O', '100', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(118, 1, 20, 'crecontr@gmail.com', 'CUMPLIMIENTO_O', '25', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(119, 1, 20, 'crecontr@gmail.com', 'CONOCIMIENTO_R_14', '100', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(120, 1, 20, 'crecontr@gmail.com', 'CUMPLIMIENTO_R_14', '50', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(121, 1, 20, 'crecontr@gmail.com', 'CONOCIMIENTO_R_15', '0', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(122, 1, 20, 'crecontr@gmail.com', 'CUMPLIMIENTO_R_15', '75', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(123, 1, 20, 'crecontr@gmail.com', 'CONOCIMIENTO_I_7', '100', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(124, 1, 20, 'crecontr@gmail.com', 'CUMPLIMIENTO_I_7', '100', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(125, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_1', '0', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(126, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_2', '1', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(127, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_3', '2', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(128, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_4', '3', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(129, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_5', '', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(130, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_6', '0', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(131, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_7', '1', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(132, 1, 20, 'crecontr@gmail.com', 'COMPROMISO_8', '2', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(133, 1, 20, 'crecontr@gmail.com', 'COMPETENCIA_1', '1', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(134, 1, 20, 'crecontr@gmail.com', 'COMPETENCIA_2', '2', 'crecontr@gmail.com', '2022-06-28 06:36:17'),
(135, 1, 20, 'crecontr@gmail.com', 'COMPETENCIA_3', '3', 'crecontr@gmail.com', '2022-06-28 06:36:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_evaluadores`
--

CREATE TABLE `viga_evaluacion_evaluadores` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_evaluacion` int(11) NOT NULL,
  `tipo_evaluacion` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_evaluadores`
--

INSERT INTO `viga_evaluacion_evaluadores` (`id`, `id_iniciativa`, `id_evaluacion`, `tipo_evaluacion`, `nombre`, `correo_electronico`, `estado`, `visible`, `autor`, `fecha_creacion`) VALUES
(10, 3, 19, 'Evaluador interno - Estudiante', 'Cristian Contreras', 'crecontr@gmail.com', '', 1, 'vinculamos_admin', '2022-06-27 00:51:27'),
(11, 3, 19, 'Evaluador interno - Estudiante', 'Marisa Sepulveda', 'marisa@gmail.com', '', 1, 'vinculamos_admin', '2022-06-27 01:16:01'),
(12, 1, 20, 'Evaluador interno - Estudiante', 'Cristian Contreras', 'crecontr@gmail.com', '', 1, 'vinculamos_admin', '2022-06-28 02:10:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_iniciativa`
--

CREATE TABLE `viga_evaluacion_iniciativa` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `tipo_evaluacion` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_tipo_compromiso`
--

CREATE TABLE `viga_evaluacion_tipo_compromiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_tipo_compromiso`
--

INSERT INTO `viga_evaluacion_tipo_compromiso` (`id`, `nombre`, `visible`) VALUES
(1, 'Plazo comprometido', 1),
(2, 'Horarios comprometidos', 1),
(3, 'Infraestructura ', 1),
(4, 'Equipamiento', 1),
(5, 'Conexión digital y/o logística', 1),
(6, 'Desempeño de él o los profesores a cargo', 1),
(7, 'Desempeño de estudiantes participantes', 1),
(8, 'Calidad de las presentaciones (SII)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_tipo_evaluador`
--

CREATE TABLE `viga_evaluacion_tipo_evaluador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_tipo_evaluador`
--

INSERT INTO `viga_evaluacion_tipo_evaluador` (`id`, `nombre`, `visible`) VALUES
(1, 'Evaluador interno - Estudiante', 1),
(2, 'Evaluador interno - Docente', 1),
(3, 'Evaluador interno - Jefatura', 1),
(4, 'Evaluador interno - Directivo', 1),
(5, 'Evaluador externo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_evaluacion_tipo_evaluador_config`
--

CREATE TABLE `viga_evaluacion_tipo_evaluador_config` (
  `id` int(11) NOT NULL,
  `tipo_evaluador` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `orden_visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_evaluacion_tipo_evaluador_config`
--

INSERT INTO `viga_evaluacion_tipo_evaluador_config` (`id`, `tipo_evaluador`, `clave`, `orden_visible`) VALUES
(1, 'Evaluador interno - Estudiante', 'CONOCIMIENTO_ORI', 1),
(2, 'Evaluador interno - Estudiante', 'CUMPLIMIENTO_ORI', 2),
(3, 'Evaluador interno - Estudiante', 'CALIDAD_EJECUCION', 3),
(4, 'Evaluador interno - Estudiante', 'APORTE_COMPETENCIAS', 4),
(5, 'Evaluador interno - Docente', 'CONOCIMIENTO_ORI', 1),
(6, 'Evaluador interno - Docente', 'CUMPLIMIENTO_ORI', 2),
(7, 'Evaluador interno - Docente', 'CALIDAD_EJECUCION', 3),
(8, 'Evaluador interno - Docente', 'APORTE_COMPETENCIAS', 4),
(9, 'Evaluador externo', 'CONOCIMIENTO_ORI', 1),
(10, 'Evaluador externo', 'CALIDAD_EJECUCION', 1),
(11, 'Evaluador interno - Jefatura', 'CONOCIMIENTO_ORI', 1),
(12, 'Evaluador interno - Jefatura', 'CUMPLIMIENTO_ORI', 2),
(13, 'Evaluador interno - Jefatura', 'CALIDAD_EJECUCION', 3),
(14, 'Evaluador interno - Jefatura', 'APORTE_COMPETENCIAS', 4),
(15, 'Evaluador interno - Directivo', 'CONOCIMIENTO_ORI', 1),
(16, 'Evaluador interno - Directivo', 'CUMPLIMIENTO_ORI', 2),
(17, 'Evaluador interno - Directivo', 'CALIDAD_EJECUCION', 3),
(18, 'Evaluador interno - Directivo', 'APORTE_COMPETENCIAS', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_facultades`
--

CREATE TABLE `viga_facultades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_geo_comuna`
--

CREATE TABLE `viga_geo_comuna` (
  `id` int(11) NOT NULL,
  `id_region` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_geo_comuna`
--

INSERT INTO `viga_geo_comuna` (`id`, `id_region`, `nombre`) VALUES
(1, 16, 'Cobquecura'),
(2, 16, 'Coelemu'),
(3, 16, 'Ninhue'),
(4, 16, 'Portezuelo'),
(5, 16, 'Quirihue'),
(6, 16, 'Ránquil'),
(7, 16, 'Trehuaco'),
(8, 16, 'Bulnes'),
(9, 16, 'Chillán Viejo'),
(10, 16, 'Chillán'),
(11, 16, 'El Carmen'),
(12, 16, 'Pemuco'),
(13, 16, 'Pinto'),
(14, 16, 'Quillón'),
(15, 16, 'San Ignacio'),
(16, 16, 'Yungay'),
(17, 16, 'Coihueco'),
(18, 16, 'Ñiquén'),
(19, 16, 'San Carlos'),
(20, 16, 'San Fabián'),
(21, 16, 'San Nicolás'),
(22, 1, 'Iquique'),
(23, 1, 'Camiña'),
(24, 1, 'Colchane'),
(25, 1, 'Huara'),
(26, 1, 'Pica'),
(27, 1, 'Pozo Almonte'),
(28, 1, 'Alto Hospicio'),
(29, 2, 'Antofagasta'),
(30, 2, 'Mejillones'),
(31, 2, 'Sierra Gorda'),
(32, 2, 'Taltal'),
(33, 2, 'Calama'),
(34, 2, 'Ollagüe'),
(35, 2, 'San Pedro de Atacama'),
(36, 2, 'Tocopilla'),
(37, 2, 'María Elena'),
(38, 3, 'Copiapó'),
(39, 3, 'Caldera'),
(40, 3, 'Tierra Amarilla'),
(41, 3, 'Chañaral'),
(42, 3, 'Diego de Almagro'),
(43, 3, 'Vallenar'),
(44, 3, 'Alto del Carmen'),
(45, 3, 'Freirina'),
(46, 3, 'Huasco'),
(47, 4, 'La Serena'),
(48, 4, 'Coquimbo'),
(49, 4, 'Andacollo'),
(50, 4, 'La Higuera'),
(51, 4, 'Paiguano'),
(52, 4, 'Vicuña'),
(53, 4, 'Illapel'),
(54, 4, 'Canela'),
(55, 4, 'Los Vilos'),
(56, 4, 'Salamanca'),
(57, 4, 'Ovalle'),
(58, 4, 'Combarbalá'),
(59, 4, 'Monte Patria'),
(60, 4, 'Punitaqui'),
(61, 4, 'Río Hurtado'),
(62, 5, 'Valparaíso'),
(63, 5, 'Casablanca'),
(64, 5, 'Concón'),
(65, 5, 'Juan Fernández'),
(66, 5, 'Puchuncaví'),
(67, 5, 'Quilpué'),
(68, 5, 'Quintero'),
(69, 5, 'Villa Alemana'),
(70, 5, 'Viña del Mar'),
(71, 5, 'Isla  de Pascua'),
(72, 5, 'Los Andes'),
(73, 5, 'Calle Larga'),
(74, 5, 'Rinconada'),
(75, 5, 'San Esteban'),
(76, 5, 'La Ligua'),
(77, 5, 'Cabildo'),
(78, 5, 'Papudo'),
(79, 5, 'Petorca'),
(80, 5, 'Zapallar'),
(81, 5, 'Quillota'),
(82, 5, 'Calera'),
(83, 5, 'Hijuelas'),
(84, 5, 'La Cruz'),
(85, 5, 'Limache'),
(86, 5, 'Nogales'),
(87, 5, 'Olmué'),
(88, 5, 'San Antonio'),
(89, 5, 'Algarrobo'),
(90, 5, 'Cartagena'),
(91, 5, 'El Quisco'),
(92, 5, 'El Tabo'),
(93, 5, 'Santo Domingo'),
(94, 5, 'San Felipe'),
(95, 5, 'Catemu'),
(96, 5, 'Llaillay'),
(97, 5, 'Panquehue'),
(98, 5, 'Putaendo'),
(99, 5, 'Santa María'),
(100, 6, 'Rancagua'),
(101, 6, 'Codegua'),
(102, 6, 'Coinco'),
(103, 6, 'Coltauco'),
(104, 6, 'Doñihue'),
(105, 6, 'Graneros'),
(106, 6, 'Las Cabras'),
(107, 6, 'Machalí'),
(108, 6, 'Malloa'),
(109, 6, 'Mostazal'),
(110, 6, 'Olivar'),
(111, 6, 'Peumo'),
(112, 6, 'Pichidegua'),
(113, 6, 'Quinta de Tilcoco'),
(114, 6, 'Rengo'),
(115, 6, 'Requínoa'),
(116, 6, 'San Vicente'),
(117, 6, 'Pichilemu'),
(118, 6, 'La Estrella'),
(119, 6, 'Litueche'),
(120, 6, 'Marchihue'),
(121, 6, 'Navidad'),
(122, 6, 'Paredones'),
(123, 6, 'San Fernando'),
(124, 6, 'Chépica'),
(125, 6, 'Chimbarongo'),
(126, 6, 'Lolol'),
(127, 6, 'Nancagua'),
(128, 6, 'Palmilla'),
(129, 6, 'Peralillo'),
(130, 6, 'Placilla'),
(131, 6, 'Pumanque'),
(132, 6, 'Santa Cruz'),
(133, 7, 'Talca'),
(134, 7, 'Constitución'),
(135, 7, 'Curepto'),
(136, 7, 'Empedrado'),
(137, 7, 'Maule'),
(138, 7, 'Pelarco'),
(139, 7, 'Pencahue'),
(140, 7, 'Río Claro'),
(141, 7, 'San Clemente'),
(142, 7, 'San Rafael'),
(143, 7, 'Cauquenes'),
(144, 7, 'Chanco'),
(145, 7, 'Pelluhue'),
(146, 7, 'Curicó'),
(147, 7, 'Hualañé'),
(148, 7, 'Licantén'),
(149, 7, 'Molina'),
(150, 7, 'Rauco'),
(151, 7, 'Romeral'),
(152, 7, 'Sagrada Familia'),
(153, 7, 'Teno'),
(154, 7, 'Vichuquén'),
(155, 7, 'Linares'),
(156, 7, 'Colbún'),
(157, 7, 'Longaví'),
(158, 7, 'Parral'),
(159, 7, 'Retiro'),
(160, 7, 'San Javier'),
(161, 7, 'Villa Alegre'),
(162, 7, 'Yerbas Buenas'),
(163, 8, 'Concepción'),
(164, 8, 'Coronel'),
(165, 8, 'Chiguayante'),
(166, 8, 'Florida'),
(167, 8, 'Hualqui'),
(168, 8, 'Lota'),
(169, 8, 'Penco'),
(170, 8, 'San Pedro de la Paz'),
(171, 8, 'Santa Juana'),
(172, 8, 'Talcahuano'),
(173, 8, 'Tomé'),
(174, 8, 'Hualpén'),
(175, 8, 'Lebu'),
(176, 8, 'Arauco'),
(177, 8, 'Cañete'),
(178, 8, 'Contulmo'),
(179, 8, 'Curanilahue'),
(180, 8, 'Los Álamos'),
(181, 8, 'Tirúa'),
(182, 8, 'Los Ángeles'),
(183, 8, 'Antuco'),
(184, 8, 'Cabrero'),
(185, 8, 'Laja'),
(186, 8, 'Mulchén'),
(187, 8, 'Nacimiento'),
(188, 8, 'Negrete'),
(189, 8, 'Quilaco'),
(190, 8, 'Quilleco'),
(191, 8, 'San Rosendo'),
(192, 8, 'Santa Bárbara'),
(193, 8, 'Tucapel'),
(194, 8, 'Yumbel'),
(195, 8, 'Alto Biobío'),
(196, 9, 'Temuco'),
(197, 9, 'Carahue'),
(198, 9, 'Cunco'),
(199, 9, 'Curarrehue'),
(200, 9, 'Freire'),
(201, 9, 'Galvarino'),
(202, 9, 'Gorbea'),
(203, 9, 'Lautaro'),
(204, 9, 'Loncoche'),
(205, 9, 'Melipeuco'),
(206, 9, 'Nueva Imperial'),
(207, 9, 'Padre Las Casas'),
(208, 9, 'Perquenco'),
(209, 9, 'Pitrufquén'),
(210, 9, 'Pucón'),
(211, 9, 'Saavedra'),
(212, 9, 'Teodoro Schmidt'),
(213, 9, 'Toltén'),
(214, 9, 'Vilcún'),
(215, 9, 'Villarrica'),
(216, 9, 'Cholchol'),
(217, 9, 'Angol'),
(218, 9, 'Collipulli'),
(219, 9, 'Curacautín'),
(220, 9, 'Ercilla'),
(221, 9, 'Lonquimay'),
(222, 9, 'Los Sauces'),
(223, 9, 'Lumaco'),
(224, 9, 'Purén'),
(225, 9, 'Renaico'),
(226, 9, 'Traiguén'),
(227, 9, 'Victoria'),
(228, 10, 'Puerto Montt'),
(229, 10, 'Calbuco'),
(230, 10, 'Cochamó'),
(231, 10, 'Fresia'),
(232, 10, 'Frutillar'),
(233, 10, 'Los Muermos'),
(234, 10, 'Llanquihue'),
(235, 10, 'Maullín'),
(236, 10, 'Puerto Varas'),
(237, 10, 'Castro'),
(238, 10, 'Ancud'),
(239, 10, 'Chonchi'),
(240, 10, 'Curaco de Vélez'),
(241, 10, 'Dalcahue'),
(242, 10, 'Puqueldón'),
(243, 10, 'Queilén'),
(244, 10, 'Quellón'),
(245, 10, 'Quemchi'),
(246, 10, 'Quinchao'),
(247, 10, 'Osorno'),
(248, 10, 'Puerto Octay'),
(249, 10, 'Purranque'),
(250, 10, 'Puyehue'),
(251, 10, 'Río Negro'),
(252, 10, 'San Juan de la Costa'),
(253, 10, 'San Pablo'),
(254, 10, 'Chaitén'),
(255, 10, 'Futaleufú'),
(256, 10, 'Hualaihué'),
(257, 10, 'Palena'),
(258, 11, 'Coihaique'),
(259, 11, 'Lago Verde'),
(260, 11, 'Aisén'),
(261, 11, 'Cisnes'),
(262, 11, 'Guaitecas'),
(263, 11, 'Cochrane'),
(264, 11, 'O Higgins'),
(265, 11, 'Tortel'),
(266, 11, 'Chile Chico'),
(267, 11, 'Río Ibáñez'),
(268, 12, 'Punta Arenas'),
(269, 12, 'Laguna Blanca'),
(270, 12, 'Río Verde'),
(271, 12, 'San Gregorio'),
(272, 12, 'Cabo de Hornos'),
(273, 12, 'Antártica'),
(274, 12, 'Porvenir'),
(275, 12, 'Primavera'),
(276, 12, 'Timaukel'),
(277, 12, 'Natales'),
(278, 12, 'Torres del Paine'),
(279, 13, 'Santiago'),
(280, 13, 'Cerrillos'),
(281, 13, 'Cerro Navia'),
(282, 13, 'Conchalí'),
(283, 13, 'El Bosque'),
(284, 13, 'Estación Central'),
(285, 13, 'Huechuraba'),
(286, 13, 'Independencia'),
(287, 13, 'La Cisterna'),
(288, 13, 'La Florida'),
(289, 13, 'La Granja'),
(290, 13, 'La Pintana'),
(291, 13, 'La Reina'),
(292, 13, 'Las Condes'),
(293, 13, 'Lo Barnechea'),
(294, 13, 'Lo Espejo'),
(295, 13, 'Lo Prado'),
(296, 13, 'Macul'),
(297, 13, 'Maipú'),
(298, 13, 'Ñuñoa'),
(299, 13, 'Pedro Aguirre Cerda'),
(300, 13, 'Peñalolén'),
(301, 13, 'Providencia'),
(302, 13, 'Pudahuel'),
(303, 13, 'Quilicura'),
(304, 13, 'Quinta Normal'),
(305, 13, 'Recoleta'),
(306, 13, 'Renca'),
(307, 13, 'San Joaquín'),
(308, 13, 'San Miguel'),
(309, 13, 'San Ramón'),
(310, 13, 'Vitacura'),
(311, 13, 'Puente Alto'),
(312, 13, 'Pirque'),
(313, 13, 'San José de Maipo'),
(314, 13, 'Colina'),
(315, 13, 'Lampa'),
(316, 13, 'Tiltil'),
(317, 13, 'San Bernardo'),
(318, 13, 'Buin'),
(319, 13, 'Calera de Tango'),
(320, 13, 'Paine'),
(321, 13, 'Melipilla'),
(322, 13, 'Alhué'),
(323, 13, 'Curacaví'),
(324, 13, 'María Pinto'),
(325, 13, 'San Pedro'),
(326, 13, 'Talagante'),
(327, 13, 'El Monte'),
(328, 13, 'Isla de Maipo'),
(329, 13, 'Padre Hurtado'),
(330, 13, 'Peñaflor'),
(331, 14, 'Valdivia'),
(332, 14, 'Corral'),
(333, 14, 'Futrono'),
(334, 14, 'La Unión'),
(335, 14, 'Lago Ranco'),
(336, 14, 'Lanco'),
(337, 14, 'Los Lagos'),
(338, 14, 'Máfil'),
(339, 14, 'Mariquina'),
(340, 14, 'Paillaco'),
(341, 14, 'Panguipulli'),
(342, 14, 'Río Bueno'),
(343, 15, 'Arica'),
(344, 15, 'Camarones'),
(345, 15, 'Putre'),
(346, 15, 'General Lagos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_geo_pais`
--

CREATE TABLE `viga_geo_pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_geo_pais`
--

INSERT INTO `viga_geo_pais` (`id`, `nombre`) VALUES
(1, 'Chile'),
(2, 'Argentina'),
(3, 'Perú'),
(4, 'Bolivia'),
(5, 'Brasil'),
(6, 'Paraguay'),
(7, 'Uruguay'),
(8, 'Colombia'),
(9, 'Ecuador'),
(10, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_geo_region`
--

CREATE TABLE `viga_geo_region` (
  `id` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_geo_region`
--

INSERT INTO `viga_geo_region` (`id`, `id_pais`, `nombre`) VALUES
(1, 1, 'Región de Tarapacá'),
(2, 1, 'Región de Antofagasta'),
(3, 1, 'Región de Atacama'),
(4, 1, 'Región de Coquimbo'),
(5, 1, 'Región de Valparaíso'),
(6, 1, 'Región del Libertador General Bernardo O\'Higgins'),
(7, 1, 'Región del Maule'),
(8, 1, 'Región del Bio Bio'),
(9, 1, 'Región de la Araucanía'),
(10, 1, 'Región de Los Lagos'),
(11, 1, 'Región de Aysén del General Carlos Ibañez del Campo'),
(12, 1, 'Región de Magallanes y de la Antártica Chilena'),
(13, 1, 'Región Metropolitana de Santiago'),
(14, 1, 'Región de Los Ríos'),
(15, 1, 'Región de Arica y Parinacota'),
(16, 1, 'Región de Ñuble');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_evidencias`
--

CREATE TABLE `viga_iniciativas_evidencias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `archivo` varchar(500) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan`
--

CREATE TABLE `viga_iniciativas_plan` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL DEFAULT '',
  `fecha_inicio` varchar(100) NOT NULL,
  `fecha_fin` varchar(100) DEFAULT '',
  `responsable` varchar(100) NOT NULL DEFAULT '',
  `responsable_cargo` varchar(100) NOT NULL DEFAULT '',
  `formato_implementacion` varchar(100) NOT NULL DEFAULT '',
  `objetivo` text NOT NULL,
  `descripcion` text NOT NULL,
  `id_mecanismo` int(11) NOT NULL DEFAULT '0',
  `id_actividad` int(11) NOT NULL DEFAULT '0',
  `id_frecuencia` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(100) NOT NULL DEFAULT '',
  `estado_ejecucion` varchar(100) NOT NULL DEFAULT '',
  `estado_completitud` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_carrera`
--

CREATE TABLE `viga_iniciativas_plan_carrera` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_convenio`
--

CREATE TABLE `viga_iniciativas_plan_convenio` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_entorno`
--

CREATE TABLE `viga_iniciativas_plan_entorno` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_entorno` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_entornodetalle`
--

CREATE TABLE `viga_iniciativas_plan_entornodetalle` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_entornosub`
--

CREATE TABLE `viga_iniciativas_plan_entornosub` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_entornosub` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_entornosubdetalle`
--

CREATE TABLE `viga_iniciativas_plan_entornosubdetalle` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_entorno` int(11) NOT NULL,
  `id_entornosub` int(11) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_entorno_entornosub_detalle`
--

CREATE TABLE `viga_iniciativas_plan_entorno_entornosub_detalle` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_entorno` int(11) NOT NULL,
  `id_entorno_sub` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL DEFAULT '',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_facultad`
--

CREATE TABLE `viga_iniciativas_plan_facultad` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_facultad` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_geocomuna`
--

CREATE TABLE `viga_iniciativas_plan_geocomuna` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_geopais`
--

CREATE TABLE `viga_iniciativas_plan_geopais` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_georegion`
--

CREATE TABLE `viga_iniciativas_plan_georegion` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_region` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_impacto`
--

CREATE TABLE `viga_iniciativas_plan_impacto` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `impacto` varchar(1000) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_impactoexterno`
--

CREATE TABLE `viga_iniciativas_plan_impactoexterno` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_impacto` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_impactointerno`
--

CREATE TABLE `viga_iniciativas_plan_impactointerno` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_impacto` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_ods`
--

CREATE TABLE `viga_iniciativas_plan_ods` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_objetivo` int(11) NOT NULL,
  `id_meta` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_programa`
--

CREATE TABLE `viga_iniciativas_plan_programa` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_programasecundario`
--

CREATE TABLE `viga_iniciativas_plan_programasecundario` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_recursodinero`
--

CREATE TABLE `viga_iniciativas_plan_recursodinero` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `fuente` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `valorizacion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_recursohumano`
--

CREATE TABLE `viga_iniciativas_plan_recursohumano` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `fuente` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `valorizacion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_recursoinfraestructura`
--

CREATE TABLE `viga_iniciativas_plan_recursoinfraestructura` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `fuente` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `valorizacion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_resultado`
--

CREATE TABLE `viga_iniciativas_plan_resultado` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `resultado` varchar(1000) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_sede`
--

CREATE TABLE `viga_iniciativas_plan_sede` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_unidad`
--

CREATE TABLE `viga_iniciativas_plan_unidad` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_iniciativas_plan_unidad_sub`
--

CREATE TABLE `viga_iniciativas_plan_unidad_sub` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_unidad_sub` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_lista_asistencia`
--

CREATE TABLE `viga_lista_asistencia` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `rut` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_logs`
--

CREATE TABLE `viga_logs` (
  `id` int(11) NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `recurso` varchar(100) NOT NULL DEFAULT '',
  `id_recurso` int(11) NOT NULL,
  `descripcion` text,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_metas`
--

CREATE TABLE `viga_metas` (
  `id` varchar(11) NOT NULL,
  `nombre` text NOT NULL,
  `concepto_pertinente` text NOT NULL,
  `factor` decimal(10,5) NOT NULL,
  `id_objetivo` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_metas`
--

INSERT INTO `viga_metas` (`id`, `nombre`, `concepto_pertinente`, `factor`, `id_objetivo`, `visible`, `fecha_creacion`) VALUES
('1.1', 'Para 2030, erradicar la pobreza extrema para todas las personas en el mundo, actualmente medida por un ingreso por persona inferior a 1,25 dólares de los Estados Unidos al día', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('1.2', 'Para 2030, reducir al menos a la mitad la proporción de hombres, mujeres y niños de todas las edades que viven en la pobreza en todas sus dimensiones con arreglo a las definiciones nacionales', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('1.3', 'Poner en práctica a nivel nacional sistemas y medidas apropiadas de protección social para todos, incluidos niveles mínimos, y, para 2030, lograr una amplia cobertura de los pobres y los vulnerables', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('1.4', 'Para 2030, garantizar que todos los hombres y mujeres, en particular los pobres y los vulnerables, tengan los mismos derechos a los recursos económicos, así como acceso a los servicios básicos, la propiedad y el control de las tierras y otros bienes, la herencia, los recursos naturales, las nuevas tecnologías apropiadas y los servicios financieros, incluida la microfinanciación', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('1.5', 'Para 2030, fomentar la resiliencia de los pobres y las personas que se encuentran en situaciones vulnerables y reducir su exposición y vulnerabilidad a los fenómenos extremos relacionados con el clima y otras crisis y desastres económicos, sociales y ambientales', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('1.a', 'Garantizar una movilización importante de recursos procedentes de diversas fuentes, incluso mediante la mejora de la cooperación para el desarrollo, a fin de proporcionar medios suficientes y previsibles a los países en desarrollo, en particular los países menos adelantados, para poner en práctica programas y políticas encaminados a poner fin a la pobreza en todas sus dimensiones', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('1.b', 'Crear marcos normativos sólidos en los planos nacional, regional e internacional, sobre la base de estrategias de desarrollo en favor de los pobres que tengan en cuenta las cuestiones de género, a fin de apoyar la inversión acelerada en medidas para erradicar la pobreza', '', '0.14000', 1, 1, '2019-06-04 19:07:21'),
('10.1', 'De aquí a 2030, lograr progresivamente y mantener el crecimiento de los ingresos del 40% más pobre de la población a una tasa superior a la media nacional', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.2', 'De aquí a 2030, potenciar y promover la inclusión social, económica y política de todas las personas, independientemente de su edad, sexo, discapacidad, raza, etnia, origen, religión o situación económica u otra condición', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.3', 'Garantizar la igualdad de oportunidades y reducir la desigualdad de resultados, incluso eliminando las leyes, políticas y prácticas discriminatorias y promoviendo legislaciones, políticas y medidas adecuadas a ese respecto', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.4', 'Adoptar políticas, especialmente fiscales, salariales y de protección social, y lograr progresivamente una mayor igualdad', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.5', 'Mejorar la reglamentación y vigilancia de las instituciones y los mercados financieros mundiales y fortalecer la aplicación de esos reglamentos', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.6', 'Asegurar una mayor representación e intervención de los países en desarrollo en las decisiones adoptadas por las instituciones económicas y financieras internacionales para aumentar la eficacia, fiabilidad, rendición de cuentas y legitimidad de esas instituciones', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.7', 'Facilitar la migración y la movilidad ordenadas, seguras, regulares y responsables de las personas, incluso mediante la aplicación de políticas migratorias planificadas y bien gestionadas', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.a', 'Aplicar el principio del trato especial y diferenciado para los países en desarrollo, en particular los países menos adelantados, de conformidad con los acuerdos de la Organización Mundial del Comercio', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.b', 'Fomentar la asistencia oficial para el desarrollo y las corrientes financieras, incluida la inversión extranjera directa, para los Estados con mayores necesidades, en particular los países menos adelantados, los países africanos, los pequeños Estados insulares en desarrollo y los países en desarrollo sin litoral, en consonancia con sus planes y programas nacionales', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('10.c', 'De aquí a 2030, reducir a menos del 3% los costos de transacción de las remesas de los migrantes y eliminar los corredores de remesas con un costo superior al 5%', '', '0.10000', 10, 1, '2019-06-04 19:07:21'),
('11.1', 'De aquí a 2030, asegurar el acceso de todas las personas a viviendas y servicios básicos adecuados, seguros y asequibles y mejorar los barrios marginales', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.2', 'De aquí a 2030, proporcionar acceso a sistemas de transporte seguros, asequibles, accesibles y sostenibles para todos y mejorar la seguridad vial, en particular mediante la ampliación del transporte público, prestando especial atención a las necesidades de las personas en situación de vulnerabilidad, las mujeres, los niños, las personas con discapacidad y las personas de edad', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.3', 'De aquí a 2030, aumentar la urbanización inclusiva y sostenible y la capacidad para la planificación y la gestión participativas, integradas y sostenibles de los asentamientos humanos en todos los países', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.4', 'Redoblar los esfuerzos para proteger y salvaguardar el patrimonio cultural y natural del mundo', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.5', 'De aquí a 2030, reducir significativamente el número de muertes causadas por los desastres, incluidos los relacionados con el agua, y de personas afectadas por ellos, y reducir considerablemente las pérdidas económicas directas provocadas por los desastres en comparación con el producto interno bruto mundial, haciendo especial hincapié en la protección de los pobres y las personas en situaciones de vulnerabilidad', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.6', 'De aquí a 2030, reducir el impacto ambiental negativo per capita de las ciudades, incluso prestando especial atención a la calidad del aire y la gestión de los desechos municipales y de otro tipo', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.7', 'De aquí a 2030, proporcionar acceso universal a zonas verdes y espacios públicos seguros, inclusivos y accesibles, en particular para las mujeres y los niños, las personas de edad y las personas con discapacidad', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.a', 'Apoyar los vínculos económicos, sociales y ambientales positivos entre las zonas urbanas, periurbanas y rurales fortaleciendo la planificación del desarrollo nacional y regional', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.b', 'De aquí a 2020, aumentar considerablemente el número de ciudades y asentamientos humanos que adoptan e implementan políticas y planes integrados para promover la inclusión, el uso eficiente de los recursos, la mitigación del cambio climático y la adaptación a él y la resiliencia ante los desastres, y desarrollar y poner en práctica, en consonancia con el Marco de Sendai para la Reducción del Riesgo de Desastres 2015-2030, la gestión integral de los riesgos de desastre a todos los niveles', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('11.c', 'Proporcionar apoyo a los países menos adelantados, incluso mediante asistencia financiera y técnica, para que puedan construir edificios sostenibles y resilientes utilizando materiales locales', '', '0.10000', 11, 1, '2019-06-04 19:07:21'),
('12.1', 'Aplicar el Marco Decenal de Programas sobre Modalidades de Consumo y Producción Sostenibles, con la participación de todos los países y bajo el liderazgo de los países desarrollados, teniendo en cuenta el grado de desarrollo y las capacidades de los países en desarrollo', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.2', 'De aquí a 2030, lograr la gestión sostenible y el uso eficiente de los recursos naturales', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.3', 'De aquí a 2030, reducir a la mitad el desperdicio de alimentos per capita mundial en la venta al por menor y a nivel de los consumidores y reducir las pérdidas de alimentos en las cadenas de producción y suministro, incluidas las pérdidas posteriores a la cosecha', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.4', 'De aquí a 2020, lograr la gestión ecológicamente racional de los productos químicos y de todos los desechos a lo largo de su ciclo de vida, de conformidad con los marcos internacionales convenidos, y reducir significativamente su liberación a la atmósfera, el agua y el suelo a fin de minimizar sus efectos adversos en la salud humana y el medio ambiente', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.5', 'De aquí a 2030, reducir considerablemente la generación de desechos mediante actividades de prevención, reducción, reciclado y reutilización', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.6', 'Alentar a las empresas, en especial las grandes empresas y las empresas transnacionales, a que adopten prácticas sostenibles e incorporen información sobre la sostenibilidad en su ciclo de presentación de informes', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.7', 'Promover prácticas de adquisición pública que sean sostenibles, de conformidad con las políticas y prioridades nacionales', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.8', 'De aquí a 2030, asegurar que las personas de todo el mundo tengan la información y los conocimientos pertinentes para el desarrollo sostenible y los estilos de vida en armonía con la naturaleza', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.a', 'Ayudar a los países en desarrollo a fortalecer su capacidad científica y tecnológica para avanzar hacia modalidades de consumo y producción más sostenibles', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.b', 'Elaborar y aplicar instrumentos para vigilar los efectos en el desarrollo sostenible, a fin de lograr un turismo sostenible que cree puestos de trabajo y promueva la cultura y los productos locales', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('12.c', 'Racionalizar los subsidios ineficientes a los combustibles fósiles que fomentan el consumo antieconómico eliminando las distorsiones del mercado, de acuerdo con las circunstancias nacionales, incluso mediante la reestructuración de los sistemas tributarios y la eliminación gradual de los subsidios perjudiciales, cuando existan, para reflejar su impacto ambiental, teniendo plenamente en cuenta las necesidades y condiciones específicas de los países en desarrollo y minimizando los posibles efectos adversos en su desarrollo, de manera que se proteja a los pobres y a las comunidades afectadas', '', '0.09000', 12, 1, '2019-06-04 19:07:21'),
('13.1', 'Fortalecer la resiliencia y la capacidad de adaptación a los riesgos relacionados con el clima y los desastres naturales en todos los países', '', '0.20000', 13, 1, '2019-06-04 19:07:21'),
('13.2', 'Incorporar medidas relativas al cambio climático en las políticas, estrategias y planes nacionales', '', '0.20000', 13, 1, '2019-06-04 19:07:21'),
('13.3', 'Mejorar la educación, la sensibilización y la capacidad humana e institucional respecto de la mitigación del cambio climático, la adaptación a él, la reducción de sus efectos y la alerta temprana', '', '0.20000', 13, 1, '2019-06-04 19:07:21'),
('13.a', 'Cumplir el compromiso de los países desarrollados que son partes en la Convención Marco de las Naciones Unidas sobre el Cambio Climático de lograr para el año 2020 el objetivo de movilizar conjuntamente 100.000 millones de dólares anuales procedentes de todas las fuentes a fin de atender las necesidades de los países en desarrollo respecto de la adopción de medidas concretas de mitigación y la transparencia de su aplicación, y poner en pleno funcionamiento el Fondo Verde para el Clima capitalizándolo lo antes posible', '', '0.20000', 13, 1, '2019-06-04 19:07:21'),
('13.b', 'Promover mecanismos para aumentar la capacidad para la planificación y gestión eficaces en relación con el cambio climático en los países menos adelantados y los pequeños Estados insulares en desarrollo, haciendo particular hincapié en las mujeres, los jóvenes y las comunidades locales y marginadas', '', '0.20000', 13, 1, '2019-06-04 19:07:21'),
('14.1', 'De aquí a 2025, prevenir y reducir significativamente la contaminación marina de todo tipo, en particular la producida por actividades realizadas en tierra, incluidos los detritos marinos y la polución por nutrientes', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.2', 'De aquí a 2020, gestionar y proteger sosteniblemente los ecosistemas marinos y costeros para evitar efectos adversos importantes, incluso fortaleciendo su resiliencia, y adoptar medidas para restaurarlos a fin de restablecer la salud y la productividad de los océanos', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.3', 'Minimizar y abordar los efectos de la acidificación de los océanos, incluso mediante una mayor cooperación científica a todos los niveles', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.4', 'De aquí a 2020, reglamentar eficazmente la explotación pesquera y poner fin a la pesca excesiva, la pesca ilegal, no declarada y no reglamentada y las prácticas pesqueras destructivas, y aplicar planes de gestión con fundamento científico a fin de restablecer las poblaciones de peces en el plazo más breve posible, al menos alcanzando niveles que puedan producir el máximo rendimiento sostenible de acuerdo con sus características biológicas', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.5', 'De aquí a 2020, conservar al menos el 10% de las zonas costeras y marinas, de conformidad con las leyes nacionales y el derecho internacional y sobre la base de la mejor información científica disponible', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.6', 'De aquí a 2020, prohibir ciertas formas de subvenciones a la pesca que contribuyen a la sobrecapacidad y la pesca excesiva, eliminar las subvenciones que contribuyen a la pesca ilegal, no declarada y no reglamentada y abstenerse de introducir nuevas subvenciones de esa índole, reconociendo que la negociación sobre las subvenciones a la pesca en el marco de la Organización Mundial del Comercio debe incluir un trato especial y diferenciado, apropiado y efectivo para los países en desarrollo y los países menos adelantados', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.7', 'De aquí a 2030, aumentar los beneficios económicos que los pequeños Estados insulares en desarrollo y los países menos adelantados obtienen del uso sostenible de los recursos marinos, en particular mediante la gestión sostenible de la pesca, la acuicultura y el turismo', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.a', 'Aumentar los conocimientos científicos, desarrollar la capacidad de investigación y transferir tecnología marina, teniendo en cuenta los Criterios y Directrices para la Transferencia de Tecnología Marina de la Comisión Oceanográfica Intergubernamental, a fin de mejorar la salud de los océanos y potenciar la contribución de la biodiversidad marina al desarrollo de los países en desarrollo, en particular los pequeños Estados insulares en desarrollo y los países menos adelantados', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.b', 'Facilitar el acceso de los pescadores artesanales a los recursos marinos y los mercados', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('14.c', 'Mejorar la conservación y el uso sostenible de los océanos y sus recursos aplicando el derecho internacional reflejado en la Convención de las Naciones Unidas sobre el Derecho del Mar, que constituye el marco jurídico para la conservación y la utilización sostenible de los océanos y sus recursos, como se recuerda en el párrafo 158 del documento “El futuro que queremos”', '', '0.10000', 14, 1, '2019-06-04 19:07:21'),
('15.1', 'Para 2020, velar por la conservación, el restablecimiento y el uso sostenible de los ecosistemas terrestres y los ecosistemas interiores de agua dulce y los servicios que proporcionan, en particular los bosques, los humedales, las montañas y las zonas áridas, en consonancia con las obligaciones contraídas en virtud de acuerdos internacionales', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.2', 'Para 2020, promover la gestión sostenible de todos los tipos de bosques, poner fin a la deforestación, recuperar los bosques degradados e incrementar la forestación y la reforestación a nivel mundial', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.3', 'Para 2030, luchar contra la desertificación, rehabilitar las tierras y los suelos degradados, incluidas las tierras afectadas por la desertificación, la sequía y las inundaciones, y procurar lograr un mundo con una degradación neutra del suelo', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.4', 'Para 2030, velar por la conservación de los ecosistemas montañosos, incluida su diversidad biológica, a fin de mejorar su capacidad de proporcionar beneficios esenciales para el desarrollo sostenible', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.5', 'Adoptar medidas urgentes y significativas para reducir la degradación de los hábitats naturales, detener la pérdida de la diversidad biológica y, para 2020, proteger las especies amenazadas y evitar su extinción', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.6', 'Promover la participación justa y equitativa en los beneficios que se deriven de la utilización de los recursos genéticos y promover el acceso adecuado a esos recursos, como se ha convenido internacionalmente', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.7', 'Adoptar medidas urgentes para poner fin a la caza furtiva y el tráfico de especies protegidas de flora y fauna y abordar la demanda y la oferta ilegales de productos silvestres', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.8', 'Para 2020, adoptar medidas para prevenir la introducción de especies exóticas invasoras y reducir de forma significativa sus efectos en los ecosistemas terrestres y acuáticos y controlar o erradicar las especies prioritarias', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.9', 'Para 2020, integrar los valores de los ecosistemas y la diversidad biológica en la planificación nacional y local, los procesos de desarrollo, las estrategias de reducción de la pobreza y la contabilidad', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.a', 'Movilizar y aumentar de manera significativa los recursos financieros procedentes de todas las fuentes para conservar y utilizar de forma sostenible la diversidad biológica y los ecosistemas', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.b', 'Movilizar un volumen apreciable de recursos procedentes de todas las fuentes y a todos los niveles para financiar la gestión forestal sostenible y proporcionar incentivos adecuados a los países en desarrollo para que promuevan dicha gestión, en particular con miras a la conservación y la reforestación', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('15.c', 'Aumentar el apoyo mundial a la lucha contra la caza furtiva y el tráfico de especies protegidas, en particular aumentando la capacidad de las comunidades locales para promover oportunidades de subsistencia sostenibles', '', '0.08000', 15, 1, '2019-06-04 19:07:21'),
('16.1', 'Reducir significativamente todas las formas de violencia y las correspondientes tasas de mortalidad en todo el mundo', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.10', 'Garantizar el acceso público a la información y proteger las libertades fundamentales, de conformidad con las leyes nacionales y los acuerdos internacionales', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.2', 'Poner fin al maltrato, la explotación, la trata y todas las formas de violencia y tortura contra los niños', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.3', 'Promover el estado de derecho en los planos nacional e internacional y garantizar la igualdad de acceso a la justicia para todos', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.4', 'De aquí a 2030, reducir significativamente las corrientes financieras y de armas ilícitas, fortalecer la recuperación y devolución de los activos robados y luchar contra todas las formas de delincuencia organizada', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.5', 'Reducir considerablemente la corrupción y el soborno en todas sus formas', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.6', 'Crear a todos los niveles instituciones eficaces y transparentes que rindan cuentas', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.7', 'Garantizar la adopción en todos los niveles de decisiones inclusivas, participativas y representativas que respondan a las necesidades', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.8', 'Ampliar y fortalecer la participación de los países en desarrollo en las instituciones de gobernanza mundial', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.9', 'De aquí a 2030, proporcionar acceso a una identidad jurídica para todos, en particular mediante el registro de nacimientos', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.a', 'Fortalecer las instituciones nacionales pertinentes, incluso mediante la cooperación internacional, para crear a todos los niveles, particularmente en los países en desarrollo, la capacidad de prevenir la violencia y combatir el terrorismo y la delincuencia', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('16.b', 'Promover y aplicar leyes y políticas no discriminatorias en favor del desarrollo sostenible', '', '0.08000', 16, 1, '2019-06-04 19:07:21'),
('17.1', 'Finanzas - Fortalecer la movilización de recursos internos, incluso mediante la prestación de apoyo internacional a los países en desarrollo, con el fin de mejorar la capacidad nacional para recaudar ingresos fiscales y de otra índole', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.10', 'Comercio - Promover un sistema de comercio multilateral universal, basado en normas, abierto, no discriminatorio y equitativo en el marco de la Organización Mundial del Comercio, incluso mediante la conclusión de las negociaciones en el marco del Programa de Doha para el Desarrollo', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.11', 'Comercio - Aumentar significativamente las exportaciones de los países en desarrollo, en particular con miras a duplicar la participación de los países menos adelantados en las exportaciones mundiales de aquí a 2020', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.12', 'Comercio - Lograr la consecución oportuna del acceso a los mercados libre de derechos y contingentes de manera duradera para todos los países menos adelantados, conforme a las decisiones de la Organización Mundial del Comercio, incluso velando por que las normas de origen preferenciales aplicables a las importaciones de los países menos adelantados sean transparentes y sencillas y contribuyan a facilitar el acceso a los mercados', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.13', 'Cuestiones sistémicas (Coherencia normativa e institucional) - Aumentar la estabilidad macroeconómica mundial, incluso mediante la coordinación y coherencia de las políticas', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.14', 'Cuestiones sistémicas (Coherencia normativa e institucional) - Mejorar la coherencia de las políticas para el desarrollo sostenible', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.15', 'Cuestiones sistémicas (Coherencia normativa e institucional) - Respetar el margen normativo y el liderazgo de cada país para establecer y aplicar políticas de erradicación de la pobreza y desarrollo sostenible', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.16', 'Cuestiones sistémicas (Alianzas entre múltiples interesados) - Mejorar la Alianza Mundial para el Desarrollo Sostenible, complementada por alianzas entre múltiples interesados que movilicen e intercambien conocimientos, especialización, tecnología y recursos financieros, a fin de apoyar el logro de los Objetivos de Desarrollo Sostenible en todos los países, particularmente los países en desarrollo', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.17', 'Cuestiones sistémicas (Alianzas entre múltiples interesados) - Fomentar y promover la constitución de alianzas eficaces en las esferas pública, público-privada y de la sociedad civil, aprovechando la experiencia y las estrategias de obtención de recursos de las alianzas', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.18', 'Cuestiones sistémicas (Datos, supervisión y rendición de cuentas) - De aquí a 2020, mejorar el apoyo a la creación de capacidad prestado a los países en desarrollo, incluidos los países menos adelantados y los pequeños Estados insulares en desarrollo, para aumentar significativamente la disponibilidad de datos oportunos, fiables y de gran calidad desglosados por ingresos, sexo, edad, raza, origen étnico, estatus migratorio, discapacidad, ubicación geográfica y otras características pertinentes en los contextos nacionales', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.19', 'Cuestiones sistémicas (Datos, supervisión y rendición de cuentas) - De aquí a 2030, aprovechar las iniciativas existentes para elaborar indicadores\r\nque permitan medir los progresos en materia de desarrollo sostenible y complementen el producto interno bruto, y apoyar la creación de capacidad estadística en los países en desarrollo', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.2', 'Finanzas - Velar por que los países desarrollados cumplan plenamente sus compromisos en relación con la asistencia oficial para el desarrollo, incluido el compromiso de numerosos países desarrollados de alcanzar el objetivo de destinar el 0,7% del ingreso nacional bruto a la asistencia oficial para el desarrollo de los países en desarrollo y entre el 0,15% y el 0,20% del ingreso nacional bruto a la asistencia oficial para el desarrollo de los países menos adelantados; se alienta a los proveedores de asistencia oficial para el desarrollo a que consideren la posibilidad de fijar una meta para destinar al menos el 0,20% del ingreso nacional bruto a la asistencia oficial para el desarrollo de los países menos adelantados', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.3', 'Finanzas - Movilizar recursos financieros adicionales de múltiples fuentes para los países en desarrollo', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.4', 'Finanzas - Ayudar a los países en desarrollo a lograr la sostenibilidad de la deuda a largo plazo con políticas coordinadas orientadas a fomentar la financiación, el alivio y la reestructuración de la deuda, según proceda, y hacer frente a la deuda externa de los países pobres muy endeudados a fin de reducir el endeudamiento excesivo', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.5', 'Finanzas - Adoptar y aplicar sistemas de promoción de las inversiones en favor de los países menos adelantados', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.6', 'Tecnología - Mejorar la cooperación regional e internacional Norte-Sur, Sur-Sur y triangular en materia de ciencia, tecnología e innovación y el acceso a estas, y aumentar el intercambio de conocimientos en condiciones mutuamente convenidas, incluso mejorando la coordinación entre los mecanismos existentes, en particular a nivel de las Naciones Unidas, y mediante un mecanismo mundial de facilitación de la tecnología', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.7', 'Tecnología - Promover el desarrollo de tecnologías ecológicamente racionales y su transferencia, divulgación y difusión a los países en desarrollo en condiciones favorables, incluso en condiciones concesionarias y preferenciales, según lo convenido de mutuo acuerdo', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.8', 'Tecnología - Poner en pleno funcionamiento, a más tardar en 2017, el banco de tecnología y el mecanismo de apoyo a la creación de capacidad en materia de ciencia, tecnología e innovación para los países menos adelantados y aumentar la utilización de tecnologías instrumentales, en particular la tecnología de la información y las comunicaciones', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('17.9', 'Creación de capacidad - Aumentar el apoyo internacional para realizar actividades de creación de capacidad eficaces y específicas en los países en desarrollo a fin de respaldar los planes nacionales de implementación de todos los Objetivos de Desarrollo Sostenible, incluso mediante la cooperación Norte-Sur, Sur-Sur y triangular', '', '0.05000', 17, 1, '2019-06-04 19:07:21'),
('2.1', 'Para 2030, poner fin al hambre y asegurar el acceso de todas las personas, en particular los pobres y las personas en situaciones vulnerables, incluidos los lactantes, a una alimentación sana, nutritiva y suficiente durante todo el año', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.2', 'Para 2030, poner fin a todas las formas de malnutrición, incluso logrando, a más tardar en 2025, las metas convenidas internacionalmente sobre el retraso del crecimiento y la emaciación de los niños menores de 5 años, y abordar las necesidades de nutrición de las adolescentes, las mujeres embarazadas y lactantes y las personas de edad', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.3', 'Para 2030, duplicar la productividad agrícola y los ingresos de los productores de alimentos en pequeña escala, en particular las mujeres, los pueblos indígenas, los agricultores familiares, los pastores y los pescadores, entre otras cosas mediante un acceso seguro y equitativo a las tierras, a otros recursos de producción e insumos, conocimientos, servicios financieros, mercados y oportunidades para la generación de valor añadido y empleos no agrícolas', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.4', 'Para 2030, asegurar la sostenibilidad de los sistemas de producción de alimentos y aplicar prácticas agrícolas resilientes que aumenten la productividad y la producción, contribuyan al mantenimiento de los ecosistemas, fortalezcan la capacidad de adaptación al cambio climático, los fenómenos meteorológicos extremos, las sequías, las inundaciones y otros desastres, y mejoren progresivamente la calidad del suelo y la tierra', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.5', 'Para 2020, mantener la diversidad genética de las semillas, las plantas cultivadas y los animales de granja y domesticados y sus especies silvestres conexas, entre otras cosas mediante una buena gestión y diversificación de los bancos de semillas y plantas a nivel nacional, regional e internacional, y promover el acceso a los beneficios que se deriven de la utilización de los recursos genéticos y los conocimientos tradicionales y su distribución justa y equitativa, como se ha convenido internacionalmente', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.a', 'Aumentar las inversiones, incluso mediante una mayor cooperación internacional, en la infraestructura rural, la investigación agrícola y los servicios de extensión, el desarrollo tecnológico y los bancos de genes de plantas y ganado a fin de mejorar la capacidad de producción agrícola en los países en desarrollo, en particular en los países menos adelantados', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.b', 'Corregir y prevenir las restricciones y distorsiones comerciales en los mercados agropecuarios mundiales, entre otras cosas mediante la eliminación paralela de todas las formas de subvenciones a las exportaciones agrícolas y todas las medidas de exportación con efectos equivalentes, de conformidad con el mandato de la Ronda de Doha para el Desarrollo', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('2.c', 'Adoptar medidas para asegurar el buen funcionamiento de los mercados de productos básicos alimentarios y sus derivados y facilitar el acceso oportuno a información sobre los mercados, en particular sobre las reservas de alimentos, a fin de ayudar a limitar la extrema volatilidad de los precios de los alimentos', '', '0.13000', 2, 1, '2019-06-04 19:07:21'),
('3.1', 'Para 2030, reducir la tasa mundial de mortalidad materna a menos de 70 por cada 100.000 nacidos vivos', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.2', 'Para 2030, poner fin a las muertes evitables de recién nacidos y de niños menores de 5 años, logrando que todos los países intenten reducir la mortalidad neonatal al menos hasta 12 por cada 1.000 nacidos vivos, y la mortalidad de niños menores de 5 años al menos hasta 25 por cada 1.000 nacidos vivos', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.3', 'Para 2030, poner fin a las epidemias del SIDA, la tuberculosis, la malaria y las enfermedades tropicales desatendidas y combatir la hepatitis, las enfermedades transmitidas por el agua y otras enfermedades transmisibles', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.4', 'Para 2030, reducir en un tercio la mortalidad prematura por enfermedades no transmisibles mediante la prevención y el tratamiento y promover la salud mental y el bienestar', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.5', 'Fortalecer la prevención y el tratamiento del abuso de sustancias adictivas, incluido el uso indebido de estupefacientes y el consumo nocivo de alcohol', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.6', 'Para 2020, reducir a la mitad el número de muertes y lesiones causadas por accidentes de tráfico en el mundo', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.7', 'Para 2030, garantizar el acceso universal a los servicios de salud sexual y reproductiva, incluidos los de planificación de la familia, información y educación, y la integración de la salud reproductiva en las estrategias y los programas nacionales', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.8', 'Lograr la cobertura sanitaria universal, en particular la protección contra los riesgos financieros, el acceso a servicios de salud esenciales de calidad y el acceso a medicamentos y vacunas seguros, eficaces, asequibles y de calidad para todos', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.9', 'Para 2030, reducir sustancialmente el número de muertes y enfermedades producidas por productos químicos peligrosos y la contaminación del aire, el agua y el suelo', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.a', 'Fortalecer la aplicación del Convenio Marco de la Organización Mundial de la Salud para el Control del Tabaco en todos los países, según proceda', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.b', 'Apoyar las actividades de investigación y desarrollo de vacunas y medicamentos para las enfermedades transmisibles y no transmisibles que afectan primordialmente a los países en desarrollo y facilitar el acceso a medicamentos y vacunas esenciales asequibles de conformidad con la Declaración de Doha relativa al Acuerdo sobre los ADPIC y la Salud Pública, en la que se afirma el derecho de los países en desarrollo a utilizar al máximo las disposiciones del Acuerdo sobre los Aspectos de los Derechos de Propiedad Intelectual Relacionados con el Comercio en lo relativo a la flexibilidad para proteger la salud pública y, en particular, proporcionar acceso a los medicamentos para todos', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.c', 'Aumentar sustancialmente la financiación de la salud y la contratación, el desarrollo, la capacitación y la retención del personal sanitario en los países en desarrollo, especialmente en los países menos adelantados y los pequeños Estados insulares en desarrollo', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('3.d', 'Reforzar la capacidad de todos los países, en particular los países en desarrollo, en materia de alerta temprana, reducción de riesgos y gestión de los riesgos para la salud nacional y mundial', '', '0.08000', 3, 1, '2019-06-04 19:07:21'),
('4.1', 'De aquí a 2030, asegurar que todas las niñas y todos los niños terminen la enseñanza primaria y secundaria, que ha de ser gratuita, equitativa y de calidad y producir resultados de aprendizaje pertinentes y efectivos', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.2', 'De aquí a 2030, asegurar que todas las niñas y todos los niños tengan acceso a servicios de atención y desarrollo en la primera infancia y educación preescolar de calidad, a fin de que estén preparados para la enseñanza primaria', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.3', 'De aquí a 2030, asegurar el acceso igualitario de todos los hombres y las mujeres a una formación técnica, profesional y superior de calidad, incluida la enseñanza universitaria', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.4', 'De aquí a 2030, aumentar considerablemente el número de jóvenes y adultos que tienen las competencias necesarias, en particular técnicas y profesionales, para acceder al empleo, el trabajo decente y el emprendimiento', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.5', 'De aquí a 2030, eliminar las disparidades de género en la educación y asegurar el acceso igualitario a todos los niveles de la enseñanza y la formación profesional para las personas vulnerables, incluidas las personas con discapacidad, los pueblos indígenas y los niños en situaciones de vulnerabilidad', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.6', 'De aquí a 2030, asegurar que todos los jóvenes y una proporción considerable de los adultos, tanto hombres como mujeres, estén alfabetizados y tengan nociones elementales de aritmética', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.7', 'De aquí a 2030, asegurar que todos los alumnos adquieran los conocimientos teóricos y prácticos necesarios para promover el desarrollo sostenible, entre otras cosas mediante la educación para el desarrollo sostenible y los estilos de vida sostenibles, los derechos humanos, la igualdad de género, la promoción de una cultura de paz y no violencia, la ciudadanía mundial y la valoración de la diversidad cultural y la contribución de la cultura al desarrollo sostenible', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.a', 'Construir y adecuar instalaciones educativas que tengan en cuenta las necesidades de los niños y las personas con discapacidad y las diferencias de género, y que ofrezcan entornos de aprendizaje seguros, no violentos, inclusivos y eficaces para todos', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.b', 'De aquí a 2020, aumentar considerablemente a nivel mundial el número de becas disponibles para los países en desarrollo, en particular los países menos adelantados, los pequeños Estados insulares en desarrollo y los países africanos, a fin de que sus estudiantes puedan matricularse en programas de enseñanza superior, incluidos programas de formación profesional y programas técnicos, científicos, de ingeniería y de tecnología de la información y las comunicaciones, de países desarrollados y otros países en desarrollo', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('4.c', 'De aquí a 2030, aumentar considerablemente la oferta de docentes calificados, incluso mediante la cooperación internacional para la formación de docentes en los países en desarrollo, especialmente los países menos adelantados y los pequeños Estados insulares en desarrollo', '', '0.10000', 4, 1, '2019-06-04 19:07:21'),
('5.1', 'Poner fin a todas las formas de discriminación contra todas las mujeres y las niñas en todo el mundo', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.2', 'Eliminar todas las formas de violencia contra todas las mujeres y las niñas en los ámbitos público y privado, incluidas la trata y la explotación sexual y otros tipos de explotación', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.3', 'Eliminar todas las prácticas nocivas, como el matrimonio infantil, precoz y forzado y la mutilación genital femenina', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.4', 'Reconocer y valorar los cuidados y el trabajo doméstico no remunerados mediante servicios públicos, infraestructuras y políticas de protección social, y promoviendo la responsabilidad compartida en el hogar y la familia, según proceda en cada país', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.5', 'Asegurar la participación plena y efectiva de las mujeres y la igualdad de oportunidades de liderazgo a todos los niveles decisorios en la vida política, económica y pública', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.6', 'Asegurar el acceso universal a la salud sexual y reproductiva y los derechos reproductivos según lo acordado de conformidad con el Programa de Acción de la Conferencia Internacional sobre la Población y el Desarrollo, la Plataforma de Acción de Beijing y los documentos finales de sus conferencias de examen', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.a', 'Emprender reformas que otorguen a las mujeres igualdad de derechos a los recursos económicos, así como acceso a la propiedad y al control de la tierra y otros tipos de bienes, los servicios financieros, la herencia y los recursos naturales, de conformidad con las leyes nacionales', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.b', 'Mejorar el uso de la tecnología instrumental, en particular la tecnología de la información y las comunicaciones, para promover el empoderamiento de las mujeres', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('5.c', 'Aprobar y fortalecer políticas acertadas y leyes aplicables para promover la igualdad de género y el empoderamiento de todas las mujeres y las niñas a todos los niveles', '', '0.11000', 5, 1, '2019-06-04 19:07:21'),
('6.1', 'De aquí a 2030, lograr el acceso universal y equitativo al agua potable a un precio asequible para todos', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.2', 'De aquí a 2030, lograr el acceso a servicios de saneamiento e higiene adecuados y equitativos para todos y poner fin a la defecación al aire libre, prestando especial atención a las necesidades de las mujeres y las niñas y las personas en situaciones de vulnerabilidad', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.3', 'De aquí a 2030, mejorar la calidad del agua reduciendo la contaminación, eliminando el vertimiento y minimizando la emisión de productos químicos y materiales peligrosos, reduciendo a la mitad el porcentaje de aguas residuales sin tratar y aumentando considerablemente el reciclado y la reutilización sin riesgos a nivel mundial', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.4', 'De aquí a 2030, aumentar considerablemente el uso eficiente de los recursos hídricos en todos los sectores y asegurar la sostenibilidad de la extracción y el abastecimiento de agua dulce para hacer frente a la escasez de agua y reducir considerablemente el número de personas que sufren falta de agua', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.5', 'De aquí a 2030, implementar la gestión integrada de los recursos hídricos a todos los niveles, incluso mediante la cooperación transfronteriza, según proceda', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.6', 'De aquí a 2020, proteger y restablecer los ecosistemas relacionados con el agua, incluidos los bosques, las montañas, los humedales, los ríos, los acuíferos y los lagos', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.a', 'De aquí a 2030, ampliar la cooperación internacional y el apoyo prestado a los países en desarrollo para la creación de capacidad en actividades y programas relativos al agua y el saneamiento, como los de captación de agua, desalinización, uso eficiente de los recursos hídricos, tratamiento de aguas residuales, reciclado y tecnologías de reutilización', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('6.b', 'Apoyar y fortalecer la participación de las comunidades locales en la mejora de la gestión del agua y el saneamiento', '', '0.13000', 6, 1, '2019-06-04 19:07:21'),
('7.1', 'De aquí a 2030, garantizar el acceso universal a servicios energéticos asequibles, fiables y modernos', '', '0.20000', 7, 1, '2019-06-04 19:07:21'),
('7.2', 'De aquí a 2030, aumentar considerablemente la proporción de energía renovable en el conjunto de fuentes energéticas', '', '0.20000', 7, 1, '2019-06-04 19:07:21'),
('7.3', 'De aquí a 2030, duplicar la tasa mundial de mejora de la eficiencia energética', '', '0.20000', 7, 1, '2019-06-04 19:07:21'),
('7.a', 'De aquí a 2030, aumentar la cooperación internacional para facilitar el acceso a la investigación y la tecnología relativas a la energía limpia, incluidas las fuentes renovables, la eficiencia energética y las tecnologías avanzadas y menos contaminantes de combustibles fósiles, y promover la inversión en infraestructura energética y tecnologías limpias', '', '0.20000', 7, 1, '2019-06-04 19:07:21'),
('7.b', 'De aquí a 2030, ampliar la infraestructura y mejorar la tecnología para prestar servicios energéticos modernos y sostenibles para todos en los países en desarrollo, en particular los países menos adelantados, los pequeños Estados insulares en desarrollo y los países en desarrollo sin litoral, en consonancia con sus respectivos programas de apoyo', '', '0.20000', 7, 1, '2019-06-04 19:07:21'),
('8.1', 'Mantener el crecimiento económico per capita de conformidad con las circunstancias nacionales y, en particular, un crecimiento del producto interno bruto de al menos el 7% anual en los países menos adelantados', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.10', 'Fortalecer la capacidad de las instituciones financieras nacionales para fomentar y ampliar el acceso a los servicios bancarios, financieros y de seguros para todos', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.2', 'Lograr niveles más elevados de productividad económica mediante la diversificación, la modernización tecnológica y la innovación, entre otras cosas centrándose en los sectores con gran valor añadido y un uso intensivo de la mano de obra', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.3', 'Promover políticas orientadas al desarrollo que apoyen las actividades productivas, la creación de puestos de trabajo decentes, el emprendimiento, la creatividad y la innovación, y fomentar la formalización y el crecimiento de las microempresas y las pequeñas y medianas empresas, incluso mediante el acceso a servicios financieros', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.4', 'Mejorar progresivamente, de aquí a 2030, la producción y el consumo eficientes de los recursos mundiales y procurar desvincular el crecimiento económico de la degradación del medio ambiente, conforme al Marco Decenal de Programas sobre modalidades de Consumo y Producción Sostenibles, empezando por los países desarrollados', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.5', 'De aquí a 2030, lograr el empleo pleno y productivo y el trabajo decente para todas las mujeres y los hombres, incluidos los jóvenes y las personas con discapacidad, así como la igualdad de remuneración por trabajo de igual valor', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.6', 'De aquí a 2020, reducir considerablemente la proporción de jóvenes que no están empleados y no cursan estudios ni reciben capacitación', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.7', 'Adoptar medidas inmediatas y eficaces para erradicar el trabajo forzoso, poner fin a las formas contemporáneas de esclavitud y la trata de personas y asegurar la prohibición y eliminación de las peores formas de trabajo infantil, incluidos el reclutamiento y la utilización de niños soldados, y, de aquí a 2025, poner fin al trabajo infantil en todas sus formas', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.8', 'Proteger los derechos laborales y promover un entorno de trabajo seguro y sin riesgos para todos los trabajadores, incluidos los trabajadores migrantes, en particular las mujeres migrantes y las personas con empleos precarios', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.9', 'De aquí a 2030, elaborar y poner en práctica políticas encaminadas a promover un turismo sostenible que cree puestos de trabajo y promueva la cultura y los productos locales', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.a', 'Aumentar el apoyo a la iniciativa de ayuda para el comercio en los países en desarrollo, en particular los países menos adelantados, incluso mediante el Marco Integrado Mejorado para la Asistencia Técnica a los Países Menos Adelantados en Materia de Comercio', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('8.b', 'De aquí a 2020, desarrollar y poner en marcha una estrategia mundial para el empleo de los jóvenes y aplicar el Pacto Mundial para el Empleo de la Organización Internacional del Trabajo', '', '0.08000', 8, 1, '2019-06-04 19:07:21'),
('9.1', 'Desarrollar infraestructuras fiables, sostenibles, resilientes y de calidad, incluidas infraestructuras regionales y transfronterizas, para apoyar el desarrollo económico y el bienestar humano, haciendo especial hincapié en el acceso asequible y equitativo para todos', '', '0.13000', 9, 1, '2019-06-04 19:07:21'),
('9.2', 'Promover una industrialización inclusiva y sostenible y, de aquí a 2030, aumentar significativamente la contribución de la industria al empleo y al producto interno bruto, de acuerdo con las circunstancias nacionales, y duplicar esa contribución en los países menos adelantados', '', '0.13000', 9, 1, '2019-06-04 19:07:21'),
('9.3', 'Aumentar el acceso de las pequeñas industrias y otras empresas, particularmente en los países en desarrollo, a los servicios financieros, incluidos créditos asequibles, y su integración en las cadenas de valor y los mercados', '', '0.13000', 9, 1, '2019-06-04 19:07:21');
INSERT INTO `viga_metas` (`id`, `nombre`, `concepto_pertinente`, `factor`, `id_objetivo`, `visible`, `fecha_creacion`) VALUES
('9.4', 'De aquí a 2030, modernizar la infraestructura y reconvertir las industrias para que sean sostenibles, utilizando los recursos con mayor eficacia y promoviendo la adopción de tecnologías y procesos industriales limpios y ambientalmente racionales, y logrando que todos los países tomen medidas de acuerdo con sus capacidades respectivas', '', '0.13000', 9, 1, '2019-06-04 19:07:21'),
('9.5', 'Aumentar la investigación científica y mejorar la capacidad tecnológica de los sectores industriales de todos los países, en particular los países en desarrollo, entre otras cosas fomentando la innovación y aumentando considerablemente, de aquí a 2030, el número de personas que trabajan en investigación y desarrollo por millón de habitantes y los gastos de los sectores público y privado en investigación y desarrollo', '', '0.13000', 9, 1, '2019-06-04 19:07:21'),
('9.a', 'Facilitar el desarrollo de infraestructuras sostenibles y resilientes en los países en desarrollo mediante un mayor apoyo financiero, tecnológico y técnico a los países africanos, los países menos adelantados, los países en desarrollo sin litoral y los pequeños Estados insulares en desarrollo', '', '0.13000', 9, 1, '2019-06-04 19:07:21'),
('9.b', 'Apoyar el desarrollo de tecnologías, la investigación y la innovación nacionales en los países en desarrollo, incluso garantizando un entorno normativo propicio a la diversificación industrial y la adición de valor a los productos básicos, entre otras cosas', '', '0.13000', 9, 1, '2019-06-04 19:07:21'),
('9.c', 'Aumentar significativamente el acceso a la tecnología de la información y las comunicaciones y esforzarse por proporcionar acceso universal y asequible a Internet en los países menos adelantados de aquí a 2020', '', '0.13000', 9, 1, '2019-06-04 19:07:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_objetivos`
--

CREATE TABLE `viga_objetivos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_largo` text NOT NULL,
  `descripcion` text NOT NULL,
  `descripcion_larga` text NOT NULL,
  `id_ambito` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_objetivos`
--

INSERT INTO `viga_objetivos` (`id`, `nombre`, `nombre_largo`, `descripcion`, `descripcion_larga`, `id_ambito`, `visible`, `fecha_creacion`) VALUES
(1, 'Fin de la pobreza', 'Poner fin a la pobreza en todas sus formas en todo el mundo', 'Poner fin a la pobreza en todas sus formas en todo el mundo.', 'Pese a que la tasa de pobreza mundial se ha reducido a la mitad desde el año 2000, en las regiones en desarrollo aún una de cada diez personas, y sus familias, sigue subsistiendo con 1,90 dólares diarios y hay millones más que ganan poco más que esta cantidad diaria. Se han logrado avances significativos en muchos países del Asia oriental y sudoriental, pero casi el 42% de la población del África Subsahariana continúa viviendo por debajo del umbral de la pobreza.<br><br>La pobreza va más allá de la falta de ingresos y recursos para garantizar unos medios de vida sostenibles. La pobreza es un problema de derechos humanos. Entre las distintas manifestaciones de la pobreza figuran el hambre, la malnutrición, la falta de una vivienda digna y el acceso limitado a otros servicios básicos como la educación o la salud. También se encuentran la discriminación y la exclusión social, que incluye la ausencia de la participación de los pobres en la adopción de decisiones, especialmente de aquellas que les afectan.<br><br>Para lograr este Objetivo de acabar con la pobreza, el crecimiento económico debe ser inclusivo, con el fin de crear empleos sostenibles y de promover la igualdad. Los sistemas de protección social deben aplicarse para mitigar los riesgos de los países propensos a sufrir desastres y brindar apoyo para enfrentarse a las dificultades económicas. Estos sistemas ayudarán a fortalecer las respuestas de las poblaciones afectadas ante pérdidas económicas inesperadas durante los desastres y, finalmente, ayudarán a erradicar la pobreza extrema en las zonas más empobrecidas.', '1', 1, '2019-09-30 10:39:38'),
(2, 'Hambre cero', 'Poner fin al hambre, lograr la seguridad alimentaria y la mejora de la nutrición y promover la agricultura sostenible', 'Poner fin al hambre, lograr la seguridad alimentaria y la mejora de la nutrición y promover la agricultura sostenible.', 'El sector alimentario y el sector agrícola ofrecen soluciones claves para el desarrollo y son vitales para la eliminación del hambre y la pobreza. Gestionadas de forma adecuada, la agricultura, la silvicultura y la acuicultura pueden suministrar comida nutritiva a todo el planeta, así como generar ingresos decentes, apoyar el desarrollo centrado en las personas del campo y proteger el medio ambiente.<br><br>Pero ahora mismo, nuestros suelos, océanos, bosques y nuestra agua potable y biodiversidad están sufriendo un rápido proceso de degradación debido a procesos de sobreexplotación.<br><br>A esto se añade el cambio climático, que repercute sobre los recursos de los que dependemos y aumenta los riesgos asociados a los desastres naturales tales como las sequías y las inundaciones. Muchas campesinas y campesinos ya no pueden ganarse la vida en las tierras que trabajan, lo que les obliga a emigrar a las ciudades en busca de oportunidades.<br><br>Necesitamos una profunda reforma del sistema agrario y alimentario mundial si queremos nutrir a los 815 millones de hambrientos que existen actualmente en el planeta y a los dos mil millones de personas adicionales que vivirán en el año 2050.<br><br>Las inversiones en agricultura son cruciales para aumentar la capacidad productiva agrícola y los sistemas de producción alimentaria sostenibles son necesarios para ayudar a mitigar las dificultades del hambre.', '1', 1, '2019-09-30 10:53:05'),
(3, 'Salud y Bienestar', 'Garantizar una vida sana y promover el bienestar para todos en todas las edades', 'Garantizar la vida saludable y promover el bienestar para todos a cualquier edad.', 'Para lograr los Objetivos de Desarrollo Sostenible es fundamental garantizar una vida saludable y promover el bienestar universal. <br><br> Sin embargo, en muchas regiones se enfrentan a graves riesgos para la salud, como altas tasas de mortalidad materna y neonatal, la propagación de enfermedades infecciosas y no transmisibles y una mala salud reproductiva. En las últimas décadas, se han obtenido grandes avances en relación con el aumento de la esperanza de vida y la reducción de algunas de las causas de muerte más comunes relacionadas con la mortalidad infantil y materna, pero para lograr la meta de este Objetivo, que establece que en 2030 haya menos de 70 fallecimientos, se deberá mejorar la asistencia cualificada en los partos. Asimismo, para alcanzar el objetivo de reducir las muertes prematuras por enfermedades no transmisibles en un tercio para 2030 se requerirá aplicar tecnologías más eficaces de combustibles limpios para cocinar y educación sobre los riesgos del tabaco. <br><br> Se necesitan muchas más iniciativas para erradicar por completo una amplia gama de enfermedades y para hacer frente a numerosas y variadas cuestiones persistentes y emergentes relativas a la salud. Si nos centramos en proporcionar una financiación más eficiente de los sistemas de salud, mejorar el saneamiento y la higiene, aumentar el acceso a los servicios médicos y proveer más consejos sobre cómo reducir la contaminación ambiental, lograremos progresos significativos en ayudar a salvar las vidas de millones de personas.', '1', 1, '2019-09-30 10:53:18'),
(4, 'Educación de calidad', 'Garantizar una educación inclusiva, equitativa y de calidad y promover oportunidades de aprendizaje durante toda la vida para todos', 'Garantizar una educación inclusiva, equitativa y de calidad y promover oportunidades de aprendizaje durante toda la vida para todos.', 'La educación es la base para mejorar nuestra vida y el desarrollo sostenible. Además de mejorar la calidad de vida de las personas, el acceso a la educación inclusiva y equitativa puede ayudar abastecer a la población local con las herramientas necesarias para desarrollar soluciones innovadoras a los problemas más grandes del mundo. <br><br> En la actualidad, más de 265 millones de niños y niñas no están escolarizados y el 22% de estos están en edad de asistir a la escuela primaria. Asimismo, los niños que asisten a la escuela carecen de los conocimientos básicos de lectura y aritmética. En la última decada, se han producido importantes avances con relación a la mejora de su acceso a todos los niveles y con el aumento  en las tasas de escolarización, sobre todo, en el caso de las mujeres y las niñas. También se ha mejorado en gran medida el nivel mínimo de alfabetización. Sin embargo, es necesario redoblar los esfuerzos para conseguir mayores avances para alcanzar los objetivos de la educación universal. Por ejemplo, el mundo ha alcanzado la igualdad entre niños y niñas en la educación primaria, pero pocos países han logrado sus objetivos en todos los niveles educativos. <br><br> Las razones de la falta de una educación de calidad son la escasez de profesores capacitados y las malas condiciones de las escuelas de muchas zonas del mundo y las cuestiones de equidad relacionadas con las oportunidades que tienen niños y niñas de zonas rurales. Para que se brinde educación de calidad a los niños de familias empobrecidas, se necesita invertir en becas educativas, talleres de formación para docentes, construcción de escuelas y una mejora del acceso al agua y electricidad en las escuelas.', '1,3,5,6', 1, '2019-09-30 10:53:28'),
(5, 'Igualdad de género', 'Lograr la igualdad entre los géneros y empoderar a todas las mujeres y las niñas', 'Lograr la igualdad entre los géneros y empoderar a todas las mujeres y las niñas.', 'Si bien entre 2000 y 2015 se produjeron avances a nivel mundial con relación a la igualdad entre los géneros gracias a los Objetivos de Desarrollo del Milenio (incluida la igualdad de acceso a la enseñanza primaria), las mujeres y las niñas siguen sufriendo la discriminación y la violencia en todos los lugares del mundo. <br><br> La igualdad entre los géneros no es solo un derecho humano fundamental, sino la base necesaria para conseguir un mundo pacífico, próspero y sostenible. Lamentablemente, en la actualidad, 1 de cada 5 mujeres y niñas entre 15 y 49 años de edad afirmaron haber experimentado violencia física o sexual, o ambas, en manos de su pareja en los 12 meses anteriores a ser preguntadas sobre este asunto. Además, 49 países no tienen leyes que protejan a las mujeres de la violencia doméstica. Asimimso, aunque se ha avanzado a la hora de proteger a las mujeres y niñas de prácticas nocivas como el matrimonio infantil y la mutilación genital femenina (MGF), que ha disminuido en un 30% en la última década, aún queda mucho trabajo por hacer para acabar con esas prácticas. <br><br> Si se facilita la igualdad a las mujeres y niñas en el acceso a la educación, a la atención médica, a un trabajo decente, y una representación en los procesos de adopción de decisiones políticas y económicas, se estarán impulsando las economías sostenibles y las sociedades y la humanidad en su conjunto se beneficiarán al mismo tiempo. <br><br> Estableciendo nuevos marcos legales sobre la igualdad de las mujeres en el lugar de trabajo y la erradicación de las prácticas nocivas sobre las mujeres es crucial para acabar con la discriminación basada en el género que prevalece en muchos países del mundo.', '1', 1, '2019-09-30 10:53:39'),
(6, 'Agua limpia y saneamiento', 'Garantizar la disponibilidad de agua y su gestión sostenible y el saneamiento para todos', 'Garantizar la disponibilidad de agua y su gestión sostenible y el saneamiento para todos.', 'El agua libre de impurezas y accesible para todos es parte esencial del mundo en que queremos vivir. Hay suficiente agua dulce en el planeta para lograr este sueño. Sin embargo, actualmente el reparto del agua no es el adecuado y para el año 2050 se espera que al menos un 25% de la población mundial viva en un país afectado por escasez crónica y reiterada de agua dulce. La sequía afecta a algunos de los países más pobres del mundo, recrudece el hambre y la desnutrición. <br><br> Esa escasez de recursos hídricos, junto con la mala calidad del agua y el saneamiento inadecuado repercuten en la seguridad alimentaria, los medios de subsistencia y la oportunidad de educación para las familias pobres en todo el mundo. Afortunadamente, se han hecho algunos avances en la última década y más del 90% de la población mundial tiene acceso a fuentes de agua potable mejoradas. <br><br> Para mejorar el acceso a agua apta para el consumo y al saneamiento, y la gestión racional de los ecosistemas de agua dulce entre las comunidades locales en varios países en desarrollo del África Subsahariana, Asia Central, Asia Meridional, Asia Oriental y Asia Sudoriental.', '1,6', 1, '2019-09-30 10:53:51'),
(7, 'Energía asequible y no contaminante', 'Garantizar el acceso a una energía asequible, segura, sostenible y moderna para todos', 'Garantizar el acceso a una energía asequible, segura, sostenible y moderna para todos.', 'La energía es fundamental para casi todos los grandes desafíos y oportunidades a los que hace frente el mundo actualmente. Ya sea para el empleo, la seguridad, el cambio climático, la producción de alimentos o para aumentar los ingresos. El acceso universal a la energía es esencial. <br><br> Trabajar para alcanzar las metas de este objetivo es especialmente importante ya que afecta directamente en la consecución de otros objetivos de desarrollo sostenible. Es vital apoyar nuevas iniciativas económicas y laborales que aseguren el acceso universal a los servicios de energía modernos, mejoren el rendimiento energético y aumenten el uso de fuentes renovables para crear comunidades más sostenibles e inclusivas y para la resiliencia ante problemas ambientales como el cambio climático. <br><br> El acceso a tecnologías y combustibles menos contaminantes para cocinar aumentó al 57,4% en 2014, poco más que el 56,5% registrado en 2012. Más de 3000 millones de personas, la mayoría de Asia y África Subsahariana, todavía cocinan con combustibles muy contaminantes y tecnologías poco eficientes. <br><br> En la actualidad, más de 3000 millones de personas, el 50% de ellas de África Subsahariana, todavía cocinan con combustibles muy contaminantes y tecnologías poco eficientes. Afortunadamente, la situación ha mejorado en la última década: la proporción de la energía renovable ha aumentado respecto al consumo final de energía gracias al uso de fuentes de energía como la hidroeléctrica, la solar y la eólica, y la proporción de energía utilizada por unidad de PIB también está disminuyendo. <br><br> Sin embargo, el avance en todos los ámbitos de la energía sostenible no está a la altura de lo que se necesita para lograr su acceso universal y alcanzar las metas de este Objetivo. Se debe aumentar el uso de energía renovable en sectores como el de la calefacción y el transporte. Asimismo, son necesarias las inversiones públicas y privadas en energía; así como mayores niveles de financiación y políticas con compromisos más audaces, además de la buena disposición de los países para adoptar nuevas tecnologías en una escala mucho más amplia.', '6', 1, '2019-09-30 10:44:00'),
(8, 'Trabajo decente y crecimiento económico', 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos', 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos.', 'Aproximadamente la mitad de la población mundial todavía vive con el equivalente a unos 2 dólares estadounidenses diarios, con una tasa mundial de desempleo del 5.7%, y en muchos lugares el hecho de tener un empleo no garantiza la capacidad para escapar de la pobreza. Debemos reflexionar sobre este progreso lento y desigual, y revisar nuestras políticas económicas y sociales destinadas a erradicar la pobreza. <br><br> La continua falta de oportunidades de trabajo decente, la insuficiente inversión y el bajo consumo producen una erosión del contrato social básico subyacente en las sociedades democráticas: el derecho de todos a compartir el progreso. La creación de empleos de calidad sigue constituyendo un gran desafío para casi todas las economías. <br><br> Aunque la tasa media de crecimiento anual del PIB real per cápita en todo el mundo va en aumento año tras año, todavía hay muchos países menos adelantados en los que las tasas de crecimiento están desacelerando y lejos de alcanzar la tasa del 7% establecida para 2030. La disminución de la productividad laboral y aumento de las tasas de desempleo influyen negativamente en el nivel de vida y los salarios. <br><br> Para conseguir el desarrollo económico sostenible, las sociedades deberán crear las condiciones necesarias para que las personas accedan a empleos de calidad, estimulando la economía sin dañar el medio ambiente. También tendrá que haber oportunidades laborales para toda la población en edad de trabajar, con condiciones de trabajo decentes. Asimismo, el aumento de la productividad laboral, la reducción de la tasa de desempleo, especialmente entre los jóvenes, y la mejora del acceso a los servicios financieros para gestionar los ingresos, acumular activos y realizar inversiones productivas son componentes esenciales de un crecimiento económico sostenido e inclusivo. El aumento de los compromisos con el comercio, la banca y la infraestructura agrícola también ayudará a aumentar la productividad y a reducir los niveles de desempleo en las regiones más empobrecidas del mundo.', '2', 1, '2019-09-30 10:44:47'),
(9, 'Industria, innovación e infraestructura', 'Industria, innovación e infraestructura', 'Construir infraestructuras resilientes, promover la industrialización inclusiva y sostenible y fomentar la innovación.', 'Desde hace tiempo se reconoce que para conseguir una economía robusta se necesitan inversiones en infraestructura (transporte, regadío, energía, tecnología de la información y las comunicaciones). Estas son fundamentales para lograr un desarrollo sostenible, empoderar a las  sociedades de numerosos países, fomentar una mayor estabilidad social y conseguir ciudades más resistentes al cambio climático. <br><br> El sector manufacturero es un impulsor importante del desarrollo económico y del empleo. En la actualidad, sin embargo, el valor agregado de la industralización per cápita es solo de 100 dólares en los países menos desarrollados en comparación con más de 4500 dólares en Europa y América del Norte. Otro factor importante a considerar es la emisión de dióxido de carbono durante los procesos de fabricación. Las emisiones han disminuido en la última década en muchos países, pero esta disminución no ha sido uniforme en todo el mundo. <br><br> El progreso tecnológico debe estar en la base de los esfuerzos para alcanzar los objetivos medioambientales, como el aumento de los recursos y la eficiencia energética. Sin tecnología e innovación, la industrialización no ocurrirá, y sin industrialización, no habrá desarrollo. Es necesario invertir más en productos de alta tecnología que dominen las producciones manufactureras para aumentar la eficiencia y mejorar los servicios celulares móviles para que las personas puedan conectadas.', '2', 1, '2019-09-30 10:45:42'),
(10, 'Reducción de las desigualdad', 'Reducir la desigualdad en y entre los países', 'Reducir la desigualdad en y entre los países.', 'La comunidad internacional ha logrado grandes avances sacando a las personas de la pobreza. Las naciones más vulnerables —los países menos adelantados, los países en desarrollo sin litoral y los pequeños Estados insulares en desarrollo— continúan avanzando en el ámbito de la reducción de la pobreza. Sin embargo, siguen existiendo desigualdades y grandes disparidades en el acceso a los servicios sanitarios y educativos y a otros bienes productivos. <br><br> Además, a pesar de que la desigualdad de los ingresos entre países ha podido reducirse, dentro de los propios países ha aumentado. Existe un consenso cada vez mayor de que el crecimiento económico no es suficiente para reducir la pobreza si este no es inclusivo ni tiene en cuenta las tres dimensiones del desarrollo sostenible: económica, social y ambiental. Afortunadamente, la desigualdad de ingresos se ha reducido tanto entre países como dentro de ellos. En la actualidad, el ingreso per cápita de 60 de los 94 países de los que se tienen datos ha aumentado más rápidamente que el promedio nacional. También se han logrado algunos progresos en la creación de condiciones de acceso favorables para las exportaciones de los países menos adelantados. <br><br> Con el fin de reducir la desigualdad, se ha recomendado la aplicación de políticas universales que presten también especial atención a las necesidades de las poblaciones desfavorecidas y marginadas. Es necesario que haya un aumento en el trato libre de aranceles y que se continúen favoreciendo las exportaciones de los países en desarrollo, además de aumentar la participación del voto de los países en desarrollo dentro del Fondo Monetario Internacional (FMI). Finalmente, las innovaciones en tecnología pueden ayudar a reducir elevado costo de transferir dinero para los trabajadores migrantes.', '1,2', 1, '2019-09-30 10:46:33'),
(11, 'Ciudades sostenibles', 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles', 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles.', 'Las ciudades son hervideros de ideas, comercio, cultura, ciencia, productividad, desarrollo social y mucho más. En el mejor de los casos, las ciudades han permitido a las personas progresar social y económicamente. En los últimos decenios, el mundo ha experimentado un crecimiento urbano sin precedentes. En 2015, cerca de 4000 millones de personas vivía en ciudades y se prevé que ese número aumente hasta unos 5000 millones para 2030. Se necesita mejorar, por tanto, la planificación y la gestión urbanas para que los espacios urbanos del mundo sean más inclusivos, seguros, resilientes y sostenibles. <br><br> Ahora bien, son muchos los problemas que existen para mantener ciudades de manera que se sigan generando empleos y siendo prósperas sin ejercer presión sobre la tierra y los recursos. Los problemas comunes de las ciudades son la congestión, la falta de fondos para prestar servicios básicos, la falta de políticas apropiadas en materia de tierras y vivienda y el deterioro de la infraestructura. <br><br> Los problemas que enfrentan las ciudades, como la recogida y la gestión seguras de los desechos sólidos, se pueden vencer de manera que les permita seguir prosperando y creciendo, y al mismo tiempo aprovechar mejor los recursos y reducir la contaminación y la pobreza. Un ejemplo de esto es el aumento en los servicios municipales de recogida de desechos. El futuro que queremos incluye ciudades de oportunidades, con acceso a servicios básicos, energía, vivienda, transporte y más facilidades para todos.', '6', 1, '2019-09-30 10:47:21'),
(12, 'Producción y consumo responsable', 'Garantizar modalidades de consumo y producción sostenibles', 'Garantizar modalidades de consumo y producción sostenibles.', 'El consumo y la producción sostenible consisten en fomentar el uso eficiente de los recursos y la energía, la construcción de infraestructuras que no dañen el medio ambiente, la mejora del acceso a los servicios básicos y la creación de empleos ecológicos, justamente remunerados y con buenas condiciones laborales.  Todo ello se traduce en una mejor calidad de vida para todos y, además, ayuda a lograr planes generales de desarrollo, que rebajen costos económicos, ambientales y sociales, que aumenten la competitividad y que reduzcan la pobreza. <br><br> En la actualidad, el consumo de materiales de los recursos naturales está aumentando, particularmente en Asia oriental. Asimismo, los países continúan abordando los desafíos relacionados con la contaminación del aire, el agua y el suelo. El objetivo del consumo y la producción sostenibles es hacer más y mejores cosas con menos recursos. Se trata de crear ganancias netas de las actividades económicas mediante la reducción de la utilización de los recursos, la degradación y la contaminación, logrando al mismo tiempo una mejor calidad de vida. Se necesita, además, adoptar un enfoque sistémico y lograr la cooperación entre los participantes de la cadena de suministro, desde el productor hasta el consumidor final. Consiste en sensibilizar a los consumidores mediante la educación sobre los modos de vida sostenibles, facilitándoles información adecuada a través del etiquetaje y las normas de uso, entre otros.', '2,6', 1, '2019-09-30 10:48:02'),
(13, 'Acción por el clima', 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos', 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.', 'El cambio climático afecta a todos los países en todos los continentes, produciendo un impacto negativo en su economía, la vida de las personas y las comunidades. En un futuro se prevé que las consecuencias serán peores. Los patrones climáticos están cambiando, los niveles del mar están aumentando, los eventos climáticos son cada vez más extremos y las emisiones del gas de efecto invernadero están ahora en los niveles más altos de la historia. Si no actuamos, la temperatura media de la superficie del mundo podría aumentar unos 3 grados centígrados este siglo. Las personas más pobres y vulnerables serán los más perjudicados. <br><br> En la actualidad, tenemos a nuestro alcance soluciones viables para que los países puedan tener una actividad económica más sostenible y más respetuosa con el medio ambiente. El cambio de actitudes se acelera a medida que más personas están recurriendo a la energía renovable y a otras soluciones para reducir las emisiones y aumentar los esfuerzos de adaptación. Pero el cambio climático es un reto global que no respeta las fronteras nacionales. Es un problema que requiere que la comunidad internacional trabaje de forma coordinada y precisa para que los países en desarrollo avancen hacia una economía baja en carbono. <br><br> Para fortalecer la respuesta global a la amenaza del cambio climático, los países adoptaron el Acuerdo de París en la COP21 en París, que entró en vigor en noviembre de 2016. En el acuerdo, todos los países acordaron trabajar para limitar el aumento de la temperatura global a menos de 2 grados centígrados. Usted puede obtener más información sobre el acuerdo aquí. La implementación del Acuerdo de París es esencial para lograr alcanzar los Objetivos de Desarrollo Sostenible, y proporciona una hoja de ruta para acciones climáticas que reducirán las emisiones y crearán la resiliencia climática que el mundo necesita. Usted puede ver qué países han firmado el acuerdo y cuáles han presentado su ratificación. A abril de 2018, 175 Partes han ratificado el Acuerdo de París y 10 países en desarrollo presentaron la primera versión de sus planes nacionales de adaptación, para responder al cambio climático.', '6', 1, '2019-09-30 10:48:52'),
(14, 'Vida submarina', 'Conservar y utilizar en forma sostenible los océanos, los mares y los recursos marinos para el desarrollo sostenible', 'Conservar y utilizar en forma sostenible los océanos, los mares y los recursos marinos para el desarrollo sostenible.', 'Los océanos del mundo —su temperatura, química, corrientes y vida— mueven sistemas que hacen que la Tierra sea habitable para la humanidad. Nuestras precipitaciones, el agua potable, el clima, el tiempo, las costas, gran parte de nuestros alimentos e incluso el oxígeno del aire que respiramos provienen, en última instancia del mar y son regulados por este. Históricamente, los océanos y los mares han sido cauces vitales del comercio y el transporte. <br><br> La gestión prudente de este recurso esencial es una característica clave del futuro sostenible. Sin embargo, en la actualidad, existe un continuo deterioro de las aguas costeras, debido a la contaminación y la acidificación de los océanos, que está teniendo un efecto adverso sobre el funcionamiento de los ecosistemas y la biodiversidad, y que también está afectando negativamente a la pesca de pequeña escala. <br><br> Las áreas marinas protegidas deben ser administradas de manera efectiva, contar con recursos suficientes y regulaciones que ayuden a reducir la sobrepesca, la contaminación marina y la acidificación de los océanos.', '6', 1, '2019-09-30 10:49:34'),
(15, 'Vida de ecosistemas terrestres', 'Gestionar sosteniblemente los bosques, luchar contra la desertificación, detener e invertir la degradación de las tierras y detener la pérdida de biodiversidad', 'Proteger, restablecer y promover el uso sostenible de los ecosistemas terrestres, gestionar los bosques de forma sostenible, luchar contra la desertificación, detener e invertir la degradación de las tierras y poner freno a la pérdida de la diversidad biológica.', 'El 30.7% de la superficie terrestre está cubierta por bosques y estos, además de proporcionar seguridad alimentaria y refugio, son fundamentales para combatir el cambio climático, pues protegen la diversidad biológica y las viviendas de la población indígena. Al proteger los bosques, también podremos fortalecer la gestión de los recursos naturales y aumentar la productividad de la tierra. <br><br> Actualmente, 13 millones de hectáreas de bosque desaparecen cada año y la degradación persistente de las zonas áridas está provocando además la desertificación de 3600 millones de hectáreas. Aunque un 15% de la tierra se encuentra actualmente bajo protección, la biodiversidad aún está en riesgo. La deforestación y la desertificación, provocadas por las actividades humanas y el cambio climático, suponen grandes retos para el desarrollo sostenible y han afectado la vida y los medios de vida de millones de personas en la lucha contra la pobreza. <br><br> A pesar de los grandes desafíos, se están realizando esfuerzos para gestionar los bosques y combatir la desertificación. Actualmente, se están implementando dos acuerdos internacionales que promueven el uso de los recursos de manera equitativa, y también se está realizando inversiones financieras en apoyo de la biodiversidad. <br><br> <strong>El fondo “The Lion’s Share”</strong> <br> El 21 de junio de 2018, el Programa de las Naciones Unidas para el Desarrollo (PNUD), en alianza con Mars y FINCH anunciaron la creación del fondo “The Lion’s Share”, una iniciativa destinada a transformar las vidas de los animales en todo el mundo, pidiendo a las empresas de comunicaciones que contribuyan con un porcentaje de su inversión en medios, destinado a la ejecución de proyectos de conservación y bienestar animal. Esta iniciativa hará que los socios aporten el 0,5 por ciento de su inversión en medios al fondo por cada anuncio que utilicen con un animal. Lo recaudado será utilizado para mantener a los animales y sus hábitats en todo el mundo. Su meta es recaudar US $ 100 millones por año dentro de tres años, dinero que se invertirá en una serie de programas de conservación de la vida silvestre y bienestar animal, para ser implementados por las Naciones Unidas y las organizaciones de la sociedad civil.', '6', 1, '2019-09-30 10:50:42'),
(16, 'Paz, justicia e instituciones sólidas', 'Promover sociedades, justas, pacíficas e inclusivas', 'Promover sociedades pacíficas e inclusivas para el desarrollo sostenible, facilitar el acceso a la justicia para todos y crear instituciones eficaces, responsables e inclusivas a todos los niveles.', 'Las amenazas de homicidio intencional, la violencia contra los niños, la trata de personas y la violencia sexual, son temas importantes que debe ser abordados para crear sociedades pacíficas e inclusivas. Allanan el camino para la provisión de acceso a la justicia para todos y para la construcción de instituciones efectivas y responsables en todos los niveles. <br><br> Si bien los casos de homicidios y trata de personas han experimentado un progreso significativo en la última década, todavía hay miles de personas en mayor riesgo de homicidio intencional en América Latina, el África subsahariana y Asia. Las violaciones de los derechos del niño a través de la agresión y la violencia sexual siguen asolando a muchos países en todo el mundo, especialmente porque la falta de información y la falta de datos agravan el problema. <br><br> Para hacer frente a estos desafíos y construir sociedades más pacíficas e inclusivas, es necesario que se establezcan reglamentaciones más eficientes y transparentes, y presupuestos gubernamentales integrales y realistas. Uno de los primeros pasos a la protección de los derechos individuales es la implementación del registro mundial de nacimientos y la creación de instituciones nacionales de derechos humanos más independientes en todo el mundo.<', '4', 1, '2019-09-30 10:51:23'),
(17, 'Alianzas para lograr los objetivos', 'Revitalizar la Alianza Mundial para el Desarrollo Sostenible', 'Fortalecer los medios de ejecución y revitalizar la Alianza Mundial para el Desarrollo Sostenible', 'Un programa exitoso de desarrollo sostenible requiere alianzas entre los gobiernos, el sector privado y la sociedad civil. Estas alianzas inclusivas construidas sobre principios y valores, una visión compartida, y metas compartidas, que colocan a la gente y al planeta en el centro, son necesarias a nivel global, regional, nacional y local. <br><br> Se han realizado progresos en relación a las alianzas para el financiamiento, especialmente con un aumento de la ayuda dirigida a los refugiados en los países donantes. Sin embargo, se requieren más alianzas para la prestación de servicios fijos masivos, que son aún en la actualidad de costo muy elevado. También hay una falta de censos de población y vivienda, necesarios para obtener datos desglosados que sirvan de base para la implementación de políticas y programas de desarrollo. <br><br> Por otro lado, se necesita una acción urgente para movilizar, redirigir y desbloquear el poder transformador de billones de dólares de los recursos privados para cumplir con los objetivos del desarrollo sostenible. Inversiones a largo plazo, incluida la inversión extranjera directa, son necesarias en sectores críticos, especialmente en los países en desarrollo. Estas incluyen la energía sostenible, la infraestructura y el transporte, así como las tecnologías de la información y las comunicaciones. El sector público tendrá que establecer una dirección clara. La revisión y supervisión de los esquemas de trabajo, los reglamentos y las estructuras de incentivos, que permiten estas inversiones, deben ser repotenciados para atraer nuevas inversiones y fortalecer el desarrollo sostenible. Los mecanismos nacionales de control como las entidades fiscalizadoras superiores y las funciones de supervisión de parte de los órganos legislativos deben también reforzarse.', '4', 1, '2019-09-30 10:52:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_cargo_encargado`
--

CREATE TABLE `viga_param_cargo_encargado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_cargo_encargado`
--

INSERT INTO `viga_param_cargo_encargado` (`id`, `nombre`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Dirección de Vinculación con el Medio', 1, '', '2021-11-04 18:10:37'),
(2, 'Dirección de Formación e Identidad', 1, '', '2021-11-04 18:10:46'),
(3, 'Director de Sede', 1, '', '2021-08-16 14:01:01'),
(4, 'Jefa de Docencia', 1, '', '2021-08-16 14:01:01'),
(5, 'Jefa de Administración y Finanzas', 1, '', '2021-08-16 14:01:01'),
(6, 'Jefe UVE', 1, '', '2021-08-16 14:01:01'),
(7, 'Jefe de Carrera', 1, '', '2021-08-16 14:01:01'),
(8, 'Docente', 1, '', '2021-08-16 14:01:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_estado_completitud`
--

CREATE TABLE `viga_param_estado_completitud` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_estado_completitud`
--

INSERT INTO `viga_param_estado_completitud` (`id`, `nombre`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Bajo', 1, '', '2021-08-16 02:57:49'),
(2, 'Medio', 1, '', '2021-08-16 02:57:49'),
(3, 'Alto', 1, '', '2021-08-16 02:57:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_estado_ejecucion`
--

CREATE TABLE `viga_param_estado_ejecucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_estado_ejecucion`
--

INSERT INTO `viga_param_estado_ejecucion` (`id`, `nombre`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'En ejecución', 1, 'superadmin', '2021-08-16 02:57:17'),
(2, 'A la espera de impactos post ejecución', 1, 'superadmin', '2021-08-16 02:57:19'),
(3, 'Finalizada', 1, 'superadmin', '2021-08-16 02:57:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_formato_implementacion`
--

CREATE TABLE `viga_param_formato_implementacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_formato_implementacion`
--

INSERT INTO `viga_param_formato_implementacion` (`id`, `nombre`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Presencial', 1, 'superadmin', '2021-06-28 03:21:18'),
(2, 'Digital', 1, 'superadmin', '2021-06-28 03:21:18'),
(3, 'Mixto', 1, 'superadmin', '2021-06-28 03:21:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_impacto_externo`
--

CREATE TABLE `viga_param_impacto_externo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_impacto_externo`
--

INSERT INTO `viga_param_impacto_externo` (`id`, `nombre`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Desarrollo de Capital Humano', 1, 'superadmin', '2021-06-30 04:19:52'),
(2, 'Solucionar problemáticas del sector productivo, de servicios y/o desafíos sociales', 1, 'superadmin', '2021-06-30 04:19:52'),
(3, 'Aporte al desarrollo social y calidad de vida de las comunidades', 1, 'superadmin', '2021-06-30 04:19:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_impacto_interno`
--

CREATE TABLE `viga_param_impacto_interno` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_impacto_interno`
--

INSERT INTO `viga_param_impacto_interno` (`id`, `nombre`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Contribución al logro del perfil de egreso', 1, 'superadmin', '2021-06-30 04:21:06'),
(2, 'Asegurar la pertinencia de la oferta educativa', 1, 'superadmin', '2021-06-30 04:21:06'),
(3, 'Promover la empleabilidad (de estudiantes)', 1, 'superadmin', '2021-06-30 04:21:06'),
(4, 'Realización de proyectos e iniciativas que aporten a la innovación, emprendimiento y a la creación de valor', 1, 'superadmin', '2021-06-30 04:21:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_participantes`
--

CREATE TABLE `viga_param_participantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_participantes`
--

INSERT INTO `viga_param_participantes` (`id`, `nombre`, `tipo`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Estudiantes', 'Interno', 1, 'vinculamos_admin', '2019-10-16 14:52:00'),
(2, 'Titulados', 'Externo', 1, 'vinculamos_admin', '2019-10-16 14:52:00'),
(3, 'Docentes', 'Interno', 1, 'vinculamos_admin', '2019-10-16 14:52:00'),
(4, 'Representantes de Pymes', 'Externo', 1, 'vinculamos_admin', '2019-10-16 14:52:00'),
(5, 'Empleadores', 'Externo', 1, 'vinculamos_admin', '2019-10-16 14:52:00'),
(6, 'Emprendedores', 'Externo', 1, 'vinculamos_admin', '2019-10-16 14:52:00'),
(7, 'Público general', 'Externo', 1, 'vinculamos_admin', '2019-10-16 14:52:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_recurso_humano`
--

CREATE TABLE `viga_param_recurso_humano` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_recurso_humano`
--

INSERT INTO `viga_param_recurso_humano` (`id`, `nombre`, `puntaje`, `descripcion`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Funcionario', 20000, '', 1, 'superadmin', '2019-05-23 10:49:05'),
(2, 'Profesional', 30000, '', 1, 'superadmin', '2019-05-23 10:49:05'),
(3, 'Magister', 40000, '', 1, 'superadmin', '2019-06-03 01:36:07'),
(4, 'Doctor', 50000, '', 1, 'superadmin', '2019-06-03 01:36:07'),
(5, 'PhD', 60000, '', 1, 'superadmin', '2019-06-03 01:36:07'),
(6, 'Estudiante', 5000, '', 1, 'superadmin', '2019-05-23 10:49:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_param_recurso_infraestructura`
--

CREATE TABLE `viga_param_recurso_infraestructura` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viga_param_recurso_infraestructura`
--

INSERT INTO `viga_param_recurso_infraestructura` (`id`, `nombre`, `puntaje`, `descripcion`, `visible`, `autor`, `fecha_creacion`) VALUES
(1, 'Sala', 20000, '', 1, 'superadmin', '2019-05-23 06:49:05'),
(2, 'Hall', 30000, '', 1, 'superadmin', '2019-05-23 06:49:05'),
(3, 'Auditorio', 40000, '', 1, 'superadmin', '2019-06-02 21:36:07'),
(4, 'Aula Magna', 50000, '', 1, 'superadmin', '2019-06-02 21:36:07'),
(5, 'Recurso online', 10000, '', 1, 'superadmin', '2019-06-02 21:36:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_participacion_plan`
--

CREATE TABLE `viga_participacion_plan` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `tipo2` varchar(100) NOT NULL DEFAULT '',
  `publico_general` int(11) NOT NULL,
  `aplica_sexo` varchar(100) DEFAULT NULL,
  `sexo_masculino` int(11) NOT NULL,
  `sexo_femenino` int(11) NOT NULL,
  `sexo_otro` int(11) NOT NULL,
  `aplica_edad` varchar(100) DEFAULT NULL,
  `edad_ninos` int(11) NOT NULL,
  `edad_jovenes` int(11) NOT NULL,
  `edad_adultos` int(11) NOT NULL,
  `edad_adultos_mayores` int(11) NOT NULL,
  `aplica_procedencia` varchar(100) DEFAULT NULL,
  `procedencia_rural` int(11) NOT NULL,
  `procedencia_urbano` int(11) NOT NULL,
  `aplica_vulnerabilidad` varchar(100) DEFAULT NULL,
  `vulnerabilidad_pueblo` int(11) NOT NULL,
  `vulnerabilidad_discapacidad` int(11) NOT NULL,
  `vulnerabilidad_pobreza` int(11) NOT NULL,
  `aplica_nacionalidad` varchar(100) DEFAULT NULL,
  `nacionalidad_chileno` int(11) NOT NULL,
  `nacionalidad_migrante` int(11) NOT NULL,
  `nacionalidad_pueblo` int(11) NOT NULL,
  `aplica_etnia` varchar(100) DEFAULT NULL,
  `etnia_mapuche` int(11) NOT NULL,
  `etnia_otro` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_participacion_plan_tag`
--

CREATE TABLE `viga_participacion_plan_tag` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_participacion` int(11) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_participacion_real`
--

CREATE TABLE `viga_participacion_real` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `publico_general` int(11) NOT NULL,
  `aplica_sexo` varchar(100) DEFAULT NULL,
  `sexo_masculino` int(11) NOT NULL,
  `sexo_femenino` int(11) NOT NULL,
  `sexo_otro` int(11) NOT NULL,
  `aplica_edad` varchar(100) DEFAULT NULL,
  `edad_ninos` int(11) NOT NULL,
  `edad_jovenes` int(11) NOT NULL,
  `edad_adultos` int(11) NOT NULL,
  `edad_adultos_mayores` int(11) NOT NULL,
  `aplica_procedencia` varchar(100) DEFAULT NULL,
  `procedencia_rural` int(11) NOT NULL,
  `procedencia_urbano` int(11) NOT NULL,
  `aplica_vulnerabilidad` varchar(100) DEFAULT NULL,
  `vulnerabilidad_pueblo` int(11) NOT NULL,
  `vulnerabilidad_discapacidad` int(11) NOT NULL,
  `vulnerabilidad_pobreza` int(11) NOT NULL,
  `aplica_nacionalidad` varchar(100) DEFAULT NULL,
  `nacionalidad_chileno` int(11) NOT NULL,
  `nacionalidad_migrante` int(11) NOT NULL,
  `nacionalidad_pueblo` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_participacion_real_tag`
--

CREATE TABLE `viga_participacion_real_tag` (
  `id` int(11) NOT NULL,
  `id_iniciativa` int(11) NOT NULL,
  `id_participacion` int(11) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_perfiles`
--

CREATE TABLE `viga_perfiles` (
  `id_perfil` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `institucion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `permiso_usuarios` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `permiso_objetivos` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `permiso_iniciativas` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `permiso_desafios` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `permiso_estadisticas` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `permiso_parametros` varchar(5) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='0: Ningun permiso, crud: Todos los permisos';

--
-- Volcado de datos para la tabla `viga_perfiles`
--

INSERT INTO `viga_perfiles` (`id_perfil`, `nombre`, `institucion`, `permiso_usuarios`, `permiso_objetivos`, `permiso_iniciativas`, `permiso_desafios`, `permiso_estadisticas`, `permiso_parametros`) VALUES
(1, 'Administrador', 'cftpucv', 'crud', 'crud', 'cruds', '0', 'rs', 'crud'),
(2, 'Digitador', 'cftpucv', '0', 'crud', 'cru', '0', '0', '0'),
(3, 'Observador', 'cftpucv', '0', 'r', 'r', '0', 'r', '0'),
(100, 'Super Admin', 'cftpucv', 'crud', 'crud', 'cruds', 'r', 'rs', 'crud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_programas`
--

CREATE TABLE `viga_programas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_sedes`
--

CREATE TABLE `viga_sedes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_unidades`
--

CREATE TABLE `viga_unidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(100) NOT NULL DEFAULT '',
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_unidades_subs`
--

CREATE TABLE `viga_unidades_subs` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(200) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `institucion` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viga_usuarios`
--

CREATE TABLE `viga_usuarios` (
  `nombre_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasenia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `visible` int(11) NOT NULL DEFAULT '1',
  `id_perfil` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `viga_usuarios`
--

INSERT INTO `viga_usuarios` (`nombre_usuario`, `nombre`, `apellido`, `correo_electronico`, `telefono`, `contrasenia`, `estado`, `visible`, `id_perfil`, `fecha_creacion`) VALUES
('vinculamos_digitador', 'Digitador', 'Digitador', '', '', '2213c83bad060c64534be8e7aa4316546401afd02a7d6db9fedde5184404731d', 1, 1, 2, '2021-09-01 18:41:24'),
('vinculamos_observador', 'Observador', 'Observador', '', '', '16e578782b041eb8fb72daed09c8a41069492f2b53e8ce29d74d7780cd5eb318', 1, 1, 3, '2021-08-11 12:30:15'),
('superadmin', 'Super', 'Admin', 'ccontreras@vinculamos.cl', '+56 9 8911 0950', 'a1a81737b054a8e47c2a1e4bc69a1af48216d8dd62515396141c6dbad66dae83', 1, 0, 100, '2021-06-27 17:43:22'),
('vinculamos_admin', 'Administrador', 'Admin', '', '', '92fb5a69c021a21ed5fa9e48fb781908fabd37eb9493f063c0ab1f5d941708e3', 1, 1, 1, '2021-07-06 01:08:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `viga_atributo_frecuencia`
--
ALTER TABLE `viga_atributo_frecuencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_atributo_mecanismo`
--
ALTER TABLE `viga_atributo_mecanismo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_atributo_mecanismo_actividad`
--
ALTER TABLE `viga_atributo_mecanismo_actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_carreras`
--
ALTER TABLE `viga_carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_concepto_pertinente`
--
ALTER TABLE `viga_concepto_pertinente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_convenios`
--
ALTER TABLE `viga_convenios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_convenios_docs`
--
ALTER TABLE `viga_convenios_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_entornos_significativos`
--
ALTER TABLE `viga_entornos_significativos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_entornos_significativos_detalle`
--
ALTER TABLE `viga_entornos_significativos_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_entornos_significativos_sub`
--
ALTER TABLE `viga_entornos_significativos_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_competencias_pregunta`
--
ALTER TABLE `viga_evaluacion_competencias_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_conocimiento_ori_pregunta`
--
ALTER TABLE `viga_evaluacion_conocimiento_ori_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_cumplimiento_ori_pregunta`
--
ALTER TABLE `viga_evaluacion_cumplimiento_ori_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_detalle_respuesta`
--
ALTER TABLE `viga_evaluacion_detalle_respuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_evaluadores`
--
ALTER TABLE `viga_evaluacion_evaluadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_iniciativa`
--
ALTER TABLE `viga_evaluacion_iniciativa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_tipo_compromiso`
--
ALTER TABLE `viga_evaluacion_tipo_compromiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_tipo_evaluador`
--
ALTER TABLE `viga_evaluacion_tipo_evaluador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_evaluacion_tipo_evaluador_config`
--
ALTER TABLE `viga_evaluacion_tipo_evaluador_config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_facultades`
--
ALTER TABLE `viga_facultades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_geo_comuna`
--
ALTER TABLE `viga_geo_comuna`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_geo_pais`
--
ALTER TABLE `viga_geo_pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_geo_region`
--
ALTER TABLE `viga_geo_region`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_evidencias`
--
ALTER TABLE `viga_iniciativas_evidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan`
--
ALTER TABLE `viga_iniciativas_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_carrera`
--
ALTER TABLE `viga_iniciativas_plan_carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_convenio`
--
ALTER TABLE `viga_iniciativas_plan_convenio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_entorno`
--
ALTER TABLE `viga_iniciativas_plan_entorno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_entornodetalle`
--
ALTER TABLE `viga_iniciativas_plan_entornodetalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_entornosub`
--
ALTER TABLE `viga_iniciativas_plan_entornosub`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_entornosubdetalle`
--
ALTER TABLE `viga_iniciativas_plan_entornosubdetalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_entorno_entornosub_detalle`
--
ALTER TABLE `viga_iniciativas_plan_entorno_entornosub_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_facultad`
--
ALTER TABLE `viga_iniciativas_plan_facultad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_geocomuna`
--
ALTER TABLE `viga_iniciativas_plan_geocomuna`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_geopais`
--
ALTER TABLE `viga_iniciativas_plan_geopais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_georegion`
--
ALTER TABLE `viga_iniciativas_plan_georegion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_impacto`
--
ALTER TABLE `viga_iniciativas_plan_impacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_impactoexterno`
--
ALTER TABLE `viga_iniciativas_plan_impactoexterno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_impactointerno`
--
ALTER TABLE `viga_iniciativas_plan_impactointerno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_ods`
--
ALTER TABLE `viga_iniciativas_plan_ods`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_programa`
--
ALTER TABLE `viga_iniciativas_plan_programa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_programasecundario`
--
ALTER TABLE `viga_iniciativas_plan_programasecundario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_recursodinero`
--
ALTER TABLE `viga_iniciativas_plan_recursodinero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_recursohumano`
--
ALTER TABLE `viga_iniciativas_plan_recursohumano`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_recursoinfraestructura`
--
ALTER TABLE `viga_iniciativas_plan_recursoinfraestructura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_resultado`
--
ALTER TABLE `viga_iniciativas_plan_resultado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_sede`
--
ALTER TABLE `viga_iniciativas_plan_sede`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_unidad`
--
ALTER TABLE `viga_iniciativas_plan_unidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_iniciativas_plan_unidad_sub`
--
ALTER TABLE `viga_iniciativas_plan_unidad_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_lista_asistencia`
--
ALTER TABLE `viga_lista_asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_logs`
--
ALTER TABLE `viga_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_metas`
--
ALTER TABLE `viga_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_objetivos`
--
ALTER TABLE `viga_objetivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_cargo_encargado`
--
ALTER TABLE `viga_param_cargo_encargado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_estado_completitud`
--
ALTER TABLE `viga_param_estado_completitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_estado_ejecucion`
--
ALTER TABLE `viga_param_estado_ejecucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_formato_implementacion`
--
ALTER TABLE `viga_param_formato_implementacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_impacto_externo`
--
ALTER TABLE `viga_param_impacto_externo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_impacto_interno`
--
ALTER TABLE `viga_param_impacto_interno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_participantes`
--
ALTER TABLE `viga_param_participantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_recurso_humano`
--
ALTER TABLE `viga_param_recurso_humano`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_param_recurso_infraestructura`
--
ALTER TABLE `viga_param_recurso_infraestructura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_participacion_plan`
--
ALTER TABLE `viga_participacion_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_participacion_plan_tag`
--
ALTER TABLE `viga_participacion_plan_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_participacion_real`
--
ALTER TABLE `viga_participacion_real`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_participacion_real_tag`
--
ALTER TABLE `viga_participacion_real_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_perfiles`
--
ALTER TABLE `viga_perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `viga_programas`
--
ALTER TABLE `viga_programas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_sedes`
--
ALTER TABLE `viga_sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_unidades`
--
ALTER TABLE `viga_unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_unidades_subs`
--
ALTER TABLE `viga_unidades_subs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viga_usuarios`
--
ALTER TABLE `viga_usuarios`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viga_atributo_frecuencia`
--
ALTER TABLE `viga_atributo_frecuencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viga_atributo_mecanismo`
--
ALTER TABLE `viga_atributo_mecanismo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `viga_atributo_mecanismo_actividad`
--
ALTER TABLE `viga_atributo_mecanismo_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_carreras`
--
ALTER TABLE `viga_carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_concepto_pertinente`
--
ALTER TABLE `viga_concepto_pertinente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=879;

--
-- AUTO_INCREMENT de la tabla `viga_convenios`
--
ALTER TABLE `viga_convenios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_convenios_docs`
--
ALTER TABLE `viga_convenios_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_entornos_significativos`
--
ALTER TABLE `viga_entornos_significativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `viga_entornos_significativos_detalle`
--
ALTER TABLE `viga_entornos_significativos_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `viga_entornos_significativos_sub`
--
ALTER TABLE `viga_entornos_significativos_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_competencias_pregunta`
--
ALTER TABLE `viga_evaluacion_competencias_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_conocimiento_ori_pregunta`
--
ALTER TABLE `viga_evaluacion_conocimiento_ori_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_cumplimiento_ori_pregunta`
--
ALTER TABLE `viga_evaluacion_cumplimiento_ori_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_detalle_respuesta`
--
ALTER TABLE `viga_evaluacion_detalle_respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_evaluadores`
--
ALTER TABLE `viga_evaluacion_evaluadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_iniciativa`
--
ALTER TABLE `viga_evaluacion_iniciativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_tipo_compromiso`
--
ALTER TABLE `viga_evaluacion_tipo_compromiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_tipo_evaluador`
--
ALTER TABLE `viga_evaluacion_tipo_evaluador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viga_evaluacion_tipo_evaluador_config`
--
ALTER TABLE `viga_evaluacion_tipo_evaluador_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `viga_facultades`
--
ALTER TABLE `viga_facultades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_geo_comuna`
--
ALTER TABLE `viga_geo_comuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `viga_geo_pais`
--
ALTER TABLE `viga_geo_pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_evidencias`
--
ALTER TABLE `viga_iniciativas_evidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan`
--
ALTER TABLE `viga_iniciativas_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_carrera`
--
ALTER TABLE `viga_iniciativas_plan_carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_convenio`
--
ALTER TABLE `viga_iniciativas_plan_convenio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_entorno`
--
ALTER TABLE `viga_iniciativas_plan_entorno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_entornodetalle`
--
ALTER TABLE `viga_iniciativas_plan_entornodetalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_entornosub`
--
ALTER TABLE `viga_iniciativas_plan_entornosub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_entornosubdetalle`
--
ALTER TABLE `viga_iniciativas_plan_entornosubdetalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_entorno_entornosub_detalle`
--
ALTER TABLE `viga_iniciativas_plan_entorno_entornosub_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_facultad`
--
ALTER TABLE `viga_iniciativas_plan_facultad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_geocomuna`
--
ALTER TABLE `viga_iniciativas_plan_geocomuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_geopais`
--
ALTER TABLE `viga_iniciativas_plan_geopais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_georegion`
--
ALTER TABLE `viga_iniciativas_plan_georegion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_impacto`
--
ALTER TABLE `viga_iniciativas_plan_impacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_impactoexterno`
--
ALTER TABLE `viga_iniciativas_plan_impactoexterno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_impactointerno`
--
ALTER TABLE `viga_iniciativas_plan_impactointerno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_ods`
--
ALTER TABLE `viga_iniciativas_plan_ods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_programa`
--
ALTER TABLE `viga_iniciativas_plan_programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_programasecundario`
--
ALTER TABLE `viga_iniciativas_plan_programasecundario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_recursodinero`
--
ALTER TABLE `viga_iniciativas_plan_recursodinero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_recursohumano`
--
ALTER TABLE `viga_iniciativas_plan_recursohumano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_recursoinfraestructura`
--
ALTER TABLE `viga_iniciativas_plan_recursoinfraestructura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_resultado`
--
ALTER TABLE `viga_iniciativas_plan_resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_sede`
--
ALTER TABLE `viga_iniciativas_plan_sede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_unidad`
--
ALTER TABLE `viga_iniciativas_plan_unidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_iniciativas_plan_unidad_sub`
--
ALTER TABLE `viga_iniciativas_plan_unidad_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_lista_asistencia`
--
ALTER TABLE `viga_lista_asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_logs`
--
ALTER TABLE `viga_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_objetivos`
--
ALTER TABLE `viga_objetivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `viga_param_cargo_encargado`
--
ALTER TABLE `viga_param_cargo_encargado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `viga_param_estado_completitud`
--
ALTER TABLE `viga_param_estado_completitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viga_param_estado_ejecucion`
--
ALTER TABLE `viga_param_estado_ejecucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viga_param_formato_implementacion`
--
ALTER TABLE `viga_param_formato_implementacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viga_param_impacto_externo`
--
ALTER TABLE `viga_param_impacto_externo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `viga_param_impacto_interno`
--
ALTER TABLE `viga_param_impacto_interno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `viga_param_participantes`
--
ALTER TABLE `viga_param_participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `viga_param_recurso_humano`
--
ALTER TABLE `viga_param_recurso_humano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `viga_param_recurso_infraestructura`
--
ALTER TABLE `viga_param_recurso_infraestructura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viga_participacion_plan`
--
ALTER TABLE `viga_participacion_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_participacion_plan_tag`
--
ALTER TABLE `viga_participacion_plan_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_participacion_real`
--
ALTER TABLE `viga_participacion_real`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_participacion_real_tag`
--
ALTER TABLE `viga_participacion_real_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_programas`
--
ALTER TABLE `viga_programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_sedes`
--
ALTER TABLE `viga_sedes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_unidades`
--
ALTER TABLE `viga_unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viga_unidades_subs`
--
ALTER TABLE `viga_unidades_subs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
