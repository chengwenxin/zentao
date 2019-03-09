<?php
public function setMenu($projects, $projectID, $buildID = 0, $extra = '')
{
    return $this->loadExtension('web')->setMenu($projects, $projectID, $buildID, $extra);
}
