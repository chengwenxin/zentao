<?php
$lang->exportFileTypeList = array('xlsx' => 'xlsx', 'xls' => 'xls') + $lang->exportFileTypeList;

if(isset($lang->bug->menu->bug['alias']))           $lang->bug->menu->bug['alias'] .= ',showimport';
if(isset($lang->testcase->menu->testcase['alias'])) $lang->testcase->menu->testcase['alias'] .= ',ajaxselectstory';

$lang->excel         = new stdclass();
$lang->excel->noData     = '沒有數據';
$lang->excel->canNotRead = '不能解析該檔案';
$lang->excel->insert     = '全新插入';
