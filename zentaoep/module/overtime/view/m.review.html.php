<?php
/**
 * The review mobile view file of overtime module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     overtime 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>

<div class='heading divider'>
  <div class='title'><i class='icon icon-plue'></i> <strong><?php echo $lang->overtime->review;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove'></i></a></nav>
</div>

<form class='content box' id='reviewOvertimeForm' data-form-refresh='#page' method='post' action='<?php echo $this->createLink('overtime', 'review', "overtimeID=$id&status=reject");?>'>
  <div class='control'>
    <label for='comment'><?php echo $lang->overtime->rejectReason;?></label>
    <?php echo html::textarea('comment', '', "class='textarea' rows='5'");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#reviewOvertimeForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#reviewOvertimeForm').modalForm().listenScroll({container: 'parent'});
})
</script>
    
