-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 mrt 2026 om 14:00
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promotion`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `course`
--

CREATE TABLE `course` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `organisationId` char(36) DEFAULT NULL,
  `authorId` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `courseImage` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `pages` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `picturename` varchar(255) DEFAULT NULL,
  `niveau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `course`
--

INSERT INTO `course` (`id`, `createdAt`, `updatedAt`, `organisationId`, `authorId`, `name`, `introduction`, `courseImage`, `time`, `pages`, `path`, `extension`, `picturename`, `niveau`) VALUES
('04da2065-755d-4013-a165-3bc4a6efacb2', '2026-02-24 09:41:23', '2026-02-24 09:51:00', 'e8ab8a46-c935-11f0-a5bd-c84bd62dda40', '039eb105-163a-4a42-a994-85ed107c4289', ' Bicep intermediate workout', '<p>This is a  bicep workout for intermediate users.</p>', NULL, NULL, NULL, '3542f886-c1dc-4273-b2c8-6f22f107d272.avif', 'avif', 'gettyimages-1127082936-682e43686a983.avif', '2'),
('35d49aa5-efad-4d70-9ab9-29602b4c278e', '2026-02-24 09:31:28', '2026-02-24 09:34:53', 'e8ab8a46-c935-11f0-a5bd-c84bd62dda40', '039eb105-163a-4a42-a994-85ed107c4289', 'Tricep beginner workout', '<p>This is a beginner friendly tricep workout.</p>', NULL, NULL, NULL, 'a6ed6f11-1ab8-49cd-8232-fd56c9758590.webp', 'webp', 'biceps-vs-triceps-which-muscle-matters-more-for-sleeve-stretching-arms-146395.webp', '0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `course_fiche`
--

CREATE TABLE `course_fiche` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `courseId` char(36) DEFAULT NULL,
  `ficheId` char(36) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `course_fiche`
--

INSERT INTO `course_fiche` (`id`, `createdAt`, `updatedAt`, `courseId`, `ficheId`, `position`) VALUES
('14af3455-c540-4118-9fc8-506f09da9976', '2026-02-24 09:31:28', '2026-02-24 09:31:28', '35d49aa5-efad-4d70-9ab9-29602b4c278e', 'd60bb581-0e60-41ac-80df-491e8ec7ff3b', '1'),
('2c395a25-81e7-4eff-9a84-268ee2bd4b27', '2026-02-24 09:41:23', '2026-02-24 09:41:23', '04da2065-755d-4013-a165-3bc4a6efacb2', '45a12e72-8801-4a0c-ac32-70a1165f47df', '2'),
('62ab6863-390a-4278-9192-bf18da5745b1', '2026-02-24 09:31:28', '2026-02-24 09:31:28', '35d49aa5-efad-4d70-9ab9-29602b4c278e', '855315b0-a2e5-4b98-b05f-4a3a51a6c31b', '2'),
('b861a468-6459-47d8-8d6d-9c9b9fecb5f2', '2026-02-24 09:41:23', '2026-02-24 09:41:23', '04da2065-755d-4013-a165-3bc4a6efacb2', '56d352da-f239-4c9f-a157-1282f3486a49', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `course_fiche_user`
--

CREATE TABLE `course_fiche_user` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `course_ficheId` char(36) DEFAULT NULL,
  `userId` char(36) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `course_user`
--

CREATE TABLE `course_user` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `courseId` char(36) DEFAULT NULL,
  `userId` char(36) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fiche`
--

CREATE TABLE `fiche` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(255) DEFAULT NULL,
  `niveau` varchar(255) DEFAULT NULL,
  `excecute` varchar(255) DEFAULT NULL,
  `muscles` varchar(255) DEFAULT NULL,
  `videoLink` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `exercise` varchar(255) DEFAULT NULL,
  `cName` varchar(255) DEFAULT NULL,
  `cPath` varchar(255) DEFAULT NULL,
  `cExtension` varchar(255) DEFAULT NULL,
  `mName` varchar(255) DEFAULT NULL,
  `mPath` varchar(255) DEFAULT NULL,
  `mExtension` varchar(255) DEFAULT NULL,
  `eName` varchar(255) DEFAULT NULL,
  `ePath` varchar(255) DEFAULT NULL,
  `eExtension` varchar(255) DEFAULT NULL,
  `authorId` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `fiche`
--

INSERT INTO `fiche` (`id`, `createdAt`, `updatedAt`, `title`, `niveau`, `excecute`, `muscles`, `videoLink`, `time`, `introduction`, `exercise`, `cName`, `cPath`, `cExtension`, `mName`, `mPath`, `mExtension`, `eName`, `ePath`, `eExtension`, `authorId`) VALUES
('45a12e72-8801-4a0c-ac32-70a1165f47df', '2026-02-24 09:39:44', '2026-02-24 09:39:44', 'Bicep workout two', '2', '<p>This is a bicep workout for intermeadiate users!</p>', 'Bicep', NULL, '15', NULL, '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>let op je houding...</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span><br></li></ol>', 'gettyimages-1127082936-682e43686a983.avif', 'faa4595f-1ecf-4f90-ad81-570b461791a6.avif', 'avif', 'gettyimages-1127082936-682e43686a983.avif', '../media/70daef1a-8f5c-490f-9b61-b2cc91b787a6.avif', 'avif', 'gettyimages-1127082936-682e43686a983.avif', '../media/4a4a0e1b-84c1-49f9-aa9f-7acbd94673a5.avif', 'avif', '039eb105-163a-4a42-a994-85ed107c4289'),
('56d352da-f239-4c9f-a157-1282f3486a49', '2026-02-24 09:36:18', '2026-02-24 09:36:18', 'Bicep curls one', '1', '<p>Bicep curls</p>', 'Bicep', NULL, '10', NULL, '<p>Bicep curls</p>', 'biceps-vs-triceps-which-muscle-matters-more-for-sleeve-stretching-arms-146395.webp', '4c4cf464-1fce-4f25-b3a7-2427f8805ca4.webp', 'webp', 'biceps-vs-triceps-which-muscle-matters-more-for-sleeve-stretching-arms-146395.webp', '../media/86588c51-71e5-4018-85dc-71ff1c3bfd7f.webp', 'webp', 'biceps-vs-triceps-which-muscle-matters-more-for-sleeve-stretching-arms-146395.webp', '../media/8699aeff-d94c-493d-90f7-b664edd4fbb2.webp', 'webp', '039eb105-163a-4a42-a994-85ed107c4289'),
('855315b0-a2e5-4b98-b05f-4a3a51a6c31b', '2026-02-24 09:24:36', '2026-02-24 09:24:36', 'Tricep workout two', '1', '<p><br></p>', 'Tricep', NULL, '30', NULL, '<p><br></p>', 'Tricep_kickback.webp', 'd9be4fa7-f4b8-4d7e-b82b-c6c57d527c84.webp', 'webp', '2_31b20275-5f35-4a42-bd4e-38b6b9eaa8a1.webp', '../media/605242d8-36a2-47a6-ad04-9a39545343a4.webp', 'webp', 'straight-bar-tricep-pushdown.webp', '../media/a4dbed22-3da5-4c71-b4f1-d4ce91b894bd.webp', 'webp', '039eb105-163a-4a42-a994-85ed107c4289'),
('d60bb581-0e60-41ac-80df-491e8ec7ff3b', '2026-02-24 09:22:01', '2026-02-24 09:22:01', 'Tricep workout one', '0', '<p>Tricep workout one</p>', 'Tricep', NULL, '20', NULL, '<p>Tricep workout one</p>', '2_31b20275-5f35-4a42-bd4e-38b6b9eaa8a1.webp', '4e1500e7-6081-4a34-a282-de01998e0298.webp', 'webp', '2_31b20275-5f35-4a42-bd4e-38b6b9eaa8a1.webp', '../media/9867977b-acd0-445d-90da-c9dcae3de981.webp', 'webp', '0_960x540.jpg', '../media/1a610227-da5e-43b4-9841-f94deac9e12c.jpg', 'jpg', '039eb105-163a-4a42-a994-85ed107c4289');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fiche_label`
--

CREATE TABLE `fiche_label` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ficheId` char(36) DEFAULT NULL,
  `labelId` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `label`
--

CREATE TABLE `label` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `landingspage` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `label`
--

INSERT INTO `label` (`id`, `createdAt`, `updatedAt`, `name`, `icon`, `landingspage`, `color`) VALUES
('32384518-c92f-11f0-a5bd-c84bd62dda40', '2025-11-24 13:14:50', '2025-11-24 13:21:48', 'school', '<i class=\"fa-solid fa-school\"></i>', NULL, 'primary'),
('49c44c6c-c9f9-11f0-b9ec-c84bd62dda40', '2025-11-25 13:21:37', '2025-11-25 13:21:37', 'Gardening', '<i class=\"fa-solid fa-fan\"></i>', NULL, 'warning'),
('5a6df5d7-c921-11f0-a5bd-c84bd62dda40', '2025-11-24 11:35:44', '2025-11-24 13:22:08', 'sports', '<i class=\"fa-solid fa-dumbbell\"></i>', NULL, 'danger'),
('f0b03c7f-c9f8-11f0-b9ec-c84bd62dda40', '2025-11-25 13:19:07', '2025-11-25 13:19:07', 'Programming', '<i class=\"fa-solid fa-laptop-code\"></i>', NULL, 'secondary');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `organisation`
--

CREATE TABLE `organisation` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `organisation`
--

INSERT INTO `organisation` (`id`, `createdAt`, `updatedAt`, `name`) VALUES
('e8ab8a46-c935-11f0-a5bd-c84bd62dda40', '2025-11-24 14:02:53', '2025-11-24 14:02:53', 'Provil');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `role`
--

CREATE TABLE `role` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `organisation` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=',
  `terms_accepted_at` datetime DEFAULT NULL,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `createdAt`, `updatedAt`, `firstname`, `lastname`, `username`, `email`, `password`, `organisation`, `age`, `weight`, `length`, `gender`, `about`, `profilePicture`, `terms_accepted_at`, `terms_accepted`, `path`, `name`, `extension`) VALUES
('039eb105-163a-4a42-a994-85ed107c4289', '2025-12-01 11:32:59', '2026-02-24 12:56:47', 'Sem', 'Biernaux', 'sBiernaux', 'sem@biernaux.be', '$2y$10$0KpD7h9YB3Vxif4RQevT6.R/EueTaO2wFM6HVx8PZ8/prQHPIdThe', 'e8ab8a46-c935-11f0-a5bd-c84bd62dda40', '17', '65', '188', '0', 'Ik ben semelus', NULL, '2025-12-16 09:09:22', 1, '039eb105-163a-4a42-a994-85ed107c4289.avif', 'gettyimages-1127082936-682e43686a983.avif', 'avif'),
('102d343a-bc5b-475c-b4ce-be69832e0c18', '2025-12-15 12:12:04', '2025-12-16 11:51:45', 'Gijs', 'vandenberk', 'Neger', 'gcgdjcdbjkcdb@gmail.com', '$2y$10$XJmNVBKjMVJ.4rq79ef2S.9jH7oLqmuDDQ7r7NXsu2MTgPVN6/WL2', NULL, NULL, NULL, NULL, NULL, NULL, 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=', '2025-12-16 09:09:22', 1, NULL, NULL, NULL),
('5a869565-9ec2-4a3c-924a-4bb8dbcfa0b5', '2025-12-16 09:09:22', '2025-12-16 11:51:47', 'Sem', 'Biernaux', 'heykesss1', 'hallo@bi.be', '$2y$10$6nwcTzaz7SskR8xH4cW5YOjOX1v1FWh6iEqku81sPVgyZIBNdBjjK', NULL, NULL, NULL, NULL, NULL, NULL, 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=', '2025-12-16 09:09:22', 1, NULL, NULL, NULL),
('6a117c77-76a4-4e11-ba00-4c023ed70e9e', '2026-02-24 09:33:30', '2026-02-24 09:33:30', 'Sem', 'Biernaux', 'kaasbaas', 'kaas@baas.be', '$2y$10$3NpiG7eiluFLAAJiv3KP/OQNX.gIX32CAoXNDe/lrbKveyAEffXJ2', NULL, NULL, NULL, NULL, NULL, NULL, 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=', '2026-02-24 09:33:30', 1, NULL, NULL, NULL),
('bc1d7c63-1de0-4f11-9d94-0bd4150e4a2f', '2026-01-20 09:36:56', '2026-01-20 09:36:56', 'Sem', 'Biernaux', 'test', 'test@test.be', '$2y$10$uO7DG.2iHusonH1TssiTvOQ91p7NftoTn.MkxBiK1dfhUI7quGvCu', NULL, NULL, NULL, NULL, NULL, NULL, 'https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=', '2026-01-20 09:36:56', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_organisation`
--

CREATE TABLE `user_organisation` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userId` char(36) DEFAULT NULL,
  `organisationId` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_organisation`
--

INSERT INTO `user_organisation` (`id`, `createdAt`, `updatedAt`, `userId`, `organisationId`) VALUES
('22cc2f0d-4a06-43f4-b19d-faaba01c3886', '2026-02-24 11:10:49', '2026-02-24 11:10:49', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('2e3776ec-0e5d-44a7-a69c-318765a4a83b', '2026-02-23 14:16:57', '2026-02-23 14:16:57', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('33ff4802-4feb-4612-bb90-0b960e972451', '2026-02-23 13:55:39', '2026-02-23 13:55:39', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('369bc5a7-e88a-4ec1-90cb-981d58965711', '2026-02-24 11:16:08', '2026-02-24 11:16:08', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('4251c05f-6f2b-4a3c-8247-29e70706686d', '2026-02-23 14:10:45', '2026-02-23 14:10:45', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('4483b67a-f49b-43b7-a97e-a3c1d81a5b2a', '2026-02-23 14:20:14', '2026-02-23 14:20:14', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('4e0b7523-300d-4507-8dcb-a34a8cf0899c', '2026-02-23 14:20:09', '2026-02-23 14:20:09', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('52ea4ab1-d940-4b51-98a7-6ba377b191d8', '2026-02-24 11:10:02', '2026-02-24 11:10:02', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('5aae41e4-47a2-4f45-ab33-5351eb3dd57d', '2026-02-24 11:09:46', '2026-02-24 11:09:46', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('6a68165d-6172-4987-96a6-481174f217d8', '2026-02-23 14:10:21', '2026-02-23 14:10:21', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('70c5e48b-f3e2-4c46-b136-26074e56d8cf', '2026-02-24 10:04:11', '2026-02-24 10:04:11', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('71817c12-4740-4cf9-a475-41136721d1c7', '2026-02-23 13:56:45', '2026-02-23 13:56:45', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('774cfc9d-b08a-468e-ab69-dcc97cb2a2f3', '2026-02-24 11:09:48', '2026-02-24 11:09:48', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('7914aa3f-71e7-4d6e-8d79-aa581e931ed8', '2026-02-24 09:59:57', '2026-02-24 09:59:57', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('80faaa3c-4b1c-4072-9c96-54da0c505534', '2026-02-23 14:10:36', '2026-02-23 14:10:36', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('8df033a1-186e-4e5b-8194-f01f0e8dab77', '2026-02-23 13:57:14', '2026-02-23 13:57:14', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('8fdd4291-4b4a-4a23-96d0-3d9d2364a34f', '2026-02-23 13:55:33', '2026-02-23 13:55:33', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('abec0416-6c25-4592-92d4-e8b6c1b19f0c', '2026-02-24 11:10:41', '2026-02-24 11:10:41', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('b57aded3-bd03-4513-8c44-8a050a7756e7', '2026-02-24 11:10:30', '2026-02-24 11:10:30', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('b68c69f3-7986-4be5-ab3e-866be9a19384', '2026-02-23 13:56:57', '2026-02-23 13:56:57', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('bdd22f29-673d-479e-8dcc-d20c8fb8f24b', '2026-02-23 13:57:08', '2026-02-23 13:57:08', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('c6a08a07-a70a-4aa9-b268-ee8a7aa69a91', '2026-02-23 14:07:40', '2026-02-23 14:07:40', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('cbb3c307-b21a-46a3-8df0-dcc501df894e', '2026-02-23 14:20:17', '2026-02-23 14:20:17', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('cf456ee9-4bf9-4538-96da-85949c98dc8d', '2026-02-24 09:54:36', '2026-02-24 09:54:36', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('d411916b-a394-4fb2-8f5a-8d7564dbdd02', '2026-02-23 13:55:45', '2026-02-23 13:55:45', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('eb74ace1-e3d7-4fb0-ba23-9804b8fa0dff', '2026-02-23 14:17:01', '2026-02-23 14:17:01', '039eb105-163a-4a42-a994-85ed107c4289', NULL),
('ffef3f75-d89d-4699-b117-81989a48d171', '2026-02-23 14:10:26', '2026-02-23 14:10:26', '039eb105-163a-4a42-a994-85ed107c4289', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` char(36) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userId` char(36) DEFAULT NULL,
  `roleId` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `courseImage` (`introduction`),
  ADD KEY `organisationId` (`organisationId`),
  ADD KEY `authorId` (`authorId`);

--
-- Indexen voor tabel `course_fiche`
--
ALTER TABLE `course_fiche`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `courseId` (`courseId`),
  ADD KEY `ficheId` (`ficheId`);

--
-- Indexen voor tabel `course_fiche_user`
--
ALTER TABLE `course_fiche_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `course_ficheId` (`course_ficheId`),
  ADD KEY `userId` (`userId`);

--
-- Indexen voor tabel `course_user`
--
ALTER TABLE `course_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `courseId` (`courseId`),
  ADD KEY `userId` (`userId`);

--
-- Indexen voor tabel `fiche`
--
ALTER TABLE `fiche`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `fiche_label`
--
ALTER TABLE `fiche_label`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `ficheId` (`ficheId`),
  ADD KEY `labelId` (`labelId`);

--
-- Indexen voor tabel `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexen voor tabel `user_organisation`
--
ALTER TABLE `user_organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `organisationId` (`organisationId`);

--
-- Indexen voor tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roleId` (`roleId`);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`organisationId`) REFERENCES `organisation` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Beperkingen voor tabel `course_fiche`
--
ALTER TABLE `course_fiche`
  ADD CONSTRAINT `course_fiche_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_fiche_ibfk_2` FOREIGN KEY (`ficheId`) REFERENCES `fiche` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `course_fiche_user`
--
ALTER TABLE `course_fiche_user`
  ADD CONSTRAINT `course_fiche_user_ibfk_1` FOREIGN KEY (`course_ficheId`) REFERENCES `course_fiche` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_fiche_user_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `course_user`
--
ALTER TABLE `course_user`
  ADD CONSTRAINT `course_user_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `fiche_label`
--
ALTER TABLE `fiche_label`
  ADD CONSTRAINT `fiche_label_ibfk_1` FOREIGN KEY (`ficheId`) REFERENCES `fiche` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fiche_label_ibfk_2` FOREIGN KEY (`labelId`) REFERENCES `label` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `user_organisation`
--
ALTER TABLE `user_organisation`
  ADD CONSTRAINT `user_organisation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_organisation_ibfk_2` FOREIGN KEY (`organisationId`) REFERENCES `organisation` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
