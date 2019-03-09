<?php
public function start($taskID)
{
    return $this->loadExtension('gantt')->start($taskID);
}

public function finish($taskID)
{
    return $this->loadExtension('gantt')->finish($taskID);
}
