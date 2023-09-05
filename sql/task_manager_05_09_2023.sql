-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-09-2023 a las 01:07:59
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
-- Base de datos: `task_manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `assigned_user_id` int(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `hours` int(100) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `assigned_user_id`, `title`, `content`, `priority`, `hours`, `state`, `created_at`) VALUES
(1, 1, 0, 'Tarea 1', 'Contenido de prueba 1', 'high', 40, '', '2023-08-19 08:19:13'),
(2, 1, 0, 'Tarea 2', 'Contenido de prueba 2', 'low', 20, '', '2023-08-19 08:19:13'),
(3, 2, 0, 'Tarea 3', 'Contenido de prueba 3', 'medium', 10, '', '2023-08-19 08:19:13'),
(4, 3, 0, 'Tarea 4', 'Contenido de prueba 4', 'high', 50, '', '2023-08-19 08:19:14'),
(5, 6, 0, 'gdfgdfg', 'dfgdfgdfg', 'medium', 4, '', '2023-08-21 17:57:59'),
(6, 6, 0, 'gdfgdfg', 'dfgdfgdfg', 'medium', 4, '', '2023-08-21 17:58:16'),
(7, 6, 0, 'test', 'ffgdfgfdg', 'high', 3, '', '2023-08-21 18:00:57'),
(8, 6, 0, 'hhhh', 'dfgdfgdfg', 'high', 6, '', '2023-08-21 18:01:47'),
(9, 6, 0, 'hhhh', 'dfgdfgdfg', 'high', 6, '', '2023-08-21 18:02:18'),
(10, 6, 0, 'Test Nueva Tarea', 'Detalles de la nueva Tarea', 'high', 34, '', '2023-08-26 13:17:17'),
(11, 6, 0, 'Otro Test', 'Mas deatelles', 'medium', 66, '', '2023-08-26 13:20:41'),
(12, 6, 0, 'dfgfd', 'fdgdfg', 'high', 55, '', '2023-08-26 13:22:02'),
(13, 6, 0, 'hfgfh', 'gfhgfhgf', 'high', 6, '', '2023-08-26 13:26:41'),
(16, 6, 0, 'editado', 'editado ewrewr', 'low', 44, 'finished', '2023-08-26 13:47:17'),
(17, 6, 0, 'estado', 'state', 'medium', 33, 'finished', '2023-08-26 17:53:49'),
(18, 6, 0, 'Tarea editada', 'editado ok', 'high', 10, 'active', '2023-08-26 21:23:28'),
(19, 6, 0, 'a robles victor', 'sdgkmfdokgnodfgn km fdogm odfgmodfmg fdg', 'high', 20, 'active', '2023-09-02 15:32:45'),
(20, 6, NULL, 'dsfdsf', 'rtyrty', 'high', 5, 'active', '2023-09-05 01:36:26'),
(21, 6, 3, 'fdgdg', 'dfg', 'high', 5, 'active', '2023-09-05 02:01:17'),
(22, 6, 3, 'fdfsd', 'sdfsdf', 'high', 4, 'active', '2023-09-06 00:58:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `password`, `created_at`) VALUES
(1, 'ROLE_USER', 'Víctor', 'Robles', 'victor@victor.com', 'password', '2023-08-19 08:19:12'),
(2, 'ROLE_USER', 'Manolo', 'Perez', 'manolo@manolo.com', 'password', '2023-08-19 08:19:12'),
(3, 'ROLE_USER', 'Carlos', 'Sanchez', 'carlos@carlos.com', 'password', '2023-08-19 08:19:12'),
(4, 'ROLE_USER', 'Hernán', 'San Martin', 'her_san_martin@hotmail.com', '$2y$13$1JveCgIWckflw0wUSB9fDOxzdWPodv2VEquZ3LSxScSJNXgUyJ5la', '2023-08-20 17:30:13'),
(5, 'ROLE_USER', 'Hernán', 'San Martin', 'her_san_martin@hotmail.com', '$2y$13$.XM.ZFZFvOS.Br5CxV7QguXdRT2JyuUOvyaZJ2H0pxYX1oyg89zjW', '2023-08-20 17:31:22'),
(6, 'ROLE_USER', 'mario', 'mario', 'mario@mario.com', '$2y$13$JmFTD94Y5dPv7WrnBzhUaubfHs4Mc3QFY65asipmgz6idPSCFJOYO', '2023-08-20 21:23:21'),
(7, 'ROLE_USER', 'Pepe', 'Pepito', 'pepe@pepe.com', '$2y$13$kubIXkSKrogI9wrH2UnpmO6ZNtan8kOVLE9S6fOECJlo7ekSgSVKi', '2023-08-26 14:28:51'),
(8, 'ROLE_USER', 'chucky', 'chucky', 'chucky@chucky.com', '$2y$13$VrAwWQjaRnsR6djc/mevveT6LQLcPqp7QUJhY.oN7SufxYQrP4Dce', '2023-08-26 14:52:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_task_user` (`user_id`),
  ADD KEY `fk_task_assigned_user_id` (`assigned_user_id`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_task_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
