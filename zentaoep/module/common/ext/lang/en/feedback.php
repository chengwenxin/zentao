<?php
$lang->menu->feedback = 'Feedback|feedback|admin|';
$lang->menuOrder[24]  = 'feedback';
$lang->searchLang     = 'Search';

$lang->feedback = new stdclass();
$lang->feedback->menu = new stdclass();
$lang->feedback->menu->unclosed = array('link' => 'Wait|feedback|admin|browseType=unclosed');
$lang->feedback->menu->all      = array('link' => 'All|feedback|admin|browseType=all');
$lang->feedback->menu->public   = array('link' => 'Public|feedback|admin|browseType=public');
$lang->feedback->menu->tostory  = array('link' => 'To Story|feedback|admin|browseType=tostory');
$lang->feedback->menu->tobug    = array('link' => 'To Bug|feedback|admin|browseType=tobug');
$lang->feedback->menu->bysearch = array('link' => '<a href="javascript:;" class="querybox-toggle"><i class="icon-search icon"></i> ' . $lang->searchLang . '</a>');
$lang->feedback->menu->products = array('link' => 'Permission|feedback|products', 'alias' => 'manageproduct');

$lang->feedbackView[0] = 'R&D interface';
$lang->feedbackView[1] = 'Non R&D interface';

global $app;
if(!empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView']) and $app and $app->viewType == 'mhtml')
{
    $lang->feedback->menu->unclosed = array('link' => 'Wait|feedback|browse|browseType=unclosed');
    $lang->feedback->menu->all      = array('link' => 'All|feedback|browse|browseType=all');
    $lang->feedback->menu->public   = array('link' => 'Public|feedback|browse|browseType=public');
}
