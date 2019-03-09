<?php
/**
 * The view file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/ext/view/calendar.html.php'?>
<?php include '../../view/featurebar.html.php';?>
<div id='mainContent'>
  <nav id='contentNav'>
    <ul class='nav nav-default'>
      <li id='allTodoTab'><?php echo html::a($this->createLink('user', 'todo', "account=$account&type=all"), $lang->todo->all)?></li>
      <li id='allEffortTab'><?php echo html::a($this->createLink('user', 'effort', "account=$account&type=all"), $lang->effort->all)?></li>
    </ul>
  </nav>
  <div class='calendar' id='calendar'>
    <header class="calender-header table-row">
      <div class="btn-toolbar col-4 table-col text-middle">
        <button type="button" class="btn btn-info btn-icon btn-mini btn-prev"><i class="icon-chevron-left"></i></button>
        <button type="button" class="btn btn-info btn-mini btn-today"><?php echo $lang->today;?></button>
        <button type="button" class="btn btn-info btn-icon btn-mini btn-next"><i class="icon-chevron-right"></i></button>
        <span class="calendar-caption"></span>
      </div>
      <div class="col-4 text-center table-col">
        <ul class="nav nav-primary">
          <li class="active"><?php echo html::a($this->createLink('user', 'todocalendar', "account=$account"), $lang->todo->common);?></li>
          <?php if(common::hasPriv('user', 'effortcalendar')):?>
          <li><?php echo html::a($this->createLink('user', 'effortcalendar', "account=$account"), $lang->effort->common);?></li>
          <?php elseif(common::hasPriv('user', 'effort')):?>
          <li><?php echo html::a($this->createLink('user', 'effort', "account=$account"), $lang->effort->common);?></li>
          <?php endif;?>
        </ul>
      </div>
      <div class="col-4 table-col"></div>
    </header>
  </div>
</div>
<script language='javascript'>
$(document).ready(function() {
    var tasks   = <?php echo $todos?>;

    $('#calendar').calendar(
    {
        hideEmptyWeekends: true,
        dragThenDrop:false,
        data:
        {
            calendars:
            {
                defaultCal: {color: '#fff'}
            },
            events: tasks 
        },
        eventCreator: function(event, $cell, calendar)
        {
            var pri = event.pri != '' ? '(' + event.pri + ')' : '';
            var $event = $('<div title="' + pri + event.title + '" data-id="' + (event.id || '') + '" class="event">' + (event.finish ? '<i class="icon todo-check icon-check-circle"></i>' : '<i class="icon  todo-check icon-check-circle-empty"></i>') + '<span class="title">' + pri + event.title + '</span>' + (event.allDay ? '' : '<span class="time">' + event.start.format('hh:mm') + '</span>') + '</div>');
            $event.toggleClass('has-time', !event.allDay)
                  .toggleClass('expired', !event.finish && !$cell.hasClass('future'));
            return $event;
        },
        clickEvent: function(event)
        {
            event = event.event;
            if(event.url)
            {
                var modalTrigger = new $.zui.ModalTrigger({width: '80%', url: event.url, type:'iframe'});
                modalTrigger.show();
            }
        }
    });
});
</script>
<?php include '../../../common/view/footer.html.php';?>
