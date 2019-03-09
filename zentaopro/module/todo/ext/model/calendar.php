<?php
/**
 * The model file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function getTodos4Calendar($account = '', $year = '')
{
    return $this->loadExtension('calendar')->getTodos4Calendar($account, $year);
}

public function getWeekTodos($begin, $end, $account = '')
{
    return $this->loadExtension('calendar')->getWeekTodos($begin, $end, $account);
}

public function getTodos4Side($account = '')
{
    return $this->loadExtension('calendar')->getTodos4Side($account);
}
