UPDATE `zt_grouppriv` set `method`='calendar' WHERE `module` = 'todo' AND `method` = 'fullcalendar';
UPDATE `zt_grouppriv` set `method`='calendar' WHERE `module` = 'effort' AND `method` = 'fullcalendar';
UPDATE `zt_grouppriv` set `method`='calendar' WHERE `module` = 'project' AND `method` = 'fullcalendar';
UPDATE `zt_grouppriv` set `method`='effortcalendar' WHERE `module` = 'user' AND `method` = 'effortfullcalendar';
UPDATE `zt_grouppriv` set `method`='todocalendar' WHERE `module` = 'user' AND `method` = 'todofullcalendar';
