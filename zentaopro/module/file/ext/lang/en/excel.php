<?php
$lang->excel->fileField = 'File';

$lang->excel->title            = new stdclass();
$lang->excel->title->testcase  = 'Case';
$lang->excel->title->bug       = 'Bug';
$lang->excel->title->task      = 'Task';
$lang->excel->title->story     = 'Story';
$lang->excel->title->testsuite = 'Library';
$lang->excel->title->sysValue  = 'System';

$lang->excel->error      = 'The value you entered is not in the drop-down box list.';
$lang->excel->errorTitle = 'Input Error';

$lang->excel->help           = new stdclass();
$lang->excel->help->testcase = "Use + '.' to mark steps of a case in a new line. Use + '.' for expectations corresponded to each steps. Title and Type are required fields. If left empty, other data in the same row will be ommitted. ";
$lang->excel->help->bug      = "Title is a required field. If left empty, other data in the same row will be ommitted.";
$lang->excel->help->task     = "Title and type are required fields. If left empty, other data in the same row will be ommitted. Use '>'  before the titile to mark child task.";
$lang->excel->help->story    = "Title is a required field. If left empty, other data in the same row will be ommitted.";
