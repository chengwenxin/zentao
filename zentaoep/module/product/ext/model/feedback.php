<?php
public function getStories($productID, $branch, $browseType, $queryID, $moduleID, $sort, $pager)
{
    return $this->loadExtension('feedback')->getStories($productID, $branch, $browseType, $queryID, $moduleID, $sort, $pager);
}
