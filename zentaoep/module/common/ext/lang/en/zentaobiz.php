<?php
$lang->try          = ' Trial';
$lang->bizName      = 'Biz';
$lang->expireDate   = "Expiration: %s";
$lang->forever      = "Permanent";
$lang->unlimited    = "Unlimited";
$lang->licensedUser = "User Licensed: %s";

$lang->searchObjects['feedback']   = 'Feedback';
$lang->searchObjects['service']    = 'Service';
$lang->searchObjects['deploy']     = 'Deploy';
$lang->searchObjects['deploystep'] = 'Deploy Step';

$lang->noticeBizLimited = "<div style='float:left;color:red' id='userLimited'>The number of biz users has exceeded that of the licensed. Please contact Renee at Renee@cnezsoft.com, or delete users.</div>";

$lang->admin->subMenu->sso->libreoffice = array('link' => 'Office|custom|libreoffice');
$lang->admin->subMenuOrder->sso[10] = 'libreoffice';

$lang->nonRDMenu = new stdclass();
$lang->nonRDMenu->my       = 'Calendar|my|calendar|';
$lang->nonRDMenu->doc      = 'Document|doc|alllibs|';
$lang->nonRDMenu->feedback = 'Feedback|feedback|browse|';
$lang->nonRDMenu->oa       = 'OA|attend|personal|';
$lang->nonRDMenu->company  = $lang->menu->company;

if(!empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView']))
{
    $lang->menu = $lang->nonRDMenu;
    $lang->menuOrder = array();
    $lang->menuOrder[5]  = 'my';
    $lang->menuOrder[10] = 'oa';
    $lang->menuOrder[15] = 'feedback';
    $lang->menuOrder[20] = 'doc';
    $lang->menuOrder[25] = 'company';
}
