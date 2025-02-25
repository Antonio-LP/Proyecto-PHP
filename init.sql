CREATE DATABASE IF NOT EXISTS graham;
USE graham;

CREATE TABLE `users` (
  `id_value` varchar(36) NOT NULL,
  `name_value` varchar(255) NOT NULL,
  `email_value` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_value`);
COMMIT;
