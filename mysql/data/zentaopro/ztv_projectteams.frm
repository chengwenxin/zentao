TYPE=VIEW
query=select `zentaopro`.`zt_team`.`root` AS `project`,count(\'*\') AS `teams` from `zentaopro`.`zt_team` where (`zentaopro`.`zt_team`.`type` = \'project\') group by `zentaopro`.`zt_team`.`root`
md5=ccd17e611ce7b5258146036fd18e7cc2
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:23:24
create-version=2
source=select zentaopro.`zt_team`.`root` AS `project`,count(\'*\') AS `teams` from zentaopro.`zt_team` where `type` = \'project\' group by zentaopro.`zt_team`.`root`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `zentaopro`.`zt_team`.`root` AS `project`,count(\'*\') AS `teams` from `zentaopro`.`zt_team` where (`zentaopro`.`zt_team`.`type` = \'project\') group by `zentaopro`.`zt_team`.`root`
mariadb-version=100121
