<?php
/**
 * The edit mobile view file of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <div class='title'><strong><?php echo $lang->story->edit;?></strong> #<?php echo $story->id ?></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>

<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('story', 'edit', "id=$story->id")?>' id='editForm' data-form-refresh='#page'>
  <div class="control">
    <label for='module'><?php echo $lang->story->module;?></label>
    <div class='select'><?php echo html::select('module', $moduleOptionMenu, $story->module);?></div>
  </div>
  <div class="control">
    <label for='plan'><?php echo $lang->story->plan;?></label>
    <div class='select'><?php echo html::select('plan[]', $plans, $story->plan, "multiple");?></div>
  </div>
  <div class='row'>
    <div class='cell'>
      <div class="control">
        <label for='source'><?php echo $lang->story->source;?></label>
        <div class='select'><?php echo html::select('source', $lang->story->sourceList, $story->source);?></div>
      </div>
    </div>
    <div class='cell'>
      <div class="control">
        <label for='sourceNote'><?php echo $lang->comment;?></label>
        <?php echo html::input('sourceNote', $story->sourceNote, "class='input'");?>
      </div>
    </div>
  </div>
  <div class="control">
    <label for='pri'><?php echo $lang->story->status;?></label>
    <div class='select'><?php echo zget($lang->story->statusList, $story->status);?></div>
  </div>
  <div class="control">
    <label for='stage'><?php echo $lang->story->stage;?></label>
    <div class='select'><?php echo html::select('stage', $lang->story->stageList, $story->stage);?></div>
  </div>
  <div class="control">
    <label for='pri'><?php echo $lang->story->pri;?></label>
    <div class='select'><?php echo html::select('pri', $lang->story->priList, $story->pri);?></div>
  </div>
  <div class="control">
    <label for='estimate'><?php echo $lang->story->estimateAB;?></label>
    <?php echo html::input('estimate', $story->estimate, "class='input'");?>
  </div>
  <div class="control">
    <label for='keywords'><?php echo $lang->story->keywords;?></label>
    <?php echo html::input('keywords', $story->keywords, "class='input'");?></div>
  </div>
  <div class="control">
    <label for='mailto'><?php echo $lang->story->mailto;?></label>
    <div class='select'> <?php echo html::select('mailto[]', $users, $story->mailto, "multiple");?></div>
  </div>
  <div class='control'>
    <label for='assignedTo'><?php echo $lang->story->assignedTo;?></label>
    <div class='select'><?php echo html::select('assignedTo', $users, $story->assignedTo);?></div>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->story->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function(){$('#editForm').submit()});
})
</script>
