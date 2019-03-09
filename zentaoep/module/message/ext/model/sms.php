<?php
public function send($objectType, $objectID, $actionType, $actionID)
{
    return $this->loadExtension('sms')->send($objectType, $objectID, $actionType, $actionID);
}
