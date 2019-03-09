<?php
$config->bug->export                 = new stdclass();
$config->bug->import                 = new stdclass();
$config->bug->export->listFields     = explode(',', "module,project,story,severity,pri,type,os,browser,openedBuild");
$config->bug->export->sysListFields  = explode(',', "module,project,story");
$config->bug->export->templateFields = explode(',', "product,branch,module,project,story,title,keywords,severity,pri,type,os,browser,steps,deadline,openedBuild");
$config->bug->import->ignoreFields   = explode(',', "status,activatedCount,confirmed,mailto,openedBy,openedDate,assignedDate,resolvedBy,resolution,resolvedBuild,resolvedDate,closedBy,closedDate,duplicateBug,linkBug,case,lastEditedBy,lastEditedDate,files");
