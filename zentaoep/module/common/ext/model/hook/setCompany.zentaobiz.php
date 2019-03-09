<?php
if(!extension_loaded('ionCube Loader')) return parent::setCompany();
$this->loadExtension('zentaobiz')->setCompany();
