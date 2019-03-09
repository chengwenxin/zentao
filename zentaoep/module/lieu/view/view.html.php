<?php
/**
 * The detail view file of lieu module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     lieu
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<table class='table table-bordered'>
  <tr>
    <th><?php echo $lang->lieu->status;?></th>
    <td class='lieu-<?php echo $lieu->status;?>'><?php echo zget($lang->lieu->statusList, $lieu->status);?></td>
    <th><?php echo $lang->lieu->hours;?></th>
    <td><?php echo $lieu->hours . $lang->lieu->hoursTip;?></td>
  </tr>
  <tr>
    <th><?php echo $lang->lieu->begin;?></th>
    <td><?php echo formatTime($lieu->begin . ' ' . $lieu->start, DT_DATETIME2);?></td>
    <th><?php echo $lang->lieu->end;?></th>
    <td><?php echo formatTime($lieu->end . ' ' . $lieu->finish, DT_DATETIME2);?></td>
  </tr>
  <?php if($lieu->overtime):?>
  <tr>
    <th class='text-middle'><?php echo $lang->lieu->overtime;?></th>
    <td colspan='3'>
      <?php foreach(explode(',', trim($lieu->overtime, ',')) as $overtime):?>
      <?php if($overtime) echo zget($overtimes, $overtime) . '</br>';?>
      <?php endforeach;?>
    </td>
  </tr>
  <?php endif;?>
  <?php if($lieu->trip):?>
  <tr>
    <th class='text-middle'><?php echo $lang->lieu->trip;?></th>
    <td colspan='3'>
      <?php foreach(explode(',', trim($lieu->trip, ',')) as $trip):?>
      <?php if($trip) echo zget($trips, $trip) . '</br>';?>
      <?php endforeach;?>
    </td>
  </tr>
  <?php endif;?>
  <tr>
    <th><?php echo $lang->lieu->desc;?></th>
    <td colspan='3'><?php echo $lieu->desc;?></td>
  </tr>
  <tr>
    <th><?php echo $lang->lieu->createdBy;?></th>
    <td><?php echo zget($users, $lieu->createdBy);?></td>
    <th><?php echo $lang->lieu->reviewedBy;?></th>
    <td id='reviewedBy'><?php echo zget($users, $lieu->reviewedBy);?></td>
  </tr>
  <tr>
    <th><?php echo $lang->lieu->createdDate;?></th>
    <td><?php echo formatTime($lieu->createdDate);?></td>
    <th><?php echo $lang->lieu->reviewedDate;?></th>
    <td><?php echo formatTime($lieu->reviewedDate);?></td>
  </tr>
</table>
<div class='page-actions'>
  <?php 
  if($type == 'personal')
  {
      $switchLabel = $lieu->status == 'wait' ? $lang->lieu->cancel : $lang->lieu->commit;
      if(strpos(',wait,draft,', ",$lieu->status,") !== false)
      {
          extCommonModel::printLink('oa.lieu', 'switchstatus', "id={$lieu->id}", $switchLabel, "class='btn'");
      }
      if(strpos(',wait,draft,reject,', ",$lieu->status,") !== false)
      {
          echo "<div class='btn-group'>";
          extCommonModel::printLink('oa.lieu', 'edit',   "id={$lieu->id}", $lang->edit,   "class='btn loadInModal'");
          extCommonModel::printLink('oa.lieu', 'delete', "id={$lieu->id}", $lang->delete, "class='btn deleteLieu'");
          echo '</div>';
      }
  }
  elseif(strpos(',wait,doing,', ",$lieu->status,") !== false)
  {
      extCommonModel::printLink('oa.lieu', 'review', "id={$lieu->id}&status=pass",   $lang->lieu->statusList['pass'],   "class='btn reviewPass'");
      extCommonModel::printLink('oa.lieu', 'review', "id={$lieu->id}&status=reject", $lang->lieu->statusList['reject'], "class='btn loadInModal'");
  }
  echo baseHTML::a('javascript:;', $lang->goback, "class='btn' data-dismiss='modal'");
  ?>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
