<?php
/**
 * The browse view file of lieu module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     lieu
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php js::set('confirmReview', $lang->lieu->confirmReview)?>
<?php $batchReview = $type == 'browseReview' && commonModel::hasPriv('lieu', 'batchReview');?>
<div class='panel xuanxuan-card'>
<?php $batchReview = false;?>
  <?php if($batchReview):?>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
  <form id='ajaxForm' method='post' action='<?php echo inlink('batchReview', 'status=pass');?>'>
  <?php endif;?>
  <table class='table table-hover text-center table-fixed tablesorter' id='lieuTable'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "&date={$date}&orderBy=%s";?>
        <?php if($batchReview):?>
        <th class='w-50px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->lieu->id);?></th>
        <?php endif;?>
        <th class='w-70px'><?php commonModel::printOrderLink('createdBy', $orderBy, $vars, $lang->lieu->createdBy);?></th>
        <th class='w-120px'><?php commonModel::printOrderLink('begin', $orderBy, $vars, $lang->lieu->begin);?></th>
        <th class='w-120px'><?php commonModel::printOrderLink('end', $orderBy, $vars, $lang->lieu->end);?></th>
        <th class='text-left'><?php echo $lang->lieu->desc;?></th>
      </tr>
    </thead>
    <?php foreach($lieuList as $lieu):?>
    <?php $viewUrl = commonModel::hasPriv('oa.lieu', 'view') ? $this->createLink('lieu', 'view', "id={$lieu->id}&type=$type") : '';?>
    <tr id='lieu<?php echo $lieu->id;?>' data-url='<?php echo $viewUrl;?>'>
      <?php if($batchReview):?>
      <td class='idTD'>
        <label class='checkbox-inline'><input type='checkbox' name='lieuIDList[]' value='<?php echo $lieu->id;?>'/> <?php echo $lieu->id;?></label>
      </td>
      <?php endif;?>
      <td><?php echo zget($users, $lieu->createdBy);?></td>
      <td><?php echo formatTime($lieu->begin . ' ' . $lieu->start, DT_DATETIME2);?></td>
      <td><?php echo formatTime($lieu->end . ' ' . $lieu->finish, DT_DATETIME2);?></td>
      <td class='text-left' title='<?php echo $lieu->desc;?>'><?php echo $lieu->desc;?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <?php if($lieuList && $batchReview):?>
  <?php endif;?>
  <?php if(!$lieuList):?>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.html.php';?>
