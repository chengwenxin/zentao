<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\common\model.php');
helper::cd();
class extcommonModel extends commonModel 
{
public function loadConfigFromDB()
{
$sn = $this->loadModel('setting')->getItem('owner=system&module=xuanxuan&key=key');
if(empty($sn)) $this->setting->setItem('system.xuanxuan..key', $this->setting->computeSN());
    parent::loadConfigFromDB();
    if(isset($this->config->system->xuanxuan)) $this->app->mergeConfig($this->config->system->xuanxuan, 'xuanxuan');
}
//**//
}