<?php
public function setCompany()
{
    if(!extension_loaded('ionCube Loader')) return parent::setCompany();

    return $this->loadExtension('bizext')->setCompany();
}
