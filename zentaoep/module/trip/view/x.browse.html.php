<?php
/**
 * The browse view file of trip module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     trip
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='panel xuanxuan-card'>
  <table class='table table-data table-hover text-center table-fixed tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "date=$date&orderBy=%s";?>
        <th class='w-80px'> <?php commonModel::printOrderLink('createdBy', $orderBy, $vars, $lang->$type->createdBy);?></th>
        <th class='w-120px'><?php commonModel::printOrderLink('begin', $orderBy, $vars, $lang->$type->begin);?></th>
        <th class='w-120px'><?php commonModel::printOrderLink('end', $orderBy, $vars, $lang->$type->end);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('to', $orderBy, $vars, $lang->$type->to);?></th>
        <th><?php echo $lang->$type->desc;?></th>
      </tr>
    </thead>
    <?php foreach($tripList as $trip):?>
    <tr>
      <td><?php echo zget($users, $trip->createdBy);?></td>
      <td><?php echo formatTime($trip->begin . ' ' . $trip->start, DT_DATETIME2);?></td>
      <td><?php echo formatTime($trip->end . ' ' . $trip->finish, DT_DATETIME2);?></td>
      <td title='<?php echo $trip->to?>'>  <?php echo $trip->to;?></td>
      <td title='<?php echo $trip->desc?>'><?php echo $trip->desc;?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <?php if(!$tripList):?>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.html.php';?>
