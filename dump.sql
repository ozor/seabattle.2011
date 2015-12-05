

CREATE TABLE `field` (
  `id` int(11) NOT NULL auto_increment,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `field_matrix` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `field_id` int(10) unsigned NOT NULL,
  `y` int(10) unsigned NOT NULL,
  `x` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `field_matrix_busy` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `field_id` int(10) unsigned NOT NULL,
  `y` int(10) unsigned NOT NULL,
  `x` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;