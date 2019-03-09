<?php
/**
 * The change mobile view file of story module of ZenTaoPMS.
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
  <span class='title'><strong><?php echo $lang->story->change ?></strong> #<?php echo $story->id ?></span>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon-remove muted'></i></a>
  </nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('story', 'change', "id=$story->id")?>' id='changeForm' data-form-refresh='#page' enctype='multipart/form-data'>
  <div class='row'>
    <div class='cell'>
      <div class='control'>
        <label for='reviewedBy'><?php echo $lang->story->reviewedBy;?></label>
        <div class='select'><?php echo html::select('assignedTo', $users, $story->assignedTo);?></div>
      </div>
      <?php if(!$this->story->checkForceReview()):?>
      <div class='cell-2'>
        <div class='control' style='padding-top:30px; padding-left:5px;width:100px;'>
          <div class='checkbox'><?php echo html::checkbox('needNotReview', $lang->story->needNotReview, '', "id='needNotReview' {$needReview}");?></div>
        </div>
      </div>
      <?php endif;?>
    </div>
  </div>
  <div class="control">
    <label for='title'><?php echo $lang->story->title;?></label>
    <?php echo html::input('title', $story->title, "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class="control">
    <label for='desc'><?php echo $lang->story->spec;?></label>
    <?php echo html::textarea('spec', $story->spec, "rows=4 class='textarea' placeholder='" . htmlspecialchars($lang->story->specTemplate) . "'");?>
  </div>
  <div class="control">
    <label for='verify'><?php echo $lang->story->verify;?></label>
    <?php echo html::textarea('verify', $story->verify, "rows=2 class='textarea'");?>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->story->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    if($('#needNotReview').prop('checked'))
    {
        $('#assignedTo').attr('disabled', 'disabled');
    }
    else
    {
        $('#assignedTo').removeAttr('disabled');
    }

    $('#needNotReview').change(function()
    {
        if($('#needNotReview').prop('checked'))
        {
            $('#assignedTo').attr('disabled', 'disabled');
        }
        else
        {
            $('#assignedTo').removeAttr('disabled');
        }
    });
    $('#submitButton').click(function(){$('#changeForm').submit()});
})
</script>
