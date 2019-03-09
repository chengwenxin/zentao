<?php
/**
 * The edit mobile view file of overtime module of RanZhi.
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
  <div class='title'><i class='icon icon-plus'></i> <strong><?php echo $lang->overtime->edit;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove'></i></a></nav>
</div>

<form class='content box' id='editOvertimeForm' data-form-refresh='#page' method='post' action='<?php echo $this->createLink('overtime', 'edit', "id=$overtime->id");?>'>
  <div class='control'>
    <label><?php echo $lang->overtime->type;?></label>
    <?php foreach($lang->overtime->typeList as $key => $type):?>
    <?php $checked = $overtime->type == $key ? "checked='checked'" : '';?>
    <div class='radio inline-block'>
      <input type='radio' name='type' value="<?php echo $key;?>" <?php echo $checked;?>>
      <label for="type"><?php echo $type;?></label>
    </div>
    <?php endforeach;?>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='begin'><?php echo $lang->overtime->begin;?></label>
        <input type='date' class='input' id='begin' name='begin' value="<?php echo $overtime->begin;?>" placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='start'><?php echo $lang->overtime->start;?></label>
        <input type='time' class='input' id='start' value='<?php echo $overtime->start;?>' name='start' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='end'><?php echo $lang->overtime->end;?></label>
        <input type='date' class='input' id='end' name='end' value="<?php echo $overtime->end;?>" placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='finish'><?php echo $lang->overtime->finish;?></label>
        <input type='time' class='input' id='finish' value='<?php echo $overtime->finish;?>' name='finish' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='hours'><?php echo $lang->overtime->hours;?></label>
    <?php echo html::input('hours', $overtime->hours, "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->overtime->desc;?></label>
    <?php echo html::textarea('desc', $overtime->desc, "rows='5' class='textarea'");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#editOvertimeForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#editOvertimeForm').modalForm().listenScroll({container: 'parent'});

    $('[name=type], #begin, #start, #end, #finish').on('change', function()
    {
        var type   = $('input[name=type]:checked').val();
        var begin  = $('#begin').val();
        var end    = $('#end').val();
        var start  = $('#start').val();
        var finish = $('#finish').val();
        if(!begin || !end || !start || !finish) return false;

        begin = begin.replace(/-/g, '/');
        end   = end.replace(/-/g, '/');

        var hours = 0;
        var workingHours = <?php echo $config->attend->workingHours;?>;
        var beginTime = Date.parse(new Date(begin + ' ' + start));
        var endTime   = Date.parse(new Date(end + ' ' + finish));
        if(beginTime > endTime) return false;

        if(begin == end)
        {
            hours = Math.round((endTime - beginTime)/(3600*1000)*100)/100;
            if(type == 'compensate' && hours > workingHours) hours = parseFloat(workingHours);
        }
        else
        {
            var signOut      = <?php echo json_encode($config->attend->signOutLimit);?>;
            var signIn       = <?php echo json_encode($config->attend->signInLimit);?>;
            var signOutTime  = Date.parse(new Date(begin + ' ' + signOut));
            var signInTime   = Date.parse(new Date(end + ' ' + signIn));
            var hoursStart   = 0;
            var hoursEnd     = 0;
            var hoursContent = 0;
            
            if(beginTime < signOutTime)  
            {
                hoursStart = Math.round((signOutTime - beginTime)/(3600*1000)*100)/100;
            }
            else
            {
                hoursStart = Math.round((Date.parse(new Date(begin + ' 23:59:60')) - beginTime)/(3600*1000)*100)/100;
            }
            if(type == 'compensate' && hoursStart > workingHours) hoursStart = parseFloat(workingHours);
            
            if(endTime > signInTime)  
            {
                hoursEnd = Math.round((endTime - signInTime)/(3600*1000)*100)/100;
            }
            else
            {
                hoursEnd = Math.round((endTime - Date.parse(new Date(end)))/(3600*1000)*100)/100;
            }
            if(type == 'compensate' && hoursEnd > workingHours) hoursEnd = parseFloat(workingHours);
            
            var dayHours = Math.round((Date.parse(new Date(begin + ' ' + signOut)) - Date.parse(new Date(begin + ' ' + signIn)))/(3600*1000)*100)/100;
            if(type == 'compensate' && dayHours > workingHours) dayHours = workingHours;
            
            var days = Math.floor((Date.parse(new Date(end)) - Date.parse(new Date(begin)))/(24*3600*1000));
            if(days > 1) hoursContent = (days - 1) * dayHours;

            hours = hoursStart + hoursEnd + hoursContent;
        }
        $('#hours').val(hours);
    });
})
</script>
