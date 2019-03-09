<?php
$lang->effort = new stdclass();
/* Insert effort into $lang->my->menu.*/
$lang->my->menu->calendar['alias']     .= ',effort';
$lang->my->menu->calendar['subModule'] .= ',effort';

/* Insert effort into $lang->user->menu.*/
$lang->user->menu->effort = array('link' => '日志|user|effort|account=%s', 'subModule' => 'effort');

$lang->effort->menuOrder      = new stdclass();
$lang->my->menuOrder[11]      = 'effort';
$lang->company->menuOrder[21] = 'effort';
$lang->project->menuOrder[44] = 'effort';
$lang->user->menuOrder[16]    = 'effort';
$lang->todo->menuOrder        = $lang->my->menuOrder;
$lang->effort->menuOrder      = $lang->my->menuOrder;
$lang->task->menuOrder        = $lang->project->menuOrder;
$lang->build->menuOrder       = $lang->project->menuOrder;
$lang->dept->menuOrder        = $lang->company->menuOrder;
$lang->group->menuOrder       = $lang->company->menuOrder;
$lang->user->menuOrder        = $lang->company->menuOrder;

$lang->dept->menu   = $lang->company->menu;
$lang->group->menu  = $lang->company->menu;
$lang->todo->menu   = $lang->my->menu;
$lang->effort->menu = $lang->my->menu;
$lang->user->menu   = $lang->company->menu;

$lang->menugroup->effort = 'my';
