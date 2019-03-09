<?php
public function getCalendarParams()
{
    return $this->loadExtension('calendar')->getCalendarParams();
}

public function printCalendarBlock($module, $param)
{
    return $this->loadExtension('calendar')->printCalendarBlock($module, $param);
}
