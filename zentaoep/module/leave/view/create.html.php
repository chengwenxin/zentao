<?php
/**
 * The create view file of leave module of Ranzhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     leave
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('signIn', $config->attend->signInLimit)?>
<?php js::set('signOut', $config->attend->signOutLimit)?>
<?php js::set('workingHours', $config->attend->workingHours)?>
<?php js::set('annualTip', sprintf($lang->leave->annualTip, $myLeftAnnuals));?>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
<form id='ajaxForm' method='post' action="<?php echo $this->createLink('leave', 'create')?>">
  <table class='table table-form table-condensed'>
    <tr>
      <th class='w-60px'><?php echo $lang->leave->type?></th>
      <td><?php echo html::radio('type', $lang->leave->typeList, 'affairs', "class=''")?></td>
      <td></td>
    </tr>
    <tr>
      <th><?php echo $lang->leave->begin?></th>
      <td>
        <div class='input-group'>
          <span class='input-group-addon'><?php echo $lang->leave->date?></span>
          <?php echo html::input('begin', $date, "class='form-control form-date date-picker-down'")?>
          <span class='input-group-addon fix-border'><?php echo $lang->leave->time?></span>
          <?php echo html::input('start', $config->attend->signInLimit, "class='form-control form-time date-picker-down'")?>
        </div>
      </td>
      <td></td>
    </tr>
    <tr>
      <th><?php echo $lang->leave->end?></th>
      <td>
        <div class='input-group'>
          <span class='input-group-addon'><?php echo $lang->leave->date?></span>
          <?php echo html::input('end', $date, "class='form-control form-date date-picker-down'")?>
          <span class='input-group-addon fix-border'><?php echo $lang->leave->time?></span>
          <?php echo html::input('finish', $config->attend->signOutLimit, "class='form-control form-time date-picker-down'")?>
        </div>
      </td>
      <td></td>
    </tr>
    <tr>
      <th><?php echo $lang->leave->hours?></th>
      <td>
        <div class='input-group'>
          <?php echo html::input('hours', '', "class='form-control'")?>
          <span class='input-group-addon'><?php echo $lang->leave->hoursTip?></span>
        </div>
      </td>
      <td></td>
    </tr>
    <tr>
      <th><?php echo $lang->leave->desc?></th>
      <td><?php echo html::textarea('desc', '', "class='form-control'")?></td>
      <td></td>
    </tr> 
    <tr>
      <th></th>
      <td><?php echo baseHTML::submitButton();?></td>
      <td></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
