<?php
$lang->create      = '新建';
$lang->saveSuccess = '保存成功';
$lang->month       = '月';
$lang->day         = '日';
$lang->detail      = '详情';
$lang->logout      = '签退';
$lang->minus       = ' - ';
$lang->exportIcon  = "<i class='icon-upload-alt'> </i>";

$lang->my->menu->review = '审批|my|review|type=all';

$lang->menu->oa  = '办公|attend|personal|';
$lang->menuOrder[23] = 'oa';

$lang->oa = new stdclass();
$lang->oa->menu = new stdclass();
$lang->oa->menu->attend   = array('link' => '考勤|attend|personal', 'subModule' => 'attend');
$lang->oa->menu->leave    = array('link' => '请假|leave|personal', 'alias' => 'browse', 'subModule' => 'leave');
$lang->oa->menu->makeup   = array('link' => '补班|makeup|personal', 'alias' => 'create,edit,view,browse', 'subModule' => 'makeup');
$lang->oa->menu->overtime = array('link' => '加班|overtime|personal', 'subModule' => 'overtime');
$lang->oa->menu->lieu     = array('link' => '调休|lieu|personal', 'subModule' => 'lieu');
$lang->oa->menu->holiday  = array('link' => '节假日|holiday|browse', 'subModule' => 'holiday');
$lang->oa->menu->review   = array('link' => '审批|my|review|type=all&orderBy=status&from=oa');

$lang->attend = new stdclass();
$lang->attend->menu = $lang->oa->menu;

$lang->leave = new stdclass();
$lang->leave->menu = $lang->oa->menu;

$lang->makeup = new stdclass();
$lang->makeup->menu = $lang->oa->menu;

$lang->overtime = new stdclass();
$lang->overtime->menu = $lang->oa->menu;

$lang->lieu = new stdclass();
$lang->lieu->menu = $lang->oa->menu;

$lang->holiday = new stdclass();
$lang->holiday->menu = $lang->oa->menu;

$lang->menugroup->attend   = 'oa';
$lang->menugroup->leave    = 'oa';
$lang->menugroup->makeup   = 'oa';
$lang->menugroup->overtime = 'oa';
$lang->menugroup->lieu     = 'oa';
$lang->menugroup->holiday  = 'oa';

$lang->attend->featurebar = new stdclass();
$lang->attend->featurebar->personal     = '我的考勤|attend|personal|';
$lang->attend->featurebar->department   = '部门考勤|attend|department|';
$lang->attend->featurebar->company      = '公司考勤|attend|company|';
$lang->attend->featurebar->detail       = '考勤明细|attend|detail|';
$lang->attend->featurebar->browsereview = '补录审核|attend|browsereview|';
$lang->attend->featurebar->stat         = '统计|attend|stat|';
$lang->attend->featurebar->settings     = array('link' => '设置|attend|settings|');

$lang->leave->featurebar = new stdclass();
$lang->leave->featurebar->personal     = '我的请假|leave|personal|';
$lang->leave->featurebar->browseReview = '我的审核|leave|browsereview|';
$lang->leave->featurebar->company      = '所有请假|leave|company|';
$lang->leave->featurebar->setReviewer  = '设置|leave|setReviewer|';

$lang->makeup->featurebar = new stdclass();
$lang->makeup->featurebar->personal     = '我的补班|makeup|personal|';
$lang->makeup->featurebar->browseReview = '我的审核|makeup|browsereview|';
$lang->makeup->featurebar->company      = '所有补班|makeup|company|';
$lang->makeup->featurebar->setReviewer  = '设置|makeup|setReviewer|';

$lang->overtime->featurebar = new stdclass();
$lang->overtime->featurebar->personal     = '我的加班|overtime|personal|';
$lang->overtime->featurebar->browseReview = '我的审核|overtime|browsereview|';
$lang->overtime->featurebar->company      = '所有加班|overtime|company|';
$lang->overtime->featurebar->setReviewer  = '设置|overtime|setReviewer|';

$lang->lieu->featurebar = new stdclass();
$lang->lieu->featurebar->personal     = '我的调休|lieu|personal|';
$lang->lieu->featurebar->browseReview = '我的审核|lieu|browsereview|';
$lang->lieu->featurebar->company      = '所有调休|lieu|company|';
$lang->lieu->featurebar->setReviewer  = '设置|lieu|setReviewer|';

$lang->holiday->featurebar = new stdclass();
$lang->holiday->featurebar->browse = '所有|holiday|browse|';
