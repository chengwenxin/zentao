<?php
/**
 * The close mobil view file of story module of ZenTaoPMS.
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
  <span class='title'><strong><?php echo $lang->story->close ?></strong> #<?php echo $story->id ?></span>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('story', 'close', "id=$story->id")?>' id='closeForm' data-form-refresh='#page'>
  <div class='control'>
    <label for='reviewedBy'><?php echo $lang->story->closedReason;?></label>
    <div class='select'><?php echo html::select('closedReason', $lang->story->reasonList);?></div>
  </div>
  <div class='control' id='duplicateStoryBox' style='display:none'>
    <label for='duplicateStory'><?php echo $lang->story->duplicateStory;?></label>
    <?php echo html::input('duplicateStory', '', "class='input'");?>
  </div>
  <div class='control' id='childStoriesBox' style='display:none'>
    <label><?php echo $lang->story->childStories;?></label>
    <?php echo html::input('childStories', '', "class='input'");?>
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
    $('#closedReason').change(function()
    {
        var reason = $(this).val();
        if(reason == 'duplicate')
        {
            $('#duplicateStoryBox').show();
            $('#childStoriesBox').hide();
        }
        else if(reason == 'subdivided')
        {
            $('#duplicateStoryBox').hide();
            $('#childStoriesBox').show();
        }
        else
        {
            $('#duplicateStoryBox').hide();
            $('#childStoriesBox').hide();
        }
    });

    $('#submitButton').click(function(){$('#closeForm').submit()});
})
</script>
