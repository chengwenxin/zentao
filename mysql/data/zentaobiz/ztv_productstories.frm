TYPE=VIEW
query=select `zentaobiz`.`zt_story`.`product` AS `product`,count(\'*\') AS `stories`,sum(if((`zentaobiz`.`zt_story`.`status` = \'closed\'),0,1)) AS `undone` from `zentaobiz`.`zt_story` where (`zentaobiz`.`zt_story`.`deleted` = \'0\') group by `zentaobiz`.`zt_story`.`product`
md5=e16f482c305d445d55ad667ab8ff4345
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:35:58
create-version=2
source=select zentaobiz.`zt_story`.`product` AS `product`,count(\'*\') AS `stories`,sum(if((zentaobiz.`zt_story`.`status` = \'closed\'),0,1)) AS `undone` from zentaobiz.`zt_story` where (zentaobiz.`zt_story`.`deleted` = \'0\') group by zentaobiz.`zt_story`.`product`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `zentaobiz`.`zt_story`.`product` AS `product`,count(\'*\') AS `stories`,sum(if((`zentaobiz`.`zt_story`.`status` = \'closed\'),0,1)) AS `undone` from `zentaobiz`.`zt_story` where (`zentaobiz`.`zt_story`.`deleted` = \'0\') group by `zentaobiz`.`zt_story`.`product`
mariadb-version=100121
