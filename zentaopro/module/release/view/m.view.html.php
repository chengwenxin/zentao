<?php
/**
 * The view mobile view file of relase module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     relase
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink = $browseLink = $this->session->releaseList ? $this->session->releaseList : inlink('browse', "productID=$release->product");?>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $release->id;?></strong></span>
      <strong><?php echo $release->name;?></strong>
    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'>
    <div class="outline">
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class='<?php if($type == 'story') echo 'active'?>' data-target="#stories"><?php echo $lang->release->stories?></a>
        <a class='<?php if($type == 'bug') echo 'active'?>' data-target="#bugs"><?php echo $lang->release->bugs?></a>
        <a class='<?php if($type == 'leftBug') echo 'active'?>' data-target="#leftBugs"><?php echo $lang->release->generatedBugs?></a>
        <a data-target="#releaseInfo"><?php echo $lang->release->view?></a>
      </nav>
      <div>
        <div class="display <?php echo $type == 'story' ? 'in' : 'hidden'?>" id="stories">
          <table class='table bordered'>
            <thead>
              <tr>
                <th class='w-50px' > <?php echo $lang->idAB;?></th>
                <th class='w-30px'>  <?php echo $lang->priAB;?></th>
                <th>                 <?php echo $lang->story->title;?></th>
                <th class='w-70px'>  <?php echo $lang->statusAB;?></th>
                <th class='w-70px'>  <?php echo $lang->story->stageAB;?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($stories as $storyID => $story):?>
              <?php $viewLink = $this->createLink('story', 'view', "storyID=$story->id");?>
              <tr class='text-center' data-url='<?php echo $viewLink?>'>
                <td><?php echo $story->id;?></td>
                <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri)?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri);?></span></td>
                <td class='text-left'><?php echo $story->title;?></td>
                <td class='story-<?php echo $story->status?>'><?php echo $lang->story->statusList[$story->status];?></td>
                <td><?php echo $lang->story->stageList[$story->stage];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan='5'><div class='text'><?php echo sprintf($lang->release->finishStories, count($stories));?></div></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display <?php echo $type == 'bug' ? 'in' : 'hidden'?>" id="bugs">
          <table class='table bordered'>
            <thead>
              <tr>
                <th class='w-50px'><?php echo $lang->idAB;?></th>
                <th class='w-30px'><?php echo $lang->priAB;?></th>
                <th >              <?php echo $lang->bug->title;?></th>
                <th class='w-80px'><?php echo $lang->assignedToAB;?></th>
                <th class='w-70px'><?php echo $lang->statusAB;?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($bugs as $bug):?>
              <tr class='text-center' data-url='<?php echo $this->createLink('bug', 'view', "bugID=$bug->id")?>'>
                <td><?php echo $bug->id;?></td>
                <td><span class='<?php echo 'pri' . zget($lang->bug->priList, $bug->pri, $bug->pri)?>'><?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?></span></td>
                <td class='text-left'><?php echo html::a($this->createLink('bug', 'view', "bugID=$bug->id"), $bug->title);?></td>
                <td><?php echo zget($users, $bug->assignedTo);?></td>
                <td class='bug-<?php echo $bug->status?>'><?php echo $lang->bug->statusList[$bug->status];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan='5'>
                  <div class='text'><?php echo sprintf($lang->release->resolvedBugs, count($bugs));?> </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display <?php echo $type == 'leftBug' ? 'in' : 'hidden'?>" id="leftBugs">
          <table class='table bordered'>
            <thead>
              <tr>
                <th class='w-50px'><?php echo $lang->idAB;?></th>
                <th class='w-30px'><?php echo $lang->priAB;?></th>
                <th >              <?php echo $lang->bug->title;?></th>
                <th class='w-80px'><?php echo $lang->assignedToAB;?></th>
                <th class='w-70px'><?php echo $lang->statusAB;?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($leftBugs as $bug):?>
              <tr class='text-center' data-url='<?php echo $this->createLink('bug', 'view', "bugID=$bug->id")?>'>
                <td><?php echo $bug->id;?></td>
                <td><span class='<?php echo 'pri' . zget($lang->bug->priList, $bug->pri, $bug->pri)?>'><?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?></span></td>
                <td class='text-left'><?php echo $bug->title;?></td>
                <td><?php echo zget($users, $bug->assignedTo);?></td>
                <td class='bug-<?php echo $bug->status?>'><?php echo $lang->bug->statusList[$bug->status];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan='5'>
                  <div class='text'><?php echo sprintf($lang->release->createdBugs, count($leftBugs));?> </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display hidden" id="releaseInfo">
            <div class='heading gray'>
              <div class='title'><strong><?php echo $lang->release->basicInfo?></strong></div>
            </div>
            <table class='table bordered table-detail'>
              <tr>
                <th class='w-80px'><?php echo $lang->release->product;?></th>
                <td><?php echo $release->productName;?></td>
              </tr>  
              <?php if($release->productType != 'normal'):?>
              <tr>
                <th><?php echo $lang->product->branch;?></th>
                <td><?php echo $branchName;?></td>
              </tr>
              <?php endif;?>
              <tr>
                <th><?php echo $lang->release->name;?></th>
                <td><?php echo $release->name;?></td>
              </tr>  
              <tr>
                <th><?php echo $lang->release->build;?></th>
                <td><?php echo ($release->project) ? html::a($this->createLink('build', 'view', "buildID=$release->buildID"), $release->buildName) : $release->buildName;?></td>
              </tr>  
              <tr>
                <th><?php echo $lang->release->status;?></th>
                <td><?php echo $lang->release->statusList[$release->status];?></td>
              </tr>
              <tr>
                <th><?php echo $lang->release->date;?></th>
                <td><?php echo $release->date;?></td>
              </tr>
            </table>
            <?php if($release->desc):?>
            <div class='heading gray'>
              <div class='title'><strong><?php echo $lang->release->desc;?></strong></div>
            </div>
            <div class='article'><?php echo $release->desc;?></div>
            <?php endif;?>
            <div class='heading gray'>
              <div class='title'><strong><?php echo $lang->files?></strong></div>
            </div>
            <div class='article'>
            <?php
            if($release->files)
            {
                echo $this->fetch('file', 'printFiles', array('files' => $release->files, 'fieldset' => 'false'));
            }
            elseif($release->filePath)
            {
                echo $lang->release->filePath . html::a($release->filePath, $release->filePath, '_blank');
            }
            elseif($release->scmPath)
            {
                echo $lang->release->scmPath . html::a($release->scmPath, $release->scmPath, '_blank');
            }
            ?>
            </div>
            <?php include '../../common/view/m.action.html.php';?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/m.footer.html.php';?>
