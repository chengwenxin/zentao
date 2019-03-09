<?php
$config->testcase->export               = new stdclass();
$config->testcase->import               = new stdclass();
$config->testcase->export->listFields   = array('module', 'type', 'stage', 'pri', 'story', 'status', 'branch');
$config->testcase->import->ignoreFields = array('openedBy', 'openedDate', 'lastEditedBy', 'lastEditedDate', 'version');
$config->testcase->exportFields = '
    id, product, branch, module, story,
    title, precondition, stepDesc, stepExpect, real, keywords,
    pri, type, stage, status, lastRunResult, openedBy,
    openedDate, lastEditedBy, lastEditedDate, version,linkCase';

