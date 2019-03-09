-- DROP TABLE IF EXISTS `zt_searchindex`;
CREATE TABLE IF NOT EXISTS `zt_searchindex` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `objectType` char(20) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object` (`objectType`,`objectID`),
  KEY `addedDate` (`addedDate`),
  FULLTEXT KEY `content` (`content`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `zt_searchdict`;
CREATE TABLE IF NOT EXISTS `zt_searchdict` (
  `key` smallint(5) unsigned NOT NULL,
  `value` char(3) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `zt_grouppriv` (`group`, `module`, `method`) VALUES
(1, 'search', 'index'),
(2, 'search', 'index'),
(3, 'search', 'index'),
(4, 'search', 'index'),
(5, 'search', 'index'),
(6, 'search', 'index'),
(7, 'search', 'index'),
(8, 'search', 'index'),
(9, 'search', 'index'),
(10, 'search', 'index'),
(1, 'search', 'buildIndex');
INSERT INTO `zt_grouppriv` (`group`, `module`, `method`) VALUES
(1, 'report', 'export'),
(4, 'report', 'export'),
(5, 'report', 'export'),
(6, 'report', 'export'),
(7, 'report', 'export'),
(8, 'report', 'export'),
(9, 'report', 'export');
