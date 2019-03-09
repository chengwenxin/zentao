<?php
public function delete($moduleID, $null = null)
{
    return $this->loadExtension('zentaobiz')->delete($moduleID);
}

public function getHostTreeMenu()
{
    return $this->loadExtension('host')->getHostTreeMenu();
}

public function createHostLink($type, $module)
{
    return $this->loadExtension('host')->createHostLink($type, $module);
}

public function getHostStructure()
{
    return $this->loadExtension('host')->getHostStructure();
}

public function getHostSons($moduleID)
{
    return $this->loadExtension('host')->getHostSons($moduleID);
}

public function getHostOptionMenu()
{
    return $this->loadExtension('host')->getHostOptionMenu();
}
