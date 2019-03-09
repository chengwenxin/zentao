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
public function createRelationOfTasks($projectID)
{
    $this->loadExtension('gantt')->createRelationOfTasks($projectID);
}

public function editRelationOfTasks($projectID)
{
    $this->loadExtension('gantt')->editRelationOfTasks($projectID);
}

public function getRelationsOfTasks($projectID)
{
    return $this->loadExtension('gantt')->getRelationsOfTasks($projectID);
}

public function getDataForGantt($projectID, $type)
{
    return $this->loadExtension('gantt')->getDataForGantt($projectID, $type);
}

public function deleteRelation($id)
{
    $this->loadExtension('gantt')->deleteRelation($id);
}
