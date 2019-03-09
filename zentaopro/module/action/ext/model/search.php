<?php
public function create($objectType, $objectID, $actionType, $comment = '', $extra = '', $actor = '', $autoDelete = true)
{
    $actionID = parent::create($objectType, $objectID, $actionType, $comment, $extra, $actor, $autoDelete);
    $this->loadExtension('search')->saveIndex($objectType, $objectID, $actionType);
    return $actionID;
}
