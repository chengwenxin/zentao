<?php
 die();
?>
20190309 21:55:02: bug-create-1-0-moduleID=0
  SELECT * FROM `zt_userview` WHERE account  = 'admin'
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('xuanxuan') AND  `key` IN ('key')
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT account, realname, deleted, INSTR(',td,pm,qd,qa,dev,', role) AS roleOrder FROM `zt_user` WHERE 1  AND  deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT version FROM `zt_story` WHERE id  = '0'
  SELECT id,title FROM `zt_bug` WHERE deleted  = '0' AND  title IN ('bug1') AND  openedDate  >= '2019-03-09 21:54:02' AND  product=1 
  INSERT INTO `zt_bug` SET `product` = '1',`module` = '0',`project` = '0',`openedBuild` = 'trunk',`assignedTo` = '',`deadline` = '0000-00-00',`automatedTesting` = '已实现',`defectSource` = '自动化测试发现',`type` = 'codeerror',`os` = '',`browser` = '',`title` = 'bug1',`color` = '',`severity` = '3',`pri` = '3',`steps` = '<p>\r\n	[步骤]\r\n</p>\r\n<br /><p>\r\n	[结果]\r\n</p>\r\n<br /><p>\r\n	[期望]\r\n</p>\r\n<br />',`story` = '0',`task` = '0',`mailto` = '',`keywords` = '',`case` = '0',`caseVersion` = '0',`result` = '0',`testtask` = '0',`openedBy` = 'admin',`openedDate` = '2019-03-09 21:55:02'

