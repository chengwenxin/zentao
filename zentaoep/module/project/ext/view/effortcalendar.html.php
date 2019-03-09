<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     project 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/ext/view/calendar.html.php'?>
<?php include '../../../common/view/datepicker.html.php';?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php 
    echo html::a(inlink('effortcalendar', "projectID=$projectID"),        "<span class='text'>{$lang->effort->common}</span>", '', "class='btn btn-link btn-active-text' id='calendarTab'");
    echo html::a(inlink('effort', "projectID=$projectID&date=all"),       "<span class='text'>{$lang->effort->allDaysEfforts}</span>",   '', "class='btn btn-link' id='all'");
    echo html::a(inlink('effort', "projectID=$projectID&date=today"),     "<span class='text'>{$lang->effort->todayEfforts}</span>",     '', "class='btn btn-link' id='today'");
    echo html::a(inlink('effort', "projectID=$projectID&date=yesterday"), "<span class='text'>{$lang->effort->yesterdayEfforts}</span>", '', "class='btn btn-link' id='yesterday'");
    echo html::a(inlink('effort', "projectID=$projectID&date=thisweek"),  "<span class='text'>{$lang->effort->thisWeekEfforts}</span>",  '', "class='btn btn-link' id='thisweek'");
    echo html::a(inlink('effort', "projectID=$projectID&date=lastweek"),  "<span class='text'>{$lang->effort->lastWeekEfforts}</span>",  '', "class='btn btn-link' id='lastweek'");
    echo html::a(inlink('effort', "projectID=$projectID&date=thismonth"), "<span class='text'>{$lang->effort->thisMonthEfforts}</span>", '', "class='btn btn-link' id='thismonth'");
    echo html::a(inlink('effort', "projectID=$projectID&date=lastmonth"), "<span class='text'>{$lang->effort->lastMonthEfforts}</span>", '', "class='btn btn-link' id='lastmonth'");
    ?>
    <div class='input-control space w-150px'>
      <?php echo html::select('account', $users, $account, "onchange='changeUser($projectID, this.value)' class='form-control chosen'");?>
    </div>
  </div>
  <div class='btn-toolbar pull-right'>
    <?php if(common::hasPriv('effort', 'export')) echo html::a('javascript:exportCalendar("' . helper::createLink('effort', 'export', "account=$account&orderBy=date_asc&date=_date_") . '")', "<i class='icon-export muted'></i> " . $lang->effort->export, '', "class='btn btn-link'") ?>
  </div>
</div>
<div class="main-row">
  <div class="main-col">
    <div class="cell">
      <div id="effortCalendar" class="calendar">
        <header class="calender-header table-row">
          <div class="btn-toolbar col-4 table-col text-middle">
            <button type="button" class="btn btn-info btn-icon btn-mini btn-prev"><i class="icon-chevron-left"></i></button>
            <button type="button" class="btn btn-info btn-mini btn-today"><?php echo $lang->today;?></button>
            <button type="button" class="btn btn-info btn-icon btn-mini btn-next"><i class="icon-chevron-right"></i></button>
            <span class="calendar-caption"></span>
          </div>
          <div class="col-4 text-center table-col"></div>
          <div class="col-4 table-col"></div>
        </header>
      </div>
    </div>
  </div>
</div>
<script>
config.ajaxGetEffortsUrl = '<?php echo $this->createLink('project', 'ajaxGetEfforts', "projectID=$projectID&account=$account&year={year}");?>';
config.effortViewUrl     = '<?php echo $this->createLink('effort', 'view', 'id={id}', '', true);?>';
config.textNetworkError  = '<?php echo $lang->textNetworkError;?>';
config.textHasMoreItems  = '<?php echo $lang->textHasMoreItems;?>';

var effortViewModalTrigger = new $.zui.ModalTrigger(
{
    width: '70%',
    type: 'iframe',
    rememberPos: 'effortViewModal',
    waittime: 5000
});

var displayDate = 0;
var calendar    = false;
$(function()
{

    var expandedDays = {};
    var minExpandCount = 6;
    var $calendar = $('#effortCalendar');
    var toggleLoading = function(loading)
    {
        $calendar.toggleClass('loading', !!loading);
    };
    calendar = $calendar.calendar(
    {
        dragThenDrop: false,
        hideEmptyWeekends: true,
        data:
        {
            events: [],
            calendars:
            {
                defaultCal: {color: '#fff'}
            }
        },
        beforeDisplay: function(display, doDisplay)
        {
            var date = display.date;
            var thisDisplayDate = date.getFullYear();
            if (displayDate === thisDisplayDate)
            {
                return doDisplay();
            }
            else
            {
                displayDate = thisDisplayDate;
            }
            var calendar = this;
            toggleLoading(true);
            $.ajax(
            {
                url: config.ajaxGetEffortsUrl.replace('{year}', date.getFullYear()),
                dataType: 'json',
                success: function(data)
                {
                    $.each(data, function(index, effort)
                    {
                        effort.allDay = !effort.end;
                    });
                    calendar.resetData({events: data});
                    doDisplay();
                },
                error: function()
                {
                    $.zui.messager.danger(config.textNetworkError);
                },
                complete: function() {toggleLoading(false);}
            });
            return false;
        },
        eventCreator: function(event, $cell, calendar)
        {
          var $event = $('<div title="' + event.divTitle + '" data-id="' + (event.id || '') + '" class="event has-time" title="' + (event.desc || '') + '"><span class="title">' + event.title + '</span><span class="time">' + event.consumed + 'h</span></div>');
          return $event;
        },
        dayFormater: function($cell, date, dayEvents, calendar)
        {
            if(dayEvents && dayEvents.maxPos >= minExpandCount)
            {
                var hideManyEvents = !expandedDays[date.toDateString()];
                $cell.toggleClass('hide-many-events', hideManyEvents);
                if(hideManyEvents)
                {
                    var $cellContent = $cell.find('.day > .content');
                    var $showMore = $cellContent.find('.show-more-events');
                    if(!$showMore.length)
                    {
                        $showMore = $('<div class="show-more-events" />').appendTo($cellContent);
                    }
                    else
                    {
                        $showMore.show();
                    }
                    $showMore.text(config.textHasMoreItems.format(dayEvents.maxPos - minExpandCount + 1));
                }
            }
            else
            {
                $cell.removeClass('hide-many-events');
            }
        },
        eventSorter: function(a, b)
        {
            var result = a.start - b.start;
            if (result === 0) {
                return a.id - b.id;
            }
            return result;
        }
    }).data('zui.calendar');
	$calendar.on('click', '.show-more-events', function(e)
	{
		var $cell = $(this).hide().closest('.cell-day');
		$cell.removeClass('hide-many-events');
		expandedDays[$cell.find('.day').attr('data-date')] = true;
		e.stopPropagation();
	}).on('click', '.event', function(e)
	{
		var event = $(this).data('event');
        eventUrl = event.url == '' ? config.effortViewUrl.replace('{id}', event.id) : event.url;
		effortViewModalTrigger.show({url: eventUrl});
		e.stopPropagation();
	});

});

function changeUser(projectID, account)
{
    location.href = createLink('project', 'effortcalendar', 'projectID=' + projectID + '&account=' + account); 
}
</script>
<?php include '../../../common/view/footer.html.php';?>
