<?php
$lang->exportFileTypeList = array('xlsx' => 'xlsx', 'xls' => 'xls') + $lang->exportFileTypeList;

if(isset($lang->bug->menu->bug['alias']))           $lang->bug->menu->bug['alias'] .= ',showimport';
if(isset($lang->testcase->menu->testcase['alias'])) $lang->testcase->menu->testcase['alias'] .= ',ajaxselectstory';

$lang->excel         = new stdclass();
$lang->excel->noData     = 'No data.';
$lang->excel->canNotRead = 'It cannot parse this file.';
$lang->excel->insert     = 'New Insertion';
