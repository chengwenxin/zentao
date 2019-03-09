<?php
/**
 * The header mobile view of common module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     common
 * @version     $Id: header.lite.html.php 3299 2015-12-02 02:10:06Z daitingting $
 * @link        http://www.zentao.net
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

if(!isset($bodyClass)) $bodyClass = '';
$bodyClass .= ' with-heading-top with-nav-top';

if(isonlybody()) return false;
include 'm.header.lite.html.php';
include 'm.avatar.html.php';

$mainMenus = customModel::getMainMenu();

$mainName = $this->app->getModuleName();
if(isset($lang->menugroup->$mainName)) $mainName = $lang->menugroup->$mainName;

$showedMainMenus = array();
foreach($mainMenus as $mainMenu)
{
    if(empty($mainMenu->hidden)) $showedMainMenus[]  = $mainMenu;
    if($mainName == $mainMenu->name) $currentMainMenu = $mainMenu;
}

if(!isset($headerTitle))
{
    $headerTitle = $currentMainMenu->text;
    if(!empty($lang->modulePageNav)) $headerTitle = $lang->modulePageNav;
    $headerTitle = preg_replace('/<i[^>]*>[^<]*<\/i>/U', '', $headerTitle);
}
?>

<header id='appbar' class='heading skin-default affix dock-top'>
  <a data-target='#userMenu' data-backdrop='true' data-display class='profile has-padding' data-target-dismiss='true'>
    <div class='avatar text-tint circle'>
      <img src='<?php echo $webRoot . 'mobile/img/profile.png' ?>' alt='<?php echo $this->app->user->realname;?>'>
    </div>
  </a>
  <strong id='headerTitle'><nobr><?php echo $headerTitle;?></nobr></strong>
  <nav id='searchbar' class='has-padding'>
    <?php if(common::hasPriv('search', 'index')):?>
    <a data-target='#searchBox' data-backdrop='true' data-display data-placement='top' class='avatar'>
      <img src='<?php echo $webRoot . 'mobile/img/search.png' ?>'>
    </a>
    <?php endif;?>
  </nav>
</header>

<nav id='appnav' class='affix dock-top nav skin-default-pale'>
  <?php commonModel::printModuleMenu($this->app->getModuleName());?>
  <a class='moreAppnav hidden' data-display='dropdown' data-placement='beside-bottom'><i class='icon icon-bars'></i></a>
  <div id='moreAppnav' class='list dropdown-menu'></div>
</nav>

<div id='userMenu' class='list compact layer hidden fade'>
  <a class='item multi-lines primary-pale' data-remote='<?php echo $this->createLink('my', 'profile');?>' data-display='modal' data-placement='bottom' data-name='userProfile'>
    <?php printUserAvatar('circle', $app->user);?>
    <div class='content'>
      <div class='title'><?php echo empty($app->user->realname) ? ('@' . $app->user->account) : $app->user->realname ?></div>
      <div class='subtitle'><?php echo $lang->user->profile ?></div>
    </div>
  </a>
  <div class='item'>
    <i class='icon icon-globe muted'></i>
    <div class="content">
      <nav class='nav lang-menu dock'>
        <?php foreach($config->langs as $key => $value):?>
          <a data-value='<?php echo $key; ?>'<?php if($key === $this->app->getClientLang()) echo ' class="active"' ?>><?php echo $value; ?></a>
        <?php endforeach;?>
      </nav>
    </div>
  </div>
  <div class='divider no-margin'></div>
  <a class='item' data-remote='<?php echo $this->createLink('misc', 'about');?>' data-display='modal' data-placement='bottom'><i class='icon icon-info-sign muted'></i> <span class='title'><?php echo $lang->aboutZenTao?></span></a>
  <div class='divider no-margin'></div>
  <?php echo html::a($this->createLink('user', 'logout'), "<i class='icon icon-signout muted'></i> <span class='title'>{$lang->logout}</span>", '', "class='item'")?>
</div>
<div id='searchBox' class='fade hidden layer'>
  <div class='heading divider'>
    <div class='title'><strong><?php echo $lang->searchAB?></strong></div>
    <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
  </div>
  <form class='content box' action='<?php echo $this->createLink('search', 'index')?>' method='post'>
    <div class='control-group'>
      <?php echo html::input('words', '', "class='input'")?>
      <?php echo html::submitButton("<i class='icon-search'></i>")?>
    </div>
  </form>
  <?php
  if($moduleName == 'product')
  {
      if($methodName == 'browse') $searchObject = 'story';
  }
  elseif($moduleName == 'project')
  {
      if(strpos('task|story|bug|build', $methodName) !== false) $searchObject = $methodName;
  }
  elseif($moduleName == 'my' or $moduleName == 'user')
  {
      $searchObject = $methodName;
  }
  if(empty($searchObject) or empty($lang->searchObjects[$searchObject])) $searchObject = 'bug';
  echo html::hidden('searchType', $searchObject);
  ?>

  <ul class='dropdown-search-menu hidden'>
    <?php
    foreach ($lang->searchObjects as $key => $value)
    {
        if(in_array($key, $config->noWebModules) or $key == 'user') continue;
        echo "<li><a href='javascript:;' data-value='{$key}'>{$value}</a></li>";
    }
    ?>
  </ul>
</div>

<div class="nav affix dock-bottom justified">

  <?php $maxBottomMenuCount = $this->app->getClientLang() == 'en' ? '5' : 6;?>
  <?php $i = 0;?>
  <?php $count = count($showedMainMenus);?>
  <?php foreach($showedMainMenus as $mainMenu):?>
  <?php $mainMenu->text = preg_replace('/<i[^>]*>[^<]*<\/i>/U', '', $mainMenu->text);?>
  <?php $mainMenuLink   = $this->createLink($mainMenu->link['module'], $mainMenu->link['method'], (isset($mainMenu->link['vars']) ? $mainMenu->link['vars'] : ''));?>
  <?php $i++;?>
  <?php if($count <= $maxBottomMenuCount or ($count > ($maxBottomMenuCount) && $i < ($maxBottomMenuCount))):?>
  <a class='item<?php if($mainMenu->name == $mainName) echo ' active' ?>' href='<?php echo $mainMenuLink?>'>
    <div class='content'>
      <div class='title text-center'><i class='icon <?php echo '';?>'></i></div>
      <div class='title'><?php echo $mainMenu->text;?></div>
    </div>
  </a>
  <?php endif;?>

  <?php if($count <= $maxBottomMenuCount) continue;?>
  <?php if($i == ($maxBottomMenuCount)):?>
  <a class='item' data-display='dropdown' data-placement='{"position": "absolute", "top": "auto", "left": "auto", "bottom": 48, "right": 0}'>
    <div class='content'>
      <div class='title text-center'></div>
      <div class='title'><?php echo $lang->more;?></div>
    </div>
  </a>
  <div id='moreApp' class='list dropdown-menu'>
  <?php endif;?>
  <?php if($i >= $maxBottomMenuCount):?>
    <a class='item text-center<?php if($mainMenu->name == $mainName) echo ' active' ?>' href='<?php echo $mainMenuLink?>'>
      <div class='title'>
        <i class='icon <?php echo '';?>'></i> <?php echo $mainMenu->text;?>
      </div>
    </a>
    <div class='divider no-margin'></div>
  <?php endif;?>
  <?php if($i == $count):?>
  </div>
  <?php endif;?>
  <?php endforeach;?>

</div>
