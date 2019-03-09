<?php
/**
 * The edit mobile view file of lieu module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com> 
 * @package     lieu 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>

<div class='heading divider'>
  <div class='title'><i class='icon icon-plus'></i> <strong><?php echo $lang->lieu->edit;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove'></i></a></nav>
</div>

<form class='content box' id='editLieuForm' data-form-refresh='#page' method='post' action='<?php echo $this->createLink('lieu', 'edit', "lieuID={$lieu->id}");?>'>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='begin'><?php echo $lang->lieu->begin;?></label>
        <input type='date' class='input' id='begin' name='begin' value="<?php echo $lieu->begin;?>" placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='start'><?php echo $lang->lieu->start;?></label>
        <input type='time' class='input' id='start' name='start' value="<?php echo $lieu->start;?>" placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='end'><?php echo $lang->lieu->end;?></label>
        <input type='date' class='input' id='end' name='end' value="<?php echo $lieu->end;?>" placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='finish'><?php echo $lang->lieu->finish;?></label>
        <input type='time' class='input' id='finish' value="<?php echo $lieu->finish;?>" name='finish' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='overtime[]'><?php echo $lang->lieu->overtime;?></label>
    <div class='select'>
      <?php echo html::select('overtime[]', $overtimes, $lieu->overtime, 'multiple');?> 
    </div>
  </div>
  <div class='control'>
    <label for='trip[]'><?php echo $lang->lieu->trip;?></label>
    <div class='select'>
      <?php echo html::select('trip[]', $trips, $lieu->trip, 'multiple');?> 
    </div>
  </div>
  <div class='control'>
    <label for='hours'><?php echo $lang->lieu->hours;?></label>
    <?php echo html::input('hours', $lieu->hours, "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->lieu->desc;?></label>
    <?php echo html::textarea('desc', $lieu->desc, "rows='3' class='textarea'");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#editLieuForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#editLieuForm').modalForm().listenScroll({container: 'parent'});
    
    $('#begin, #start, #end, #finish').on('change', function()
    {
        var begin  = $('#begin').val();
        var end    = $('#end').val();
        var start  = $('#start').val();
        var finish = $('#finish').val();
        if(!begin || !end || !start || !finish) return false;

        begin = begin.replace(/-/g, '/');
        end   = end.replace(/-/g, '/');

        var hours = 0;
        var beginTime    = Date.parse(new Date(begin + ' ' + start));
        var endTime      = Date.parse(new Date(end + ' ' + finish));
        var workingHours = <?php echo $config->attend->workingHours;?>;
        if(beginTime > endTime) return false;

        if(begin == end)
        {
            hours = Math.round((endTime - beginTime)/(3600*1000)*100)/100;
            if(hours > workingHours) hours = parseFloat(workingHours);
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
            if(beginTime < signOutTime) hoursStart = Math.round((signOutTime - beginTime)/(3600*1000)*100)/100;
            if(hoursStart > workingHours) hoursStart = parseFloat(workingHours);
            if(endTime > signInTime) hoursEnd = Math.round((endTime - signInTime)/(3600*1000)*100)/100;
            if(hoursEnd > workingHours) hoursEnd = parseFloat(workingHours);
            var days = Math.floor((Date.parse(new Date(end)) - Date.parse(new Date(begin)))/(24*3600*1000));
            if(days > 1) hoursContent = (days - 1) * workingHours;

            hours = hoursStart + hoursEnd + hoursContent;
        }
        $('#hours').val(hours);
    });
});
</script>
