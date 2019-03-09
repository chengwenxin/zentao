<?php
/**
 * The model file of calendar module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function getTasks4Calendar($projectID, $status = 'all', $orderBy = 'status_asc, id_desc', $pager = null)
{
    return $this->loadExtension('calendar')->getTasks4Calendar($projectID, $status, $orderBy, $pager);
}

public function getEfforts4Calendar($projectID, $account = '', $year = '')
{
    return $this->loadExtension('calendar')->getEfforts4Calendar($projectID, $account, $year);
}
