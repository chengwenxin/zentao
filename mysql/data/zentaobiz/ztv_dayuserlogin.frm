TYPE=VIEW
query=select count(0) AS `userlogin`,left(`zentaobiz`.`zt_action`.`date`,10) AS `day` from `zentaobiz`.`zt_action` where ((`zentaobiz`.`zt_action`.`objectType` = \'user\') and (`zentaobiz`.`zt_action`.`action` = \'login\')) group by left(`zentaobiz`.`zt_action`.`date`,10)
md5=327cb6a5bf0052dbc9b42b3b5839513a
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:35:58
create-version=2
source=select count(*) AS `userlogin`,left(zentaobiz.`zt_action`.`date`,10) AS `day` from zentaobiz.`zt_action` where ((zentaobiz.`zt_action`.`objectType` = \'user\') and (zentaobiz.`zt_action`.`action` = \'login\')) group by left(zentaobiz.`zt_action`.`date`,10)
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select count(0) AS `userlogin`,left(`zentaobiz`.`zt_action`.`date`,10) AS `day` from `zentaobiz`.`zt_action` where ((`zentaobiz`.`zt_action`.`objectType` = \'user\') and (`zentaobiz`.`zt_action`.`action` = \'login\')) group by left(`zentaobiz`.`zt_action`.`date`,10)
mariadb-version=100121
