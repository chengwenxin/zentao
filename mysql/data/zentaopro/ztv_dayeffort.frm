TYPE=VIEW
query=select round(sum(`zentaopro`.`zt_effort`.`consumed`),1) AS `consumed`,`zentaopro`.`zt_effort`.`date` AS `date` from `zentaopro`.`zt_effort` group by `zentaopro`.`zt_effort`.`date`
md5=6fce8237056aa688181d356fd91aef3c
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-11-20 09:23:25
create-version=2
source=select round(sum(zentaopro.`zt_effort`.`consumed`),1) AS `consumed`,zentaopro.`zt_effort`.`date` AS `date` from zentaopro.`zt_effort` group by zentaopro.`zt_effort`.`date`
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select round(sum(`zentaopro`.`zt_effort`.`consumed`),1) AS `consumed`,`zentaopro`.`zt_effort`.`date` AS `date` from `zentaopro`.`zt_effort` group by `zentaopro`.`zt_effort`.`date`
mariadb-version=100121
