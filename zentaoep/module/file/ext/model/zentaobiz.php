<?php
public function convertOffice($file, $type = '')
{
    return $this->loadExtension('zentaobiz')->convertOffice($file, $type);
}

public function getCollaboraDiscovery($collaboraPath = '')
{
    return $this->loadExtension('zentaobiz')->getCollaboraDiscovery($collaboraPath);
}

public function getFileInfo4Wopi($file, $canEdit = false)
{
    return $this->loadExtension('zentaobiz')->getFileInfo4Wopi($file, $canEdit);
}
