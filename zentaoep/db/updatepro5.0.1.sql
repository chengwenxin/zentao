ALTER TABLE `zt_effort` ADD INDEX `effort` (`project`, `objectID`, `date`, `account`);
ALTER TABLE `zt_relationoftasks` ADD INDEX `relationoftasks` (`project`, `task`);
ALTER TABLE `zt_repofiles` ADD INDEX `repo` (`repo`, `revision`);
ALTER TABLE `zt_repohistory` ADD INDEX `repo` (`repo`, `revision`);
