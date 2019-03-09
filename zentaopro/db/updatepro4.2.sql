ALTER TABLE `zt_bug` CHANGE `entry` `entry` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `repo`;
ALTER TABLE `zt_bug` ADD `repoType` varchar(30) COLLATE 'utf8_general_ci' NOT NULL default '' AFTER `v2`;
ALTER TABLE `zt_report` ADD `step` tinyint(1) NOT NULL DEFAULT '2' AFTER `params`;
