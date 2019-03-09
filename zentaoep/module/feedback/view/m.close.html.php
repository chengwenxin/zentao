<?php
/**
 * The close mobile web view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     feedback
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <span class='title'><strong><?php echo $lang->feedback->close ?></strong> #<?php echo $feedbackID?></span>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('feedback', 'close', "id=$feedbackID")?>' id='closeForm' data-form-refresh='#page'>
  <div class='control <?php echo $app->user->feedback ? 'hidden' : ''?>'>
    <label for='closedReason'><?php echo $lang->feedback->closedReason;?></label>
    <div class='select'><?php echo html::select('closedReason', $lang->feedback->closedReasonList, $closedReason);?></div>
  </div>
  <div class='control'>
    <label for='comment'><?php echo $lang->comment;?></label>
    <?php echo html::textarea('comment', '', 'rows=2 class="textarea"');?></td>
  </div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>

<script>
$(function()
{
    $('#submitButton').click(function(){$('#closeForm').submit()});
})
</script>
