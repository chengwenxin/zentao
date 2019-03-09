<?php
/**
 * The effort module zh-cn file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     effort
 * @version     $Id: zh-cn.php 2609 2012-02-21 13:40:19Z wwccss $
 * @link        http://www.zentao.net
 */
$lang->effort->common          = '日志';
$lang->effort->index           = "日志一览";
$lang->effort->create          = "新增日志";
$lang->effort->batchCreate     = "新增日志";
$lang->effort->createForObject = "对象详情添加日志";
$lang->effort->edit            = "更新日志";
$lang->effort->batchEdit       = "批量编辑";
$lang->effort->view            = "日志详情";
$lang->effort->viewAB          = "详情";
$lang->effort->comment         = '备注';
$lang->effort->export          = "导出";
$lang->effort->delete          = "删除日志";
$lang->effort->browse          = "浏览日志";
$lang->effort->history         = "已登记日志";
$lang->effort->hour            = "小时";
$lang->effort->clean           = "清除";

$lang->effort->id          = '编号';
$lang->effort->account     = '登记人';
$lang->effort->date        = '日期';
$lang->effort->dept        = '部门';
$lang->effort->left        = '剩余';
$lang->effort->leftAB      = '剩';
$lang->effort->consumed    = '耗时';
$lang->effort->consumedAB  = '耗';
$lang->effort->objectType  = '对象';
$lang->effort->objectID    = '对象ID';
$lang->effort->product     = $lang->productCommon;
$lang->effort->project     = $lang->projectCommon;
$lang->effort->work        = '工作内容';
$lang->effort->deal        = '处理';
$lang->effort->allDept     = '所有';

$lang->effort->week         = '星期';
$lang->effort->today        = '今天';
$lang->effort->weekDateList = '一,二,三,四,五,六,天';

$lang->effort->objectTypeList['custom']      = '';
$lang->effort->objectTypeList['story']       = '需求';
$lang->effort->objectTypeList['productplan'] = '计划';
$lang->effort->objectTypeList['release']     = '发布';
$lang->effort->objectTypeList['task']        = '任务';
$lang->effort->objectTypeList['build']       = '版本';
$lang->effort->objectTypeList['bug']         = 'Bug';
$lang->effort->objectTypeList['case']        = '用例';
$lang->effort->objectTypeList['testcase']    = '用例';
$lang->effort->objectTypeList['testtask']    = '测试单';
$lang->effort->objectTypeList['doc']         = '文档';
$lang->effort->objectTypeList['todo']        = '待办';

$lang->effort->todayEfforts     = '今日';
$lang->effort->yesterdayEfforts = '昨日';
$lang->effort->thisWeekEfforts  = '本周';
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

$lang->effort->notEmpty          = '不能为空;';
$lang->effort->notNegative       = "不能为负！";
$lang->effort->isNumber          = '需为数字;';
$lang->effort->tooLang           = 'ID%s 日志内容过长';
$lang->effort->nowork            = "ID%s 工作内容不能为空！";
$lang->effort->notice            = '(注：1、%s为空视为此行无效；2、若%s不是%s，%s为空也视为此行无效)';
$lang->effort->notFuture         = '不能为将来的日期添加日志';
$lang->effort->confirmDelete     = "您确定要删除该条日志吗？";
$lang->effort->noticeClean       = "只清除所有系统计算生成的日志";
$lang->effort->noticeFinish      = "有剩余工时为零的任务日志，系统将自动完成该任务，是否继续？";
$lang->effort->noticeSaveRecord  = '您有尚未保存的工时记录，请先将其保存。';
$lang->effort->remindSubject     = '日志录入提醒';
$lang->effort->remindContent     = "你昨天还没有录入日志，<a href='%s' target='_blank'>录入日志</a>";
