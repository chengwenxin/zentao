ALTER TABLE  `zt_effort` ADD  `consumed` FLOAT NOT NULL AFTER  `date`;
ALTER TABLE `zt_user` ADD `ldap` CHAR(30) NOT NULL AFTER `ranzhi`;

