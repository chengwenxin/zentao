TYPE=VIEW
query=select `zentaobiz`.`zt_task`.`project` AS `project`,sum(`zentaobiz`.`zt_task`.`estimate`) AS `estimate`,sum(`zentaobiz`.`zt_task`.`consumed`) AS `consumed`,sum(if((`zentaobiz`.`zt_task`.`status` <> \'cancel\'),`zentaobiz`.`zt_task`.`left`,0)) AS `left`,count(0) AS `number`,sum(if(((`zentaobiz`.`zt_task`.`status` = \'wait\') or (`zentaobiz`.`zt_task`.`status` = \'doing\')),1,0)) AS `undone`,sum((`zentaobiz`.`zt_task`.`consumed` + if((`zentaobiz`.`zt_task`.`status` <> \'cancel\'),`zentaobiz`.`zt_task`.`left`,0))) AS `totalReal` from `zentaobiz`.`zt_task` where ((`zentaobiz`.`zt_task`.`deleted` = \'0\') and (`zentaobiz`.`zt_task`.`parent` = \'0\')) group by `zentaobiz`.`zt_task`.`project`
md5=51808c997c5513dea965a2da6021179d
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:35:58
create-version=2
source=select zentaobiz.`zt_task`.`project` AS `project`,sum(zentaobiz.`zt_task`.`estimate`) AS `estimate`,sum(zentaobiz.`zt_task`.`consumed`) AS `consumed`,sum(if(zentaobiz.`zt_task`.status != \'cancel\', `left`, 0)) AS `left`,count(0) AS `number`,sum(if(((zentaobiz.`zt_task`.`status` = \'wait\') or (zentaobiz.`zt_task`.`status` = \'doing\')),1,0)) AS `undone`,sum((zentaobiz.`zt_task`.`consumed` + if(zentaobiz.`zt_task`.status != \'cancel\', `left`, 0))) AS `totalReal` from zentaobiz.`zt_task` where ((zentaobiz.`zt_task`.`deleted` = \'0\') and (zentaobiz.`zt_task`.`parent` = \'0\')) group by zentaobiz.`zt_task`.`project`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `zentaobiz`.`zt_task`.`project` AS `project`,sum(`zentaobiz`.`zt_task`.`estimate`) AS `estimate`,sum(`zentaobiz`.`zt_task`.`consumed`) AS `consumed`,sum(if((`zentaobiz`.`zt_task`.`status` <> \'cancel\'),`zentaobiz`.`zt_task`.`left`,0)) AS `left`,count(0) AS `number`,sum(if(((`zentaobiz`.`zt_task`.`status` = \'wait\') or (`zentaobiz`.`zt_task`.`status` = \'doing\')),1,0)) AS `undone`,sum((`zentaobiz`.`zt_task`.`consumed` + if((`zentaobiz`.`zt_task`.`status` <> \'cancel\'),`zentaobiz`.`zt_task`.`left`,0))) AS `totalReal` from `zentaobiz`.`zt_task` where ((`zentaobiz`.`zt_task`.`deleted` = \'0\') and (`zentaobiz`.`zt_task`.`parent` = \'0\')) group by `zentaobiz`.`zt_task`.`project`
mariadb-version=100121
