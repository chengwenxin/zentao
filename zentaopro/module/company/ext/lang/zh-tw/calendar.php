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
$lang->company->calendar       = '日誌';
$lang->company->todo           = '待辦';
$lang->company->selectDept     = '請選擇部門';
$lang->company->date           = '日期';
$lang->company->allDept        = '所有';
$lang->company->to             = '至';
$lang->company->user           = '用戶';
$lang->company->dept           = '部門';
$lang->company->effortCalendar = '日誌日曆';
$lang->company->todoCalendar   = '待辦日曆';
$lang->company->beginDate      = '開始';
$lang->company->endDate        = '結束';
$lang->company->companyTodo    = '組織待辦';
$lang->company->todoList       = '組織待辦列表';
$lang->company->effortList     = '日誌日曆列表';
$lang->company->showAll        = '顯示部門所有成員';
$lang->company->allTodo        = '查看所有人待辦';

if(!isset($lang->company->effort)) $lang->company->effort = new stdclass();
$lang->company->effort->selectDate    = '日期';
$lang->company->effort->projectSelect = $lang->projectCommon;
$lang->company->effort->productSelect = $lang->productCommon;
$lang->company->effort->userSelect    = '用戶';
$lang->company->effort->view          = '查看';

$lang->company->currentDept = '當前部門';
