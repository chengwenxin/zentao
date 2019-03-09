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
public function getEfforts4Calendar($account = '', $year = '', $type = '', $id = 0)
{
    if($type == 'project') return $this->loadModel('project')->getEfforts4Calendar($id, $account, $year);
    return $this->loadExtension('calendar')->getEfforts4Calendar($account, $year);
}
