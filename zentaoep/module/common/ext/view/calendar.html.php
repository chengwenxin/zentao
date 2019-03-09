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
css::import($jsRoot . 'zui/calendar/zui.calendar.min.css');
js::import($jsRoot . 'zui/calendar/zui.calendar.min.js');
?>
<style>
.calendar .event.with-action {position: relative; padding-right: 30px;}
.calendar .event.with-action .action {position: absolute; right: 0; top: 0;}
.calendar .event.with-action .action > a {display: inline-block; padding: 0 4px; color: #fff; background-color: rgba(0,0,0,0.25); line-height: 19px; padding: 0 6px;}
.calendar .event.with-action .action > a:hover {background-color: rgba(0,0,0,0.5)}
td.cell-day {vertical-align: top !important;}
</style>
<script>
function exportCalendar(href)
{
    var thisDate = new Date($('.calendar td.current-month:first').find('div.day').attr('data-date'));
    var year     = thisDate.getFullYear();
    var month    = thisDate.getMonth() + 1;
    var thisDate = year + '_' + month + '_01';
    var href = href.replace("_date_", thisDate);
    $.zui.modalTrigger.show({type: 'iframe', url: href});
}

function refreshCalendar()
{
    displayDate = 0;
    calendar.display();
}
</script>
