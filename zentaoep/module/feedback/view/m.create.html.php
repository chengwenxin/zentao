<?php
/**
 * The feedback create mobile view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     feedback
 * @version     $Id
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->feedback->create;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>
<form class='content box' data-form-refresh='#page' method='post' id='createForm' action='<?php echo $this->createLink('feedback', 'create');?>' target='hiddenwin' enctype='multipart/form-data'>
  <div class="control">
    <label for='module'><?php echo $lang->feedback->product;?></label>
    <div class='select'><?php echo html::select('product', $products, '');?></div>
  </div>
  <div class='control'>
    <label for='name'><?php echo $lang->feedback->title;?></label>
    <?php echo html::input('title', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='public' name='public' value='1'>
      <label for='public'> <?php echo $lang->feedback->public;?></label>
    </div>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->feedback->desc;?></label>
    <?php echo html::textarea('desc', '', "rews='5' class='textarea'");?>
  </div>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>
  <div class='control'>
    <div class='checkbox'>
      <input type='checkbox' id='notify' name='notify' value='1'>
      <label for='notify'> <?php echo $lang->feedback->mailNotify;?></label>
    </div>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#submitButton').click(function(){$('#createForm').submit()});
});
</script>
