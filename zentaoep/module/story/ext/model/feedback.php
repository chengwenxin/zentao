<?php
public function create($projectID = 0, $bugID = 0, $from = '')
{
    return $this->loadExtension('feedback')->create($projectID, $bugID, $from);
}

public function getById($storyID, $version = 0, $setImgSize = false)
{
    return $this->loadExtension('feedback')->getById($storyID, $version, $setImgSize);
}

public function sendmail($storyID, $actionID)
{
    return $this->loadExtension('feedback')->sendmail($storyID, $actionID);
}
