<?php
$lang->create      = 'Create';
$lang->saveSuccess = 'Save Success';
$lang->month       = 'Month';
$lang->day         = 'Day';
$lang->detail      = 'Detail';
$lang->logout      = 'Sign out';
$lang->minus       = ' - ';
$lang->exportIcon  = "<i class='icon-upload-alt'> </i>";

$lang->my->menu->review = 'Review|my|review|type=all';

$lang->menu->oa  = 'OA|attend|personal|';
$lang->menuOrder[23] = 'oa';

$lang->oa = new stdclass();
$lang->oa->menu = new stdclass();
$lang->oa->menu->attend   = array('link' => 'Attend|attend|personal', 'subModule' => 'attend');
$lang->oa->menu->leave    = array('link' => 'Leave|leave|personal', 'alias' => 'browse', 'subModule' => 'leave');
$lang->oa->menu->makeup   = array('link' => 'Makeup|makeup|personal', 'alias' => 'create,edit,view,browse', 'subModule' => 'makeup');
$lang->oa->menu->overtime = array('link' => 'Overtime|overtime|personal', 'subModule' => 'overtime');
$lang->oa->menu->lieu     = array('link' => 'Comp-time|lieu|personal', 'subModule' => 'lieu');
$lang->oa->menu->holiday  = array('link' => 'Holiday|holiday|browse', 'subModule' => 'holiday');
$lang->oa->menu->review   = array('link' => 'Review|my|review|type=all&orderBy=status&from=oa');

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
$lang->attend->featurebar->personal     = 'My|attend|personal|';
$lang->attend->featurebar->department   = 'Department|attend|department|';
$lang->attend->featurebar->company      = 'Company|attend|company|';
$lang->attend->featurebar->detail       = 'Detailed|attend|detail|';
$lang->attend->featurebar->browsereview = 'Review|attend|browsereview|';
$lang->attend->featurebar->stat         = 'Report|attend|stat|';
$lang->attend->featurebar->settings     = array('link' => 'Settings|attend|settings|');

$lang->leave->featurebar = new stdclass();
$lang->leave->featurebar->personal     = 'My Leave|leave|personal|';
$lang->leave->featurebar->browseReview = 'Review|leave|browsereview|';
$lang->leave->featurebar->company      = 'All|leave|company|';
$lang->leave->featurebar->setReviewer  = 'Settings|leave|setReviewer|';

$lang->makeup->featurebar = new stdclass();
$lang->makeup->featurebar->personal     = 'My Makeup|makeup|personal|';
$lang->makeup->featurebar->browseReview = 'Review|makeup|browsereview|';
$lang->makeup->featurebar->company      = 'All|makeup|company|';
$lang->makeup->featurebar->setReviewer  = 'Settings|makeup|setReviewer|';

$lang->overtime->featurebar = new stdclass();
$lang->overtime->featurebar->personal     = 'My Overtime|overtime|personal|';
$lang->overtime->featurebar->browseReview = 'Review|overtime|browsereview|';
$lang->overtime->featurebar->company      = 'All|overtime|company|';
$lang->overtime->featurebar->setReviewer  = 'Settings|overtime|setReviewer|';

$lang->lieu->featurebar = new stdclass();
$lang->lieu->featurebar->personal     = 'My Comp-time|lieu|personal|';
$lang->lieu->featurebar->browseReview = 'Review|lieu|browsereview|';
$lang->lieu->featurebar->company      = 'All|lieu|company|';
$lang->lieu->featurebar->setReviewer  = 'Settings|lieu|setReviewer|';

$lang->holiday->featurebar = new stdclass();
$lang->holiday->featurebar->browse = 'All|holiday|browse|';
