<?php
$lang->action->objectTypes['holiday']   = '放假安排';
$lang->action->objectTypes['leave']     = '請假';
$lang->action->objectTypes['lieu']      = '調休';
$lang->action->objectTypes['makeup']    = '補班';
$lang->action->objectTypes['overtime']  = '加班';

$lang->action->label->attend = array();
$lang->action->label->attend['commited'] = '考勤|attend|browsereview|';
$lang->action->label->attend['reviewed'] = '考勤|attend|personal|';
$lang->action->label->leave = array();
$lang->action->label->leave['created']  = '請假|leave|browsereview|';
$lang->action->label->leave['commited'] = '請假|leave|browsereview|';
$lang->action->label->leave['revoked']  = '請假|leave|browsereview|';
$lang->action->label->leave['reported'] = '銷假|leave|browsereview|';
$lang->action->label->leave['reviewed'] = '請假|leave|personal|';
$lang->action->label->lieu = array();
$lang->action->label->lieu['created']  = '調休|lieu|browsereview|';
$lang->action->label->lieu['commited'] = '調休|lieu|browsereview|';
$lang->action->label->lieu['revoked']  = '調休|lieu|browsereview|';
$lang->action->label->lieu['reviewed'] = '調休|lieu|personal|';
$lang->action->label->makeup = array();
$lang->action->label->makeup['created']  = '補班|makeup|browsereview|';
$lang->action->label->makeup['commited'] = '補班|makeup|browsereview|';
$lang->action->label->makeup['revoked']  = '補班|makeup|browsereview|';
$lang->action->label->makeup['reviewed'] = '補班|makeup|personal|';
$lang->action->label->overtime = array();
$lang->action->label->overtime['created']  = '加班|overtime|browsereview|';
$lang->action->label->overtime['commited'] = '加班|overtime|browsereview|';
$lang->action->label->overtime['revoked']  = '加班|overtime|browsereview|';
$lang->action->label->overtime['reviewed'] = '加班|overtime|personal|';

$lang->action->label->holiday   = '放假安排|holiday|browse|';

$lang->action->desc->reported = '$date, 由 <strong>$actor</strong> 銷假。' . "\n";
$lang->action->desc->revoked  = '$date, 由 <strong>$actor</strong> 撤銷。' . "\n";
$lang->action->desc->commited = '$date, 由 <strong>$actor</strong> 提交。' . "\n";

$lang->action->label->reported = '銷假了';
$lang->action->label->revoked  = '撤銷了';
$lang->action->label->commited = '提交了';
