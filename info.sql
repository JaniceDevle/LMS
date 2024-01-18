DROP TABLE IF EXISTS `info`;
CREATE TABLE `info`(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
    `title` varchar(60) NOT NULL COMMENT 'title',
    `content` varchar(60) NOT NULL COMMENT 'content',
    `author` varchar(60) NOT NULL COMMENT 'author',
    `country` varchar(60) NOT null COMMENT 'country',
    `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'addtime',
    `state` BOOLEAN NOT NULL DEFAULT 1 COMMENT 'state',
    PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `info` VALUES
(1, 'Anna Karenina', 'Lev Tolstoy','Russia','2022-04-16 09:07:58','1'),
(2, 'Hamlet', 'Shakespeare','England','2022-09-24 12:12:58','0'),
(3, 'Walden', 'Henry David Thoreau','United States','2022-12-12 15:06:58','1'),