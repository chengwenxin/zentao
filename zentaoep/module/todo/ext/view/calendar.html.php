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
<?php include '../../../common/ext/view/calendar.html.php';?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php if(common::hasPriv('my', 'todo')) echo html::a(helper::createLink('my', 'todo', "type=all"), $lang->todo->all . " <span class='label label-light label-badge'>{$todoCount}</span>", '', "class='btn btn-link'");?>
    <?php if(isset($effortCount)):?>
    <?php if(common::hasPriv('my', 'effort')) echo html::a(helper::createLink('my', 'effort', "type=all"), $lang->effort->all . " <span class='label label-light label-badge'>{$effortCount}</span>", '', "class='btn btn-link'");?>
    <?php endif;?>
  </div>
  <div class="btn-toolbar pull-right">
    <?php if(common::hasPriv('todo', 'export')) echo html::a('javascript:exportCalendar("' . helper::createLink('todo', 'export', "account=$account&orderBy=id_desc&date=_date_") . '")', "<i class='icon-export muted'> </i> " . $lang->todo->export, '', "class='btn btn-link'");?>
    <?php common::printLink('todo', 'batchCreate', '', "<i class='icon icon-plus'></i> " . $lang->todo->batchCreate, '', "class='btn btn-secondary' id='batchCreate'", '', true);?>
    <?php common::printLink('todo', 'create', '', "<i class='icon icon-plus'></i> " . $lang->todo->create, '', "id='create' class='btn btn-primary iframe' data-width='80%'", '', 'true');?>
  </div>
</div>
<div class="main-row">
  <div class="main-col">
    <div class="cell">
      <div id="todoCalendar" class="calendar">
        <header class="calender-header table-row">
          <div class="btn-toolbar col-4 table-col text-middle">
            <button type="button" class="btn btn-info btn-icon btn-mini btn-prev"><i class="icon-chevron-left"></i></button>
            <button type="button" class="btn btn-info btn-mini btn-today"><?php echo $lang->today;?></button>
            <button type="button" class="btn btn-info btn-icon btn-mini btn-next"><i class="icon-chevron-right"></i></button>
            <span class="calendar-caption"></span>
          </div>
          <div class="col-4 text-center table-col">
            <ul class="nav nav-primary">
              <li class="active"><?php echo html::a($this->createLink('todo', 'calendar'), $lang->todo->common);?></li>
              <?php if(isset($effortCount)):?>
              <?php if(common::hasPriv('effort', 'calendar')):?>
              <li><?php echo html::a($this->createLink('effort', 'calendar'), $lang->effort->common);?></li>
              <?php elseif(common::hasPriv('my', 'effort')):?>
              <li><?php echo html::a($this->createLink('my', 'effort'), $lang->effort->common);?></li>
              <?php endif;?>
              <?php endif;?>
            </ul>
          </div>
          <div class="col-4 table-col"></div>
        </header>
      </div>
    </div>
  </div>
  <div class="side-col">
    <div class="cell">
      <ul class="nav nav-secondary nav-justified">
        <li class="active"><a href="#tab_task" data-toggle='tab'><?php echo $lang->side->task?></a></li>
        <li><a href="#tab_story" data-toggle='tab'><?php echo $lang->side->story?></a></li>
        <li><a href="#tab_bug" data-toggle='tab'><?php echo $lang->side->bug?></a></li>
      </ul>
      <div class='tab-content' id="todoLists">
        <?php if(!empty($todoList)):?>
        <?php foreach($todoList as $type => $todoSides):?>
        <div class='tab-pane fade <?php if($type == 'task') echo 'active in';?>' id='tab_<?php echo $type;?>'>
          <?php if(!empty($todoSides)):?>
          <ul class='todo-list'>
          <?php $i = 1;?>
          <?php foreach($todoSides as $id => $todo):?>
            <li data-index='<?php echo $i++;?>'>
              <?php
              $title = '[' . strtoupper($type{0}) . ']' . $todo;
              echo html::a($this->createLink($type, 'view', "id=$id", 'html', true), $title, '', "class='iframe todo-item' data-id='{$id}' data-type='{$type}' data-title='{$title}' title='{$todo}' data-width='70%'");
              ?>
            </li>
          <?php endforeach;?>
		  </ul>
          <?php endif;?>
        </div>
        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<script>
config.ajaxGetTodosUrl   = '<?php echo $this->createLink('todo', 'ajaxGetTodos', "account={$this->app->user->account}&year={year}");?>';
config.ajaxChangeDaysUrl = '<?php echo $this->createLink('todo', 'ajaxChangeDays', 'id={id}&date={date}');?>';
config.ajaxFinishUrl     = '<?php echo $this->createLink('todo', 'finish', 'id={id}');?>';
config.ajaxActivateUrl   = '<?php echo $this->createLink('todo', 'activate', 'id={id}');?>';
config.todoCreateUrl     = '<?php echo $this->createLink('todo', 'create', '', 'json');?>';
config.todoViewUrl 	     = '<?php echo $this->createLink('todo', 'view', 'id={id}', '', true);?>';
config.batchAddUrl 		 = '<?php echo $this->createLink('todo', 'batchCreate', 'date={date}', '', true);?>';
config.userAccount       = '<?php echo $this->app->user->account;?>';
config.textNetworkError  = '<?php echo $lang->textNetworkError;?>';
config.textHasMoreItems  = '<?php echo $lang->textHasMoreItems;?>';
</script>
<script>
var todoModalTrigger = new $.zui.ModalTrigger(
{
    width: '70%',
    type: 'iframe',
    rememberPos: 'todoViewModal',
    waittime: 5000
});

var batchAddModalTrigger = new $.zui.ModalTrigger(
{
    width: '80%',
    type: 'iframe',
    waittime: 5000
});

var displayDate = 0;
var calendar    = false;
$(function()
{

    var expandedDays   = {};
    var minExpandCount = 6;
    var $calendar      = $('#todoCalendar');
    var toggleLoading  = function(loading)
    {
        $calendar.toggleClass('loading', !!loading);
    };
    calendar = $calendar.calendar(
    {
        hideEmptyWeekends: true,
        data:
        {
            events: [],
            calendars:
            {
                defaultCal: {color: '#fff'}
            }
        },
        beforeDisplay: function(display, doDisplay) {
            var date = display.date;
            var thisDisplayDate = date.getFullYear();
            if(displayDate === thisDisplayDate)
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
                url: config.ajaxGetTodosUrl.replace('{year}', date.getFullYear()),
                dataType: 'json',
                success: function(data)
                {
                    $.each(data, function(index, todo)
                    {
                        todo.finish = todo.status === 'done' || todo.status === 'closed';
                        todo.allDay = !todo.end;
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
            var pri = event.pri != '' ? '(' + event.pri + ')' : '';
            var $event = $('<div title="' + pri + event.title + '" data-id="' + (event.id || '') + '" class="event">' + (event.finish ? '<i class="icon todo-check icon-check-circle"></i>' : '<i class="icon  todo-check icon-check-circle-empty"></i>') + '<span class="title">' + pri + event.title + '</span>' + (event.allDay ? '' : '<span class="time">' + event.start.format('hh:mm') + '</span>') + '</div>');
            $event.toggleClass('has-time', !event.allDay)
                  .toggleClass('expired', !event.finish && !$cell.hasClass('future'));
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
            if($cell.is('.future')) $cell.addClass('with-plus-sign');
        },
        beforeChange: function(change)
        {
            toggleLoading(true);
            $.ajax(
            {
                url: config.ajaxChangeDaysUrl.replace('{id}', change.event.id).replace('{date}', change.to.getTime()),
                error: function()
                {
                    $.zui.messager.danger(config.textNetworkError);
                    calendar.display();
                },
                complete: function() {toggleLoading(false);}
            });
            displayDate = 0;
            this.display();
        },
        eventSorter: function(a, b)
        {
            var result = (a.finish ? 1 : 0) - (b.finish ? 1 : 0);
            if(result === 0) result = (a.allDay ? (-1) : 0) - (b.allDay ? (-1) : 0);
            if(result === 0) result = a.start - b.start;
            if(result === 0) return a.id - b.id;
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
        todoModalTrigger.show({url: config.todoViewUrl.replace('{id}', event.id)});
        e.stopPropagation();
    }).on('click', '.day', function(e)
    {
        var $day = $(this);
        if($day.parent().hasClass('future')) batchAddModalTrigger.show({url: config.batchAddUrl.replace('{date}', $day.data('date').format('yyyyMMdd')), showHeader:false});
        e.stopPropagation();
    }).on('click', '.todo-check', function(e)
    {
        // 当点击日历待办勾选框时
        var $event = $(this).closest('.event');
        var event = $event.data('event');
        toggleLoading(true);
        var actionUrl = event.finish ? config.ajaxActivateUrl : config.ajaxFinishUrl;
        $.ajax({
              url: actionUrl.replace('{id}', event.id),
              success: function()
              {
                  event.finish = !event.finish;
                  calendar.display();
              },
              error: function()
              {
                  $.zui.messager.danger(config.textNetworkError);
                  calendar.display();
              },
              complete: function() {toggleLoading(false);}
        });
        displayDate = 0;
        e.preventDefault();
        e.stopPropagation();
    });

    $('#todoLists').droppable(
    {
        selector: '.todo-item',
        target: function()
        {
            return $calendar.find('.cell-day');
        },
        before: function()
        {
            $calendar.addClass('event-dragging');
        },
        always: function()
        {
            $calendar.removeClass('event-dragging');
        },
        drop: function(e)
        {
            var $item = $(e.element);
            var $day = $(e.target).children('.day');
            var date = $day.data('date');
            var item = $item.data();
            var $li = $item.parent();
            var finish = $li.hasClass('active');
            var todoEvent = {
                id: item.id,
                title: item.title,
                start: date,
                end: null,
                finish: finish,
                status: finish ? 'done' : 'wait',
                allDay: true
            };
            if(item.type === 'todo')
            {
                $.ajax(
                {
                    url: config.ajaxChangeDaysUrl.replace('{id}', item.id).replace('{date}', date.getTime()),
                    error: function()
                    {
                        $.zui.messager.danger(config.textNetworkError);
                        calendar.display();
                    },
                    success: function() {
                        calendar.addEvents([todoEvent]);
                        $li.remove();
                    },
                    complete: function() {toggleLoading(false);}
                });
            }
            else if(item.type === 'task' || item.type === 'bug' || item.type === 'story')
            {
                $.ajax(
                {
                    type: 'POST',
                    dataType: 'json',
                    url: config.todoCreateUrl,
                    data: {
                        date: date.format('yyyy-MM-dd'),
                        type: item.type,
                        idvalue: item.id,
                        name: item.title,
                        begin: '',
                        end: ''
                    },
                    error: function()
                    {
                        $.zui.messager.danger(config.textNetworkError);
                        calendar.display();
                    },
                    success: function() {
                        calendar.addEvents([todoEvent]);
                        $li.remove();
                    },
                    complete: function() {toggleLoading(false);}
                });
            }
            displayDate = 0;
        }
    })

    $('#batchCreate').click(function(e)
    {
        batchAddModalTrigger.show({url: $(this).attr('href'), showHeader:false});
        return false;
    })

    addPager('#tab_task');
    addPager('#tab_story');
    addPager('#tab_bug');
});

$.extend({'closeModal':function(callback, location)
{
    batchAddModalTrigger.close();
    if(callback && $.isFunction(callback)) callback();
}});

function addPager(selecter)
{   
    var preNum = 15;
    var tab = $(selecter);
    var count = tab.find('li').length;
    var page  = Math.ceil(count / preNum);
    if(page > 1)
    {   
        for(i = page; i > 0; i--)
        {   
            tab.append("<span class='page-num btn' data-id='" + i + "'>" + i + '</span>')
        }   
        $(selecter + ' span.page-num').click(function()
        {   
            var tab = $(this).parent();
            var page = $(this).data('id');
            tab.find('.page-num').removeClass('active');
            $(this).addClass('active');
            page = parseInt(page) *  preNum; 
            tab.find('li').hide();
            for(i = page; i > page - preNum; i--)
            {   
                var item = tab.find('[data-index=' + i + ']');
                if(item.prop('data-remove') != '1') item.show();
            }   
        }); 
        $(selecter + ' span.page-num[data-id=1]').click();
    }   
}   
</script>
<?php include '../../../common/view/footer.html.php';?>
