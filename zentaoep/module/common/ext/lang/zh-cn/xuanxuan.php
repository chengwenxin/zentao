<?php
$lang->xuanxuan = new stdclass();

$lang->admin->menu->sso['link'] = '集成|admin|xuanxuan';
if(!isset($lang->admin->menu->sso['alias'])) $lang->admin->menu->sso['alias'] = '';
$lang->admin->menu->sso['alias'] .= ',sso';

$lang->admin->subMenu->sso->xuanxuan = '喧喧集成|admin|xuanxuan';
$lang->admin->subMenuOrder->sso[4] = 'xuanxuan';
