-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2022 a las 16:43:31
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webtfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` varchar(255) NOT NULL,
  `memory` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `language` varchar(50) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `problem`
--

INSERT INTO `problem` (`id`, `route`, `title`, `description`, `visibility`, `memory`, `time`, `language`, `subject_id`, `edited`) VALUES
(46, './../app/problemes/Progamació de classes i headers', 'Progamació de classes i headers', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Public', '50', '5', 'C++', 0, 0),
(47, './../app/problemes/Llibreria numpy', 'Llibreria numpy', 'NumPy es una librería de Python especializada en el cálculo numérico y el análisis de datos, especialmente para un gran volumen de datos. asuojkdhg\r\n\r\nIncorpora una nueva clase de objetos llamados arrays que permite representar colecciones de datos de un mismo tipo en varias dimensiones, y funciones muy eficientes para su manipulación.', 'Public', '50', '5', 'Python', 0, 0),
(48, './../app/problemes/Classes de Python', 'Classes de Python', 'Creación de arrays\nPara crear un array se utiliza la siguiente función de NumPy\n\nnp.array(lista) : Crea un array a partir de la lista o tupla lista y devuelve una referencia a él. El número de dimensiones del array dependerá de las listas o tuplas anidadas en lista:\n\nPara una lista de valores se crea un array de una dimensión, también conocido como vector.\nPara una lista de listas de valores se crea un array de dos dimensiones, también conocido como matriz.\nPara una lista de listas de listas de valores se crea un array de tres dimensiones, también conocido como cubo.\nY así sucesivamente. No hay límite en el número de dimensiones del array más allá de la memoria disponible en el sistema.\n Los elementos de la lista o tupla deben ser del mismo tipo.', 'Public', '50', '5', 'Python', 2, 0),
(55, './../app/problemes/pROBLEMA PARA PROGTAMAR', 'pROBLEMA PARA PROGTAMAR', 'SADFSADF\nASDF\nASD\nF\nASD\nF\nSADF\nASDFASDFASDFASDFASD ADSF DASF ASDFSAD F\nHabia una vez una descripcion editada', 'Public', '50', '10', 'Python', 5, 0),
(67, './../app/problemes/Clearly a test good', 'Clearly a test good', 'Descipcion coeta', 'Public', '50', '5', 'Python', 0, 0),
(69, './../app/problemes/problema de prova', 'problema de prova', 'Això és una prova', 'Public', '50', '5', 'C++', 6, 0),
(75, './../app/problemes/Problema de ficheros en c++', 'Problema de ficheros en c++', 'Este es un test de ficheros de c++', 'Public', '50', '5', 'C++', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professor`
--

INSERT INTO `professor` (`id`, `name`, `surname`, `password`, `email`) VALUES
(1, 'Pepe', 'Viyuela', '$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy', 'punyetazo@gmail.com'),
(3, 'as', 'Youssef', '$2y$10$oaTlGuc4RZSFpvi9KpbHu.slYt25h/0Zf4n4/S.5rNSbHY1QuQJju', 'punyetsazo@gmail.com'),
(4, 'Assbaghi', 'iksajklasd', '$2y$10$McYjqkQjFZMuwUNtVTZ4MO5Wxt3B4TF5N5ZlmryX4p7Uk0pg6rN.q', 'sermankerwe@gmail.com'),
(5, 'asAssbaghi', 'iksajklasd', '$2y$10$nOmfkPG4fN3r8uJeBaRlwe2qgLDOci/dqKJcTHF0mE2u3SagWJtBa', 'sermankersd@gmail.com'),
(6, 'Assbaghi', 'Youssef', '$2y$10$fNSN7nTZizXzI2rruJGqXO8I3QL1vqfE7K9ocrqNje2nhT8a7SI8e', 'punyetasdsdzo@gmail.com'),
(7, 'Ernest', 'Valveny', '$2y$10$P1H9Znk0rcyzHRceT1NL9u6oNMK0zmq6VNATm2BhSN78rixPYBmtC', 'ernest@cvc.uab.es'),
(8, 'Ernest', 'Valveny', '$2y$10$h6gIK9JRPlgt8dM7J39ox.bW0ErdRZeyFvHFNZjdCMcQBm.7btbKG', 'ernest@cvc.uab.cat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solution`
--

CREATE TABLE `solution` (
  `id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `editing` int(11) NOT NULL DEFAULT 0,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solution`
--

INSERT INTO `solution` (`id`, `route`, `problem_id`, `subject_id`, `user`, `editing`, `edited`) VALUES
(32, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/Classes de Python', 48, 2, 'sermanker@gmail.com', 0, 0),
(33, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/Progamació de classes i headers', 46, 0, 'sermanker@gmail.com', 1, 0),
(34, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/Llibreria numpy', 47, 0, 'sermanker@gmail.com', 0, 0),
(38, 'D:/xampp/htdocs/app/solucions/sermansker@gmail.com/Progamació de classes i headers', 46, 0, 'sermansker@gmail.com', 1, 0),
(50, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/Clearly a test good', 67, 0, 'sermanker@gmail.com', 0, 0),
(51, 'D:/xampp/htdocs/app/solucions/Ernest.Valveny@uab.cat/Classes de Python', 48, 2, 'Ernest.Valveny@uab.cat', 0, 1),
(52, 'D:/xampp/htdocs/app/solucions/Ernest.Valveny@uab.cat/Progamació de classes i headers', 46, 0, 'Ernest.Valveny@uab.cat', 1, 0),
(53, 'D:/xampp/htdocs/app/solucions/Ernest.Valveny@uab.cat/Clearly a test good', 67, 0, 'Ernest.Valveny@uab.cat', 0, 0),
(54, 'D:/xampp/htdocs/app/solucions/Ernest.Valveny@uab.cat/pROBLEMA PARA PROGTAMAR', 55, 5, 'Ernest.Valveny@uab.cat', 0, 0),
(55, 'D:/xampp/htdocs/app/solucions/Ernest.Valveny@uab.cat/Llibreria numpy', 47, 0, 'Ernest.Valveny@uab.cat', 0, 0),
(61, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/problema de prova', 69, 6, 'sermanker@gmail.com', 0, 0),
(70, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/Problema de ficheros en c++', 75, 0, 'sermanker@gmail.com', 0, 0),
(73, 'D:/xampp/htdocs/app/solucions/sermanker@gmail.com/pROBLEMA PARA PROGTAMAR', 55, 5, 'sermanker@gmail.com', 0, 0),
(75, 'D:/xampp/htdocs/app/solucions/mail@gmail.com/Llibreria numpy', 47, 0, 'mail@gmail.com', 0, 0),
(76, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/Progamació de classes i headers', 46, 0, 'namesurname@mail.com', 0, 0),
(77, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/problema de prova', 69, 6, 'namesurname@mail.com', 0, 0),
(78, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/Problema de ficheros en c++', 75, 0, 'namesurname@mail.com', 0, 0),
(79, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/Clearly a test good', 67, 0, 'namesurname@mail.com', 0, 0),
(80, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/Llibreria numpy', 47, 0, 'namesurname@mail.com', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`id`, `name`, `surname`, `email`, `password`) VALUES
(1, 'Assbaghi', 'iksajklasd', 'youssef.assbaghi@e-campus.uab.cat', '$2y$10$wmqxL/WbZ.VxpCBXnGUzHONRS63r0TGemZcxxqTx/7DRCURZhAxFu'),
(3, 'Assbaghi', 'iksajklasd', 'sermanker@gmail.com', '$2y$10$v1kK859Ze00Cycf/ExLNzeBAZLkH49oWtHUrDpA/1bc8wa6/BnkLm'),
(4, 'Juan', 'Perez', 'localhost@gmail.com', '$2y$10$YnMM19UwnDIF1JZBX4t7HeOB4pxdr7MSBMBkgkiizuJJ3hdOaW082'),
(5, 'asAssbaghi', 'iksajklasd', 'asas@gmail.com', '$2y$10$MhmvoB2q7/k/K9jt8jsrveKXwZV7IOn1ELEn8SYyq1IVbgDdqKYtS'),
(6, 'asAssbaghi', 'iksajklasd', 'asass@gmail.com', '$2y$10$Jt4Dla8Awfytyjpt9SEiyedF4J3zu9nRBQ0ac4/xC5EM68l10udnG'),
(7, 'asdasd', 'asdasd', 'sermansker@gmail.com', '$2y$10$QhhDcNBAAh4lAqwZ5qI7g.nXJSnOeW5WCX6ZQyvNsp7SpasztF5.m'),
(8, 'Assbaghi', 'iksajklasd', 'sermankasder@gmail.com', '$2y$10$705LiEPcbcwdBVLHWeAMROc/q1QkXpHiOFnZ/EIaEZfYC1IxXgKf6'),
(9, 'hgh', 'hgfhfg', 'hgfhgf@gmail.com', '$2y$10$Dmcf6CyWhKasX3SGK.NeueL8w1I4mSd2F/3jYRQRNbzvDqPrDRWw6'),
(10, 'Ernest', 'Valveny', 'Ernest.Valveny@uab.cat', '$2y$10$3ejx5cmcxA4Xr3vlKCelpu.LpB//GZidFR/O9qq2.i6yiQ7YnyrrW'),
(11, 'Pepecito', 'Vinyuelita', 'mail@gmail.com', '$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy'),
(12, 'name', 'surname', 'namesurname@mail.com', '$2y$10$wQBwkcJvXRj7uEGjtPUcpudHwRaYDsZp37vFb2KyiDw06.Oi7Aavm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `title`, `description`, `course`) VALUES
(0, 'Laboratori de programació', 'Programacio interactiva per estudiants', '3'),
(2, 'Metodologia de la programació', 'Programacio interactiva per estudiants', '2'),
(5, 'pRUEBA', 'pRUEBA KANDSAD', '12'),
(6, 'assignatura nova', 'Aquesta és una assignatura de prova', '1'),
(7, '13', '232131', '31231');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `usage` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id`, `value`, `usage`) VALUES
(1, '52f8af023bc9b1707006c496352e312f5bbf9fc1a98b84bddf371a0ab51f9a1819b202ba7f5d5671e21ddfdd337534568463965f35a419c906096cc509a73fad938908e3e599fd7dac8eebfbb2ce905f7042bcae48ef27e9948f7d6376c63decc23c5cb03224b5b16bf56940cc5e5389b394df937e59ff4cdcbe3cfbab050e0', 1),
(7, 'f5f050b5902c3818639ee84b4b666b20d8b6ab8fdac88e8377a75fdc748dc3c840a3108c5774191962c8abc7b514a85dc9f09768dedf622b1c6f0e0f08e5aa7e304c4cef10e4bddc80fbe683cfcb08100a2051c44703881df0244994fb7eb598951afcad84434a3944118c6ac1bb579adbb07e6a7c5ae90e34193cd5e2e9d2e', 1),
(8, '73adca3336b576fda430e443185888003bd148c012cd0706271298356e2e098af5a27a3a125e13e729b0f0c49ebd88a6d8242c21c3818a8441a8f375ed23388466f753828d57cb013208cacb703dad230aba4a23c1994f2b9a9622ca63f6105c6217f15b77ab01429093087e6132a9db023ba93fae18d45f9bcfb1576ffaf36', 1),
(9, 'bd4be1be0e667c590ab9436eb53d2605eec788262989aaf30dfc75c5cbf126df32e74fad8a7ac06d861975bdb8f467b35e2fbffc5f445880553ee3d691c61187f801d23da7623807f101fe35dabb0b430797cd15ed7540bdc89326e4e8e322111536e212282b205c78e4c45e41f0e769c7ba494d5bcb6f007b24ac9190c5aee', 1),
(10, 'ebb11ba989c4c45b4c2df1ed5ce291d8e50f0f7b3d5d7151b72213f01d2b7436a486fbcb39cd31e0c669f45f4d48eb85c86ac822a67700b4cf973fc0a2d0cf3acd97a65698122f8e500ee478642b0934e006eac3531892cd792432e37b24315e9ac0261d1f1225f194194633e4ac1e1203bb49bc2cd86851563a40ab5a86c9e', 1),
(11, '64ea134eb773ae29ae917e9433807f515db480e0ea32cfe6559316236f2dfe8ed0ecf32cb7ebf987dad5ad602c54c0e5ebb776b1d61b8e4f09731d40571e2322d103739487b3eac50484dd8a90045ebc3361d4c377d4621d8f2839b40077406cfd338dae93b1c53d2e69d3b1933653828e483446503302baefe4b4108c9a707', 1),
(12, '1dec03a633ac8712054561f9e5ae1f2df827fd2e93be0ec88e1d2773b1e49e4bdc64ad50679582438e529d47612e1feb990777da2a15ddc5df1c30a5ceb7c5808d575963b4e993978680314cb112d5e586ba880fd2dc5f2296ff0b1b89782b9173f8b7a300256ee6797a76ffe27678551244c3a63aa56c3bdcc53ce604e563e', 0),
(13, '33963f1d52add63ded81371b3e5c30b8b4b3aa9c1f06077bf06158e5fbe08fa654d060d3cfb9c752adab2ed1a05c5115dce1bef0a265f2420d2a13c60b002a3c4e33c14d229c094dea02910f5dfc56cea04f44967b0b172c40032fe6e3bfbb5f1f3f457ef9c927fe4016004dbd992c1f44949f773e319240346b107852cabf7', 0),
(14, 'e9cfc454553e16c19628c36a6a4b30d253c30ca052aeb2960432c281c07004c2', 1),
(15, 'fd37b6cc95eb3941a6314891109289ef6b3ecca7cb345039e379dbba50199696', 1),
(16, '58cbb101d4b1840cb2f92f5cea353f8048313cdb953a4df28825f0d707d436f5', 1),
(17, '58f0cff5556958ac3407dd9b5a4d73c38da5797616b2931da63d4679a5701c5a', 0),
(18, 'd583c345c57e0c16d21735a8225d2859b6b828d96c72f25be7da672c80f638da', 0),
(19, '57ef95e73a693cf1a62224c864f1a250cbd9308838d16beefeb07cc56808c7e6', 0),
(20, 'e17b922e97b436062ff3fb51a1649e027b8ffcec51a4fd79ac1689530073a9b3', 0),
(21, 'e15e6f37f05c5ace8488d52d42a974a58195fe3daa077dbb60345e6a082e7a45', 0),
(22, '9ea7a4b087a8d01b92d4dcf268adbb5de2d06e81567c3069c4cc91653fb7608d', 0),
(23, '538416e6d9e6dd1ed7509629f00a3403dc155bccbbc0c84d50872a37426e81bc', 0),
(24, '81361929c4dc5a81f761c33930aff77c7a2a74a4058e27df2b035be2eebd015c', 0),
(25, 'acad310e56bd8ea4a319f22909fa7b356ba0dcb2af9cc0da48a7fe8fc6671c15', 0),
(26, '01d85a82582e0b3fd72ad632ce2655bbf121ccd286e3bfcfbda4bce4382325d1', 0),
(27, '7b2425d9842d695ef9782093392b9eadf4b38e1c33ea8c37cbfecb32956da39e', 0),
(28, '92b21267a59b183eb8c9eccbf67e3e0a5550c1bde01aad070498535e059880a4', 0),
(29, 'a8a0eb1e65e278b2bfdeb212385f0f39af75b7c66fc865c3191f1ec7daad50af', 1),
(30, '7c580e380811df33311dab4e41d0ca711ee1316a698ac88a4a19e6e29b43ca23', 0),
(31, 'ce8712bf2514c3351f325d214516d2367bed7afc3a6d6198a7665d5ab0f87115', 0),
(32, '34bbae9188cfb5b34df327deae1cc4955d69eed1e7d4b0a10a00661321bbf2b8', 0),
(33, 'd22745de4fc9ef48224eb5e0ea083451dc5ae6ffe5157720144e6766cf653c33', 0),
(34, '56fbad167c64a0fc47b7b36c9ac2ccc896e19e8c17cc3c164fd41ca289cf13d3', 0),
(35, 'f859495ee33015778f56940a2e3b33b0f7de2abaf85fc93ea154d799ab6702f4', 0),
(36, '082f98b82a3281f9127a5ac2d9dd9dc2c9fbe44a41817d486fe3b419f95c933e', 0),
(37, '5965a8ea862c6dbb0c37d897fa7e2c30bafac55874f27fb8757735adcf98beae', 0),
(38, '950f9be66835253c1fcfde91ba64352f168d3d1543b217333edb8336e42810fc', 0),
(39, '621627d3c728d9b395b2573567612749cb711e0b1036041ef18843729f51d2f7', 1),
(40, 'a4e8cbdf84330e2078bea1e55008751789c9d19a4f79ce9364661fdfeb2f70de', 0),
(41, '73fd45732b5a2f9b79ef3da7adca4da179505ac292127cd0bdb1daeaf749773a', 0),
(42, '8d8bd66417f22c8db16ce3e09761c0951d64f1df3b2ee17b60e408dc23b3082d', 0),
(43, '45bb0dd716a35766be8a166376805f336a086d397e8edd1fa20b7486034451f8', 0),
(44, '344c0195489e89d4a4661188537a364c07db49a71c651106929bef8eb9487876', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AsignaturaID` (`subject_id`);

--
-- Indices de la tabla `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- Indices de la tabla `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_asignatura` (`subject_id`),
  ADD KEY `Usuario` (`user`),
  ADD KEY `Id_problema` (`problem_id`) USING BTREE;

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Valor` (`value`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `problem`
--
ALTER TABLE `problem`
  ADD CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`Id`);

--
-- Filtros para la tabla `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `solution_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`Id`),
  ADD CONSTRAINT `solution_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solution_ibfk_3` FOREIGN KEY (`user`) REFERENCES `student` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
