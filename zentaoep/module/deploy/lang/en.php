<?php
$lang->deploy->common           = 'Deploy';
$lang->deploy->create           = 'Create Deploy Plan';
$lang->deploy->view             = 'Overview';
$lang->deploy->finish           = 'Finish';
$lang->deploy->edit             = 'Edit';
$lang->deploy->delete           = 'Delete';
$lang->deploy->activate         = 'Activate';
$lang->deploy->browse           = 'Browse Deploy';
$lang->deploy->scope            = 'Deploy Scope';
$lang->deploy->manageScope      = 'Manage scope';
$lang->deploy->cases            = 'Case';
$lang->deploy->linkCases        = 'Link Case';
$lang->deploy->unlinkCase       = 'Unlink Case';
$lang->deploy->steps            = 'Deploy Steps';
$lang->deploy->manageStep       = 'Manage Step';
$lang->deploy->finishStep       = 'Finish Step';
$lang->deploy->activateStep     = 'Activate Step';
$lang->deploy->assignTo         = 'Assign To';
$lang->deploy->editStep         = 'Edit Step';
$lang->deploy->deleteStep       = 'Delete Step';
$lang->deploy->viewStep         = 'Step Detail';
$lang->deploy->batchUnlinkCases = 'Batch Unlink Case';

$lang->deploy->name       = 'Name';
$lang->deploy->desc       = 'Desc';
$lang->deploy->members    = 'Members';
$lang->deploy->hosts      = 'Hosts';
$lang->deploy->service    = 'Service';
$lang->deploy->product    = 'Product';
$lang->deploy->release    = 'Release';
$lang->deploy->package    = 'Package Address';
$lang->deploy->begin      = 'Begin';
$lang->deploy->end        = 'End';
$lang->deploy->status     = 'Status';
$lang->deploy->owner      = 'Owner';
$lang->deploy->stage      = 'Stage';
$lang->deploy->ditto      = 'Ditto';
$lang->deploy->manageAB   = 'Manage';
$lang->deploy->title      = 'Title';
$lang->deploy->content    = 'Content';
$lang->deploy->assignedTo = 'Assigned To';
$lang->deploy->finishedBy = 'Finished By';
$lang->deploy->createdBy  = 'Created By';
$lang->deploy->result     = 'Result';
$lang->deploy->updateHost = 'Update Host';
$lang->deploy->removeHost = 'Wait Remove Host';
$lang->deploy->addHost    = 'New Host';
$lang->deploy->hadHost    = 'Had Host';

$lang->deploy->lblBeginEnd = 'Begin And End';
$lang->deploy->lblBasic    = 'Basic Infomation';
$lang->deploy->lblProduct  = 'Linked Product';
$lang->deploy->lblMonth    = 'Current';
$lang->deploy->toggle      = 'Toggle';

$lang->deploy->monthFormat = 'M Y';

$lang->deploy->statusList['wait'] = 'Wait';
$lang->deploy->statusList['done'] = 'Done';

$lang->deploy->dateList['today']     = 'Today';
$lang->deploy->dateList['tomorrow']  = 'Tomorrow';
$lang->deploy->dateList['thisweek']  = 'This Week';
$lang->deploy->dateList['thismonth'] = 'This Month';
$lang->deploy->dateList['done']      = $lang->deploy->statusList['done'];

$lang->deploy->stageList['wait']    = 'Before Deploy';
$lang->deploy->stageList['doing']   = 'Deploying';
$lang->deploy->stageList['testing'] = 'Smoke Testing';
$lang->deploy->stageList['done']    = 'After Deploy';

$lang->deploy->resultList['']        = '';
$lang->deploy->resultList['success'] = 'Succeed';
$lang->deploy->resultList['fail']    = 'Failed';

$lang->deploy->confirmDelete     = 'Do you want to delete this deploy?';
$lang->deploy->confirmDeleteStep = 'Do you want to delete this step?';
$lang->deploy->errorTime         = 'The end time must be greater than the start time!';
$lang->deploy->errorStatusWait   = 'If the step status is wait, The finished by must be empty';
$lang->deploy->errorStatusDone   = 'If the step status is done, The finished by must be not empty';
$lang->deploy->errorOffline      = 'The host can not coexist for remove and add in service';
$lang->deploy->resultNotEmpty    = 'Result can not be empty';
