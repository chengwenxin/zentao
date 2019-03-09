<?php
/**
 * The lang file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$lang->todo->calendar = 'Calendar';

$lang->todo->all = 'All Todo';

$lang->todo->AM = 'AM';
$lang->todo->PM = 'PM';

$lang->side = new stdClass();
$lang->side->bug   = 'Bug';
$lang->side->task  = 'Task';
$lang->side->story = 'Story';

global $app;
if(!empty($app->user) and common::hasPriv('todo', 'calendar')) $lang->todo->periods = array('calendarTab' => $lang->todo->calendar) + $lang->todo->periods;
