DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
    `username` varchar(60) NOT NULL COMMENT 'username',
    `password` varchar(60) NOT NULL COMMENT 'password',
    `avatar` longblob COMMENT 'avatar', 
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
