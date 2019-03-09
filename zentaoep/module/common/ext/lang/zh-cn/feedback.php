<?php
$lang->menu->feedback = '反馈|feedback|admin|';
$lang->menuOrder[24]  = 'feedback';
$lang->searchLang     = '搜索';

$lang->feedback = new stdclass();
$lang->feedback->menu = new stdclass();
$lang->feedback->menu->unclosed = array('link' => '待处理|feedback|admin|browseType=unclosed');
$lang->feedback->menu->all      = array('link' => '全部|feedback|admin|browseType=all');
$lang->feedback->menu->public   = array('link' => '公开|feedback|admin|browseType=public');
$lang->feedback->menu->tostory  = array('link' => '转需求|feedback|admin|browseType=tostory');
$lang->feedback->menu->tobug    = array('link' => '转Bug|feedback|admin|browseType=tobug');
$lang->feedback->menu->bysearch = array('link' => '<a href="javascript:;" class="querybox-toggle"><i class="icon-search icon"></i> ' . $lang->searchLang . '</a>');
$lang->feedback->menu->products = array('link' => '权限|feedback|products', 'alias' => 'manageproduct');

$lang->feedbackView[0] = '研发界面';
$lang->feedbackView[1] = '非研发界面';

global $app;
if(!empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView']) and $app and $app->viewType == 'mhtml')
{
    $lang->feedback->menu->unclosed = array('link' => '待处理|feedback|browse|browseType=unclosed');
    $lang->feedback->menu->all      = array('link' => '全部|feedback|browse|browseType=all');
    $lang->feedback->menu->public   = array('link' => '公开|feedback|browse|browseType=public');
}
