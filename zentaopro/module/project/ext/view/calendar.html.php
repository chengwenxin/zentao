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
<?php include '../../../common/ext/view/calendar.html.php'?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-right'>
    <?php
    $misc = common::hasPriv('task', 'export') ? "class='btn btn-link export iframe' data-width='700'" : "class='btn btn-link disabled'";
    $link = common::hasPriv('task', 'export') ? $this->createLink('task', 'export', "project=$projectID&orderBy=$orderBy&type=calendar") : '#';
    echo html::a($link, "<i class='icon-import muted'></i> " . $lang->task->export, '', $misc);
    ?>
    <?php
    $checkObject = new stdclass();
    $checkObject->project = $projectID;
    $misc = common::hasPriv('task', 'create', $checkObject) ? "class='btn btn-primary'" : "class='btn btn-primary disabled'";
    $link = common::hasPriv('task', 'create', $checkObject) ?  $this->createLink('task', 'create', "project=$projectID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : '')) : '#';
    echo html::a($link, "<i class='icon icon-plus'></i>" . $lang->task->create, '', $misc);
    ?>
  </div>
</div>
<div id='mainContent' class='main-row'>
  <div class="main-col">
    <div class="cell">
      <div id="calendar" class="calendar load-indicator loading no-margin">
        <header class="calender-header table-row">
          <div class="btn-toolbar col-12 table-col text-middle">
            <button type="button" class="btn btn-info btn-icon btn-mini btn-prev"><i class="icon-chevron-left"></i></button>
            <button type="button" class="btn btn-info btn-mini btn-today"><?php echo $lang->today;?></button>
            <button type="button" class="btn btn-info btn-icon btn-mini btn-next"><i class="icon-chevron-right"></i></button>
            <span class="calendar-caption"></span>
          </div>
        </header>
      </div>
    </div>
  </div>
  <?php $startDate = '';?>
  <div class="side-col">
    <div class="cell" id="taskLists">
      <ul class="task-list">
      <li id='undoneTask'><?php echo $lang->task->waitTask?></li>
      <?php foreach($events as $task):?>
        <?php if($task['status'] != 'wait') continue;?>
        <li><a class="iframe" href='<?php echo $task['url'];?>'><?php echo $task['title'];?></a></li>
      <?php endforeach;?>
      </ul>
    </div>
  </div>
</div>
<script>
config.textHasMoreItems  = '<?php echo $lang->textHasMoreItems;?>';
</script>
<script>
$(function()
{
    var taskViewModalTrigger = new $.zui.ModalTrigger(
    {
        width: '70%',
        type: 'iframe',
        rememberPos: 'taskViewModal',
        waittime: 5000
    });

    var $calendar = $('#calendar');
    var $taskLists = $('#taskLists');

    var scrollToElement = function($ele)
    {
        var ele = $ele[0];
        ele && ele.scrollIntoView && ele.scrollIntoView({block: "start", behavior: "smooth"});
        $ele.addClass('highlight');
        setTimeout(function(){$ele.removeClass('highlight');}, 1000);
    };

    var scrollToDate = function(date)
    {
        if (!date) date = new Date();
        var $today = $taskLists.find('.task-list .heading[data-day="' + date.format('yyyy-MM-dd') + '"]');
        if($today.length)
        {
            scrollToElement($today);
        }
        else
        {
            var $thisMonth = $taskLists.find('.task-list[data-month="' + date.format('yyyy-MM') + '"]');
            if ($thisMonth.length) scrollToElement($thisMonth);
        }
    };

    var displayDate    = 0;
    var expandedDays   = {};
    var minExpandCount = 6;
    var toggleLoading = function(loading)
    {
        $calendar.toggleClass('loading', !!loading);
    };
    var calendarEvents = <?php echo json_encode($events);?>;
    var calendar = $calendar.calendar(
    {
        startDate:'<?php echo $startDate;?>',
        dragThenDrop: false,
        hideEmptyWeekends: true,
        data:
        {
            events: calendarEvents,
            calendars:
            {
                defaultCal: {color: '#fff'}
            }
        },
        eventCreator: function(event, $cell, calendar)
        {
            var $event = $('<div title="' + event.divTitle + '" data-id="' + (event.id || '') + '" class="event" title="' + (event.desc || '') + '"><span class="status-' + event.status + '">' + ' <span class="label label-dot"></span></span> <span class="title">' + event.iconTitle + '</span></div>');
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
        display: function(e)
        {
            scrollToDate(e.date);
            toggleLoading(false);
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
        taskViewModalTrigger.show({url: createLink('task', 'view', 'taskID=' + event.id, 'html', true)});
        e.stopPropagation();
    });

    $taskLists.css('height', $calendar.parent().outerHeight());
});
</script>
<?php include '../../../common/view/footer.html.php';?>
