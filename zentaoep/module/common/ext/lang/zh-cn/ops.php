<?php
$lang->menu->ops  = '运维|ops|index|';
$lang->menuOrder[22] = 'ops';

$lang->ops = new stdclass();
$lang->ops->menu = new stdclass();
$lang->ops->menu->deploy     = array('link' => '上线|deploy|browse', 'alias' => 'create,edit,view');
$lang->ops->menu->host       = array('link' => '主机|host|browse', 'alias' => 'create,edit,view,treemap', 'subModule' => 'tree');
$lang->ops->menu->serverroom = array('link' => '机房|serverroom|browse', 'alias' => 'create,edit,view');
$lang->ops->menu->service    = array('link' => '服务|service|manage', 'alias' => 'create,edit,view,browse');
$lang->ops->menu->setting    = array('link' => '设置|ops|setting');

$lang->host = new stdclass();
$lang->host->menu = new stdclass();
$lang->host->menu = $lang->ops->menu;

$lang->serverroom = new stdclass();
$lang->serverroom->menu = new stdclass();
$lang->serverroom->menu = $lang->ops->menu;

$lang->service = new stdclass();
$lang->service->menu = new stdclass();
$lang->service->menu->deploy     = array('link' => '上线|deploy|browse');
$lang->service->menu->host       = array('link' => '主机|host|browse');
$lang->service->menu->serverroom = array('link' => '机房|serverroom|browse');
$lang->service->menu->service    = array('link' => '服务|service|manage', 'alias' => 'create,edit,view,browse');
$lang->service->menu->setting    = array('link' => '设置|ops|setting');

$lang->deploy = new stdclass();
$lang->deploy->menu = new stdclass();
$lang->deploy->menu->deploy     = array('link' => '上线|deploy|browse', 'alias' => 'create,view,edit,steps,scope,managescope,activate,finish,cases,linkcases,managestep');
$lang->deploy->menu->host       = array('link' => '主机|host|browse');
$lang->deploy->menu->serverroom = array('link' => '机房|serverroom|browse');
$lang->deploy->menu->service    = array('link' => '服务|service|manage');
$lang->deploy->menu->setting    = array('link' => '设置|ops|setting');

$lang->menugroup->host       = 'ops';
$lang->menugroup->service    = 'ops';
$lang->menugroup->serverroom = 'ops';
$lang->menugroup->deploy     = 'ops';
