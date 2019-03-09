<?php
/**
 * The assignTo mobile view file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php if(!empty($task->team) && $task->assignedTo != $this->app->user->account):?>
<div class='heading'>
  <div class='title'><strong><?php echo $lang->task->tips;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>
<div class='content article box'>
  <p><?php echo sprintf($lang->task->deniedNotice, '<strong>' . $task->assignedToRealName . '</strong>', $lang->task->transfer);?></p>
</div>
<?php else:?>
<div class='heading divider'>
  <span class='title'><strong><?php echo $lang->task->assign;?></strong> #<?php echo $task->id . ' ' . $task->name;?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('task', 'assignTo', "projectID={$task->project}&taskID={$task->id}")?>' id='assignToForm' data-form-refresh='#page'>
  <div class='control'>
    <label for='assignedTo'><?php echo $lang->task->assignedTo;?></label>
    <div class='select'><?php echo html::select('assignedTo', $users, '');?></div>
  </div>
  <div class='control'>
    <label for='left'><?php echo $lang->task->left;?></label>
    <?php echo html::input('left', $task->left, "class='input'");?></div>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function(){$('#assignToForm').submit()});
})
</script>
<?php endif;?>
