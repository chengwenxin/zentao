TYPE=VIEW
query=select `zentaobiz`.`zt_team`.`root` AS `project`,count(\'*\') AS `teams` from `zentaobiz`.`zt_team` where (`zentaobiz`.`zt_team`.`type` = \'project\') group by `zentaobiz`.`zt_team`.`root`
md5=7a0168bc92b08601ee68fde6d7080ef7
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:35:58
create-version=2
source=select zentaobiz.`zt_team`.`root` AS `project`,count(\'*\') AS `teams` from zentaobiz.`zt_team` where `type` = \'project\' group by zentaobiz.`zt_team`.`root`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `zentaobiz`.`zt_team`.`root` AS `project`,count(\'*\') AS `teams` from `zentaobiz`.`zt_team` where (`zentaobiz`.`zt_team`.`type` = \'project\') group by `zentaobiz`.`zt_team`.`root`
mariadb-version=100121
