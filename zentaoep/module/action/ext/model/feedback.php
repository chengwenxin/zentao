<?php
public function getList($objectType, $objectID)
{
    return $this->loadExtension('feedback')->getList($objectType, $objectID);
}

public function getProductAndProject($objectType, $objectID)
{
    return $this->loadExtension('feedback')->getProductAndProject($objectType, $objectID);
}
