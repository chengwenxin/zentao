<?php
$config->search->fields = new stdclass();
$config->search->fields->bug = new stdclass();
$config->search->fields->bug->id         = 'id';
$config->search->fields->bug->title      = 'title';
$config->search->fields->bug->content    = 'steps,keywords,resolvedBuild';
$config->search->fields->bug->addedDate  = 'openedDate';
$config->search->fields->bug->editedDate = 'lastEditedDate';

$config->search->fields->build = new stdclass();
$config->search->fields->build->id         = 'id';
$config->search->fields->build->title      = 'name';
$config->search->fields->build->content    = 'desc,filePath,scmPath';
$config->search->fields->build->addedDate  = 'date';
$config->search->fields->build->editedDate = 'lastEditedDate';

$config->search->fields->case = new stdclass();
$config->search->fields->case->id         = 'id';
$config->search->fields->case->title      = 'title';
$config->search->fields->case->content    = 'precondition,desc,expect';
$config->search->fields->case->addedDate  = 'openedDate';
$config->search->fields->case->editedDate = 'lastEditedDate';

$config->search->fields->doc = new stdclass();
$config->search->fields->doc->id         = 'id';
$config->search->fields->doc->title      = 'title';
$config->search->fields->doc->content    = 'digest,keywords,content';
$config->search->fields->doc->addedDate  = 'addedDate';
$config->search->fields->doc->editedDate = 'editedDate';

$config->search->fields->product = new stdclass();
$config->search->fields->product->id         = 'id';
$config->search->fields->product->title      = 'name';
$config->search->fields->product->content    = 'code,desc';
$config->search->fields->product->addedDate  = 'createdDate';
$config->search->fields->product->editedDate = 'lastEditedDate';

$config->search->fields->productplan = new stdclass();
$config->search->fields->productplan->id         = 'id';
$config->search->fields->productplan->title      = 'title';
$config->search->fields->productplan->content    = 'desc';
$config->search->fields->productplan->addedDate  = 'addedDate';
$config->search->fields->productplan->editedDate = 'lastEditedDate';

$config->search->fields->project = new stdclass();
$config->search->fields->project->id         = 'id';
$config->search->fields->project->title      = 'name';
$config->search->fields->project->content    = 'code,desc';
$config->search->fields->project->addedDate  = 'openedDate';
$config->search->fields->project->editedDate = 'lastEditedDate';

$config->search->fields->release = new stdclass();
$config->search->fields->release->id         = 'id';
$config->search->fields->release->title      = 'name';
$config->search->fields->release->content    = 'desc';
$config->search->fields->release->addedDate  = 'addedDate';
$config->search->fields->release->editedDate = 'lastEditedDate';

$config->search->fields->story = new stdclass();
$config->search->fields->story->id         = 'id';
$config->search->fields->story->title      = 'title';
$config->search->fields->story->content    = 'keywords,spec,verify';
$config->search->fields->story->addedDate  = 'openedDate';
$config->search->fields->story->editedDate = 'lastEditedDate';

$config->search->fields->task = new stdclass();
$config->search->fields->task->id         = 'id';
$config->search->fields->task->title      = 'name';
$config->search->fields->task->content    = 'desc';
$config->search->fields->task->addedDate  = 'openedDate';
$config->search->fields->task->editedDate = 'lastEditedDate';

$config->search->fields->testtask = new stdclass();
$config->search->fields->testtask->id         = 'id';
$config->search->fields->testtask->title      = 'name';
$config->search->fields->testtask->content    = 'desc,report';
$config->search->fields->testtask->addedDate  = 'addedDate';
$config->search->fields->testtask->editedDate = 'lastEditedDate';

$config->search->fields->todo = new stdclass();
$config->search->fields->todo->id         = 'id';
$config->search->fields->todo->title      = 'name';
$config->search->fields->todo->content    = 'desc';
$config->search->fields->todo->addedDate  = 'date';
$config->search->fields->todo->editedDate = 'lastEditedDate';

$config->search->fields->effort = new stdclass();
$config->search->fields->effort->id         = 'id';
$config->search->fields->effort->title      = 'work';
$config->search->fields->effort->content    = '';
$config->search->fields->effort->addedDate  = 'date';
$config->search->fields->effort->editedDate = 'date';

$config->search->fields->testsuite = new stdclass();
$config->search->fields->testsuite->id         = 'id';
$config->search->fields->testsuite->title      = 'name';
$config->search->fields->testsuite->content    = 'desc';
$config->search->fields->testsuite->addedDate  = 'addedDate';
$config->search->fields->testsuite->editedDate = 'lastEditedDate';

$config->search->fields->caselib = new stdclass();
$config->search->fields->caselib->id         = 'id';
$config->search->fields->caselib->title      = 'name';
$config->search->fields->caselib->content    = 'desc';
$config->search->fields->caselib->addedDate  = 'addedDate';
$config->search->fields->caselib->editedDate = 'lastEditedDate';

$config->search->fields->testreport = new stdclass();
$config->search->fields->testreport->id         = 'id';
$config->search->fields->testreport->title      = 'title';
$config->search->fields->testreport->content    = 'report';
$config->search->fields->testreport->addedDate  = 'createdDate';
$config->search->fields->testreport->editedDate = 'createdDate';

/* Set the recPerPage of search. */
$config->search->recPerPage = 10;

/* Set the length of summary of search results. */
$config->search->summaryLength = 120;
