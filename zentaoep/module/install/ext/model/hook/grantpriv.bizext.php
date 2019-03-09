<?php
$config->owner   = 'system';
$config->module  = 'common';
$config->section = 'global';
$config->key     = 'flow';
$config->value   = 'full';

$this->dao->replace(TABLE_CONFIG)->data($config, false)->exec();

if($this->app->clientLang == 'en')
{
    $enDataFile = $this->app->getAppRoot() . 'db' . DS . 'en.sql';
    if(file_exists($enDataFile))
    {
        $enData = file_get_contents($enDataFile);
        $enData = str_replace('`zt_', $this->config->db->name . '.`zt_', $enData);
        $enData = str_replace('zt_',  $this->config->db->prefix, $enData);
        $this->dbh->query($enData);
    }
}
