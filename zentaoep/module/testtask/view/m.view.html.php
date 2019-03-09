<?php
/**
 * The view mobile view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testtask
 * @version     $Id$
 * @link        http://www.zentao.net
 */
$bodyClass  = 'with-nav-bottom';
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink = $this->session->testtaskList ? $this->session->testtaskList : $this->createLink('testtask', 'browse', "productID=$task->product");?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $task->id;?></strong></span>
      <strong><?php echo $task->name;?></strong>
    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'>
    <div class="outline">
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class="active" data-target="#legendView"><?php echo $lang->testtask->view?></a>
        <a data-target="#legendBasicInfo"><?php echo $lang->testtask->legendBasicInfo?></a>
      </nav>
      <div>
        <div class="display in" id="legendView">
          <div class='heading gray'>
            <div class='title'><?php echo $lang->testtask->legendDesc;?></div>
          </div>
          <div class='article'><?php echo $task->desc;?></div>
          <?php if($task->report):?>
          <div class='heading gray'>
            <div class='title'><?php echo $lang->testtask->legendReport;?></div>
          </div>
          <div class='article'><?php echo $task->report;?></div>
          <?php endif;?>
          <?php include '../../common/view/m.action.html.php';?>
        </div>
        <div class="display hidden" id="legendBasicInfo">
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-80px'><?php echo $lang->testtask->project;?></th>
              <td><?php echo html::a($this->createLink('project', 'story', "projectID=$task->project"), $task->projectName);?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->testtask->build;?></th>
              <td><?php $task->build == 'trunk' ? print($lang->trunk) : print(html::a($this->createLink('build', 'view', "buildID=$task->build"), $task->buildName));?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->testtask->owner;?></th>
              <td><?php echo $users[$task->owner];?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->testtask->mailto;?></th>
              <td><?php $mailto = explode(',', str_replace(' ', '', $task->mailto)); foreach($mailto as $account) echo ' ' . zget($users, $account, $account);?></td> 
            </tr>
            <tr>
              <th><?php echo $lang->testtask->pri;?></th>
              <td><?php echo $task->pri;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->testtask->begin;?></th>
              <td><?php echo $task->begin;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->testtask->end;?></th>
              <td><?php echo $task->end;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->testtask->status;?></th>
              <td class='task-<?php echo $task->status?>'><?php echo $lang->testtask->statusList[$task->status];?></td>
            </tr>  
          </table>
        </div>
      </div>
    </div>
  </div>

  <nav class='nav nav-auto affix dock-bottom footer-actions'>
  <?php
  common::printIcon('testtask', 'start',    "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->testtask->start);
  common::printIcon('testtask', 'close',    "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->testtask->close);
  common::printIcon('testtask', 'block',    "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->testtask->block);
  common::printIcon('testtask', 'activate', "taskID=$task->id", $task, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->testtask->activate);
  if(common::hasPriv('testtask', 'cases'))  echo html::a($this->createLink('testtask', 'cases', "taskID=$task->id"), $lang->testtask->cases);
  if(common::hasPriv('testtask', 'delete')) echo html::a($this->createLink('testtask', 'delete', "taskID=$task->id"), $lang->delete, 'hiddenwin');
  ?>
  </nav>
</div>
<?php include '../../common/view/m.footer.html.php';?>
