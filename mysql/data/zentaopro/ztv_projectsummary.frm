TYPE=VIEW
query=select `zentaopro`.`zt_task`.`project` AS `project`,sum(`zentaopro`.`zt_task`.`estimate`) AS `estimate`,sum(`zentaopro`.`zt_task`.`consumed`) AS `consumed`,sum(if((`zentaopro`.`zt_task`.`status` <> \'cancel\'),`zentaopro`.`zt_task`.`left`,0)) AS `left`,count(0) AS `number`,sum(if(((`zentaopro`.`zt_task`.`status` = \'wait\') or (`zentaopro`.`zt_task`.`status` = \'doing\')),1,0)) AS `undone`,sum((`zentaopro`.`zt_task`.`consumed` + if((`zentaopro`.`zt_task`.`status` <> \'cancel\'),`zentaopro`.`zt_task`.`left`,0))) AS `totalReal` from `zentaopro`.`zt_task` where ((`zentaopro`.`zt_task`.`deleted` = \'0\') and (`zentaopro`.`zt_task`.`parent` = \'0\')) group by `zentaopro`.`zt_task`.`project`
md5=1d500a90953aa54b9b39bfbabe808de0
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:23:24
create-version=2
source=select zentaopro.`zt_task`.`project` AS `project`,sum(zentaopro.`zt_task`.`estimate`) AS `estimate`,sum(zentaopro.`zt_task`.`consumed`) AS `consumed`,sum(if(zentaopro.`zt_task`.status != \'cancel\', `left`, 0)) AS `left`,count(0) AS `number`,sum(if(((zentaopro.`zt_task`.`status` = \'wait\') or (zentaopro.`zt_task`.`status` = \'doing\')),1,0)) AS `undone`,sum((zentaopro.`zt_task`.`consumed` + if(zentaopro.`zt_task`.status != \'cancel\', `left`, 0))) AS `totalReal` from zentaopro.`zt_task` where ((zentaopro.`zt_task`.`deleted` = \'0\') and (zentaopro.`zt_task`.`parent` = \'0\')) group by zentaopro.`zt_task`.`project`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `zentaopro`.`zt_task`.`project` AS `project`,sum(`zentaopro`.`zt_task`.`estimate`) AS `estimate`,sum(`zentaopro`.`zt_task`.`consumed`) AS `consumed`,sum(if((`zentaopro`.`zt_task`.`status` <> \'cancel\'),`zentaopro`.`zt_task`.`left`,0)) AS `left`,count(0) AS `number`,sum(if(((`zentaopro`.`zt_task`.`status` = \'wait\') or (`zentaopro`.`zt_task`.`status` = \'doing\')),1,0)) AS `undone`,sum((`zentaopro`.`zt_task`.`consumed` + if((`zentaopro`.`zt_task`.`status` <> \'cancel\'),`zentaopro`.`zt_task`.`left`,0))) AS `totalReal` from `zentaopro`.`zt_task` where ((`zentaopro`.`zt_task`.`deleted` = \'0\') and (`zentaopro`.`zt_task`.`parent` = \'0\')) group by `zentaopro`.`zt_task`.`project`
mariadb-version=100121
