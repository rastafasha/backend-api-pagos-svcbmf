-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-06-2023 a las 12:00:23
-- Versión del servidor: 10.5.19-MariaDB-cll-lve-log
-- Versión de PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `svcbmfor_Pagos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('APPROVED','PENDING','REJECTED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Malcolm Cordova', 'mercadocreativo@gmail.com', '+584241874370', 'prueba', 'esto es una prueba', 'PENDING', '2023-05-19 05:57:18', '2023-05-19 05:57:18'),
(2, 'Malcolm Cordova', 'mercadocreativo@gmail.com', '+584241874370', 'prueba 2', 'esto es otra prueba', 'PENDING', '2023-05-19 06:09:39', '2023-05-19 06:09:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MXN', '2023-03-14 07:33:39', '2023-03-14 07:33:39', NULL),
(2, 'USD', '2023-03-15 00:06:45', '2023-03-15 00:06:45', NULL),
(3, 'BSDVES', '2023-03-15 00:06:56', '2023-03-15 00:06:56', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directories`
--

CREATE TABLE `directories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `especialidad` varchar(255) NOT NULL,
  `universidad` varchar(255) NOT NULL,
  `ano` varchar(255) DEFAULT NULL,
  `org` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `direccion1` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `telefonos` varchar(255) DEFAULT NULL,
  `tel1` varchar(255) DEFAULT NULL,
  `telhome` varchar(255) DEFAULT NULL,
  `telmovil` varchar(255) DEFAULT NULL,
  `telprincipal` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `vcard` text DEFAULT NULL,
  `status` enum('PUBLISHED','PENDING','REJECTED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `directories`
--

INSERT INTO `directories` (`id`, `user_id`, `nombre`, `surname`, `especialidad`, `universidad`, `ano`, `org`, `website`, `email`, `direccion`, `direccion1`, `estado`, `ciudad`, `telefonos`, `tel1`, `telhome`, `telmovil`, `telprincipal`, `facebook`, `instagram`, `twitter`, `linkedin`, `image`, `vcard`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'dasdsa', 'das', 'Cirugía Buco-maxilofacial', 'sadasdas', NULL, 'SVCBMF', NULL, 'dsadsa@fdsfsd.com', 'asdsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dassad', NULL, NULL, NULL, NULL, NULL, 'BEGIN:VCARD\nVERSION:3.0\nN:das;dasdsa\nFN:das dasdsa\nORG:SVCBMF\nURL:null\nURL:null\nURL:null\nURL:null\nURL:null\nEMAIL:dsadsa@fdsfsd.com\nPHOTO:\nTITLE:Cirugía Buco-maxilofacial\nADR;TYPE=work:asdsa\nADR;TYPE=home:null\nTEL;TYPE=voice,work,oref:null\nTEL;TYPE=voice,home,oref:null\nTEL;TYPE=voice,mobile,oref:null\nTEL;TYPE=voice,first,oref:dassad\nEND:VCARD', 'PENDING', '2023-03-14 21:06:29', '2023-03-14 22:37:43', '2023-03-14 22:37:43'),
(2, 1, 'Malcolm', 'Cordova', 'Cirugía Buco-maxilofacial', 'dasdsa', 'undefined', 'SVCBMF', 'undefined', 'mercadocreativo@gmail.com', 'caracas\r\ncaracas', 'caracas\r\ncaracas', 'Distrito Federal', 'caracas', '+584241874370', 'undefined', 'undefined', 'undefined', 'dasdsa', 'undefined', 'undefined', 'undefined', 'undefined', 'profile-img-1678822943.jpg', 'BEGIN:VCARD\r\nVERSION:3.0\r\nN:Cordova;Malcolm\r\nFN:Cordova Malcolm\r\nORG:undefined\r\nURL:undefined\r\nURL:undefined\r\nURL:undefined\r\nURL:undefined\r\nURL:undefined\r\nEMAIL:mercadocreativo@gmail.com\r\nPHOTO:undefined\r\nTITLE:Cirugía Buco-maxilofacial\r\nADR;TYPE=work:caracas\r\ncaracas\r\nADR;TYPE=home:caracas\r\ncaracas\r\nTEL;TYPE=voice,work,oref:undefined\r\nTEL;TYPE=voice,home,oref:undefined\r\nTEL;TYPE=voice,mobile,oref:undefined\r\nTEL;TYPE=voice,first,oref:dasdsa\r\nEND:VCARD', 'PENDING', '2023-03-14 22:42:23', '2023-03-18 18:18:47', '2023-03-18 18:18:47'),
(3, 1, 'Malcolm1', 'Cordova', 'Cirugía Buco-maxilofacial', 'dasdsa', 'undefined', 'SVCBMF', 'undefined', 'mercadocreativo@gmail.com', 'caracas\r\ncaracas', 'caracas\r\ncaracas', 'Distrito Federal', 'caracas', '+584241874370', 'undefined', 'undefined', 'undefined', 'dasdsa', 'undefined', 'undefined', 'undefined', 'undefined', '2023-03-21 18:33:03d4jpg.jpg', 'BEGIN:VCARD\nVERSION:3.0\nN:Cordova;Malcolm1\nFN:Cordova Malcolm1\nORG:SVCBMF\nURL:undefined\nURL:undefined\nURL:undefined\nURL:undefined\nURL:undefined\nEMAIL:mercadocreativo@gmail.com\nPHOTO:2023-03-21 18:33:03d4jpg.jpg\nTITLE:Cirugía Buco-maxilofacial\nADR;TYPE=work:caracas\r\ncaracas\nADR;TYPE=home:caracas\r\ncaracas\nTEL;TYPE=voice,work,oref:undefined\nTEL;TYPE=voice,home,oref:undefined\nTEL;TYPE=voice,mobile,oref:undefined\nTEL;TYPE=voice,first,oref:dasdsa\nEND:VCARD', 'PUBLISHED', '2023-03-18 18:18:47', '2023-03-21 21:33:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2022_11_25_205816_create_currencies_table', 1),
(17, '2022_11_25_205817_create_plans_table', 1),
(18, '2022_11_25_205847_create_directories_table', 1),
(19, '2022_11_30_175428_create_jobs_table', 1),
(20, '2022_12_09_225550_create_payment_methods_table', 1),
(21, '2022_12_09_225551_create_payments_table', 1),
(22, '2022_12_18_035041_create_contacts_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mercadocreativo@gmail.com', 'dEytg6T2XATlALh8U3j01T4NBWyj6mbHr87n8PWvcGq52U9hVhlxH074lUDvETYjG47xJd1k2ZfjwfOC', '2023-05-24 01:29:15'),
('mercadocreativo@gmail.com', 'mKefov9JbsOlnd8tjvaXVVKSr01oXQ7PEfNtrorlAu15lJHU0PKW6nstX63HycBsBGrk1i6tzm4HUrNB', '2023-05-24 01:29:15'),
('maldonado.eduar.1983@gmail.com', 'pYMAzt3biaY1s3U1Q6tMslKyfS7E7lEIKbTuBGoNe2Vm88R4qVFwpuoyeqbQAVqtvSc3ceh1WqSiKJlA', '2023-06-06 01:06:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `metodo` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `monto` varchar(255) NOT NULL,
  `validacion` varchar(255) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('APPROVED','PENDING','REJECTED') NOT NULL DEFAULT 'PENDING',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `referencia`, `metodo`, `bank_name`, `monto`, `validacion`, `currency_id`, `nombre`, `email`, `status`, `user_id`, `plan_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Illum sint ex quis', 'Zelle', 'Hall Dunlap', 'Veniam rerum laboru', 'PENDING', 1, 'Impedit est impedi', 'refovagob@mailinator.com', 'PENDING', 1, 1, '1-titanfall-1678768862.jpg', '2023-03-14 07:41:02', '2023-03-14 07:41:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Paypal', 'img/PaymentMehods/paypal.jpg', '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL),
(2, 'Paypal', 'img/PaymentMehods/paypal.jpg', '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL),
(3, 'Formulario', 'img/PaymentMehods/form.png', '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('PUBLISHED','PENDING','REJECTED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `currency_id`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Whitney Britt', '55', 1, '1-muneca-1678768456.jpeg', 'PENDING', '2023-03-14 07:34:16', '2023-03-15 00:07:39', '2023-03-15 00:07:39'),
(2, 'Plan Miembro', '80', 2, 'logo-1678828059.png', 'PENDING', '2023-03-15 00:07:39', '2023-03-21 18:43:28', '2023-03-21 18:43:28'),
(3, 'Plan Miembro', '80', 2, '2023-03-21 17:20:40logopng.png', 'PENDING', '2023-03-21 20:20:42', '2023-03-21 20:20:42', NULL),
(4, 'Plan Miembro', '80', 2, '2023-03-21 17:20:40logopng.png', 'PENDING', '2023-03-21 20:20:42', '2023-03-21 20:20:47', '2023-03-21 20:20:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('SUPERADMIN','ADMIN','MEMBER','GUEST') NOT NULL DEFAULT 'GUEST',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadministrador', 'SUPERADMIN', 'superadmin@superadmin.com', '2023-03-14 06:30:14', '$2y$10$eIdPmhD/II983kRb1hR0RuFuvZqlns3E0gPAfRVwRcgjsWbfadnku', NULL, NULL, '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL),
(2, 'administrador', 'ADMIN', 'admin@admin.com', '2023-03-14 06:30:14', '$2y$10$OKBUWVJUeE/bMNOOeJ15Mu3A3jSVFgE9a.xS6J4r5NnrkQzwzqeoW', NULL, NULL, '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL),
(3, 'miembro', 'MEMBER', 'miembro@miembro.com', '2023-03-14 06:30:14', '$2y$10$vrsDUGypTlJjZ8V4ohZGgeM0OXginm90UzO81CszhnDlDmZ4NFiwe', NULL, NULL, '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL),
(4, 'invitado', 'GUEST', 'invitado@invitado.com', '2023-03-14 06:30:14', '$2y$10$O0f53942OaMn1DqmL7YNhu9aHll6NNPrSwi/A/.f6U.c5NqhqB9Ba', NULL, NULL, '2023-03-14 06:30:14', '2023-03-14 06:30:14', NULL),
(5, 'malc', 'GUEST', 'mercadocreativo@gmail.com', NULL, '$2y$10$aOPMfIQFM1QgjnR/gf9vMeuDbyn0JXOPRv6QJDD5DMoVChR0/.Rde', NULL, NULL, '2023-05-24 01:29:00', '2023-05-24 01:29:00', NULL),
(7, 'Maldonado', 'GUEST', 'maldonado.eduar.1983@gmail.com', NULL, '$2y$10$W2xzSVrFO7c2vlKYuuExqOa3PG8kIBSbQr9p7dWWMv3sKVdTlV74S', NULL, NULL, '2023-06-06 01:02:10', '2023-06-06 01:02:10', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `directories`
--
ALTER TABLE `directories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directories_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_currency_id_foreign` (`currency_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_currency_id_foreign` (`currency_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `directories`
--
ALTER TABLE `directories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `directories`
--
ALTER TABLE `directories`
  ADD CONSTRAINT `directories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
