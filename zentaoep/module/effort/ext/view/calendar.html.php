<?php
/**
 * The view file of calendar module of ZenTaoPMS.
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
<?php include '../../../common/view/datepicker.html.php';?>
<?php include '../../../common/ext/view/calendar.html.php';?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php if(common::hasPriv('my', 'todo')) echo html::a(helper::createLink('my', 'todo', "type=all"), $lang->todo->all . " <span class='label label-light label-badge'>{$todoCount}</span>", '', "class='btn btn-link'");?>
    <?php if(isset($effortCount)):?>
    <?php if(common::hasPriv('my', 'effort')) echo html::a(helper::createLink('my', 'effort', "type=all"), $lang->effort->all . " <span class='label label-light label-badge'>{$effortCount}</span>", '', "class='btn btn-link'");?>
    <?php endif?>
  </div>
  <div class="btn-toolbar pull-right">
    <?php if(common::hasPriv('effort', 'export')) echo html::a('javascript:exportCalendar("' . helper::createLink('effort', 'export', "account=$account&orderBy=date_asc&date=_date_") . '")', "<i class='icon-export muted'> </i> " . $lang->effort->export, '', "class='btn btn-link'") ?>
    <?php 
    $date = str_replace('-', '', $date);
    common::printLink('effort', 'batchCreate', "date=$date", "<i class='icon icon-plus'></i> " . $lang->effort->create, '', "class='btn btn-primary' id='batchCreate'", '', true);
    ?>
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
          <div class="col-4 text-center table-col">
            <ul class="nav nav-primary">
              <?php if(common::hasPriv('todo', 'calendar')):?>
              <li><?php echo html::a($this->createLink('todo', 'calendar'), $lang->todo->common);?></li>
              <?php elseif(common::hasPriv('my', 'todo')):?>
              <li><?php echo html::a($this->createLink('my', 'todo'), $lang->todo->common);?></li>
              <?php endif;?>
              <li class="active"><?php echo html::a($this->createLink('effort', 'calendar'), $lang->effort->common);?></li>
            </ul>
          </div>
          <div class="col-4 table-col"></div>
        </header>
      </div>
    </div>
  </div>
</div>
<script>
config.ajaxGetEffortsUrl = '<?php echo $this->createLink('effort', 'ajaxGetEfforts', "account={$this->app->user->account}&year={year}");?>';
config.effortViewUrl     = '<?php echo $this->createLink('effort', 'view', 'id={id}', '', true);?>';
config.batchAddUrl     	 = '<?php echo $this->createLink('effort', 'batchCreate', 'date={date}', '', true);?>';
config.textNetworkError  = '<?php echo $lang->textNetworkError;?>';
config.textHasMoreItems  = '<?php echo $lang->textHasMoreItems;?>';
</script>
<script>
var effortViewModalTrigger = new $.zui.ModalTrigger(
{
    width: '70%',
    type: 'iframe',
    rememberPos: 'effortViewModal',
    waittime: 5000
});
var batchAddModalTrigger = new $.zui.ModalTrigger(
{
    width: '90%',
    type: 'iframe',
    waittime: 5000,
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
          var $event = $('<div title="' + event.title + '" data-id="' + (event.id || '') + '" class="event has-time" title="' + (event.desc || '') + '"><span class="title">' + event.title + '</span><span class="time">' + event.consumed + 'h</span></div>');
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
            if($cell.is('.past,.current')) $cell.addClass('with-plus-sign');
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
        eventUrl = config.effortViewUrl.replace('{id}', event.id);
		effortViewModalTrigger.show({url: eventUrl});
		e.stopPropagation();
	}).on('click', '.day', function(e)
	{
		var $day = $(this);
		var $cell = $day.parent();
        if (!$cell.hasClass('future') || $cell.hasClass('current'))
        {
            batchAddModalTrigger.show({url: config.batchAddUrl.replace('{date}', $day.data('date').format('yyyyMMdd')), showHeader:false});
		}
		e.stopPropagation();
	});

    $('#batchCreate').click(function(e)
    {
        batchAddModalTrigger.show({url: $(this).attr('href'), showHeader:false});
        return false;
    })
});

$.extend({'closeModal':function(callback, location)
{
    batchAddModalTrigger.close();
    if(callback && $.isFunction(callback)) callback();
}});
</script>
<?php include '../../../common/view/footer.html.php';?>
