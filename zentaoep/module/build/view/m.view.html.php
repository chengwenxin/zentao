<?php
/**
 * The view mobile view file of build module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     build
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<?php $browseLink = $browseLink = $this->session->buildList ? $this->session->buildList : $this->createLink('project', 'build', "projectID=$build->project");?>
<style>
table tr > td{word-break:break-all;}
</style>
<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'>
      <span class="prefix"> <strong><?php echo $build->id;?></strong></span>
      <strong><?php echo $build->name;?></strong>
    </div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>

  <div class='section no-margin'>
    <div class='outline'>
      <nav class="nav" data-display="" data-selector="a" data-show-single="true" data-active-class="active" data-animate="false">
        <a class='<?php if($type == 'story') echo 'active'?>' data-target="#stories"><?php echo $lang->build->stories?></a>
        <a class='<?php if($type == 'bug')    echo 'active'?>' data-target="#bugs"><?php echo $lang->build->bugs?></a>
        <a class='<?php if($type == 'nweBug') echo 'active'?>' data-target="#newBugs"><?php echo $lang->build->generatedBugs?></a>
        <a data-target="#buildInfo"><?php echo $lang->build->view?></a>
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
                <td colspan='5'><div class='text'><?php echo sprintf($lang->build->finishStories, count($stories));?></div></td>
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
                  <div class='text'><?php echo sprintf($lang->build->resolvedBugs, count($bugs));?> </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display <?php echo $type == 'newBug' ? 'in' : 'hidden'?>" id="newBugs">
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
              <?php foreach($generatedBugs as $bug):?>
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
                  <div class='text'><?php echo sprintf($lang->build->createdBugs, count($generatedBugs));?> </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="display hidden" id="buildInfo">
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->build->basicInfo;?></strong></div>
          </div>
          <table class='table bordered table-detail'>
            <tr>
              <th class='w-100px'><?php echo $lang->build->product;?></th>
              <td><?php echo $build->productName;?></td>
            </tr>  
            <?php if($build->productType != 'normal'):?>
            <tr>
              <th><?php echo $lang->product->branch;?></th>
              <td><?php echo $branchName;?></td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->build->name;?></th>
              <td><?php echo $build->name;?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->build->builder;?></th>
              <td><?php echo $users[$build->builder];?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->build->date;?></th>
              <td><?php echo $build->date;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->build->filePath;?></th>
              <td><?php echo html::a($build->filePath, $build->filePath, '_blank');?></td>
            </tr>
            <tr>
              <th><?php echo $lang->build->scmPath;?></th>
              <td><?php echo html::a($build->scmPath, $build->scmPath, '_blank')?></td>
            </tr>
          </table>
          <div class='heading gray'>
            <div class='title'><strong><?php echo $lang->build->desc;?></strong></div>
          </div>
          <div class='article'><?php echo $build->desc;?></div>

          <?php if($build->files):?>
          <div class='heading gray'>
            <div class='title'><i class='icon icon-file-text-o'> </i><?php echo $lang->files;?></div>
          </div>
          <div class='article'>
          <?php echo $this->fetch('file', 'printFiles', array('files' => $build->files, 'fieldset' => 'false'));?>
          </div>
          <?php endif;?>

          <?php include '../../common/view/m.action.html.php';?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/m.footer.html.php';?>
