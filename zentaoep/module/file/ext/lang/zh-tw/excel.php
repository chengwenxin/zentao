<?php
$lang->excel->fileField = '附件';

$lang->excel->title            = new stdclass();
$lang->excel->title->testcase  = '用例';
$lang->excel->title->bug       = 'Bug';
$lang->excel->title->task      = '任務';
$lang->excel->title->story     = '需求';
$lang->excel->title->testsuite = '用例庫';
$lang->excel->title->sysValue  = '系統數據';

$lang->excel->error      = '您輸入的值不在下拉框列表內。';
$lang->excel->errorTitle = '輸入有誤';

$lang->excel->help           = new stdclass();
$lang->excel->help->testcase = '添加用例時，每個用例步驟在新行用數字 + ‘.’來標記。同樣的，預期也是用數字 + ‘.’與步驟對應。“用例標題”和“用例類型”是必填欄位，如果不填導入時會忽略該條數據。';
$lang->excel->help->bug      = '添加Bug時，“標題”是必填欄位，如果不填導入時會忽略該條數據。';
$lang->excel->help->task     = '添加任務時，“任務名稱”和“任務類型”是必填欄位，如果不填導入時會忽略該條數據；如需添加子任務，請在任務名稱前用“>”標記。';
$lang->excel->help->story    = '添加需求時，“需求名稱”是必填欄位，如果不填導入時會忽略該條數據。';
