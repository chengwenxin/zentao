TYPE=VIEW
query=select `t1`.`project` AS `project`,count(\'*\') AS `stories`,sum(if((`t2`.`status` = \'closed\'),0,1)) AS `undone` from (`zentaobiz`.`zt_projectstory` `t1` left join `zentaobiz`.`zt_story` `t2` on((`t1`.`story` = `t2`.`id`))) group by `t1`.`project`
md5=d2b00c21277ff3c917cb915dd1952c9f
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:35:58
create-version=2
source=select `t1`.`project` AS `project`,count(\'*\') AS `stories`,sum(if((`t2`.`status` = \'closed\'),0,1)) AS `undone` from (zentaobiz.`zt_projectstory` `t1` left join zentaobiz.`zt_story` `t2` on((`t1`.`story` = `t2`.`id`))) group by `t1`.`project`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `t1`.`project` AS `project`,count(\'*\') AS `stories`,sum(if((`t2`.`status` = \'closed\'),0,1)) AS `undone` from (`zentaobiz`.`zt_projectstory` `t1` left join `zentaobiz`.`zt_story` `t2` on((`t1`.`story` = `t2`.`id`))) group by `t1`.`project`
mariadb-version=100121
