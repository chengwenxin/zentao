ALTER TABLE  `zt_effort` ADD  `left` FLOAT NOT NULL AFTER  `date` ;
ALTER TABLE  `zt_action` ADD  `efforted` BOOL NOT NULL DEFAULT  '0';
