-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 01, 2023 lúc 12:12 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_wibu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `age` date NOT NULL,
  `phone` int(11) NOT NULL,
  `email` text NOT NULL,
  `address` varchar(1000) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `createBy` int(11) NOT NULL,
  `tile` varchar(1000) NOT NULL,
  `content` mediumtext NOT NULL,
  `tag` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `blogId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `replyId` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `like` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `age` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `address` varchar(1000) NOT NULL,
  `image` text NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `name`, `age`, `gender`, `phone`, `email`, `password`, `address`, `image`, `createAt`, `updateAt`) VALUES
(1, 'hiện', '2000-09-08', 'Nam', 865198651, 'nguyenhienlnh@gmail.com', 'eed23196e62f8b98b6fd2ea881fec77a', 'Bắc Ninh', 'review-1.jpg', '2023-04-20 17:46:29', '2023-04-26 17:03:54'),
(2, 'hiện b', '2000-09-08', 'Nam', 865198651, 'nguyenhien@gmail.com', 'h123', 'Bắc Ninh', 'review-2.jpg', '2023-04-20 17:46:29', '2023-04-20 21:07:41'),
(3, 'Nguyen hien', '0000-00-00', '', 0, 'nguyenhienlnh1@gmail.com', 'eed23196e62f8b98b6fd2ea881fec77a', '', '', '2023-04-27 14:14:35', '2023-04-27 14:14:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_follow`
--

CREATE TABLE `customer_follow` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer_follow`
--

INSERT INTO `customer_follow` (`id`, `customerId`, `movieId`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_history`
--

CREATE TABLE `customer_history` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `epId` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `movieId` int(11) NOT NULL,
  `movieUrl` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `poster` text NOT NULL,
  `video` text NOT NULL,
  `views` int(11) NOT NULL,
  `type` text NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `episodes`
--

INSERT INTO `episodes` (`id`, `url`, `movieId`, `movieUrl`, `name`, `poster`, `video`, `views`, `type`, `createAt`, `updateAt`) VALUES
(1, 'ep1', 1, 'fate-stay-night-unlimited-blade', 'Ep 01', 'anime-watch.jpg', 'ep1.mp4', 3, 'video/mp4', '2023-04-24 23:58:54', '2023-04-30 17:36:26'),
(2, 'ep2', 1, 'fate-stay-night-unlimited-blade', 'Ep 02', 'anime-watch.jpg', 'ep2.mp4', 12, 'video/mp4', '2023-04-24 23:59:54', '2023-04-28 16:41:03');

--
-- Bẫy `episodes`
--
DELIMITER $$
CREATE TRIGGER `update_total_episode` AFTER INSERT ON `episodes` FOR EACH ROW UPDATE movies 
SET movies.episodes = (
    SELECT COUNT(*) 
    FROM episodes 
    WHERE movieId = NEW.movieId)
WHERE movies.id = NEW.movieId
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_views` AFTER UPDATE ON `episodes` FOR EACH ROW UPDATE movies 
SET movies.views = (
    SELECT SUM(episodes.views) 
    FROM episodes 
    WHERE movieId = NEW.movieId)
WHERE movies.id = NEW.movieId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `name` text NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `genres`
--

INSERT INTO `genres` (`id`, `url`, `name`, `createAt`, `updateAt`) VALUES
(1, 'action', 'Action', '2023-04-20 15:11:10', '2023-04-20 15:27:38'),
(2, 'movie', 'Movie', '2023-04-20 15:24:28', '2023-04-20 15:27:25'),
(3, 'adventure', 'Adventure', '2023-04-20 15:26:07', '2023-04-20 15:26:07'),
(4, 'fantasy', 'Fantasy', '2023-04-20 15:27:50', '2023-04-20 15:27:50'),
(5, 'magic', 'Magic', '2023-04-20 15:28:01', '2023-04-20 15:28:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `anotherName` varchar(200) NOT NULL,
  `type` text NOT NULL,
  `studios` varchar(200) NOT NULL,
  `dateAired` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `isHighlights` tinyint(1) NOT NULL,
  `genre` text NOT NULL,
  `episodes` int(11) NOT NULL,
  `totalEpisode` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `duration` text NOT NULL,
  `quality` text NOT NULL,
  `views` int(11) NOT NULL,
  `describe` varchar(2000) NOT NULL,
  `image` text NOT NULL,
  `imageSidebar` text NOT NULL,
  `isSidebar` tinyint(1) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `url`, `name`, `anotherName`, `type`, `studios`, `dateAired`, `status`, `isHighlights`, `genre`, `episodes`, `totalEpisode`, `like`, `dislike`, `duration`, `quality`, `views`, `describe`, `image`, `imageSidebar`, `isSidebar`, `createAt`, `updateAt`) VALUES
(1, 'fate-stay-night-unlimited-blade', 'Fate Stay Night: Unlimited Blade', 'フェイト／ステイナイト, Feito／sutei naito', 'TV Series', 'Lerche', '2019-10-02', 'Airing', 0, 'Action, Adventure, Fantasy, Magic', 1, 0, 2, 0, '24 min/ep', 'HD', 15, 'Every human inhabiting the world of Alcia is branded by a “Count” or a number written on their body. For Hina’s mother, her total drops to 0 and she’s pulled into the Abyss, never to be seen again. But her mother’s last words send Hina on a quest to find a legendary hero from the Waste War - the fabled Ace!', 'popular-3.jpg', 'hero-1.jpg', 1, '2023-04-20 15:34:10', '2023-04-30 17:36:26'),
(2, 'boruto-baruto-next-generations', 'Boruto: Naruto next generations', 'BORUTO-ボルト- NARUTO NEXT GENERATIONS', 'TV Series', 'Lerche', '2017-04-05', 'Airing', 1, 'Action, Adventure, Fantasy, Shonen', 293, 0, 0, 0, '24 min/ep', 'HD', 829099, 'Years have passed since Naruto and Sasuke teamed up to defeat Kaguya, the progenitor of chakra and the greatest threat the ninja world has ever faced. Times are now peaceful and the new generation of shinobi has not experienced the same hardships as its parents. Perhaps that is why Boruto would rather play video games than train. However, one passion does burn deep in this ninja boy’s heart, and that is the desire to defeat his father!', 'trend-1.jpg', 'tv-1.jpg', 0, '2023-04-20 15:34:10', '2023-04-28 17:26:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_likes`
--

CREATE TABLE `movie_likes` (
  `movieId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `movie_likes`
--

INSERT INTO `movie_likes` (`movieId`, `customerId`, `status`) VALUES
(1, 3, 1),
(1, 1, 1);

--
-- Bẫy `movie_likes`
--
DELIMITER $$
CREATE TRIGGER `update_like_dislike_delete` AFTER DELETE ON `movie_likes` FOR EACH ROW UPDATE movies 
SET 
movies.like = (
    SELECT COUNT(*) 
    FROM movie_likes 
    WHERE movieId = old.movieId AND status = 1), 
movies.dislike = (
    SELECT COUNT(*) 
    FROM movie_likes 
    WHERE movieId = old.movieId AND status = 0) 
WHERE movies.id = old.movieId
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_like_dislike_insert` AFTER INSERT ON `movie_likes` FOR EACH ROW UPDATE movies 
SET 
movies.like = (
    SELECT COUNT(*) 
    FROM movie_likes 
    WHERE movieId = NEW.movieId AND status = 1), 
movies.dislike = (
    SELECT COUNT(*) 
    FROM movie_likes 
    WHERE movieId = NEW.movieId AND status = 0) 
WHERE movies.id = NEW.movieId
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_like_dislike_update` AFTER UPDATE ON `movie_likes` FOR EACH ROW UPDATE movies 
SET 
movies.like = (
    SELECT COUNT(*) 
    FROM movie_likes 
    WHERE movieId = NEW.movieId AND status = 1), 
movies.dislike = (
    SELECT COUNT(*) 
    FROM movie_likes 
    WHERE movieId = NEW.movieId AND status = 0) 
WHERE movies.id = NEW.movieId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_reviews`
--

CREATE TABLE `movie_reviews` (
  `id` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `movie_reviews`
--

INSERT INTO `movie_reviews` (`id`, `movieId`, `customerId`, `comment`, `createAt`, `updateAt`) VALUES
(1, 1, 1, 'hay vcl', '2023-04-20 17:48:25', '2023-04-20 17:48:25'),
(2, 1, 2, 'Cũng được đấy', '2023-04-20 17:48:25', '2023-04-20 17:48:25'),
(3, 2, 1, 'd', '2023-04-24 20:31:25', '2023-04-24 20:31:25'),
(4, 2, 1, 'hay', '2023-04-24 20:32:11', '2023-04-24 20:32:11'),
(5, 2, 1, 'hay vcl', '2023-04-24 20:37:00', '2023-04-24 20:37:00'),
(6, 2, 1, 'ok', '2023-04-24 20:37:39', '2023-04-24 20:37:39'),
(7, 2, 1, 'ok', '2023-04-24 20:38:02', '2023-04-24 20:38:02'),
(8, 2, 1, 'oka', '2023-04-24 20:39:17', '2023-04-24 20:39:17'),
(9, 2, 1, 'ccv', '2023-04-16 20:39:31', '2023-04-27 17:06:48'),
(10, 2, 1, 'vxcv1', '2023-04-24 20:40:13', '2023-04-24 20:40:13'),
(11, 2, 1, 'hashdas', '2023-04-24 20:59:38', '2023-04-24 20:59:38'),
(12, 2, 1, 'ok', '2023-04-24 21:19:09', '2023-04-24 21:19:09'),
(13, 2, 1, 'hi', '2023-04-24 21:20:19', '2023-04-24 21:20:19'),
(14, 2, 1, 'asd', '2023-04-24 21:21:04', '2023-04-24 21:21:04'),
(15, 2, 1, 'asd', '2023-04-24 21:21:15', '2023-04-24 21:21:15'),
(16, 2, 1, 'asd', '2023-04-24 21:22:09', '2023-04-24 21:22:09'),
(17, 2, 1, 'ok roi day', '2023-04-24 21:30:56', '2023-04-24 21:30:56'),
(18, 1, 1, 'phim hay vãi', '2023-04-24 21:32:39', '2023-04-24 21:32:39'),
(19, 1, 1, 'ok', '2023-04-25 17:31:51', '2023-04-25 17:31:51'),
(20, 1, 1, 'test\r\n', '2023-04-25 17:33:41', '2023-04-25 17:33:41'),
(21, 1, 1, 'test lan 2', '2023-04-25 17:37:55', '2023-04-25 17:37:55'),
(22, 2, 3, 'test ok chuwa', '2023-04-27 14:50:27', '2023-04-27 14:50:27'),
(23, 2, 3, 'ok', '2023-04-27 15:00:08', '2023-04-27 15:00:08'),
(24, 2, 3, 'ok lan 2', '2023-04-27 15:00:46', '2023-04-27 15:00:46'),
(25, 1, 3, 'test', '2023-04-27 15:01:03', '2023-04-27 15:01:03'),
(26, 1, 3, 'test', '2023-04-27 15:12:03', '2023-04-27 15:12:03'),
(27, 1, 3, 'ok', '2023-04-27 15:13:12', '2023-04-27 15:13:12'),
(28, 1, 3, 'ok', '2023-04-27 15:13:50', '2023-04-27 15:13:50'),
(29, 1, 1, 'test 2\r\n', '2023-04-28 14:59:50', '2023-04-28 14:59:50'),
(30, 1, 1, 'test 3', '2023-05-01 14:51:30', '2023-05-01 14:51:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_view_time`
--

CREATE TABLE `movie_view_time` (
  `movieId` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `movie_view_time`
--

INSERT INTO `movie_view_time` (`movieId`, `views`, `date`, `createAt`, `updateAt`) VALUES
(2, 7, '2023-04-28', '2023-04-28 09:25:35', '2023-04-28 10:49:17'),
(1, 2, '2023-04-27', '2023-04-28 10:44:06', '2023-04-28 10:49:08'),
(1, 4, '2023-04-28', '2023-04-28 10:49:29', '2023-04-28 11:01:55'),
(1, 1, '2023-04-30', '2023-04-30 17:36:26', '2023-04-30 17:36:26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`) USING HASH;

--
-- Chỉ mục cho bảng `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogId` (`blogId`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_follow`
--
ALTER TABLE `customer_follow`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_history`
--
ALTER TABLE `customer_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Url` (`url`) USING HASH;

--
-- Chỉ mục cho bảng `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`) USING HASH;

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`) USING HASH;

--
-- Chỉ mục cho bảng `movie_reviews`
--
ALTER TABLE `movie_reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customer_follow`
--
ALTER TABLE `customer_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `customer_history`
--
ALTER TABLE `customer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `movie_reviews`
--
ALTER TABLE `movie_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
