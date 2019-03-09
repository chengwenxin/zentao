<?php
$lang->excel->fileField = '附件';

$lang->excel->title            = new stdclass();
$lang->excel->title->testcase  = '用例';
$lang->excel->title->bug       = 'Bug';
$lang->excel->title->task      = '任务';
$lang->excel->title->story     = '需求';
$lang->excel->title->testsuite = '用例库';
$lang->excel->title->sysValue  = '系统数据';

$lang->excel->error      = '您输入的值不在下拉框列表内。';
$lang->excel->errorTitle = '输入有误';

$lang->excel->help           = new stdclass();
$lang->excel->help->testcase = '添加用例时，每个用例步骤在新行用数字 + ‘.’来标记。同样的，预期也是用数字 + ‘.’与步骤对应。“用例标题”和“用例类型”是必填字段，如果不填导入时会忽略该条数据。';
$lang->excel->help->bug      = '添加Bug时，“标题”是必填字段，如果不填导入时会忽略该条数据。';
$lang->excel->help->task     = '添加任务时，“任务名称”和“任务类型”是必填字段，如果不填导入时会忽略该条数据；如需添加子任务，请在任务名称前用“>”标记。';
$lang->excel->help->story    = '添加需求时，“需求名称”是必填字段，如果不填导入时会忽略该条数据。';
