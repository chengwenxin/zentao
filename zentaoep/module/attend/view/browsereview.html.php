<?php
/**
 * The personal view file of attend module of Ranzhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     attend
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.html.php';?>
  <style>
  #menuActions{float:right !important; margin-top: -60px !important;}
  .input-group-required > .required::after, .required-wrapper.required::after {top:12px !important;}
  .modal-body .table {margin-bottom:0px !important;}
  </style>
  <div id='featurebar'>
    <ul class='nav'>
    <?php
    $methodName = strtolower($this->app->getMethodName());
    foreach($lang->attend->featurebar as $key => $menu)
    {
        if(is_string($menu)) $link = $menu;
        if(is_array($menu)) $link = $menu['link'];
        list($name, $currentModule, $currentMethod, $params) = explode('|', $link);
       $class = strtolower($key) == $methodName ? "class='active'" : '';
        if(isset($menu['alias'])) $class = strpos(strtolower($menu['alias']), strtolower($key)) !== false ? "class='active'" : $class;
        if(common::hasPriv($currentModule, $currentMethod)) echo "<li id='$key' $class>" . html::a($this->createLink($currentModule, $currentMethod, $params), $name) . '</li>';
    }
    ?>
    </ul>
  </div>

<?php js::set('confirmReview', $lang->attend->confirmReview);?>
<?php $batchReview = commonModel::hasPriv('attend', 'batchReview');?>
<div class='panel'>
  <?php if($batchReview):?>
  <form id='batchReviewForm' method='post' action='<?php echo inlink('batchReview', 'status=pass');?>'>
  <?php endif;?>
    <table class='table table-hover table-striped table-sorter table-data table-fixed text-center'>
      <thead>
        <tr class='text-center'>
          <th class='w-80px'><?php echo $lang->attend->id;?></th>
          <th class='w-100px'><?php echo $lang->user->dept;?></th>
          <th class='w-100px'><?php echo $lang->attend->account;?></th>
          <th class='w-100px'><?php echo $lang->attend->date;?></th>
          <th class='w-80px'><?php echo $lang->attend->manualIn;?></th>
          <th class='w-80px'><?php echo $lang->attend->manualOut;?></th>
          <th class='w-100px'><?php echo $lang->attend->reason;?></th>
          <th><?php echo $lang->attend->desc;?></th>
          <th class='w-100px'><?php echo $lang->attend->status;?></th>
          <th class='w-100px'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <?php foreach($attends as $attend):?>
      <?php if(!isset($users[$attend->account])) continue;?>
      <?php $user = $users[$attend->account];?>
      <tr>
        <td>
          <?php if($batchReview):?>
          <label class='checkbox-inline'><input type='checkbox' name='attendIDList[]' value='<?php echo $attend->id;?>'/> <?php echo $attend->id;?></label>
          <?php else:?>
          <?php echo $attend->id;?>
          <?php endif;?>
        </td>
        <td><?php echo zget($deptList, $user->dept, '');?></td>
        <td><?php echo $user->realname;?></td>
        <td><?php echo $attend->date?></td>
        <td><?php echo substr($attend->manualIn, 0, 5)?></td>
        <td><?php echo substr($attend->manualOut, 0, 5)?></td>
        <td><?php echo zget($lang->attend->reasonList, $attend->reason)?></td>
        <td><?php echo $attend->desc?></td>
        <td><?php echo zget($lang->attend->statusList, $attend->status)?></td>
        <td>
          <?php extCommonModel::printLink('oa.attend', 'review', "attendID={$attend->id}&status=pass",   $lang->attend->reviewStatusList['pass'],   "class='pass'")?>
          <?php extCommonModel::printLink('oa.attend', 'review', "attendID={$attend->id}&status=reject", $lang->attend->reviewStatusList['reject'], "data-toggle='modal'")?>
        </td>
      </tr>
      <?php endforeach;?>
    </table>
    <?php if($attends && $batchReview):?>
    <?php endif?>
    <?php if(!$attends):?>
    <?php endif;?>
  <?php if($batchReview):?>
  </form>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.html.php';?>
