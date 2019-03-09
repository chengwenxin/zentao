<?php
/**
 * The todo mobile view file of my module of ZenTaoPMS.
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
<style>
  #dateBox{padding-top:8px;}
</style>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <div id='dateBox'>
    <input type='date' class='input' id='date' name='date' value='<?php echo $date?>' onchange='changeDate(this.value)'>
  </div>
  <?php 
  foreach($lang->todo->periods as $period => $label)
  {
      $vars = "date=$period";
      if($period == 'before') $vars .= "&account={$app->user->account}&status=undone";
      echo html::a(inlink('todo', $vars), $label);
  }
  ?>
  <?php
  if(is_numeric($type)) 
  {
      if($date == date('Y-m-d'))
      {
          $type = 'today'; 
      }
      else if($date == date('Y-m-d', strtotime('-1 day')))
      {
          $type = 'yesterday'; 
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
  <nav class='nav'>
    <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('todo', 'create') ?>' class='btn primary'><i class='icon icon-plus'></i>&nbsp;&nbsp; <?php echo $lang->todo->create;?></a>
  </nav>
</div>

<section id='page' class='section list-with-pager'>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $this->createLink('my', 'todo', "type=$type&account=$account&status=$status&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"); ?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th><?php echo $lang->todo->name;?></th>
          <th class='text-center w-70px'><?php echo $lang->todo->beginAB;?></th>
          <th class='text-center w-70px'><?php echo $lang->todo->endAB;?></th>
          <th class='text-center w-70px'><?php echo $lang->todo->status;?></th>
        </tr>
      </thead>
      <?php foreach($todos as $todo):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('todo', 'view', "id=$todo->id&from=my");?>' data-id='<?php echo $todo->id;?>'>
        <td class='text-left'><?php echo $todo->name;?></td>
        <td><?php echo $todo->begin;?></td>
        <td><?php echo $todo->end;?></td>
        <td class='todo-<?php echo $todo->status;?>'><?php echo zget($lang->todo->statusList, $todo->status);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel enter-from-bottom hidden affix layer' id='sortPanel'>
  <?php
  $vars = "type=$type&account=$account&status=$status&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $orders = array('id', 'date', 'type', 'pri', 'name', 'begin', 'end', 'status');
  foreach ($orders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->todo->{$order});
  }
  ?>
</div>

<script>
$('#appnav > a').removeClass('active').filter('[href*="todo"]').addClass('active');
$('#menu > a').removeClass('active').filter('[href*="<?php echo $type?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
