<?php
public function checkUserLimit()
{
    return $this->loadExtension('bizext')->checkUserLimit();
}

public function getProUserLimit()
{
    return $this->loadExtension('bizext')->getProUserLimit();
}
