<?php
/**
 * The review mobile view file of testcase module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testcase
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->testcase->review; ?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>

<form class='has-padding content' method='post' action='<?php echo $this->createLink('testcase', 'review', http_build_query($this->app->getParams()))?>' id='reviewForm' data-form-refresh='#page' target='hiddenwin'>
  <div class="control">
    <label for='reviewedDate'><?php echo $lang->testcase->reviewedDate;?></label>
    <?php echo html::input('reviewedDate', helper::today(), "class='input'");?>
  </div>
  <div class="control">
    <label for='result'><?php echo $lang->testcase->reviewResult;?></label>
    <div class='select'><?php echo html::select('result', $lang->testcase->reviewResultList, '');?></div>
  </div>
  <div class="control">
    <label for='reviewedBy'><?php echo $lang->testcase->reviewedBy;?></label>
    <div class='select'><?php echo html::select('reviewedBy[]', $users, $this->app->user->account, 'multiple');?></div>
  </div>
  <div class="control">
    <label for='comment'><?php echo $lang->comment;?></label>
    <?php echo html::textarea('comment', '', "rows='1' class='textarea' data-default-val");?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function(){ $('#reviewForm').submit() });
})
</script>
