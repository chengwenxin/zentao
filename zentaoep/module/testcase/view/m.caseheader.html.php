<?php
$featureMenu = $config->global->flow == 'full' ? customModel::getFeatureMenu('testcase', 'browse') : array();
if($featureMenu) $bodyClass = 'with-menu-top';
?>
<?php include '../../common/view/m.header.html.php';?>
<?php
$hasBrowsePriv = common::hasPriv('testcase', 'browse');
$hasGroupPriv  = common::hasPriv('testcase', 'groupcase');
$hasZeroPriv   = common::hasPriv('story', 'zerocase');
?>
<nav id='menu' class='menu nav affix dock-top canvas'>
<?php foreach($featureMenu as $menuItem):?>
  <?php
  if(isset($menuItem->hidden)) continue;
  $menuType = $menuItem->name;
  if(!$config->testcase->needReview and $menuType == 'wait') continue;
  if($hasBrowsePriv and strpos($menuType, 'QUERY') === 0)
  {
      $queryID = (int)substr($menuType, 5);
      echo html::a($this->createLink('testcase', 'browse', "productid=$productID&branch=$branch&browseType=bySearch&param=$queryID"), $menuItem->text, '', "id='{$menuType}Tab'");
  }
  elseif($hasBrowsePriv and ($menuType == 'all' or $menuType == 'needconfirm' or $menuType == 'wait'))
  {
      echo html::a($this->createLink('testcase', 'browse', "productid=$productID&branch=$branch&browseType=$menuType"), $menuItem->text, '', "id='{$menuType}Tab'");
  }
  elseif($hasBrowsePriv and $menuType == 'suite')
  {
      $currentSuiteID = isset($suiteID) ? (int)$suiteID : 0;
      $currentSuite   = zget($suiteList, $currentSuiteID, '');
      echo html::a('###', $lang->testsuite->common . "&nbsp;<span class='icon-caret-down'></span>", '', ($browseType == 'bysuite' ? "class='active'" : '') . "data-display='modal' data-target='#suiteModal' data-backdrop='true' data-placement='bottom'");
  }
  elseif($hasGroupPriv and $menuType == 'group')
  {
      $groupBy  = isset($groupBy) ? $groupBy : '';
      $current  = zget($lang->testcase->groups, isset($groupBy) ? $groupBy : '', '');
      if(empty($current)) $current = $lang->testcase->groups[''];

      echo html::a('###', $current . "&nbsp;<span class='icon-caret-down'></span>", '', "data-display='modal' data-target='#groupModal' data-backdrop='true' data-placement='bottom' id='groupcaseTab'");
  }
  elseif($hasZeroPriv and $menuType == 'zerocase')
  {
      echo html::a($this->createLink('story', 'zeroCase', "productID=$productID"), $lang->story->zeroCase, '', "id='zerocaseTab'");
  }
  ?>
  <?php endforeach;?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>
<?php 
if($hasBrowsePriv)
{
    echo "<div class='list hidden affix enter-from-bottom layer' id='suiteModal'>";
    if(empty($suiteList))
    {
        $tipMessage  = "<div class='heading'>";
        $tipMessage .= "<div class='title'><strong>{$lang->testcase->tips}</strong></div>";
        $tipMessage .= "<nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>";
        $tipMessage .= "</div>";
        $tipMessage .= "<div class='content article box'>";
        $tipMessage .= "<p>{$lang->testcase->noSuite}</p>";
        $tipMessage .= "</div>";
        echo $tipMessage;
    }

    foreach($suiteList as $suiteID => $suite)
    {
        $suiteName = $suite->name;
        if($suite->type == 'public') $suiteName .= " <span class='label label-info'>{$lang->testsuite->authorList[$suite->type]}</span>";
        echo html::a($this->createLink('testcase', 'browse', "productID=$productID&branch=$branch&browseType=bySuite&param=$suiteID"), $suiteName, '', "class='item " . ($suiteID == (int)$currentSuiteID ? 'active' : '') . "'");
    }
    echo '</div>';
}
if($hasGroupPriv)
{
    echo "<div class='list hidden affix enter-from-bottom layer' id='groupModal'>";
    foreach ($lang->testcase->groups as $key => $value)
    {
        if($key == '') continue;
        echo html::a($this->createLink('testcase', 'groupCase', "productID=$productID&branch=$branch&groupBy=$key"), $value, '', "class='item " . ($key == $groupBy ? "active" : '') . "'");
    }
    echo '</div>';
}
?>

<?php
$headerHooks = glob(dirname(dirname(__FILE__)) . "/ext/view/m.featurebar.*.html.hook.php");
if(!empty($headerHooks))
{
    foreach($headerHooks as $fileName) include($fileName);
}
?>
