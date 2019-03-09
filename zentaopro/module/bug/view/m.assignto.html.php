<?php
/**
 * The assignTo mobile view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     bug
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <span class='title'><strong><?php echo $lang->bug->assignedTo ?></strong> #<?php echo $bug->id ?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('bug', 'assignTo', "id=$bug->id")?>' id='assignToForm' data-form-refresh='#page'>
  <div class='control'>
    <label for='assignedTo'><?php echo $lang->bug->assignedTo;?></label>
    <div class='select'><?php echo html::select('assignedTo', $users, $bug->assignedTo);?></div>
  </div>
  <div class="control">
    <label for='mailto'><?php echo $lang->bug->mailto;?></label>
    <div class='select'><?php echo html::select('mailto[]', $users, str_replace(' ' , '', $bug->mailto), "multiple");?></div>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->story->comment;?></label>
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
