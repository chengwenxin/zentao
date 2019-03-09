<?php
 die();
?>

21:55:02 ERROR: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'automatedTesting' in 'field list'&lt;p&gt;The sql is: INSERT INTO `zt_bug` SET `product` = '1',`module` = '0',`project` = '0',`openedBuild` = 'trunk',`assignedTo` = '',`deadline` = '0000-00-00',`automatedTesting` = '已实现',`defectSource` = '自动化测试发现',`type` = 'codeerror',`os` = '',`browser` = '',`title` = 'bug1',`color` = '',`severity` = '3',`pri` = '3',`steps` = '&lt;p&gt;\r\n	[步骤]\r\n&lt;/p&gt;\r\n&lt;br /&gt;&lt;p&gt;\r\n	[结果]\r\n&lt;/p&gt;\r\n&lt;br /&gt;&lt;p&gt;\r\n	[期望]\r\n&lt;/p&gt;\r\n&lt;br /&gt;',`story` = '0',`task` = '0',`mailto` = '',`keywords` = '',`case` = '0',`caseVersion` = '0',`result` = '0',`testtask` = '0',`openedBy` = 'admin',`openedDate` = '2019-03-09 21:55:02'&lt;/p&gt; in E:\xampp\zentao\lib\base\dao\dao.class.php on line 1394, last called by E:\xampp\zentao\lib\base\dao\dao.class.php on line 768 through function sqlError.
 in E:\xampp\zentao\framework\base\router.class.php on line 2215 when visiting bug-create-1-0-moduleID=0
