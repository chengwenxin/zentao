<?php
$config->crystal = new stdclass();
$config->crystal->sqlBlackList = "create,drop,backup,alter,insert,replace,update,delete,rename,do,truncate,load,handler,lock,unlock,grant,outfile,infile";
$config->crystal->sqlBlackFunc = "current_user,load_file,session_user,database,user,system_user";
