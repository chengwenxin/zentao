<?php
/**
 * The resolve mobile view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     bug
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <span class='title'><strong><?php echo $lang->bug->resolve ?></strong> #<?php echo $bug->id ?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('bug', 'resolve', "id=$bug->id")?>' id='resolveForm' data-form-refresh='#page' enctype='multipart/form-data'>
  <div class='control'>
    <label for='resolution'><?php echo $lang->bug->resolution;?></label>
    <div class='select'><?php echo html::select('resolution', $lang->bug->resolutionList, '', "onchange='setDuplicate(this.value)'");?></div>
  </div>
  <div class="control hidden" id='duplicateBugBox'>
    <label for='duplicateBug'><?php echo $lang->bug->duplicateBug;?></label>
    <?php echo html::input('duplicateBug', '', "class='input'");?>
  </div>
  <div class="control">
    <div>
      <label for='resolvedBuild'><strong><?php echo $lang->bug->resolvedBuild;?></strong></label>
      <?php if(common::hasPriv('build', 'create')):?>
      <span><input type="checkbox" name="createBuild" value='1' id='createBuild'> <?php echo $lang->bug->createBuild?></span>
      <?php endif;?>
    </div>
    <div id='resolvedBuildBox' class='select'><?php echo html::select('resolvedBuild', $builds, '');?></div>
    <?php if(common::hasPriv('build', 'create')):?>
     <span id='newBuildBox' class='hidden'><?php echo html::input('buildName', '', "class='input' placeholder='{$lang->bug->placeholder->newBuildName}'");?></span>
    <?php endif;?>
  </div>
  <div class="control hidden" id='newBuildProjectBox'>
    <label for='buildProject'><?php echo $lang->bug->project;?></label>
    <div class='select'><?php echo html::select('buildProject', $projects, '');?></div>
  </div>
  <div class="control">
    <label for='resolvedDate'><?php echo $lang->bug->resolvedDate;?></label>
    <input type='date' id='resolvedDate' name='resolvedDate' class='input' />
  </div>
  <div class="control">
    <label for='assignedTo'><?php echo $lang->bug->assignedTo;?></label>
    <div class='select'><?php echo html::select('assignedTo', $users, $assignedTo);?></div>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->story->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildform');?>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#createBuild').change(function()
    {
        if($(this).prop('checked'))
        {
            $('#resolvedBuildBox').addClass('hidden');
            $('#newBuildBox').removeClass('hidden');
            $('#newBuildProjectBox').removeClass('hidden');
        }
        else
        {
            $('#resolvedBuildBox').removeClass('hidden');
            $('#newBuildBox').addClass('hidden');
            $('#newBuildProjectBox').addClass('hidden');
        }
    })
    $('#submitButton').click(function(){$('#resolveForm').submit()});
})
</script>
