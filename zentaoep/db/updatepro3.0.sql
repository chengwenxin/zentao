ALTER TABLE `zt_repo` ADD `commits` mediumint unsigned NOT NULL AFTER `client`;
ALTER TABLE `zt_repoComment` CHANGE `revision` `revision` varchar(40) COLLATE 'utf8_general_ci' NOT NULL AFTER `repo`;
ALTER TABLE `zt_repoComment` ADD `commit` mediumint unsigned NOT NULL AFTER `revision`;
ALTER TABLE `zt_repoComment` RENAME TO `zt_repoHistory`;

ALTER TABLE `zt_bug` CHANGE `caseVersion` `caseVersion` smallint(6) NOT NULL AFTER `case`;
ALTER TABLE `zt_bug` ADD `repo` mediumint(8) unsigned NOT NULL AFTER `result`;
ALTER TABLE `zt_bug` ADD `lines` varchar(10) COLLATE 'utf8_general_ci' NOT NULL AFTER `repo`;
ALTER TABLE `zt_bug` ADD `v1` varchar(40) COLLATE 'utf8_general_ci' NOT NULL AFTER `lines`;
ALTER TABLE `zt_bug` ADD `v2` varchar(40) COLLATE 'utf8_general_ci' NOT NULL AFTER `v1`;
ALTER TABLE `zt_bug` ADD `entry` varchar(60) COLLATE 'utf8_general_ci' NOT NULL AFTER `repo`;
