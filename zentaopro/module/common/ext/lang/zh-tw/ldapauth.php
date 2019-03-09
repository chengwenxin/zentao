<?php
if(!isset($lang->admin->menu->sso['subModule'])) $lang->admin->menu->sso['subModule'] = '';
$lang->admin->menu->sso['subModule'] .= ',ldap';
$lang->admin->subMenu->sso->ldap = array('link' => 'LDAP|ldap|set', 'subModule' => 'ldap');
$lang->admin->subMenuOrder->sso[15] = 'ldap';

$lang->ldap = new stdclass();
$lang->ldap->menu = $lang->admin->menu;

$lang->menugroup->ldap = 'admin';
