TYPE=VIEW
query=select count(0) AS `bugresolve`,left(`zentaopro`.`zt_action`.`date`,10) AS `day` from `zentaopro`.`zt_action` where ((`zentaopro`.`zt_action`.`objectType` = \'bug\') and (`zentaopro`.`zt_action`.`action` = \'resolved\')) group by left(`zentaopro`.`zt_action`.`date`,10)
md5=2a256abcc1d2d6bae27b4a9ac9dae0c7
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:23:25
create-version=2
source=select count(*) AS `bugresolve`,left(zentaopro.`zt_action`.`date`,10) AS `day` from zentaopro.`zt_action` where ((zentaopro.`zt_action`.`objectType` = \'bug\') and (zentaopro.`zt_action`.`action` = \'resolved\')) group by left(zentaopro.`zt_action`.`date`,10)
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select count(0) AS `bugresolve`,left(`zentaopro`.`zt_action`.`date`,10) AS `day` from `zentaopro`.`zt_action` where ((`zentaopro`.`zt_action`.`objectType` = \'bug\') and (`zentaopro`.`zt_action`.`action` = \'resolved\')) group by left(`zentaopro`.`zt_action`.`date`,10)
mariadb-version=100121
