<?php
$lang->report->crystalExport = '水晶報表導出';
$lang->report->null          = '空';

$lang->crystal = new stdclass();
$lang->crystal->common  = '水晶報表';
$lang->crystal->setVar  = '設置變數';
$lang->crystal->browse  = '已保存報表';
$lang->crystal->use     = '設計';
$lang->crystal->addVar  = '添加變數';
$lang->crystal->addLang = '設置欄位名';
$lang->crystal->custom  = '新增報表';
$lang->crystal->saveAs  = '另存為';

$lang->crystal->sql         = '查詢語句';
$lang->crystal->query       = '查詢';
$lang->crystal->condition   = '報表設計';
$lang->crystal->params      = '報表條件';
$lang->crystal->result      = '查詢結果';
$lang->crystal->group       = '分組欄位';
$lang->crystal->statistics  = '統計欄位';
$lang->crystal->group1      = '第一分組欄位';
$lang->crystal->group2      = '第二分組欄位';
$lang->crystal->reportField = '要統計的欄位';
$lang->crystal->reportType  = '統計方式';
$lang->crystal->reportTotal = '顯示彙總';
$lang->crystal->percent     = '顯示百分比';
$lang->crystal->contrast    = '對比';
$lang->crystal->showAlone   = '獨占一列';
$lang->crystal->percentAB   = '百分比';
$lang->crystal->isUser      = '顯示用戶真實姓名';
$lang->crystal->total       = '總計';
$lang->crystal->requestType = '輸入方式';
$lang->crystal->varName     = '變數名稱';
$lang->crystal->showName    = '顯示名稱';
$lang->crystal->name        = '報表名稱';
$lang->crystal->module      = '所屬類目';
$lang->crystal->id          = '編號';
$lang->crystal->code        = '代號';
$lang->crystal->all         = '所有';
$lang->crystal->fieldName   = '欄位名';
$lang->crystal->fieldValue  = '顯示名';
$lang->crystal->lang        = '語言';
$lang->crystal->desc        = '描述';
$lang->crystal->default     = '預設值';

$lang->crystal->reportTypeList['count'] = '計數';
$lang->crystal->reportTypeList['sum']   = '求和';

$lang->crystal->requestTypeList['input']   = '文本框';
$lang->crystal->requestTypeList['date']    = '日期';
$lang->crystal->requestTypeList['select']  = '下拉菜單';

$lang->crystal->selectList['user']    = '用戶列表';
$lang->crystal->selectList['product'] = $lang->productCommon . '列表';
$lang->crystal->selectList['project'] = $lang->projectCommon . '列表';
$lang->crystal->selectList['dept']    = '部門列表';
$lang->crystal->selectList['project.status'] = $lang->projectCommon . '狀態列表';

$lang->crystal->moduleList['']        = '';
$lang->crystal->moduleList['product'] = $lang->productCommon;
$lang->crystal->moduleList['project'] = $lang->projectCommon;
$lang->crystal->moduleList['test']    = '測試';
$lang->crystal->moduleList['staff']   = '組織';

$lang->crystal->sqlPlaceholder    = '直接寫入一句SQL查詢語句，只能進行查詢操作，禁止其他SQL操作';
$lang->crystal->sumPlaceholder    = '選擇求和欄位';
$lang->crystal->codePlaceholder   = '報表的唯一代號';
$lang->crystal->noticeSelect      = 'SQL語句只能是查詢語句';
$lang->crystal->noticeBlack       = 'SQL中含有禁用SQL關鍵字 %s';
$lang->crystal->notResult         = '沒有查詢數據.';
$lang->crystal->noticeResult      = '共有%s條數據，顯示了%s條';
$lang->crystal->noticeVarName     = '變數名稱沒有設置';
$lang->crystal->noticeRequestType = '變數%s的輸入方式沒有設置';
$lang->crystal->noticeShowName    = '變數%s的顯示名稱沒有設置';
$lang->crystal->errorSave         = '該SQL的變數信息不能為空！';
$lang->crystal->errorNoReport     = '不存在此報表！';
$lang->crystal->confirmDelete     = '是否刪除此報表？';
$lang->crystal->errorSql          = 'SQL語句有錯！錯誤：';
$lang->crystal->noSumAppend       = '第%s行沒有選擇求和欄位';
$lang->crystal->noStep            = '請先查詢出數據再保存報表！';
$lang->crystal->emptyName         = '報表名稱不能為空。';

$lang->report->custom       = $lang->crystal->custom;
$lang->report->useReport    = $lang->crystal->use;
$lang->report->browseReport = '瀏覽保存報表';
$lang->report->deleteReport = '刪除報表';
$lang->report->editReport   = '編輯';
$lang->report->saveReport   = '保存報表';
$lang->report->show         = '顯示報表';

$lang->datepicker->dpText->TEXT_WEEK_MONDAY = '本週一';
$lang->datepicker->dpText->TEXT_WEEK_SUNDAY = '本週日';
$lang->datepicker->dpText->TEXT_MONTH_BEGIN = '本月初';
$lang->datepicker->dpText->TEXT_MONTH_END   = '本月末';
