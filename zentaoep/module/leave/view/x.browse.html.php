<?php
/**
 * The browse view file of leave module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     leave
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php js::set('confirmReview', $lang->leave->confirmReview)?>
<?php $batchReview = $type == 'browseReview' && commonModel::hasPriv('leave', 'batchReview');?>
<div class='panel xuanxuan-card'>
<?php $batchReview = false;?>
  <?php if($batchReview):?>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
  <form id='ajaxForm' method='post' action='<?php echo inlink('batchReview', 'status=pass');?>'>
  <?php endif;?>
  <table class='table table-hover text-center table-fixed tablesorter' id='leaveTable'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "&date={$date}&orderBy=%s";?>
        <?php if($batchReview):?>
        <th class='w-50px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->leave->id);?></th>
        <?php endif;?>
        <th class='w-70px'><?php commonModel::printOrderLink('createdBy', $orderBy, $vars, $lang->leave->createdBy);?></th>
        <th class='w-120px'><?php commonModel::printOrderLink('begin', $orderBy, $vars, $lang->leave->start);?></th>
        <th class='w-120px'><?php commonModel::printOrderLink('end', $orderBy, $vars, $lang->leave->finish);?></th>
        <th class='text-left'><?php echo $lang->leave->desc;?></th>
      </tr>
    </thead>
    <?php foreach($leaveList as $leave):?>
    <?php $viewUrl = commonModel::hasPriv('oa.leave', 'view') ? $this->createLink('leave', 'view', "id={$leave->id}&type=$type") : '';?>
    <?php if($type == 'browseReview' && $leave->type == 'annual' && isset($leftAnnualDays[$leave->createdBy])):?>
    <tr id='leave<?php echo $leave->id;?>' data-url='<?php echo $viewUrl;?>' data-toggle='tooltip' data-placement='top' data-tip-class='tooltip-danger' title="<?php echo sprintf($lang->leave->annualTip, $leftAnnualDays[$leave->createdBy]);?>">
    <?php else:?>
    <tr id='leave<?php echo $leave->id;?>' data-url='<?php echo $viewUrl;?>'>
    <?php endif?>
      <?php if($batchReview):?>
      <td class='idTD'>
        <label class='checkbox-inline'><input type='checkbox' name='leaveIDList[]' value='<?php echo $leave->id;?>'/> <?php echo $leave->id;?></label>
      </td>
      <?php endif;?>
      <td><?php echo zget($users, $leave->createdBy);?></td>
      <td><?php echo formatTime($leave->begin . ' ' . $leave->start, DT_DATETIME2);?></td>
      <td><?php echo formatTime($leave->end . ' ' . $leave->finish, DT_DATETIME2);?></td>
      <td class='text-left' title='<?php echo $leave->desc;?>'><?php echo $leave->desc;?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <?php if($leaveList && $batchReview):?>
  <?php endif;?>
  <?php if(!$leaveList):?>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.html.php';?>
