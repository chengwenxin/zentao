<?php
/**
 * The create mobile view file of lieu module of RanZhi.
 *
 * @copyright   Copyright 2009-2017 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com> 
 * @package     lieu 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>

<?php if(!helper::isAjaxRequest()):?>
<?php include "../../common/view/m.header.html.php";?>
<?php endif;?>

<div class='heading divider'>
  <div class='title'><i class='icon icon-plus'></i> <strong><?php echo $lang->makeup->create;?></strong></div>
  <?php if(helper::isAjaxRequest()):?>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
  <?php endif;?>
</div>

<form class='content box' id='createMakeupForm' data-form-refresh='#page' method='post' action='<?php echo $this->createLink('makeup', 'create');?>'>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='begin'><?php echo $lang->makeup->begin;?></label>
        <input type='date' class='input' id='begin' name='begin' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='start'><?php echo $lang->makeup->start;?></label>
        <input type='time' class='input' id='start' value='<?php echo $config->attend->signInLimit;?>' name='start' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='end'><?php echo $lang->makeup->end;?></label>
        <input type='date' class='input' id='end' name='end' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='finish'><?php echo $lang->makeup->finish;?></label>
        <input type='time' class='input' id='finish' value='<?php echo $config->attend->signOutLimit;?>' name='finish' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='hours'><?php echo $lang->makeup->hours;?></label>
    <?php echo html::input('hours', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <label for='leave[]'><?php echo $lang->makeup->leave;?></label>
    <div class='select'>
    <?php echo html::select('leave[]', $leaves, '', 'multiple');?>
    </div>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->makeup->desc;?></label>
    <?php echo html::textarea('desc', '', "rows='3' class='textarea'");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#createMakeupForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#createMakeupForm').modalForm({onResult: true}).listenScroll({container: 'parent'});
    
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
        var workingHours = <?php echo $config->attend->workingHours;?>;
        var beginTime    = Date.parse(new Date(begin + ' ' + start));
        var endTime      = Date.parse(new Date(end + ' ' + finish));
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

<?php if(!helper::isAjaxRequest()):?>
<?php include "../../common/view/m.footer.html.php";?>
<?php endif;?>
