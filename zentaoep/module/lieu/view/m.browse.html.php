<?php
/**
 * The browse view file of lieu module of Ranzhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com> 
 * @package     lieu
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include "../../common/view/m.header.html.php";?>
<?php js::set('confirmReview', $lang->lieu->confirmReview)?>

<style>
.list > .list {margin-left: 10px;}
.list > .item {padding: 8px;}
</style>
<div class='heading'>
  <div class='title'>
    <?php if(!empty($yearList)):?>
    <a data-display='dropdown' data-placement='beside-bottom-start'><i class='icon-bars'></i> &nbsp; <?php echo $lang->lieu->date;?></a>
    <div class='list dropdown-menu'>
      <?php foreach($yearList as $year):?>    
      <a class='item item-year' href='<?php echo inlink($type, "date={$year}");?>'><?php echo $year;?></a>
      <div class='list'>
        <?php foreach($monthList[$year] as $month):?>    
        <a class='item item-month' href='<?php echo inlink($type, "date=$year$month");?>'>
          <?php echo $year . $month;?>
        </a>
        <?php endforeach;?>
      </div>
      <?php endforeach;?>
    </div>
    <?php else:?>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort;?></span></a>
    <?php endif;?>
  </div>

  <nav class='nav'>
    <?php if(!empty($yearList)):?>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort;?></span></a>
    <?php endif;?>
    <a class='btn primary' data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('lieu', 'create') ?>'>
      <i class='icon icon-plus'></i> &nbsp;&nbsp;<?php echo $lang->lieu->create;?>
    </a>
  </nav>
</div>

<section id='page' class='section list-with-actions'>
  <?php $refreshUrl = $this->createLink('lieu', 'browse', "type={$type}&date={$date}&orderBy=$orderBy");?>
  <div class='box' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered'>
      <thead>
        <tr>
         <th class='text-center'><?php echo $lang->lieu->createdBy;?></th>
         <th class='w-80px'><?php echo $lang->lieu->hours;?></th>
         <th class='w-100px text-center'><?php echo $lang->lieu->status;?></th>
        </tr>
      </thead>
      <?php foreach($lieuList as $lieu):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('lieu', 'view', "lieuID={$lieu->id}&type={$type}")?>'>
        <td><?php echo zget($users, $lieu->createdBy);?></td>
        <td><?php echo $lieu->hours;?></td>
        <td><span class='label status-<?php echo $lieu->status?>-pale'><?php echo zget($lang->lieu->statusList, $lieu->status);?></span></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars   = "data={$date}&orderBy=%s";
  $orders = array('id', 'createdBy', 'begin', 'end', 'hours', 'status', 'reviewedBy');
  foreach($orders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->lieu->{$order});
  }
  ?>
</div>

<?php include "../../common/view/m.footer.html.php";?>
