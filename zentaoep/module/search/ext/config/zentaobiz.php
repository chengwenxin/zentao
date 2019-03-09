<?php
$config->search->fields->feedback = new stdclass();
$config->search->fields->feedback->id         = 'id';
$config->search->fields->feedback->title      = 'title';
$config->search->fields->feedback->content    = 'desc';
$config->search->fields->feedback->addedDate  = 'openedDate';
$config->search->fields->feedback->editedDate = 'editedDate';

$config->search->fields->service = new stdclass();
$config->search->fields->service->id         = 'id';
$config->search->fields->service->title      = 'name';
$config->search->fields->service->content    = 'desc';
$config->search->fields->service->addedDate  = 'createdDate';
$config->search->fields->service->editedDate = 'editedDate';

$config->search->fields->deploy = new stdclass();
$config->search->fields->deploy->id         = 'id';
$config->search->fields->deploy->title      = 'name';
$config->search->fields->deploy->content    = 'desc';
$config->search->fields->deploy->addedDate  = 'createdDate';
$config->search->fields->deploy->editedDate = 'createdDate';

$config->search->fields->deploystep = new stdclass();
$config->search->fields->deploystep->id         = 'id';
$config->search->fields->deploystep->title      = 'title';
$config->search->fields->deploystep->content    = 'content';
$config->search->fields->deploystep->addedDate  = 'createdDate';
$config->search->fields->deploystep->editedDate = 'createdDate';
