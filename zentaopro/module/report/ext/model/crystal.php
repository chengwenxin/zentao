<?php
public function __construct()
{
    parent::__construct();
    $this->loadExtension('crystal');
}

public function getReportByID($reportID)
{
    return $this->crystalReport->getReportByID($reportID);
}

public function getReportList($module = '', $orderBy = 'id_desc', $pager = null)
{
    return $this->crystalReport->getReportList($module, $orderBy, $pager);
}

public function checkBlackList($sql)
{
    return $this->crystalReport->checkBlackList($sql);
}

public function getTables($sql)
{
    return $this->crystalReport->getTables($sql);
}

public function mergeFields($dataFields, $sqlFields, $moduleNames)
{
    return $this->crystalReport->mergeFields($dataFields, $sqlFields, $moduleNames);
}

public function getCellData($data, $dataCols, $condition)
{
    return $this->crystalReport->getCellData($data, $dataCols, $condition);
}

public function checkSqlVar($sql)
{
    return $this->crystalReport->checkSqlVar($sql);
}

public function getHeaderNames($fields, $moduleNames, $condition)
{
    return $this->crystalReport->getHeaderNames($fields, $moduleNames, $condition);
}

public function getGroupLang($field, $sqlFields, $moduleNames)
{
    return $this->crystalReport->getGroupLang($field, $sqlFields, $moduleNames);
}

public function replaceTableNames($sql)
{
    return $this->crystalReport->replaceTableNames($sql);
}

public function processSqlVar($sqlVar)
{
    return $this->crystalReport->processSqlVar($sqlVar);
}

public function processData($dataList, $condition)
{
    return $this->crystalReport->processData($dataList, $condition);
}
