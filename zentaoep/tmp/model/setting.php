<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\setting\model.php');
helper::cd();
class extsettingModel extends settingModel 
{
public function updateVersion($version)
{
    return parent::updateVersion($version);
}
//**//
}