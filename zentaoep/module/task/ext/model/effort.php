<?php
public function addTaskEstimate($data)
{
    return $this->loadExtension('effort')->addTaskEstimate($data);
}
