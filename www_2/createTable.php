CREATE TABLE IF NOT EXISTS `giffie_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_regid` text,
  `name` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imei` varchar(20) NOT NULL,
  `ph_num` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `imei` (`imei`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


















ALTER TABLE giffie_users
ADD verified INT NOT NULL DEFAULT 0 
