CREATE TABLE `user` (
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(128) CHARACTER SET utf8mb3 NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `message` (
  `message_id` int(255) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `message_user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `message_user_id_idxfx` (`message_user_id`),
  CONSTRAINT `message_user_id_idxfx` FOREIGN KEY (`message_user_id`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;