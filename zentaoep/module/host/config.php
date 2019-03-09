<?php
$config->host->create       = new stdclass();
$config->host->edit         = new stdclass();
$config->host->changestatus = new stdclass();
$config->host->create->requiredFields       = 'name';
$config->host->edit->requiredFields         = 'name';

$config->host->editor = new stdclass();
$config->host->editor->changestatus = array('id' => 'reason', 'tools' => 'simple');

global $lang;
$config->host->search['module'] = 'host';
$config->host->search['fields']['name']        = $lang->host->name;
$config->host->search['fields']['id']          = 'ID';
$config->host->search['fields']['serverRoom']  = $lang->host->serverRoom;
$config->host->search['fields']['privateIP']   = $lang->host->privateIP;
$config->host->search['fields']['publicIP']    = $lang->host->publicIP;
$config->host->search['fields']['group']       = $lang->host->group;
$config->host->search['fields']['osName']      = $lang->host->osName;
$config->host->search['fields']['osVersion']   = $lang->host->osVersion;
$config->host->search['fields']['createdBy']   = $lang->host->createdBy;
$config->host->search['fields']['createdDate'] = $lang->host->createdDate;
$config->host->search['fields']['editedBy']    = $lang->host->editedBy;
$config->host->search['fields']['editedDate']  = $lang->host->editedDate;

$config->host->search['params']['name']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->host->search['params']['id']          = array('operator' => '=', 'control' => 'input',  'values' => '');
$config->host->search['params']['serverRoom']  = array('operator' => '=', 'control' => 'select',  'values' => '');
$config->host->search['params']['privateIP']   = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->host->search['params']['publicIP']    = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->host->search['params']['group']       = array('operator' => '=', 'control' => 'select',  'values' => '');
$config->host->search['params']['osName']      = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->host->search['params']['osVersion']   = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->host->search['params']['createdBy']   = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->host->search['params']['createdDate'] = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->host->search['params']['editedBy']    = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->host->search['params']['editedDate']  = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
