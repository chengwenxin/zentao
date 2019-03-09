<?php
/**
 * The calendar block view file of block module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<style>
.nomargin {margin: 0;}
.header {height: 10%;}
.AM {height: 39%;}
.PM {height: 39%;}
.col-p8 {width: 8%;}
.col-p137 {width: 13.7%;}
.col-p145 {width: 14.5%;}
.col-p158 {width: 15.8%;}
.status {height: 13%;}
.calendar {width: 100%; height: 100%; text-align: center;}
.calendar th {text-align: center; color: gray;}
.AM td, .PM td {vertical-align: top;}
.calendar tr+tr {border-top: 1px solid rgb(221, 221, 221);}
.calendar th+th, .calendar td+td, .calendar th+td {border-left: 1px solid rgb(221, 221, 221);}
.calendar th, .calendar td{padding:0px;}
.calendar .today {background: #f0f0f0;}
.event {color: rgb(255, 255, 255); width: 100%; height: 18px; overflow: hidden; margin: 1px 0;}
.event:hover {cursor: pointer;}
.event.done {background-color: rgb(56, 176, 63);}
.event.wait {background-color: rgb(50, 128, 252);}

.calendar .text-muted {position: relative; float: right; padding: 3px; color: #CCC;}
</style>
<?php extract($data);?>
<?php $dateList = range(strtotime($startDate), strtotime($endDate), 86400);?>
<table class='calendar'>
  <tr class='header'>
    <th class='w-p5'></th>
    <?php 
        $sunTodo = '';
        $satTodo = '';
        foreach($dateList as $d)
        {
            if(date('w', $d) == 0) $sunTodo = isset($todos[date('Y-m-d', $d)]) ? $todos[date('Y-m-d', $d)] : '';
            if(date('w', $d) == 6) $satTodo = isset($todos[date('Y-m-d', $d)]) ? $todos[date('Y-m-d', $d)] : '';
        }
    ?>
    <?php foreach($dateList as $d):?>
    <?php 
        $dStr  = date('Y-m-d', $d);
        $week  = date('w', $d);
        if(empty($sunTodo) && empty($satTodo))
        {
            $width = ($week == 0 || $week == 6) ? 'col-p8' : 'col-p158';
        }
        elseif(!empty($sunTodo) && !empty($satTodo))
        {
            $width = 'col-p137';
        }
        elseif(!empty($sunTodo))
        {
            $width = $week == 6 ? 'col-p8' : 'col-p145';
        }
        else
        {
            $width = $week == 0 ? 'col-p8' : 'col-p145';
        }
        $class = $dStr == $date ? 'today' : '';
    ?>
    <th class='<?php echo $width . ' ' . $class?>' data-date='<?php echo $dStr?>'><?php echo zget($this->lang->datepicker->abbrDayNames, date('w', $d))?></th>
    <?php endforeach;?>
  </tr>
  <tr class='AM'>
    <th><?php echo $lang->todo->AM?></th>
    <?php foreach($dateList as $d):?>
    <?php $dStr = date('Y-m-d', $d);?>
    <?php $class = $dStr == $date ? 'today' : '';?>
      <td class='day <?php echo $class?>' data-date='<?php echo $dStr?>'>
        <?php if(!isset($todos[$dStr]['AM'])) continue;?>
        <?php foreach($todos[$dStr]['AM'] as $todo):?>
        <div class='event <?php echo $todo->status?>' data-id="<?php echo $todo->id?>" title='<?php echo $todo->begin . ' ' . $todo->name?>'>
          <?php echo $todo->name;?>
        </div>
        <?php endforeach;?>
      </td>
    <?php endforeach;?>
  </tr>
  <tr class='PM'>
    <th><?php echo $lang->todo->PM?></th>
    <?php foreach($dateList as $d):?>
    <?php $dStr = date('Y-m-d', $d);?>
    <?php $class = $dStr == $date ? 'today' : '';?>
      <td class='day <?php echo $class?>' data-date='<?php echo $dStr?>'>
        <?php if(!isset($todos[$dStr]['PM'])) continue;?>
        <?php foreach($todos[$dStr]['PM'] as $todo):?>
        <div class='event <?php echo $todo->status?>' data-id="<?php echo $todo->id?>" title='<?php echo $todo->begin . ' ' . $todo->name?>'>
          <?php echo $todo->name;?>
        </div>
        <?php endforeach;?>
      </td>
    <?php endforeach;?>
  </tr>
</table>
<script>
$(document).ready(function()
{
    date = new Date();
    d    = date.getDate();
    m    = date.getMonth();
    y    = date.getFullYear();

    var calendar = $('table.calendar');
    /* view todo. */
    calendar.find('.event').click(function()
    {
        var todourl = createLink('todo', 'view', "id=" + $(this).data('id'), '', true);
        $.modalTrigger({width: '85%', url: todourl});
        return false;
    });
    /* Add + */
    calendar.find('.day').each(function()
    {
        var date = new Date($(this).data('date'));
        var year   = date.getFullYear();
        var month  = date.getMonth();
        var day    = date.getDate();
        if(year > y || (year == y && month > m) || (year == y && month == m && day >= d))
        {
            if($(this).find('.icon-plus').length == 0)
            {
                $(this).prepend("<span class='text-muted icon-plus'></span><div class='clearfix'></div>");
            }
        }
    });
    /* batch create todo. */
    calendar.find('.day').click(function()
    {
        var date = new Date($(this).data('date'));
        var year   = date.getFullYear();
        var month  = date.getMonth();
        var day    = date.getDate();
        if(year > y || (year == y && month > m) || (year == y && month == m && day >= d))
        {
            month = month + 1;
            if(day <= 9) day = '0' + day;
            if(month <= 9) month = '0' + month;
            var todourl = createLink('todo', 'batchCreate', "date=" + year + '' + month + '' + day, '', true);
            $.modalTrigger({width: '85%', url: todourl});
        }
        return false;
    });
});
</script>
