<?php
/**
 * The lang file of calendar module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->company->calendar       = '日志';
$lang->company->todo           = '待办';
$lang->company->selectDept     = '请选择部门';
$lang->company->date           = '日期';
$lang->company->allDept        = '所有';
$lang->company->to             = '至';
$lang->company->user           = '用户';
$lang->company->dept           = '部门';
$lang->company->effortCalendar = '日志日历';
$lang->company->todoCalendar   = '待办日历';
$lang->company->beginDate      = '开始';
$lang->company->endDate        = '结束';
$lang->company->companyTodo    = '组织待办';
$lang->company->todoList       = '组织待办列表';
$lang->company->effortList     = '日志日历列表';
$lang->company->showAll        = '显示部门所有成员';
$lang->company->allTodo        = '查看所有人待办';

if(!isset($lang->company->effort)) $lang->company->effort = new stdclass();
$lang->company->effort->selectDate    = '日期';
$lang->company->effort->projectSelect = $lang->projectCommon;
$lang->company->effort->productSelect = $lang->productCommon;
$lang->company->effort->userSelect    = '用户';
$lang->company->effort->view          = '查看';

$lang->company->currentDept = '当前部门';
