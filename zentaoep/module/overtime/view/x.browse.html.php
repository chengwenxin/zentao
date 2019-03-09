<?php
/**
 * The browse view file of overtime module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     overtime
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php js::set('confirmReview', $lang->overtime->confirmReview)?>
<?php $batchReview = $type == 'browseReview' && commonModel::hasPriv('overtime', 'batchReview');?>
<div class='panel xuanxuan-card'>
<?php $batchReview = false;?>
  <?php if($batchReview):?>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
  <form id='ajaxForm' method='post' action='<?php echo inlink('batchReview', 'status=pass');?>'>
  <?php endif;?>
  <table class='table table-hover text-center table-fixed tablesorter' id='overtimeTable'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "&date={$date}&orderBy=%s";?>
        <?php if($batchReview):?>
        <th class='w-80px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->overtime->id);?></th>
        <?php endif;?>
        <th class='w-80px'><?php commonModel::printOrderLink('createdBy', $orderBy, $vars, $lang->overtime->createdBy);?></th>
        <th class='w-150px'><?php commonModel::printOrderLink('begin', $orderBy, $vars, $lang->overtime->begin);?></th>
        <th class='w-150px'><?php commonModel::printOrderLink('end', $orderBy, $vars, $lang->overtime->end);?></th>
        <th class='text-left'><?php echo $lang->overtime->desc;?></th>
      </tr>
    </thead>
    <?php foreach($overtimeList as $overtime):?>
    <?php $viewUrl = commonModel::hasPriv('oa.overtime', 'view') ? $this->createLink('overtime', 'view', "id=$overtime->id&type=$type") : '';?>
    <tr id='overtime<?php echo $overtime->id;?>' data-url='<?php echo $viewUrl;?>'>
      <?php if($batchReview):?>
      <td class='idTD'>
        <label class='checkbox-inline'><input type='checkbox' name='overtimeIDList[]' value='<?php echo $overtime->id;?>'/> <?php echo $overtime->id;?></label>
      </td>
      <?php endif;?>
      <td><?php echo zget($users, $overtime->createdBy);?></td>
      <td><?php echo formatTime($overtime->begin . ' ' . $overtime->start, DT_DATETIME2);?></td>
      <td><?php echo formatTime($overtime->end . ' ' . $overtime->finish, DT_DATETIME2);?></td>
      <td class='text-left' title='<?php echo $overtime->desc?>'><?php echo $overtime->desc;?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <?php if($overtimeList && $batchReview):?>
  <?php endif;?>
  <?php if(!$overtimeList):?>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.html.php';?>
