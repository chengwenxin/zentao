<?php
/**
 * The task browse mobile view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     project
 * @version     $Id
 * @link        http://www.zentao.net
 */

$featureMenu = customModel::getFeatureMenu($this->moduleName, $this->methodName);
if($featureMenu) $bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
?>

<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php
  foreach($featureMenu as $menuItem)
  {
      if(isset($menuItem->hidden)) continue;
      $menuType = $menuItem->name;
      if($menuType != 'status')
      {   
          echo html::a(inlink('task', "project=$projectID&type=$menuType"), $menuItem->text);
      }

      if($menuType == 'status')
      {
          foreach($lang->project->statusSelects as $key => $value)
          {
              if($key == '') continue;
              echo html::a($this->createLink('project', 'task', "project=$projectID&type=$key"), $value);
          }
      }
  }
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
  <?php if($projectID):?>
  <nav class='nav'>
    <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('task', 'create', "projectID=$projectID");?>' class='btn primary'><i class='icon icon-plus'> </i> &nbsp;&nbsp;<?php echo $lang->task->create;?></a>
  </nav>
  <?php endif;?>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('project', 'task', "projectID=$projectID&status=$status&param=0&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID;?>' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->task->name;?> </th>
          <th class='text-center w-80px'><?php echo $lang->task->assignedTo;?> </th>
          <th class='text-center w-70px'><?php echo $lang->statusAB;?> </th>
        </tr>
      </thead>
      <?php foreach($tasks as $task):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('task', 'view', "taskID={$task->id}")?>' data-id='<?php echo $task->id;?>'>
        <td class='text-left<?php if(!empty($task->children)) echo " has-child";?>'>
          <?php if(!empty($task->team)) echo '<span class="label label-badge label-light">' . $this->lang->task->multipleAB . '</span> ';?>
          <?php if(!empty($task->children)) echo '<a class="task-toggle" data-id="' . $task->id . '"><i class="icon icon-caret-down"></i></a>';?>
          <?php echo $task->name;?>
        </td>
        <td><?php echo zget($users, $task->assignedTo);?></td>
        <td class='task-<?php echo $task->status;?>'><?php echo zget($lang->task->statusList, $task->status);?></td>
      </tr>

      <?php if(!empty($task->children)):?>
      <?php foreach($task->children as $key => $child):?>
      <?php $class  = $key == 0 ? ' table-child-top' : '';?>
      <?php $class .= ($key + 1 == count($task->children)) ? ' table-child-bottom' : '';?>
      <tr class='table-children<?php echo $class;?> parent-<?php echo $task->id;?>' data-id='<?php echo $child->id;?>' data-url='<?php echo $this->createLink('task', 'view', "taskID={$child->id}")?>' data-left='<?php echo $child->left;?>'>
        <td class='text-left'>
          <?php echo '<span class="label label-badge label-light">' . $this->lang->task->childrenAB . '</span> ';?>
          <?php echo $child->name;?>
        </td>
        <td><?php echo zget($users, $child->assignedTo);?></td>
        <td class='task-<?php echo $child->status;?>'><?php echo zget($lang->task->statusList, $child->status);?></td>
      </tr>
      <?php endforeach;?>
      <?php endif;?>

      <?php endforeach;?>
      <?php if($tasks):?>
      <tfoot>
        <tr><td colspan='3'><small><?php echo $summary?></small</td></tr>
      </tfoot>
      <?php endif?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "projectID={$projectID}&status={$status}&param=0&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'pri', 'name', 'deadline', 'assignedTo', 'status', 'openedDate', 'consumed', 'left');
  foreach($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->task->{$sortOrder});
  }
  ?>
</div>

<script>
$('#menu > a').removeClass('active').filter('[href*="<?php echo $status;?>"]').addClass('active');
</script>

<?php include "../../common/view/m.footer.html.php"; ?>
