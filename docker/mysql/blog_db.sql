create DATABASE IF NOT EXISTS blog_db;

USE blog_db;

# Volcado tabla authors
# -------------------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
    `id` varchar(36) NOT NULL,
    `name` varchar(36) NOT NULL,
    `alias` varchar(36) NOT NULL,
    `contact_email` varchar(191) NOT NULL,
    `personal_description` text,
    `short_description` text NOT NULL,
    `avatar` varchar(256) NOT NULL,
    `social_media` text,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
