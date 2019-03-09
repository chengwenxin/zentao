<?php
/**
 * The close mobile view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testtask
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <span class='title'><strong><?php echo $lang->testtask->close ?></strong> #<?php echo $testtask->id ?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('testtask', 'close', "id=$testtask->id")?>' id='closeForm' data-form-refresh='#page'>
  <div class='control'>
    <label for='comment'><?php echo $lang->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
  <div class="row">
    <div class="control">
      <label for='mailto'><?php echo $lang->testtask->mailto;?></label>
      <div class='select'><?php echo html::select('mailto[]', $users, str_replace(' ' , '', $testtask->mailto), "multiple");?></div>
    </div>
    <?php echo $this->fetch('my', 'buildContactLists');?>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function(){$('#closeForm').submit()});
})
</script>
