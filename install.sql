DROP TABLE IF EXISTS `{#}horoscope`;
CREATE TABLE `{#}horoscope` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `plan` varchar(20) DEFAULT NULL,
  `forecast` mediumtext DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `record` (`name`,`plan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `{#}widgets`(, `controller`, `name`, `title`, `author`, `url`, `version`, `is_external`, `files`, `addon_id`) VALUES ('horoscope', 'default', 'Гороскоп', 'myInstantCMS Team', 'https://myinstantcms.ru', '0.1.0', 1, NULL, NULL);
INSERT INTO `{#}scheduler_tasks`(`title`, `controller`, `hook`, `period`, `is_strict_period`, `date_last_run`, `is_active`, `is_new`) VALUES ('Обновление гороскопа', 'horoscope', 'refresh', 1440, 1, '2018-10-10 16:42:00', NULL, 0);