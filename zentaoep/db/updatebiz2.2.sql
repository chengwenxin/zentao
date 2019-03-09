ALTER TABLE `zt_doc`
ADD `parent` smallint(5) unsigned NOT NULL DEFAULT '0' AFTER `type`,
ADD `path` char(255) COLLATE 'utf8_general_ci' NOT NULL DEFAULT '' AFTER `parent`,
ADD `grade` tinyint(3) unsigned NOT NULL DEFAULT '0' AFTER `path`,
ADD `order` smallint(5) unsigned NOT NULL DEFAULT '0' AFTER `grade`;
