SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `cms`;

CREATE TABLE `admin` (
  `pwd` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`pwd`) VALUES
('3bc8e4132ba92a989c9a0a2271554a6d1889c66054d14333c08ea2085251b7863e1b8394da45f45b3a4169890c76bf055426bec48386da90021a6355191eab34');

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `dynamic_block` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `page` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `dynamic_block` (`id`, `content`, `page`) VALUES
(1, 'This is a lightweight CMS written in PHP with jQuery and Quill.', 1),
(2, 'Dynamic blocks are actually displayed by static code, but they have customizable content.', 1),
(3, 'Campinas | SP\r\nCEP 13010-000', 1),
(4, 'Campinas | SP\r\nCEP 13010-000', NULL);

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `admin`
  ADD UNIQUE KEY `pwd` (`pwd`);

ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dynamic_block`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dynamic_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
