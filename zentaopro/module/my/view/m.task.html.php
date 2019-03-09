<?php
/**
 * The task browse mobile view file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     my
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<?php
$bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
?>

<nav id='menu' class='menu nav affix dock-top canvas'>
  <?php
  echo html::a(inlink('task', "type=assignedTo"),  $lang->my->taskMenu->assignedToMe);
  echo html::a(inlink('task', "type=openedBy"),    $lang->my->taskMenu->openedByMe);
  echo html::a(inlink('task', "type=finishedBy"),  $lang->my->taskMenu->finishedByMe);
  echo html::a(inlink('task', "type=closedBy"),    $lang->my->taskMenu->closedByMe);
  echo html::a(inlink('task', "type=canceledBy"),  $lang->my->taskMenu->canceledByMe);
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-actions list-with-pager'>
  <?php $refreshUrl = $this->createLink('my', 'task', "type={$type}&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID;?>' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th><?php echo $lang->task->name;?> </th>
          <th class='text-center w-70px'><?php echo $lang->statusAB;?> </th>
        </tr>
      </thead>
      <?php foreach($tasks as $task):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('task', 'view', "taskID={$task->id}");?>' data-id='<?php echo $task->id;?>'>
        <td class='text-left'><?php echo $task->name;?></td>
        <td class='task-<?php echo $task->status;?>'><?php echo zget($lang->task->statusList, $task->status);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "type={$type}&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'pri', 'name', 'deadline', 'assignedTo', 'status', 'openedDate', 'consumed', 'left');
  foreach ($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->task->{$sortOrder}));
  }
  ?>
</div>

<script>
$('#menu > a').removeClass('active').filter('[href*="<?php echo $type ?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
