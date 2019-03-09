<?php
/**
 * The edit mobile view file of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     effort
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <span class='title'><i class='icon-pencil'></i> <strong><?php echo $lang->effort->edit ?></strong> #<?php echo $effort->id ?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>

<form class='has-padding content' method='post' action='<?php echo $this->createLink('effort', 'edit', "id=$effort->id")?>' id='editForm' data-form-refresh='#page'>
  <div class="control">
    <label for='date'><?php echo $lang->effort->date;?></label>
    <input type='date' name='date' value='<?php echo $effort->date?>' class='input' />
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class="control">
        <label for='consumed'><?php echo $lang->effort->consumed;?></label>
        <?php echo html::input('consumed', $effort->consumed, "class='input'")?>
      </div>
    </div>
    <div class='cell-6'>
      <div class="control">
        <label for='left'><?php echo $lang->effort->left;?></label>
        <?php echo html::input('left', $effort->left, "class='input'")?>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell'>
      <div class="control">
        <label for='objectType'><?php echo $lang->effort->objectType;?></label>
        <div class='select'><?php echo html::select('objectType', $lang->effort->objectTypeList, $effort->objectType)?></div>
      </div>
    </div>
    <div class='cell'>
      <div class="control">
        <label for='objectID'><?php echo $lang->effort->objectID;?></label>
        <?php echo html::input('objectID', $effort->objectID, "class='input'")?>
      </div>
    </div>
  </div>
  <div class="control">
    <label for='work'><?php echo $lang->effort->work;?></label>
    <?php echo html::input('work', $effort->work, "class='input'")?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function()
    {
        if(checkTaskLeft("<?php echo $lang->effort->noticeFinish;?>"))
        {
            $('#editForm').submit()
        }
    });
});
</script>
