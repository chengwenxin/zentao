<?php
/**
 * The edit mobile view file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     attend 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>

<?php if(!helper::isAjaxRequest()):?>
<?php include "../../common/view/m.header.html.php";?>
<?php endif;?>

<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->attend->edit;?></strong></div>
  <?php if(helper::isAjaxRequest()):?>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
  <?php endif;?>
</div>

<form class='content box' id='editAttendForm' data-refresh-form='#page' method='post' action='<?php echo $this->createLink('attend', 'edit', "date=$date");?>'>
  <div class='list'>
    <?php $class = $attend->reviewStatus ? 'status-' . $attend->reviewStatus : 'info';?>
    <div class='item <?php echo $class;?>'>
      <div class='title'><i class='icon icon-calendar-empty'></i> <?php echo $attend->dayName;?></div>
      <span class='label pull-right <?php echo $class;?>-pale'><?php echo zget($lang->attend->reviewStatusList, $attend->reviewStatus);?></span>
    </div>
  </div>
  <?php if(strpos(',late,both,absent', $attend->status) !== false):?>
  <div class='control'>
    <label for='manualIn'><?php echo $lang->attend->manualIn;?></label>
    <?php echo html::input('manualIn', empty($attend->manualIn) ? $this->config->attend->signInLimit : $attend->manualIn, "class='input'");?>
  </div>
  <?php endif;?>
  <?php if(strpos(',early,both,absent', $attend->status) !== false):?>
  <div class='control'>
    <label for='manualOut'><?php echo $lang->attend->manualOut;?></label>
    <?php echo html::input('manualOut', empty($attend->manualOut) ? $this->config->attend->signOutLimit : $attend->manualOut, "class='input'");?>
  </div>
  <?php endif;?>
  <div class='control'>
    <label for='desc'><?php echo $lang->attend->desc;?></label>
    <?php echo html::textarea('desc', '', "class='textarea' rows='3'");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' class='btn primary' data-submit='#editAttendForm'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#editAttendForm').modalForm({onResult: true}).listenScroll({container:'parent'});
})
</script>

<?php if(!helper::isAjaxRequest()):?>
<?php include "../../common/view/m.footer.html.php";?>
<?php endif;?>
