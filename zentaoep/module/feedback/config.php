<?php
$config->feedback->create = new stdclass();
$config->feedback->create->requiredFields = 'title';
$config->feedback->edit = new stdclass();
$config->feedback->edit->requiredFields = 'title';

$config->feedback->editor = new stdclass();
$config->feedback->editor->create  = array('id' => 'desc', 'tools' => 'simpleTools');
$config->feedback->editor->edit    = array('id' => 'desc', 'tools' => 'simpleTools');
$config->feedback->editor->view    = array('id' => 'lastComment', 'tools' => 'simpleTools');
$config->feedback->editor->comment = array('id' => 'comment', 'tools' => 'simpleTools');
$config->feedback->editor->close   = array('id' => 'comment', 'tools' => 'simpleTools');

global $lang;
$config->feedback->search['module'] = 'feedback';
$config->feedback->search['fields']['title']         = $lang->feedback->title;
$config->feedback->search['fields']['id']            = 'ID';
$config->feedback->search['fields']['product']       = $lang->feedback->product;
$config->feedback->search['fields']['status']        = $lang->feedback->status;
$config->feedback->search['fields']['desc']          = $lang->feedback->desc;
$config->feedback->search['fields']['public']        = $lang->feedback->public;
$config->feedback->search['fields']['openedBy']      = $lang->feedback->openedBy;
$config->feedback->search['fields']['openedDate']    = $lang->feedback->openedDate;
$config->feedback->search['fields']['processedBy']   = $lang->feedback->processedBy;
$config->feedback->search['fields']['processedDate'] = $lang->feedback->processedDate;
$config->feedback->search['fields']['closedBy']      = $lang->feedback->closedBy;
$config->feedback->search['fields']['closedDate']    = $lang->feedback->closedDate;
$config->feedback->search['fields']['closedReason']  = $lang->feedback->closedReason;

$config->feedback->search['params']['title']         = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->feedback->search['params']['id']            = array('operator' => '=', 'control' => 'input',  'values' => '');
$config->feedback->search['params']['product']       = array('operator' => '=', 'control' => 'select',  'values' => '');
$config->feedback->search['params']['status']        = array('operator' => '=', 'control' => 'select',  'values' => $lang->feedback->statusList);
$config->feedback->search['params']['desc']          = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->feedback->search['params']['public']        = array('operator' => '=', 'control' => 'select',  'values' => $lang->feedback->publicList);
$config->feedback->search['params']['openedBy']      = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->feedback->search['params']['openedDate']    = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->feedback->search['params']['processedBy']   = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->feedback->search['params']['processedDate'] = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->feedback->search['params']['closedBy']      = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->feedback->search['params']['closedDate']    = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->feedback->search['params']['closedReason']  = array('operator' => '=', 'control' => 'select',  'values' => $lang->feedback->closedReasonList);
