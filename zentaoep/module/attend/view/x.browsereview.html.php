<?php
/**
 * The browse review view file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     attend
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php js::set('confirmReview', $lang->attend->confirmReview);?>
<div class='panel xuanxuan-card'>
  <table class='table table-hover table-striped table-sorter table-data table-fixed text-center'>
    <thead>
      <tr class='text-center'>
        <th class='w-100px'><?php echo $lang->attend->account;?></th>
        <th class='w-100px'><?php echo $lang->attend->date;?></th>
        <th class='w-80px'><?php echo $lang->attend->manualIn;?></th>
        <th class='text-left'><?php echo $lang->attend->desc;?></th>
        <th class='w-100px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <?php foreach($attends as $attend):?>
    <?php if(!isset($users[$attend->account])) continue;?>
    <?php $user = $users[$attend->account];?>
    <tr>
      <td><?php echo $user->realname;?></td>
      <td><?php echo $attend->date?></td>
      <td><?php echo substr($attend->manualIn, 0, 5)?></td>
      <td class='text-left' title='<?php echo $attend->desc;?>'><?php echo $attend->desc?></td>
      <td>
        <?php extCommonModel::printLink('oa.attend', 'review', "attendID={$attend->id}&status=pass",   $lang->attend->reviewStatusList['pass'],   "class='pass'")?>
        <?php extCommonModel::printLink('oa.attend', 'review', "attendID={$attend->id}&status=reject", $lang->attend->reviewStatusList['reject'], "data-toggle='modal'")?>
      </td>
    </tr>
    <?php endforeach;?>
  </table>
  <?php if(!$attends):?>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.html.php';?>
