<?php
/**
 * The effort module zh-cn file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青島易軟天創網絡科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     effort
 * @version     $Id: zh-cn.php 2609 2012-02-21 13:40:19Z wwccss $
 * @link        http://www.zentao.net
 */
$lang->effort->common          = '日誌';
$lang->effort->index           = "日誌一覽";
$lang->effort->create          = "新增日誌";
$lang->effort->batchCreate     = "新增日誌";
$lang->effort->createForObject = "對象詳情添加日誌";
$lang->effort->edit            = "更新日誌";
$lang->effort->batchEdit       = "批量編輯";
$lang->effort->view            = "日誌詳情";
$lang->effort->viewAB          = "詳情";
$lang->effort->comment         = '備註';
$lang->effort->export          = "導出";
$lang->effort->delete          = "刪除日誌";
$lang->effort->browse          = "瀏覽日誌";
$lang->effort->history         = "已登記日誌";
$lang->effort->hour            = "小時";
$lang->effort->clean           = "清除";

$lang->effort->id          = '編號';
$lang->effort->account     = '登記人';
$lang->effort->date        = '日期';
$lang->effort->dept        = '部門';
$lang->effort->left        = '剩餘';
$lang->effort->leftAB      = '剩';
$lang->effort->consumed    = '耗時';
$lang->effort->consumedAB  = '耗';
$lang->effort->objectType  = '對象';
$lang->effort->objectID    = '對象ID';
$lang->effort->product     = $lang->productCommon;
$lang->effort->project     = $lang->projectCommon;
$lang->effort->work        = '工作內容';
$lang->effort->deal        = '處理';
$lang->effort->allDept     = '所有';

$lang->effort->week         = '星期';
$lang->effort->today        = '今天';
$lang->effort->weekDateList = '一,二,三,四,五,六,天';

$lang->effort->objectTypeList['custom']      = '';
$lang->effort->objectTypeList['story']       = '需求';
$lang->effort->objectTypeList['productplan'] = '計劃';
$lang->effort->objectTypeList['release']     = '發佈';
$lang->effort->objectTypeList['task']        = '任務';
$lang->effort->objectTypeList['build']       = '版本';
$lang->effort->objectTypeList['bug']         = 'Bug';
$lang->effort->objectTypeList['case']        = '用例';
$lang->effort->objectTypeList['testcase']    = '用例';
$lang->effort->objectTypeList['testtask']    = '測試單';
$lang->effort->objectTypeList['doc']         = '文檔';
$lang->effort->objectTypeList['todo']        = '待辦';

$lang->effort->todayEfforts     = '今日';
$lang->effort->yesterdayEfforts = '昨日';
$lang->effort->thisWeekEfforts  = '本週';
$lang->effort->lastWeekEfforts  = '上周';
$lang->effort->thisMonthEfforts = '本月';
$lang->effort->lastMonthEfforts = '上月';
$lang->effort->allDaysEfforts   = '所有';

$lang->effort->periods['all']       = $lang->effort->allDaysEfforts;
$lang->effort->periods['today']     = $lang->effort->todayEfforts;
$lang->effort->periods['yesterday'] = $lang->effort->yesterdayEfforts;
$lang->effort->periods['thisweek']  = $lang->effort->thisWeekEfforts;
$lang->effort->periods['lastweek']  = $lang->effort->lastWeekEfforts;
$lang->effort->periods['thismonth'] = $lang->effort->thisMonthEfforts;
$lang->effort->periods['lastmonth'] = $lang->effort->lastMonthEfforts;

$lang->effort->notEmpty          = '不能為空;';
$lang->effort->notNegative       = "不能為負！";
$lang->effort->isNumber          = '需為數字;';
$lang->effort->tooLang           = 'ID%s 日誌內容過長';
$lang->effort->nowork            = "ID%s 工作內容不能為空！";
$lang->effort->notice            = '(註：1、%s為空視為此行無效；2、若%s不是%s，%s為空也視為此行無效)';
$lang->effort->notFuture         = '不能為將來的日期添加日誌';
$lang->effort->confirmDelete     = "您確定要刪除該條日誌嗎？";
$lang->effort->noticeClean       = "只清除所有系統計算生成的日誌";
$lang->effort->noticeFinish      = "有剩餘工時為零的任務日誌，系統將自動完成該任務，是否繼續？";
$lang->effort->noticeSaveRecord  = '您有尚未保存的工時記錄，請先將其保存。';
$lang->effort->remindSubject     = '日誌錄入提醒';
$lang->effort->remindContent     = "你昨天還沒有錄入日誌，<a href='%s' target='_blank'>錄入日誌</a>";
