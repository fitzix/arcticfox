DROP TABLE IF EXISTS `#__wing_img`;

CREATE TABLE `#__wing_img`(
  `id`    INT(11) NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(25),
  `path`  VARCHAR(255) NOT NULL,
  `published` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM
  AUTO_INCREMENT = 0
  DEFAULT CHARSET utf8;
