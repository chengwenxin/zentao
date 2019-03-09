<?php
/**
 * The model file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     calendar 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function getEffort($parent, $begin, $end, $product = 0, $project = 0, $user = '', $showAll = 0)
{
    return $this->loadExtension('calendar')->getEffort($parent, $begin, $end, $product, $project, $user, $showAll);
}

public function getTodo($parent, $begin, $end)
{
    return $this->loadExtension('calendar')->getTodo($parent, $begin, $end);
}

public function getChildren($deptID)
{
    return $this->loadExtension('calendar')->getChildren($deptID);
}
