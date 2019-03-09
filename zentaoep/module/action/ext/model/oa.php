<?php
public function sendNotice($actionID, $reader, $onlyNotice = false)
{
    return $this->loadExtension('oa')->sendNotice($actionID, $reader, $onlyNotice);
}
