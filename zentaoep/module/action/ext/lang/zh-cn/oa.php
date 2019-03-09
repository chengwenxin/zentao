<?php
$lang->action->objectTypes['holiday']   = '放假安排';
$lang->action->objectTypes['leave']     = '请假';
$lang->action->objectTypes['lieu']      = '调休';
$lang->action->objectTypes['makeup']    = '补班';
$lang->action->objectTypes['overtime']  = '加班';

$lang->action->label->attend = array();
$lang->action->label->attend['commited'] = '考勤|attend|browsereview|';
$lang->action->label->attend['reviewed'] = '考勤|attend|personal|';
$lang->action->label->leave = array();
$lang->action->label->leave['created']  = '请假|leave|browsereview|';
$lang->action->label->leave['commited'] = '请假|leave|browsereview|';
$lang->action->label->leave['revoked']  = '请假|leave|browsereview|';
$lang->action->label->leave['reported'] = '销假|leave|browsereview|';
$lang->action->label->leave['reviewed'] = '请假|leave|personal|';
$lang->action->label->lieu = array();
$lang->action->label->lieu['created']  = '调休|lieu|browsereview|';
$lang->action->label->lieu['commited'] = '调休|lieu|browsereview|';
$lang->action->label->lieu['revoked']  = '调休|lieu|browsereview|';
$lang->action->label->lieu['reviewed'] = '调休|lieu|personal|';
$lang->action->label->makeup = array();
$lang->action->label->makeup['created']  = '补班|makeup|browsereview|';
$lang->action->label->makeup['commited'] = '补班|makeup|browsereview|';
$lang->action->label->makeup['revoked']  = '补班|makeup|browsereview|';
$lang->action->label->makeup['reviewed'] = '补班|makeup|personal|';
$lang->action->label->overtime = array();
$lang->action->label->overtime['created']  = '加班|overtime|browsereview|';
$lang->action->label->overtime['commited'] = '加班|overtime|browsereview|';
$lang->action->label->overtime['revoked']  = '加班|overtime|browsereview|';
$lang->action->label->overtime['reviewed'] = '加班|overtime|personal|';

$lang->action->label->holiday   = '放假安排|holiday|browse|';

$lang->action->desc->reported = '$date, 由 <strong>$actor</strong> 销假。' . "\n";
$lang->action->desc->revoked  = '$date, 由 <strong>$actor</strong> 撤销。' . "\n";
$lang->action->desc->commited = '$date, 由 <strong>$actor</strong> 提交。' . "\n";

$lang->action->label->reported = '销假了';
$lang->action->label->revoked  = '撤销了';
$lang->action->label->commited = '提交了';
