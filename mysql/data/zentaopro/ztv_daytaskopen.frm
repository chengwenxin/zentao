TYPE=VIEW
query=select count(0) AS `taskopen`,left(`zentaopro`.`zt_action`.`date`,10) AS `day` from `zentaopro`.`zt_action` where ((`zentaopro`.`zt_action`.`objectType` = \'task\') and (`zentaopro`.`zt_action`.`action` = \'opened\')) group by left(`zentaopro`.`zt_action`.`date`,10)
md5=84b113d0fa6b9121fe376cf64214aabc
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:23:25
create-version=2
source=select count(*) AS `taskopen`,left(zentaopro.`zt_action`.`date`,10) AS `day` from zentaopro.`zt_action` where ((zentaopro.`zt_action`.`objectType` = \'task\') and (zentaopro.`zt_action`.`action` = \'opened\')) group by left(zentaopro.`zt_action`.`date`,10)
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select count(0) AS `taskopen`,left(`zentaopro`.`zt_action`.`date`,10) AS `day` from `zentaopro`.`zt_action` where ((`zentaopro`.`zt_action`.`objectType` = \'task\') and (`zentaopro`.`zt_action`.`action` = \'opened\')) group by left(`zentaopro`.`zt_action`.`date`,10)
mariadb-version=100121
