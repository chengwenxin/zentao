<?php
/**
 * The lang file of calendar module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青島易軟天創網絡科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商業軟件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->project->menu->list['alias'] .= ',calendar';

$lang->project->subMenu->list->calendar = array('link' => '任務日曆|project|calendar|projectID=%s', 'alias' => 'calendar');

$lang->project->menu->effort = '日誌|project|effort|projectID=%s';

$lang->company->menu->effort  = array('link' => '日誌|company|calendar|', 'alias' => 'effort');

if(!isset($lang->project->menu->action['alias'])) $lang->project->menu->action['alias'] = '';
$lang->project->menu->action['alias'] .= ',effortcalendar';

if(!isset($lang->effort))$lang->effort = new stdclass();
if(!isset($lang->effort->menuOrder))$lang->effort->menuOrder = new stdclass();
$lang->my->menuOrder[11]      = 'effort';
$lang->company->menuOrder[16] = 'todo';
$lang->company->menuOrder[17] = 'effort';
$lang->dept->menuOrder        = $lang->company->menuOrder;
$lang->group->menuOrder       = $lang->company->menuOrder;
$lang->todo->menuOrder        = $lang->my->menuOrder;
$lang->effort->menuOrder      = $lang->my->menuOrder;
$lang->task->menuOrder        = $lang->project->menuOrder;
$lang->build->menuOrder       = $lang->project->menuOrder;
$lang->user->menuOrder        = $lang->company->menuOrder;

$lang->dept->menu   = $lang->company->menu;
$lang->group->menu  = $lang->company->menu;
$lang->todo->menu   = $lang->my->menu;
$lang->effort->menu = $lang->my->menu;
$lang->task->menu   = $lang->project->menu;
$lang->build->menu  = $lang->project->menu;
$lang->user->menu   = $lang->company->menu;

$lang->today = '今天';
$lang->textNetworkError = '網絡錯誤';
$lang->textHasMoreItems = '還有 {0} 項...';

$lang->my->menu->calendar = array('link' => '日程|my|calendar|', 'subModule' => 'todo,effort', 'alias' => 'todo', 'class' => 'dropdown dropdown-hover');

$lang->my->subMenu = new stdclass();
$lang->my->subMenu->calendar = new stdclass();
$lang->my->subMenu->calendar->todo   = '待辦|todo|calendar|';
$lang->my->subMenu->calendar->effort = '日誌|effort|calendar|';
