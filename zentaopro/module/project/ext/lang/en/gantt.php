<?php
$lang->project->editrelation     = 'Manange';
$lang->project->maintainRelation = 'Manange';
$lang->project->deleterelation   = 'Delete';
$lang->project->viewrelation     = 'View';
$lang->project->ganttchart       = 'Gantt Chart';

$lang->project->gantt            = new stdclass();
$lang->project->gantt->common    = 'GanttChart';
$lang->project->gantt->id        = 'ID';
$lang->project->gantt->pretask   = 'Prerequisite';
$lang->project->gantt->condition = 'Prerequisite';
$lang->project->gantt->task      = 'Task';
$lang->project->gantt->action    = 'Action';
$lang->project->gantt->type      = 'Relation type';

$lang->project->gantt->createRelationOfTasks    = 'Create';
$lang->project->gantt->newCreateRelationOfTasks = 'Add';
$lang->project->gantt->editRelationOfTasks      = 'Edit Task Relations';
$lang->project->gantt->relationOfTasks          = 'View Task Relations';

$lang->project->gantt->assignTo  = 'To';
$lang->project->gantt->duration  = 'Duration';
$lang->project->gantt->comp      = 'Progress';
$lang->project->gantt->startDate = 'Start';
$lang->project->gantt->endDate   = 'End';
$lang->project->gantt->days      = ' Days';
$lang->project->gantt->format    = 'Format';
$lang->project->gantt->day       = 'Day';
$lang->project->gantt->week      = 'Week';
$lang->project->gantt->month     = 'Month';
$lang->project->gantt->quarter   = 'Quarter';

$lang->project->gantt->preTaskStatus['']      = '';
$lang->project->gantt->preTaskStatus['begin'] = 'is started, then';
$lang->project->gantt->preTaskStatus['end']   = 'is finished, then';

$lang->project->gantt->taskActions[''] = '';
$lang->project->gantt->taskActions['begin'] = 'can be started.';
$lang->project->gantt->taskActions['end']   = 'can be finished.';

$lang->project->gantt->color[0] = 'fff000';
$lang->project->gantt->color[1] = 'ff0000';
$lang->project->gantt->color[2] = 'ff00ff';
$lang->project->gantt->color[3] = '0000ff';
$lang->project->gantt->color[4] = '00ff00';

$lang->project->gantt->browseType['type']       = 'by Task Type';
$lang->project->gantt->browseType['module']     = 'by Module';
$lang->project->gantt->browseType['assignedTo'] = 'by Assignee';
$lang->project->gantt->browseType['story']      = 'by Story';

$lang->project->gantt->confirmDelete = 'Are sure to delete this relation?';
$lang->project->gantt->tmpNotWrite   = 'Not Writable';

$lang->project->gantt->warning                 = new stdclass();
$lang->project->gantt->warning->noEditSame     = "The tasks before and after the existing ID %s should not be the same.";
$lang->project->gantt->warning->noEditRepeat   = "Task relations between the existing ID %s and ID %s is duplicated!";
$lang->project->gantt->warning->noEditContrary = "Task relations between the existing ID %s and ID %s is contradicted!";
$lang->project->gantt->warning->noRepeat       = "Task relations between the existing ID %s and the newly added ID %s is duplicated!";
$lang->project->gantt->warning->noContrary     = "Task relations between the existing ID %s and the newly added ID %s is contradicted!";
$lang->project->gantt->warning->noNewSame      = "The tasks before and after the newly added ID %s should not be the same.";
$lang->project->gantt->warning->noNewRepeat    = "Task relations between the newly added ID %s and ID %s is duplicated!";
$lang->project->gantt->warning->noNewContrary  = "Task relations between the newly added ID %s and ID %s is contradicted!";
