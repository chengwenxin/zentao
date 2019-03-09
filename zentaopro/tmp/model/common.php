<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\common\model.php');
helper::cd();
class extcommonModel extends commonModel 
{
public function setCompany()
{
    if(!extension_loaded('ionCube Loader')) return parent::setCompany();

    return $this->loadExtension('bizext')->setCompany();
}/**
 * Print the position bar of Search. 
 * 
 * @param  int    $module 
 * @param  int    $object 
 * @param  int    $keywords 
 * @access public
 * @return void
 */
public function printSearch($module, $object, $keywords)
{
    echo "<li> {$this->lang->search->common} </li>" . "<li>{$keywords}</li>";
}public function loadConfigFromDB()
{
$sn = $this->loadModel('setting')->getItem('owner=system&module=xuanxuan&key=key');
if(empty($sn)) $this->setting->setItem('system.xuanxuan..key', $this->setting->computeSN());
    parent::loadConfigFromDB();
    if(isset($this->config->system->xuanxuan)) $this->app->mergeConfig($this->config->system->xuanxuan, 'xuanxuan');
}
    public function isOpenMethod($module, $method)
    {
if($module == 'api' and $method == 'getlicenses') return true;
if($module == 'api')
{
    if($method == 'mobilegetlist'    ||
       $method == 'mobilegetinfo'    ||
       $method == 'mobilegetuser'    ||
       $method == 'mobilegetusers'   ||
       $method == 'mobilegethistory' ||
       $method == 'mobilecomment'    ||
       $method == 'mobilegetcustom') return true;
}
        if($module == 'user' and strpos('login|logout|deny|reset', $method) !== false) return true;
        if($module == 'api'  and $method == 'getsessionid') return true;
        if($module == 'misc' and $method == 'checktable') return true;
        if($module == 'misc' and $method == 'qrcode') return true;
        if($module == 'misc' and $method == 'about') return true;
        if($module == 'misc' and $method == 'checkupdate') return true;
        if($module == 'misc' and $method == 'ping')  return true;
        if($module == 'sso' and $method == 'login')  return true;
        if($module == 'sso' and $method == 'logout') return true;
        if($module == 'sso' and $method == 'bind') return true;
        if($module == 'sso' and $method == 'gettodolist') return true;
        if($module == 'block' and $method == 'main' and isset($_GET['hash'])) return true;
        if($module == 'file' and $method == 'read') return true;

        if($this->loadModel('user')->isLogon() or ($this->app->company->guest and $this->app->user->account == 'guest'))
        {
            if(stripos($method, 'ajax') !== false) return true;
            if(stripos($method, 'downnotify') !== false) return true;
            if($module == 'block' and $method == 'main') return true;
            if($module == 'misc' and $method == 'changelog') return true;
            if($module == 'tutorial') return true;
            if($module == 'block') return true;
            if($module == 'product' and $method == 'showerrornone') return true;
        }
        return false;
    }

//**//
}