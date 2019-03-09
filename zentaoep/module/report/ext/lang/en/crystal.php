<?php
$lang->report->crystalExport = 'Export';
$lang->report->null          = 'NULL';

$lang->crystal = new stdclass();
$lang->crystal->common  = 'Crystal Reports';
$lang->crystal->setVar  = 'Add Variable';
$lang->crystal->browse  = 'Browse';
$lang->crystal->use     = 'Design';
$lang->crystal->addVar  = 'Add Variable';
$lang->crystal->addLang = 'Set Field';
$lang->crystal->custom  = 'Add Report';
$lang->crystal->saveAs  = 'Save as';

$lang->crystal->sql         = 'SQL';
$lang->crystal->query       = 'Query';
$lang->crystal->condition   = 'Design Report';
$lang->crystal->params      = 'Params';
$lang->crystal->result      = 'Query Result';
$lang->crystal->group       = 'Group';
$lang->crystal->statistics  = 'Aggregate';
$lang->crystal->group1      = 'Group 1';
$lang->crystal->group2      = 'Group 2';
$lang->crystal->reportField = 'Field';
$lang->crystal->reportType  = 'Method';
$lang->crystal->reportTotal = 'Show Summary';
$lang->crystal->percent     = 'Show Percent';
$lang->crystal->contrast    = 'Compare';
$lang->crystal->showAlone   = 'Exclusive Column';
$lang->crystal->percentAB   = 'Percentage';
$lang->crystal->isUser      = 'Show realname';
$lang->crystal->total       = 'Total';
$lang->crystal->requestType = 'Input Type';
$lang->crystal->varName     = 'Name';
$lang->crystal->showName    = 'Lable';
$lang->crystal->name        = 'Report Name';
$lang->crystal->module      = 'Belongs To';
$lang->crystal->id          = 'ID';
$lang->crystal->code        = 'Code';
$lang->crystal->all         = 'All';
$lang->crystal->fieldName   = 'Field in SQL';
$lang->crystal->fieldValue  = 'Field Label';
$lang->crystal->lang        = 'Language';
$lang->crystal->desc        = 'Description';
$lang->crystal->default     = 'Default Value';

$lang->crystal->reportTypeList['count'] = 'Count';
$lang->crystal->reportTypeList['sum']   = 'Sum';

$lang->crystal->requestTypeList['input']   = 'Text';
$lang->crystal->requestTypeList['date']    = 'Date';
$lang->crystal->requestTypeList['select']  = 'Select';

$lang->crystal->selectList['user']    = 'User List';
$lang->crystal->selectList['product'] = $lang->productCommon . ' List';
$lang->crystal->selectList['project'] = $lang->projectCommon . ' List';
$lang->crystal->selectList['dept']    = 'Dept list';
$lang->crystal->selectList['project.status'] = $lang->projectCommon . ' Status List';

$lang->crystal->moduleList['']        = '';
$lang->crystal->moduleList['product'] = $lang->productCommon;
$lang->crystal->moduleList['project'] = $lang->projectCommon;
$lang->crystal->moduleList['test']    = 'Test';
$lang->crystal->moduleList['staff']   = 'Company';

$lang->crystal->sqlPlaceholder    = 'A SQL query can only do query, and other SQL is forbidden.';
$lang->crystal->sumPlaceholder    = 'Select fields to sum';
$lang->crystal->codePlaceholder   = 'Unique code of report';
$lang->crystal->noticeSelect      = 'SQL query only';
$lang->crystal->noticeBlack       = 'SQL contains non query keywords %s';
$lang->crystal->notResult         = 'No query data.';
$lang->crystal->noticeResult      = 'Total %s. Show %s';
$lang->crystal->noticeVarName     = 'The name of the variable is not set';
$lang->crystal->noticeRequestType = 'The input of %s is not set.';
$lang->crystal->noticeShowName    = 'The name of variable %s is not set.';
$lang->crystal->errorSave         = 'SQL variables cannot be empty!';
$lang->crystal->errorNoReport     = 'The report does not exist!';
$lang->crystal->confirmDelete     = 'Do you want to delete this report?';
$lang->crystal->errorSql          = 'The SQL is wrong! Error:';
$lang->crystal->noSumAppend       = 'No fields have been selected to sum up in %s.';
$lang->crystal->noStep            = 'Please search out the data, then save the report!';
$lang->crystal->emptyName         = 'The report name should not be empty.';

$lang->report->custom       = $lang->crystal->custom;
$lang->report->useReport    = $lang->crystal->use;
$lang->report->browseReport = 'Browse';
$lang->report->deleteReport = 'Delete';
$lang->report->editReport   = 'Edit';
$lang->report->saveReport   = 'Save';
$lang->report->show         = 'Show data';

$lang->datepicker->dpText->TEXT_WEEK_MONDAY = 'Monday';
$lang->datepicker->dpText->TEXT_WEEK_SUNDAY = 'Sunday';
$lang->datepicker->dpText->TEXT_MONTH_BEGIN = 'Begin Month';
$lang->datepicker->dpText->TEXT_MONTH_END   = 'End Month';
