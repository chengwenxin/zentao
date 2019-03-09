<?php
/**
 * The browse mobile view file of trip module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     trip 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

include "../../common/view/m.header.html.php";?>

<style>
.list > .list {margin-left: 10px;}
.list > .item {padding: 8px;}
</style>

<div class='heading'>
  <div class='title'>
    <a data-display='dropdown' data-placement='beside-bottom-start'><i class='icon-bars'></i> &nbsp; <?php echo $lang->$type->date;?></a>
    <div class='list dropdown-menu'>
      <?php if($yearList):?>
      <?php foreach($yearList as $year):?>    
      <a class='item item-year' href='<?php echo $this->createLink($type, $mode, "date={$year}");?>'><?php echo $year;?></a>
      <div class='list'>
        <?php foreach($monthList[$year] as $month):?>    
        <a class='item item-month' href='<?php echo $this->createLink($type, $mode, "date=$year$month");?>'>
          <?php echo $year . $month;?>
        </a>
        <?php endforeach;?>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>

  <nav class='nav'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort;?></span></a>
    <a class='btn primary' data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink($type, 'create') ?>'>
      <i class='icon icon-plus'></i> &nbsp;&nbsp;<?php echo $lang->$type->create;?>
    </a>
  </nav>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink($type, 'browse', "mode={$mode}&date={$date}&orderBy=$orderBy");?>
  <div class='box' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered'>
      <thead>
        <tr>
         <th class='w-80px text-center'><?php echo $lang->$type->createdBy;?></th>
         <th><?php echo $lang->$type->name;?></th>
         <?php if($type == 'trip'):?>
         <th class='w-80px'><?php echo $lang->$type->from;?></th>
         <?php endif;?>
         <th class='w-80px text-center'><?php echo $lang->$type->to;?></th>
        </tr>
      </thead>
      <?php foreach($tripList as $trip):?>
      <tr class='text-center' data-url='<?php echo inlink('view', "tripID=$trip->id")?>'>
        <td><?php echo zget($users, $trip->createdBy);?></td>
        <td class='text-left'><?php echo $trip->name;?></td>
        <?php if($type == 'trip'):?>
        <td><?php echo $trip->from;?></td>
        <?php endif;?>
        <td><?php echo $trip->to;?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars   = "data={$date}&orderBy=%s";
  $orders = array('id', 'createdBy', 'name', 'customer', 'begin', 'end', 'to');
  foreach($orders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->$type->{$order});
  }
  ?>
</div>

<?php include "../../common/view/m.footer.html.php";?>
