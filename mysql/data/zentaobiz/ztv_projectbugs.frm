TYPE=VIEW
query=select `zentaobiz`.`zt_bug`.`project` AS `project`,count(0) AS `bugs`,sum(if((`zentaobiz`.`zt_bug`.`resolution` = \'\'),0,1)) AS `resolutions`,sum(if((`zentaobiz`.`zt_bug`.`severity` <= 2),1,0)) AS `seriousBugs` from `zentaobiz`.`zt_bug` where (`zentaobiz`.`zt_bug`.`deleted` = \'0\') group by `zentaobiz`.`zt_bug`.`project`
md5=c70281a9ccc3475037823d04f8b47483
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:35:58
create-version=2
source=select zentaobiz.`zt_bug`.`project` AS `project`,count(0) AS `bugs`,sum(if((zentaobiz.`zt_bug`.`resolution` = \'\'),0,1)) AS `resolutions`,sum(if((zentaobiz.`zt_bug`.`severity` <= 2),1,0)) AS `seriousBugs` from zentaobiz.`zt_bug` where (zentaobiz.`zt_bug`.`deleted` = \'0\') group by zentaobiz.`zt_bug`.`project`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `zentaobiz`.`zt_bug`.`project` AS `project`,count(0) AS `bugs`,sum(if((`zentaobiz`.`zt_bug`.`resolution` = \'\'),0,1)) AS `resolutions`,sum(if((`zentaobiz`.`zt_bug`.`severity` <= 2),1,0)) AS `seriousBugs` from `zentaobiz`.`zt_bug` where (`zentaobiz`.`zt_bug`.`deleted` = \'0\') group by `zentaobiz`.`zt_bug`.`project`
mariadb-version=100121
