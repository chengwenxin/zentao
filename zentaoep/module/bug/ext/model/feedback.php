<?php
public function create($from = '')
{
    return $this->loadExtension('feedback')->create($from);
}

public function getById($bugID, $setImgSize = false)
{
    return $this->loadExtension('feedback')->getById($bugID, $setImgSize);
}

public function sendmail($bugID, $actionID)
{
    return $this->loadExtension('feedback')->sendmail($bugID, $actionID);
}

public function getBugs($productID, $projects, $branch, $browseType, $moduleID, $queryID, $sort, $pager)
{
    return $this->loadExtension('feedback')->getBugs($productID, $projects, $branch, $browseType, $moduleID, $queryID, $sort, $pager);
}
