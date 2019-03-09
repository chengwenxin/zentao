<?php
/**
 * The create mobile view file of todo module of ZenTaoPMS.
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
  <span class='title'><i class='icon-plus'></i> <strong><?php echo $lang->todo->create ?></strong></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>

<form class='has-padding content' method='post' action='<?php echo $this->createLink('todo', 'create', "date=$date")?>' id='createForm' data-form-refresh='#page' target='hiddenwin'>
  <div class='row'>
    <div class='cell'>
      <div class="control">
        <label for='pri'><?php echo $lang->todo->pri;?></label>
        <div class='select'>
          <?php echo html::select('pri', $lang->todo->priList, '3');?>
        </div>
      </div>
    </div>
    <div class='cell'>
      <div class="control">
        <label for='type'><?php echo $lang->todo->type;?></label>
        <div class='select'>
          <input type='text' class='input' disabled value='<?php echo $lang->todo->typeList['custom'] ?>'>
          <?php echo html::hidden('type', 'custom') ?>
        </div>
      </div>
    </div>
  </div>
  <div class="control">
    <label for='name'><?php echo $lang->todo->name;?></label>
    <?php echo html::input('name', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class="control">
    <label for='desc'><?php echo $lang->todo->desc;?></label>
    <?php echo html::textarea('desc', '', "rows=4 class='textarea'");?>
  </div>
  <div class="control">
    <label for='status'><?php echo $lang->todo->status;?></label>
    <div class='select'>
      <?php echo html::select('status', $lang->todo->statusList, 'wait');?>
    </div>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='switchDate' checked>
      <label for='switchDate' class='strong'> <?php echo $lang->todo->date;?></label>
    </div>
    <input type="date" value='<?php echo $date ?>' name='date' id='date' class='input'>
  </div>
  <div class='row' id='beginAndEnd'>
    <div class='cell'>
      <div class='control'>
        <label for='begin'><?php echo $lang->todo->begin;?></label>
        <div class='select'>
          <?php echo html::select('begin', $times, date('Y-m-d') != $date ? key($times) : $time);?>
        </div>
      </div>
    </div>
    <div class='cell'>
      <div class='control'>
        <label for='end'><?php echo $lang->todo->end;?></label>
        <div class='select'>
          <?php echo html::select('end', $times, '');?>
        </div>
      </div>
    </div>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='switchTime'>
      <label for='switchTime'> <?php echo $lang->todo->lblDisableDate;?></label>
    </div>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='private' name='private' value='1'>
      <label for='private'> <?php echo $lang->todo->private;?></label>
    </div>
  </div>
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

    $('#submitButton').click(function(){$('#createForm').submit()});

    $('#begin').on('change', function()
    {
        $('#end')[0].selectedIndex = $(this)[0].selectedIndex + 3;
    }).change();
});
</script>
