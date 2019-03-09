<?php
global $app;
if(!empty($app->user->feedback) or !empty($_COOKIE['feedbackView']))
{
    unset($lang->resource);
    unset($lang->moduleOrder);

    /* Module order. */
    $lang->moduleOrder[10]  = 'todo';
    $lang->moduleOrder[85]  = 'doc';
    $lang->moduleOrder[95]  = 'company';
    $lang->moduleOrder[105] = 'group';
    $lang->moduleOrder[160] = 'search';
    $lang->moduleOrder[165] = 'tree';
    $lang->moduleOrder[175] = 'file';

    $lang->resource = new stdclass();

    $lang->resource->index = new stdclass();
    $lang->resource->index->index = 'index';

    /* My module. */
    $lang->resource->my = new stdclass();
    $lang->resource->my->calendar       = 'calendar';
    $lang->resource->my->todo           = 'todo';
    $lang->resource->my->profile        = 'profile';
    $lang->resource->my->editProfile    = 'editProfile';
    $lang->resource->my->changePassword = 'changePassword';
    $lang->resource->my->effort         = 'effort';  // pro effort

    /* Pro effort */
    $lang->resource->effort = new stdclass();
    $lang->resource->effort->batchCreate     = 'batchCreate';
    $lang->resource->effort->createForObject = 'createForObject';
    $lang->resource->effort->edit            = 'edit';
    $lang->resource->effort->batchEdit       = 'batchEdit';
    $lang->resource->effort->view            = 'view';
    $lang->resource->effort->delete          = 'delete';
    $lang->resource->effort->export          = 'export';
    $lang->resource->effort->calendar        = 'calendar';  // pro calendar

    /* Todo. */
    $lang->resource->todo = new stdclass();
    $lang->resource->todo->create       = 'create';
    $lang->resource->todo->batchCreate  = 'batchCreate';
    $lang->resource->todo->edit         = 'edit';
    $lang->resource->todo->batchEdit    = 'batchEdit';
    $lang->resource->todo->view         = 'view';
    $lang->resource->todo->delete       = 'delete';
    $lang->resource->todo->export       = 'export';
    $lang->resource->todo->finish       = 'finish';
    $lang->resource->todo->batchFinish  = 'batchFinish';
    $lang->resource->todo->import2Today = 'import2Today';

    $lang->resource->todo->calendar          = 'calendar';  // pro calendar

    $lang->todo->methodOrder[5]  = 'create';
    $lang->todo->methodOrder[10] = 'batchCreate';
    $lang->todo->methodOrder[15] = 'edit';
    $lang->todo->methodOrder[20] = 'view';
    $lang->todo->methodOrder[25] = 'delete';
    $lang->todo->methodOrder[30] = 'export';
    $lang->todo->methodOrder[35] = 'finish';
    $lang->todo->methodOrder[40] = 'import2Today';

    /* Tree. */
    $lang->resource->tree = new stdclass();
    $lang->resource->tree->browse      = 'browse';
    $lang->resource->tree->updateOrder = 'updateOrder';
    $lang->resource->tree->manageChild = 'manageChild';
    $lang->resource->tree->delete      = 'delete';

    $lang->tree->methodOrder[5]  = 'browse';
    $lang->tree->methodOrder[15] = 'updateOrder';
    $lang->tree->methodOrder[20] = 'manageChild';
    $lang->tree->methodOrder[30] = 'delete';

    /* Company. */
    $lang->resource->company = new stdclass();
    $lang->resource->company->index  = 'index';
    $lang->resource->company->browse = 'browse';
    $lang->resource->company->view   = 'view';

    $lang->company->methodOrder[0]  = 'index';
    $lang->company->methodOrder[5]  = 'browse';

    /* Group. */
    $lang->resource->group = new stdclass();
    $lang->resource->group->browse       = 'browse';
    $lang->resource->group->create       = 'create';
    $lang->resource->group->edit         = 'edit';
    $lang->resource->group->copy         = 'copy';
    $lang->resource->group->delete       = 'delete';
    $lang->resource->group->manageView   = 'manageView';
    $lang->resource->group->managePriv   = 'managePriv';
    $lang->resource->group->manageMember = 'manageMember';

    $lang->group->methodOrder[5]  = 'browse';
    $lang->group->methodOrder[10] = 'create';
    $lang->group->methodOrder[15] = 'edit';
    $lang->group->methodOrder[20] = 'copy';
    $lang->group->methodOrder[25] = 'delete';
    $lang->group->methodOrder[30] = 'managePriv';
    $lang->group->methodOrder[35] = 'manageMember';

    /* Doc. */
    $lang->resource->doc = new stdclass();
    $lang->resource->doc->alllibs    = 'allLibs';
    $lang->resource->doc->browse     = 'browse';
    $lang->resource->doc->create     = 'create';
    $lang->resource->doc->view       = 'view';
    $lang->resource->doc->edit       = 'edit';
    $lang->resource->doc->delete     = 'delete';
    $lang->resource->doc->showFiles  = 'showFiles';

    $lang->resource->doc->diff = 'diff';

    $lang->doc->methodOrder[5]  = 'browse';
    $lang->doc->methodOrder[25] = 'create';
    $lang->doc->methodOrder[30] = 'view';
    $lang->doc->methodOrder[35] = 'edit';
    $lang->doc->methodOrder[40] = 'delete';
    $lang->doc->methodOrder[50] = 'showFiles';
    $lang->doc->methodOrder[55] = 'diff';

    /* Feedback. */
    $lang->resource->feedback = new stdclass();
    $lang->resource->feedback->index  = 'index';
    $lang->resource->feedback->create  = 'create';
    $lang->resource->feedback->edit    = 'edit';
    $lang->resource->feedback->browse  = 'browse';
    $lang->resource->feedback->view    = 'view';
    $lang->resource->feedback->comment = 'comment';
    $lang->resource->feedback->delete  = 'delete';
    $lang->resource->feedback->close   = 'close';

    /* Others. */
    $lang->resource->file = new stdclass();
    $lang->resource->file->download     = 'download';
    $lang->resource->file->edit         = 'edit';
    $lang->resource->file->delete       = 'delete';

    $lang->file->methodOrder[5]  = 'download';
    $lang->file->methodOrder[10] = 'edit';
    $lang->file->methodOrder[15] = 'delete';

    /* Search. */
    $lang->resource->search = new stdclass();
    $lang->resource->search->buildForm    = 'buildForm';
    $lang->resource->search->buildQuery   = 'buildQuery';
    $lang->resource->search->saveQuery    = 'saveQuery';
    $lang->resource->search->deleteQuery  = 'deleteQuery';
    $lang->resource->search->select       = 'select';

    $lang->search->methodOrder[5]  = 'buildForm';
    $lang->search->methodOrder[10] = 'buildQuery';
    $lang->search->methodOrder[15] = 'saveQuery';
    $lang->search->methodOrder[20] = 'deleteQuery';
    $lang->search->methodOrder[25] = 'select';

    /* Attend */
    $lang->resource->attend = new stdclass();
    $lang->resource->attend->personal         = 'personal';
    $lang->resource->attend->edit             = 'edit';
    //$lang->resource->attend->read             = 'read';

    $lang->attend->methodOrder[5]  = 'personal';
    $lang->attend->methodOrder[10] = 'edit';
    //$lang->attend->methodOrder[15] = 'read';

    /* Holiday */
    $lang->resource->holiday = new stdclass();
    $lang->resource->holiday->browse = 'browse';

    /* Leave */
    $lang->resource->leave = new stdclass();
    $lang->resource->leave->personal     = 'personal';
    $lang->resource->leave->create       = 'create';
    $lang->resource->leave->edit         = 'edit';
    $lang->resource->leave->delete       = 'delete';
    $lang->resource->leave->view         = 'view';
    $lang->resource->leave->switchstatus = 'switchstatus';
    $lang->resource->leave->back         = 'back';

    $lang->leave->methodOrder[0]  = 'personal';
    $lang->leave->methodOrder[5]  = 'create';
    $lang->leave->methodOrder[10] = 'edit';
    $lang->leave->methodOrder[15] = 'delete';
    $lang->leave->methodOrder[20] = 'view';
    $lang->leave->methodOrder[25] = 'switchstatus';
    $lang->leave->methodOrder[30] = 'back';

    /* Makeup */
    $lang->resource->makeup = new stdclass();
    $lang->resource->makeup->personal     = 'personal';
    $lang->resource->makeup->create       = 'create';
    $lang->resource->makeup->edit         = 'edit';
    $lang->resource->makeup->view         = 'view';
    $lang->resource->makeup->delete       = 'delete';
    $lang->resource->makeup->switchstatus = 'switchstatus';

    $lang->makeup->methodOrder[0]  = 'personal';
    $lang->makeup->methodOrder[5]  = 'create';
    $lang->makeup->methodOrder[10] = 'edit';
    $lang->makeup->methodOrder[15] = 'view';
    $lang->makeup->methodOrder[20] = 'delete';
    $lang->makeup->methodOrder[25] = 'switchstatus';

    /* Overtime */
    $lang->resource->overtime = new stdclass();
    $lang->resource->overtime->personal     = 'personal';
    $lang->resource->overtime->create       = 'create';
    $lang->resource->overtime->edit         = 'edit';
    $lang->resource->overtime->view         = 'view';
    $lang->resource->overtime->delete       = 'delete';
    $lang->resource->overtime->switchstatus = 'switchstatus';

    $lang->overtime->methodOrder[0]  = 'personal';
    $lang->overtime->methodOrder[5]  = 'create';
    $lang->overtime->methodOrder[10] = 'edit';
    $lang->overtime->methodOrder[15] = 'view';
    $lang->overtime->methodOrder[20] = 'delete';
    $lang->overtime->methodOrder[25] = 'switchstatus';

    /* Lieu */
    $lang->resource->lieu = new stdclass();
    $lang->resource->lieu->personal     = 'personal';
    $lang->resource->lieu->create       = 'create';
    $lang->resource->lieu->edit         = 'edit';
    $lang->resource->lieu->delete       = 'delete';
    $lang->resource->lieu->view         = 'view';
    $lang->resource->lieu->switchstatus = 'switchstatus';

    $lang->lieu->methodOrder[0]  = 'personal';
    $lang->lieu->methodOrder[5]  = 'create';
    $lang->lieu->methodOrder[10] = 'edit';
    $lang->lieu->methodOrder[15] = 'delete';
    $lang->lieu->methodOrder[20] = 'view';
    $lang->lieu->methodOrder[25] = 'switchstatus';
}
else
{
    /* Feedback */
    $lang->resource->feedback = new stdclass();
    $lang->resource->feedback->index     = 'index';
    $lang->resource->feedback->create    = 'create';
    $lang->resource->feedback->edit      = 'edit';
    $lang->resource->feedback->view      = 'view';
    $lang->resource->feedback->admin     = 'browse';
    $lang->resource->feedback->browse    = 'nonRDBrowse';
    $lang->resource->feedback->adminview = 'view';
    $lang->resource->feedback->comment   = 'reply';
    $lang->resource->feedback->close     = 'close';
    $lang->resource->feedback->delete    = 'delete';
    $lang->resource->custom->libreoffice = 'libreOffice';

    /* Attend */
    $lang->resource->attend = new stdclass();
    $lang->resource->attend->department       = 'department';
    $lang->resource->attend->company          = 'company';
    $lang->resource->attend->browseReview     = 'browseReview';
    $lang->resource->attend->review           = 'review';
    $lang->resource->attend->export           = 'export';
    $lang->resource->attend->stat             = 'stat';
    $lang->resource->attend->saveStat         = 'saveStat';
    $lang->resource->attend->exportStat       = 'exportStat';
    $lang->resource->attend->detail           = 'detail';
    $lang->resource->attend->exportDetail     = 'exportDetail';
    $lang->resource->attend->settings         = 'settings';
    $lang->resource->attend->personalSettings = 'personalSettings';
    $lang->resource->attend->setManager       = 'setManager';

    $lang->resource->attend->personal         = 'personal';
    $lang->resource->attend->edit             = 'edit';

    $lang->attend->methodOrder[5]  = 'department';
    $lang->attend->methodOrder[10] = 'company';
    $lang->attend->methodOrder[15] = 'browseReview';
    $lang->attend->methodOrder[20] = 'review';
    $lang->attend->methodOrder[25] = 'export';
    $lang->attend->methodOrder[30] = 'stat';
    $lang->attend->methodOrder[35] = 'saveStat';
    $lang->attend->methodOrder[40] = 'exportStat';
    $lang->attend->methodOrder[45] = 'detail';
    $lang->attend->methodOrder[60] = 'exportDetail';
    $lang->attend->methodOrder[65] = 'settings';
    $lang->attend->methodOrder[70] = 'personalSettings';
    $lang->attend->methodOrder[75] = 'setManager';

    $lang->attend->methodOrder[80]  = 'personal';
    $lang->attend->methodOrder[85] = 'edit';

    /* Holiday */
    $lang->resource->holiday = new stdclass();
    $lang->resource->holiday->create = 'create';
    $lang->resource->holiday->edit   = 'edit';
    $lang->resource->holiday->delete = 'delete';

    $lang->resource->holiday->browse = 'browse';

    $lang->holiday->methodOrder[0]  = 'create';
    $lang->holiday->methodOrder[5]  = 'edit';
    $lang->holiday->methodOrder[10] = 'delete';

    $lang->holiday->methodOrder[15] = 'browse';

    /* Leave */
    $lang->resource->leave = new stdclass();
    $lang->resource->leave->browseReview = 'browseReview';
    $lang->resource->leave->company      = 'company';
    $lang->resource->leave->review       = 'review';
    $lang->resource->leave->export       = 'export';
    $lang->resource->leave->setReviewer  = 'setReviewer';

    $lang->resource->leave->personal     = 'personal';
    $lang->resource->leave->create       = 'create';
    $lang->resource->leave->edit         = 'edit';
    $lang->resource->leave->delete       = 'delete';
    $lang->resource->leave->view         = 'view';
    $lang->resource->leave->switchstatus = 'switchstatus';
    $lang->resource->leave->back         = 'back';

    $lang->leave->methodOrder[0]  = 'browseReview';
    $lang->leave->methodOrder[5]  = 'company';
    $lang->leave->methodOrder[10] = 'review';
    $lang->leave->methodOrder[15] = 'export';
    $lang->leave->methodOrder[20] = 'setReviewer';

    $lang->leave->methodOrder[25]  = 'personal';
    $lang->leave->methodOrder[30]  = 'create';
    $lang->leave->methodOrder[35] = 'edit';
    $lang->leave->methodOrder[40] = 'delete';
    $lang->leave->methodOrder[45] = 'view';
    $lang->leave->methodOrder[50] = 'switchstatus';
    $lang->leave->methodOrder[55] = 'back';

    /* Makeup */
    $lang->resource->makeup = new stdclass();
    $lang->resource->makeup->browseReview = 'browseReview';
    $lang->resource->makeup->company      = 'company';
    $lang->resource->makeup->review       = 'review';
    $lang->resource->makeup->export       = 'export';
    $lang->resource->makeup->setReviewer  = 'setReviewer';

    $lang->resource->makeup->personal     = 'personal';
    $lang->resource->makeup->create       = 'create';
    $lang->resource->makeup->edit         = 'edit';
    $lang->resource->makeup->view         = 'view';
    $lang->resource->makeup->delete       = 'delete';
    $lang->resource->makeup->switchstatus = 'switchstatus';

    $lang->makeup->methodOrder[0]  = 'browseReview';
    $lang->makeup->methodOrder[5]  = 'company';
    $lang->makeup->methodOrder[10] = 'review';
    $lang->makeup->methodOrder[15] = 'export';
    $lang->makeup->methodOrder[20] = 'setReviewer';

    $lang->makeup->methodOrder[25]  = 'personal';
    $lang->makeup->methodOrder[30]  = 'create';
    $lang->makeup->methodOrder[35] = 'edit';
    $lang->makeup->methodOrder[40] = 'view';
    $lang->makeup->methodOrder[45] = 'delete';
    $lang->makeup->methodOrder[50] = 'switchstatus';

    /* Overtime */
    $lang->resource->overtime = new stdclass();
    $lang->resource->overtime->browseReview = 'browseReview';
    $lang->resource->overtime->company      = 'company';
    $lang->resource->overtime->review       = 'review';
    $lang->resource->overtime->export       = 'export';
    $lang->resource->overtime->setReviewer  = 'setReviewer';

    $lang->resource->overtime->personal     = 'personal';
    $lang->resource->overtime->create       = 'create';
    $lang->resource->overtime->edit         = 'edit';
    $lang->resource->overtime->view         = 'view';
    $lang->resource->overtime->delete       = 'delete';
    $lang->resource->overtime->switchstatus = 'switchstatus';

    $lang->overtime->methodOrder[0]  = 'browseReview';
    $lang->overtime->methodOrder[5]  = 'company';
    $lang->overtime->methodOrder[10] = 'review';
    $lang->overtime->methodOrder[15] = 'export';
    $lang->overtime->methodOrder[20] = 'setReviewer';

    $lang->overtime->methodOrder[25]  = 'personal';
    $lang->overtime->methodOrder[30]  = 'create';
    $lang->overtime->methodOrder[35] = 'edit';
    $lang->overtime->methodOrder[40] = 'view';
    $lang->overtime->methodOrder[45] = 'delete';
    $lang->overtime->methodOrder[50] = 'switchstatus';

    /* Lieu */
    $lang->resource->lieu = new stdclass();
    $lang->resource->lieu->browseReview = 'browseReview';
    $lang->resource->lieu->company      = 'company';
    $lang->resource->lieu->review       = 'review';
    $lang->resource->lieu->setReviewer  = 'setReviewer';

    $lang->resource->lieu->personal     = 'personal';
    $lang->resource->lieu->create       = 'create';
    $lang->resource->lieu->edit         = 'edit';
    $lang->resource->lieu->delete       = 'delete';
    $lang->resource->lieu->view         = 'view';
    $lang->resource->lieu->switchstatus = 'switchstatus';

    $lang->lieu->methodOrder[0]  = 'browseReview';
    $lang->lieu->methodOrder[5]  = 'company';
    $lang->lieu->methodOrder[10] = 'review';
    $lang->lieu->methodOrder[15] = 'setReviewer';

    $lang->lieu->methodOrder[20]  = 'personal';
    $lang->lieu->methodOrder[25]  = 'create';
    $lang->lieu->methodOrder[30] = 'edit';
    $lang->lieu->methodOrder[35] = 'delete';
    $lang->lieu->methodOrder[40] = 'view';
    $lang->lieu->methodOrder[45] = 'switchstatus';

    /* Ops */
    $lang->resource->tree->editHost = 'editHost';
    $lang->resource->tree->browsehost = 'groupMaintenance';

    $lang->tree->methodOrder[35] = 'editHost';
    $lang->host->methodOrder[40] = 'groupMaintenance';

    $lang->resource->ops = new stdclass();
    $lang->resource->ops->index    = 'index';
    $lang->resource->ops->setting  = 'setting';

    $lang->ops->methodOrder[5]  = 'index';
    $lang->ops->methodOrder[10] = 'setting';

    $lang->resource->host = new stdclass();
    $lang->resource->host->browse       = 'browse';
    $lang->resource->host->create       = 'create';
    $lang->resource->host->edit         = 'edit';
    $lang->resource->host->view         = 'view';
    $lang->resource->host->delete       = 'delete';
    $lang->resource->host->changeStatus = 'changeStatus';
    $lang->resource->host->treemap      = 'treemap';

    $lang->host->methodOrder[5]  = 'browse';
    $lang->host->methodOrder[10] = 'create';
    $lang->host->methodOrder[15] = 'edit';
    $lang->host->methodOrder[20] = 'view';
    $lang->host->methodOrder[25] = 'delete';
    $lang->host->methodOrder[30] = 'changeStatus';
    $lang->host->methodOrder[35] = 'treemap';

    $lang->resource->serverroom = new stdclass();
    $lang->resource->serverroom->browse = 'browse';
    $lang->resource->serverroom->create = 'create';
    $lang->resource->serverroom->edit   = 'edit';
    $lang->resource->serverroom->view   = 'view';
    $lang->resource->serverroom->delete = 'delete';

    $lang->serverroom->methodOrder[5]  = 'browse';
    $lang->serverroom->methodOrder[10] = 'create';
    $lang->serverroom->methodOrder[15] = 'edit';
    $lang->serverroom->methodOrder[20] = 'view';
    $lang->serverroom->methodOrder[25] = 'delete';

    $lang->resource->service = new stdclass();
    $lang->resource->service->index  = 'index';
    $lang->resource->service->create = 'create';
    $lang->resource->service->edit   = 'edit';
    $lang->resource->service->view   = 'view';
    $lang->resource->service->delete = 'delete';
    $lang->resource->service->manage = 'manage';

    $lang->service->methodOrder[5]  = 'index';
    $lang->service->methodOrder[10] = 'create';
    $lang->service->methodOrder[15] = 'edit';
    $lang->service->methodOrder[20] = 'view';
    $lang->service->methodOrder[25] = 'delete';
    $lang->service->methodOrder[30] = 'manage';

    $lang->resource->deploy = new stdclass();
    $lang->resource->deploy->browse           = 'browse';
    $lang->resource->deploy->create           = 'create';
    $lang->resource->deploy->edit             = 'edit';
    $lang->resource->deploy->delete           = 'delete';
    $lang->resource->deploy->activate         = 'activate';
    $lang->resource->deploy->finish           = 'finish';
    $lang->resource->deploy->scope            = 'scope';
    $lang->resource->deploy->manageScope      = 'manageScope';
    $lang->resource->deploy->view             = 'view';
    $lang->resource->deploy->cases            = 'cases';
    $lang->resource->deploy->linkCases        = 'linkCases';
    $lang->resource->deploy->unlinkCase       = 'unlinkCase';
    $lang->resource->deploy->batchUnlinkCases = 'batchUnlinkCases';
    $lang->resource->deploy->steps            = 'steps';
    $lang->resource->deploy->manageStep       = 'manageStep';
    $lang->resource->deploy->finishStep       = 'finishStep';
    $lang->resource->deploy->assignTo         = 'assignTo';
    $lang->resource->deploy->viewStep         = 'viewStep';
    $lang->resource->deploy->editStep         = 'editStep';
    $lang->resource->deploy->deleteStep       = 'deleteStep';

    $lang->service->methodOrder[5]   = 'browse';
    $lang->service->methodOrder[10]  = 'create';
    $lang->service->methodOrder[15]  = 'edit';
    $lang->service->methodOrder[20]  = 'delete';
    $lang->service->methodOrder[25]  = 'activate';
    $lang->service->methodOrder[30]  = 'finish';
    $lang->service->methodOrder[35]  = 'scope';
    $lang->service->methodOrder[40]  = 'manageScope';
    $lang->service->methodOrder[45]  = 'view';
    $lang->service->methodOrder[50]  = 'cases';
    $lang->service->methodOrder[55]  = 'linkCases';
    $lang->service->methodOrder[60]  = 'unlinkCase';
    $lang->service->methodOrder[65]  = 'batchUnlinkCases';
    $lang->service->methodOrder[70]  = 'steps';
    $lang->service->methodOrder[75]  = 'manageStep';
    $lang->service->methodOrder[80]  = 'finishStep';
    $lang->service->methodOrder[85]  = 'assignTo';
    $lang->service->methodOrder[90]  = 'viewStep';
    $lang->service->methodOrder[95]  = 'editStep';
    $lang->service->methodOrder[100] = 'deleteStep';

    $lang->resource->testtask->runDeployCase     = 'runDeployCase';
    $lang->resource->testtask->deployCaseResults = 'deployCaseResults';

    $lang->resource->doc->diff       = 'diff';
    $lang->resource->doc->manageBook = 'manageBook';
    $lang->resource->doc->catalog    = 'catalog';

    $lang->resource->my->review = 'review';
}

