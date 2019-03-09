<?php
$bodyClass = 'with-menu-top';
$headerTitle = $lang->testtask->common . $lang->colon . $task->name;
?>
<?php include '../../common/view/m.header.html.php';?>
<?php
$hasCasesPriv = common::hasPriv('testtask', 'cases');
$hasGroupPriv = common::hasPriv('testtask', 'groupcase');
?>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php
  if($hasCasesPriv) echo html::a($this->inlink('cases', "taskID=$taskID&browseType=all&param=0"), $lang->testtask->allCases, '', "id='allTab'");
  if($hasCasesPriv) echo html::a($this->inlink('cases', "taskID=$taskID&browseType=assignedtome&param=0"), $lang->testtask->assignedToMe, '', "id='assignedtomeTab'");
  if($hasGroupPriv)
  {
      $groupBy  = isset($groupBy) ? $groupBy : '';
      $current  = zget($lang->testcase->groups, isset($groupBy) ? $groupBy : '', '');
      if(empty($current)) $current = $lang->testcase->groups[''];

      echo html::a('###', $current . " <span class='icon-caret-down'></span>", '', "data-display='modal' data-target='#groupModal' data-backdrop='true' data-placement='bottom' id='groupcaseTab'");
  }
  if(common::hasPriv('testtask', 'view')) echo html::a(inlink('view', "taskID=$taskID"), $lang->testtask->view);
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>
<?php 
if($hasGroupPriv)
{
    echo "<div class='list hidden affix enter-from-bottom layer' id='groupModal'>";
    foreach ($lang->testcase->groups as $key => $value)
    {
        if($key == '') continue;
        echo html::a($this->createLink('testtask', 'groupCase', "taskID=$taskID&&groupBy=$key"), $value, '', "class='item " . ($key == $groupBy ? "active" : '') . "'");
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
