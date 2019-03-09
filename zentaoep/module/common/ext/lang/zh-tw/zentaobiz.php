<?php
$lang->try          = ' 試用';
$lang->bizName      = '企業版';
$lang->expireDate   = "到期時間：%s";
$lang->forever      = "永久授權";
$lang->unlimited    = "不限人數";
$lang->licensedUser = "授權人數：%s";

$lang->searchObjects['feedback']   = '反饋';
$lang->searchObjects['service']    = '服務';
$lang->searchObjects['deploy']     = '上線';
$lang->searchObjects['deploystep'] = '上線步驟';

$lang->noticeBizLimited = "<div style='float:left;color:red' id='bizUserLimited'>已經超出企業版授權人數限制。請聯繫：4006-8899-23，或者刪除用戶。</div>";

$lang->admin->subMenu->sso->libreoffice = array('link' => 'Office|custom|libreoffice');
$lang->admin->subMenuOrder->sso[10] = 'libreoffice';

$lang->nonRDMenu = new stdclass();
$lang->nonRDMenu->my       = '日程|my|calendar|';
$lang->nonRDMenu->doc      = '文檔|doc|alllibs|';
$lang->nonRDMenu->feedback = '反饋|feedback|browse|';
$lang->nonRDMenu->oa       = '辦公|attend|personal|';
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
