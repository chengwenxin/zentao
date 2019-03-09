<?php
public function getDeployResults($deployID, $caseID)
{
    return $this->loadExtension('ops')->getDeployResults($deployID, $caseID);
}
