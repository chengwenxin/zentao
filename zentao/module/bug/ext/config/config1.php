<?php
$config->bug->list->allFields = 'defectSource,automatedTesting,';

$config->bug->search['fields']['defectSource']   = $lang->bug->defectSource;
$config->bug->search['fields']['automatedTesting']   = $lang->bug->automatedTesting;

$config->bug->search['params']['defectSource']    = array('operator' => '=',       'control' => 'select', 'values' => $lang->bug->defectSourceList);
$config->bug->search['params']['automatedTesting']    = array('operator' => '=',       'control' => 'select', 'values' => $lang->bug->automatedTestingList);
