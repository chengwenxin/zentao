<?php
$config->task->export                 = new stdclass();
$config->task->import                 = new stdclass();
$config->task->export->listFields     = explode(',', "module,story,pri,type");
$config->task->export->sysListFields  = explode(',', "module,story");
$config->task->export->templateFields = explode(',', "project,module,story,name,desc,type,pri,estimate,estStarted,deadline");
$config->task->import->ignoreFields   = explode(',', "mailto,openedBy,openedDate,assignedTo,assignedDate,finishedBy,finishedDate,canceledBy,canceledDate,closedBy,closedDate,closedReason,lastEditedBy,lastEditedDate,files");
$config->task->exportFields = '
    id, project, module, story,
    name, desc,
    type, pri, estStarted, realStarted, deadline, status,estimate, consumed, left,
    mailto,
    openedBy, openedDate, assignedTo, assignedDate,
    finishedBy, finishedDate, canceledBy, canceledDate,
    closedBy, closedDate, closedReason,
    lastEditedBy, lastEditedDate,files
    ';

