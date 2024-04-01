DROP TABLE IF EXISTS users;


CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `decrypt_key` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `decrypt_key`, `status`, `created_at`) VALUES
(1, 'Amit', 'admin@admin.com', 'ss', 1, '2024-03-29 20:49:19'),
(2, 'Amit', 'hobumyko@mailinator.com', 'sdsdsd', 1, '2024-03-29 20:50:03'),
(3, 'Amit', 'xyqywute@mailinator.com', 'a', 1, '2024-03-29 20:54:00'),
(4, 'Amit', 'sdS@ff.d', 'dsd', 1, '2024-03-29 20:56:22'),
(5, 'Amit', 'abhishek.kumar@smartdatainc.net', 'asassasa', 1, '2024-03-29 21:01:57'),
(6, 'Amit', 'admin@admins.com', 'aaaaa', 1, '2024-03-29 23:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;