<?php
/**
 * The create mobile view file of trip module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     trip 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>

<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->$type->create ?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon-remove muted'></i></a></nav>
</div>

<form class='content box' data-form-refresh='#page' method='post' id='createTripForm' action='<?php echo $this->createLink('trip', 'create')?>'>
  <div class='control'>
    <label for='name'><?php echo $lang->$type->name;?></label>
    <?php echo html::input('name', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <label for='customers[]'><?php echo $lang->$type->customer;?></label>
    <div class='select'>
      <?php echo html::select('customers[]', $customerList, '', 'multiple');?>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='begin'><?php echo $lang->$type->begin;?></label>
        <input type='date' class='input' id='begin' name='begin' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='start'><?php echo $lang->$type->time;?></label>
        <input type='time' class='input' id='start' value='<?php echo $config->attend->signInLimit;?>' name='start' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='end'><?php echo $lang->$type->end;?></label>
        <input type='date' class='input' id='end' name='end' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='finish'><?php echo $lang->$type->time;?></label>
        <input type='time' class='input' id='finish' value='<?php echo $config->attend->signOutLimit;?>' name='finish' placeholder='<?php echo $lang->required;?>'>
      </div>
    </div>
  </div>
  <?php if($type == 'trip'):?>
  <div class='control'>
    <label for='from'><?php echo $lang->$type->from;?></label>
    <?php echo html::input('from', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <?php endif;?>
  <div class='control'>
    <label for='to'><?php echo $lang->$type->to;?></label>
    <?php echo html::input('to', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->$type->desc;?></label>
    <?php echo html::textarea('desc', '', "rows='3' class='textarea'");?>
    <?php echo html::hidden('type', $type);?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#createTripForm' class='btn primary'><?php echo $lang->save;?></button>
</div>

<script>
$(function()
{
    $('#createTripForm').modalForm().listenScroll({container: 'parent'});
});
</script>
