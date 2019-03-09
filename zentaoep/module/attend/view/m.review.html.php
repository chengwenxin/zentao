<?php
/**
 * The review mobile view file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
 * @package     attend
 * @version     $Id
 * @link        http://www.ranzhi.org
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>

<div class='heading divider'>
  <div class='title'><i class='icon icon-plue'></i> <strong><?php echo $lang->attend->review;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove'></i></a></nav>
</div>

<form class='content box' id='reviewAttendForm' data-form-refresh='#page' method='post' action='<?php echo $this->createLink('attend', 'review', "attendID=$attendID&status=reject");?>'>
  <div class='control'>
    <label for='comment'><?php echo $lang->attend->rejectReason;?></label>
    <?php echo html::textarea('comment', '', "class='textarea' rows='5' placeholder='{$lang->required}'");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#reviewAttendForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#reviewAttendForm').modalForm().listenScroll({container: 'parent'});
})
</script>
    
