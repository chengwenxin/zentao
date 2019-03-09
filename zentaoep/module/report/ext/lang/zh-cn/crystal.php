<?php
$lang->report->crystalExport = '水晶报表导出';
$lang->report->null          = '空';

$lang->crystal = new stdclass();
$lang->crystal->common  = '水晶报表';
$lang->crystal->setVar  = '设置变量';
$lang->crystal->browse  = '已保存报表';
$lang->crystal->use     = '设计';
$lang->crystal->addVar  = '添加变量';
$lang->crystal->addLang = '设置字段名';
$lang->crystal->custom  = '新增报表';
$lang->crystal->saveAs  = '另存为';

$lang->crystal->sql         = '查询语句';
$lang->crystal->query       = '查询';
$lang->crystal->condition   = '报表设计';
$lang->crystal->params      = '报表条件';
$lang->crystal->result      = '查询结果';
$lang->crystal->group       = '分组字段';
$lang->crystal->statistics  = '统计字段';
$lang->crystal->group1      = '第一分组字段';
$lang->crystal->group2      = '第二分组字段';
$lang->crystal->reportField = '要统计的字段';
$lang->crystal->reportType  = '统计方式';
$lang->crystal->reportTotal = '显示汇总';
$lang->crystal->percent     = '显示百分比';
$lang->crystal->contrast    = '对比';
$lang->crystal->showAlone   = '独占一列';
$lang->crystal->percentAB   = '百分比';
$lang->crystal->isUser      = '显示用户真实姓名';
$lang->crystal->total       = '总计';
$lang->crystal->requestType = '输入方式';
$lang->crystal->varName     = '变量名称';
$lang->crystal->showName    = '显示名称';
$lang->crystal->name        = '报表名称';
$lang->crystal->module      = '所属类目';
$lang->crystal->id          = '编号';
$lang->crystal->code        = '代号';
$lang->crystal->all         = '所有';
$lang->crystal->fieldName   = '字段名';
$lang->crystal->fieldValue  = '显示名';
$lang->crystal->lang        = '语言';
$lang->crystal->desc        = '描述';
$lang->crystal->default     = '默认值';

$lang->crystal->reportTypeList['count'] = '计数';
$lang->crystal->reportTypeList['sum']   = '求和';

$lang->crystal->requestTypeList['input']   = '文本框';
$lang->crystal->requestTypeList['date']    = '日期';
$lang->crystal->requestTypeList['select']  = '下拉菜单';

$lang->crystal->selectList['user']    = '用户列表';
$lang->crystal->selectList['product'] = $lang->productCommon . '列表';
$lang->crystal->selectList['project'] = $lang->projectCommon . '列表';
$lang->crystal->selectList['dept']    = '部门列表';
$lang->crystal->selectList['project.status'] = $lang->projectCommon . '状态列表';

$lang->crystal->moduleList['']        = '';
$lang->crystal->moduleList['product'] = $lang->productCommon;
$lang->crystal->moduleList['project'] = $lang->projectCommon;
$lang->crystal->moduleList['test']    = '测试';
$lang->crystal->moduleList['staff']   = '组织';

$lang->crystal->sqlPlaceholder    = '直接写入一句SQL查询语句，只能进行查询操作，禁止其他SQL操作';
$lang->crystal->sumPlaceholder    = '选择求和字段';
$lang->crystal->codePlaceholder   = '报表的唯一代号';
$lang->crystal->noticeSelect      = 'SQL语句只能是查询语句';
$lang->crystal->noticeBlack       = 'SQL中含有禁用SQL关键字 %s';
$lang->crystal->notResult         = '没有查询数据.';
$lang->crystal->noticeResult      = '共有%s条数据，显示了%s条';
$lang->crystal->noticeVarName     = '变量名称没有设置';
$lang->crystal->noticeRequestType = '变量%s的输入方式没有设置';
$lang->crystal->noticeShowName    = '变量%s的显示名称没有设置';
$lang->crystal->errorSave         = '该SQL的变量信息不能为空！';
$lang->crystal->errorNoReport     = '不存在此报表！';
$lang->crystal->confirmDelete     = '是否删除此报表？';
$lang->crystal->errorSql          = 'SQL语句有错！错误：';
$lang->crystal->noSumAppend       = '第%s行没有选择求和字段';
$lang->crystal->noStep            = '请先查询出数据再保存报表！';
$lang->crystal->emptyName         = '报表名称不能为空。';

$lang->report->custom       = $lang->crystal->custom;
$lang->report->useReport    = $lang->crystal->use;
$lang->report->browseReport = '浏览保存报表';
$lang->report->deleteReport = '删除报表';
$lang->report->editReport   = '编辑';
$lang->report->saveReport   = '保存报表';
$lang->report->show         = '显示报表';

$lang->datepicker->dpText->TEXT_WEEK_MONDAY = '本周一';
$lang->datepicker->dpText->TEXT_WEEK_SUNDAY = '本周日';
$lang->datepicker->dpText->TEXT_MONTH_BEGIN = '本月初';
$lang->datepicker->dpText->TEXT_MONTH_END   = '本月末';
