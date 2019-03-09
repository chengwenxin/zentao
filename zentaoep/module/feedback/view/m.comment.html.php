<?php
/**
 * The comment view mobile web file of feedback module of ZenTaoPMS.
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
  <span class='title'>
    <strong>
    <?php
    $title = $type == 'asked' ? $lang->feedback->ask : $lang->feedback->comment;
    $title = $type == 'replied' ? $lang->feedback->reply : $lang->feedback->comment;
    echo $title;
    ?>
    </strong>
    #<?php echo $feedbackID?>
  </span>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>
<form class='has-padding content' method='post' target='hiddenwin' action='<?php echo $this->createLink('feedback', 'comment', http_build_query($this->app->getParams()))?>' id='commentForm' data-form-refresh='#page'>
  <div class='control'><?php echo html::textarea('comment', '',"rows='5' class='textarea' data-default-val");?></div>
</form>
<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    $('#submitButton').click(function(){$('#commentForm').submit()});
})
</script>
