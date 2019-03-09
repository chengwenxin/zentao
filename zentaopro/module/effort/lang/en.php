<?php
/**
 * The effort module English file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     effort
 * @version     $Id: en.php 2605 2012-02-21 07:22:58Z wwccss $
 * @link        http://www.zentao.net
 */
$lang->effort->common          = 'Effort';
$lang->effort->index           = "Effort List";
$lang->effort->create          = "Create Effort";
$lang->effort->batchCreate     = "Create Effort";
$lang->effort->createForObject = "Create for object";
$lang->effort->edit            = "Edit";
$lang->effort->batchEdit       = "Batch Edit";
$lang->effort->view            = "Details";
$lang->effort->viewAB          = "Info";
$lang->effort->comment         = 'Comment';
$lang->effort->export          = "Export";
$lang->effort->delete          = "Delete";
$lang->effort->browse          = "Browse";
$lang->effort->history         = "History";
$lang->effort->hour            = "h";
$lang->effort->clean           = "Clean";

$lang->effort->id          = 'ID';
$lang->effort->account     = 'Recorder';
$lang->effort->date        = 'Date';
$lang->effort->dept        = 'Dept';
$lang->effort->left        = 'Left';
$lang->effort->leftAB      = 'Remained';
$lang->effort->consumed    = 'Cost';
$lang->effort->consumedAB  = 'Consumed';
$lang->effort->objectType  = 'Object Type';
$lang->effort->objectID    = 'Object ID';
$lang->effort->product     = $lang->productCommon;
$lang->effort->project     = $lang->projectCommon;
$lang->effort->work        = 'Work';
$lang->effort->deal        = 'Handle';
$lang->effort->allDept     = 'All';

$lang->effort->week         = '(l)';  // date function's param.
$lang->effort->today        = 'Today';
$lang->effort->weekDateList = '';

$lang->effort->objectTypeList['custom']      = '';
$lang->effort->objectTypeList['story']       = 'Story';
$lang->effort->objectTypeList['productplan'] = 'Product Plan';
$lang->effort->objectTypeList['release']     = 'Release';
$lang->effort->objectTypeList['task']        = 'Task';
$lang->effort->objectTypeList['build']       = 'Build';
$lang->effort->objectTypeList['bug']         = 'Bug';
$lang->effort->objectTypeList['case']        = 'Test Case';
$lang->effort->objectTypeList['testcase']    = 'Test Case';
$lang->effort->objectTypeList['testtask']    = 'Test Task';
$lang->effort->objectTypeList['doc']         = 'Doc';
$lang->effort->objectTypeList['todo']        = 'TO-Do';

$lang->effort->todayEfforts     = 'Today';
$lang->effort->yesterdayEfforts = 'Yesterday';
$lang->effort->thisWeekEfforts  = 'This Week';
$lang->effort->lastWeekEfforts  = 'Last Week';
$lang->effort->thisMonthEfforts = 'This Month';
$lang->effort->lastMonthEfforts = 'Last Month';
$lang->effort->allDaysEfforts   = 'All';

$lang->effort->periods['all']       = $lang->effort->allDaysEfforts;
$lang->effort->periods['today']     = $lang->effort->todayEfforts;
$lang->effort->periods['yesterday'] = $lang->effort->yesterdayEfforts;
$lang->effort->periods['thisweek']  = $lang->effort->thisWeekEfforts;
$lang->effort->periods['lastweek']  = $lang->effort->lastWeekEfforts;
$lang->effort->periods['thismonth'] = $lang->effort->thisMonthEfforts;
$lang->effort->periods['lastmonth'] = $lang->effort->lastMonthEfforts;

$lang->effort->notEmpty          = 'It shoudl not be empty.';
$lang->effort->notNegative       = "It should not be negative.";
$lang->effort->isNumber          = 'It must be numbers.';
$lang->effort->tooLang           = 'Effore of ID%s is too long.';
$lang->effort->nowork            = "Work content of ID%s  should not be empty!";
$lang->effort->notice            = '(notice:1.if the %s is empty, it is invalid;2.if the %s is not equal %s and %s is empty, it is invalid)';
$lang->effort->notFuture         = 'Cannot add logs for future dates';
$lang->effort->confirmDelete     = "Are you sure to delete this effort?";
$lang->effort->noticeClean       = "Only removal of all system generated effort";
$lang->effort->noticeFinish      = "There are log that left is zero, the system will automatically complete the task, do you want to continue?";
$lang->effort->noticeSaveRecord  = 'Please save the estimate record which has not been saved.';
$lang->effort->remindSubject     = 'Record effort remind';
$lang->effort->remindContent     = "You didn't log in yesterday, <a href='%s' target='_blank'>Record Effort</a>";
