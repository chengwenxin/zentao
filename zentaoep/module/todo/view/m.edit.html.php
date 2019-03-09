<?php
/**
 * The edit mobile view file of todo module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     todo 
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<div class='heading divider'>
  <span class='title'><i class='icon-pencil'></i> <strong><?php echo $lang->todo->edit ?></strong> #<?php echo $todo->id ?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>

<form class='has-padding content' method='post' action='<?php echo $this->createLink('todo', 'edit', "id=$todo->id")?>' id='editForm' data-form-refresh='#page'>
  <div class="control">
    <label for='name'><?php echo $lang->todo->name;?></label>
    <?php
      $readType = $todo->type != 'custom' ? 'readonly' : '';
      echo html::input('name', $todo->name, "$readType class='input'");
      ?>
  </div>
  <div class="control">
    <label for='desc'><?php echo $lang->todo->desc;?></label>
    <?php echo html::textarea('desc', htmlspecialchars($todo->desc), "rows=4 class='textarea'");?>
  </div>
  <div class='row'>
    <div class='cell'>
      <div class="control">
        <label for='pri'><?php echo $lang->todo->pri;?></label>
        <div class='select'>
          <?php echo html::select('pri', $lang->todo->priList, $todo->pri);?>
        </div>
      </div>
    </div>
    <div class='cell'>
      <div class="control">
        <label for='status'><?php echo $lang->todo->status;?></label>
        <div class='select'>
          <?php echo html::select('status', $lang->todo->statusList, $todo->status);?>
        </div>
      </div>
    </div>
  </div>
  <div class='control'>
    <?php $disabledDate = $todo->date === '00000000';?>
    <div class='checkbox'>
      <input type='checkbox' id='switchDate'<?php if(!$disabledDate) echo " checked" ?>>
      <label for='switchDate' class='strong'> <?php echo $lang->todo->date;?></label>
    </div>
    <input type="date" value='<?php echo $todo->date ?>' name='date' id='date' class='input'<?php if($disabledDate) echo " disabled" ?>>
  </div>
  <?php $disabledTime = $todo->begin == 2400;?>
  <div class='row<?php if($disabledTime) echo " disabled" ?>' id='beginAndEnd'>
    <div class='cell'>
      <div class='control'>
        <label for='begin'><?php echo $lang->todo->begin;?></label>
        <div class='select'>
          <?php echo html::select('begin', $times, $todo->begin);?>
        </div>
      </div>
    </div>
    <div class='cell'>
      <div class='control'>
        <label for='end'><?php echo $lang->todo->end;?></label>
        <div class='select'>
          <?php echo html::select('end', $times, $todo->end);?>
        </div>
      </div>
    </div>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='switchTime'<?php if($disabledTime) echo " checked" ?>>
      <label for='switchTime'> <?php echo $lang->todo->lblDisableDate;?></label>
    </div>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='private' value='1' name='private'<?php if($todo->private) echo " checked" ?>>
      <label for='private'> <?php echo $lang->todo->private;?></label>
    </div>
  </div>
  <input type='hidden' name='type' value='<?php echo $todo->type;?>' />
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    var switchDate = function(enable)
    {
        $('#switchDate').attr('checked', enable ? 'checked' : null);
        $('#date').attr('disabled', enable ? null : 'disabled');
        if(!enable) switchTime(false);
    };
    
    var switchTime = function(enable)
    {
        $('#switchTime').attr('checked', !enable ? 'checked' : null);
        $('#beginAndEnd').toggleClass('disabled', !enable);
        $('#begin, #end').attr('disabled', enable ? null : 'disabled');
        if(enable) switchDate(true);
    };

    $('#switchDate').on('change', function()
    {
        switchDate($(this).is(':checked'));
    });

    $('#switchTime').on('change', function()
    {
        switchTime(!$(this).is(':checked'));
    });

    $('#submitButton').click(function(){ $('#editForm').submit() });
});
</script>
