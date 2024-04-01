DROP TABLE IF EXISTS messages;

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `text` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiry_time` int(20) NOT NULL DEFAULT 10,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `text`, `recipient`, `created_at`, `expiry_time`, `status`) VALUES
(82, 'T1egCaF3h4j3rwh6DWhznBktobeq+HDzjMaygPHp6Y7TvMU2ahM4kuCmRq2X0CEbuZ2gyGhQyuWj2lYsy17QqQ==', 'admin@admin.com', '2024-03-29 22:55:13', 10, 0),
(83, 'KMEAjrwAJHNj7fqJmYeofQ2YwazkdgiW8n0+gxgngriGxDjLzdaOgASgtyyNcHR6', 'admin@admin.com', '2024-03-29 22:55:24', 10, 0),
(84, 'jxML0wUQNdBoRVC3yxMx1g==', 'admin@admin.com', '2024-03-29 22:58:04', 10, 0),
(85, 'xNWommd5WtjWoSN5+0s0yA==', 'admin@admin.com', '2024-03-29 22:58:07', 10, 0),
(86, 'RHDDCFK8GUIPOXgxkjya7g==', 'admin@admin.com', '2024-03-29 22:58:09', 10, 0),
(87, 'MSUA5N4tjyPLboGMxMqTmA==', 'admin@admin.com', '2024-03-29 22:58:12', 10, 0),
(88, '8+EjxLTZOBvmFrabQM9ApQ==', 'admin@admin.com', '2024-03-29 22:58:16', 10, 0),
(89, 'xvAReFaVStSKKXaRAD4bsA==', 'admin@admin.com', '2024-03-29 23:04:20', 10, 1),
(90, 'VISumNl/W9t8HOMfPkuzXA==', 'admin@admins.com', '2024-03-29 23:04:33', 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;
