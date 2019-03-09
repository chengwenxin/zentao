<?php
/**
 * The control file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     business(商业软件) 
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     my 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php include './featurebar.html.php';?>
<div id='mainContent'>
  <nav id='contentNav'>
    <ul class='nav nav-default'>
      <?php
      echo '<li id="all">'      . html::a(inlink('effort', "account=$account&date=all"),       $lang->effort->allDaysEfforts)   . '</li>';
      echo '<li id="today">'    . html::a(inlink('effort', "account=$account&date=today"),     $lang->effort->todayEfforts)     . '</li>';
      echo '<li id="yesterday">'. html::a(inlink('effort', "account=$account&date=yesterday"), $lang->effort->yesterdayEfforts) . '</li>';
      echo '<li id="thisweek">' . html::a(inlink('effort', "account=$account&date=thisweek"),  $lang->effort->thisWeekEfforts)  . '</li>';
      echo '<li id="lastweek">' . html::a(inlink('effort', "account=$account&date=lastweek"),  $lang->effort->lastWeekEfforts)  . '</li>';
      echo '<li id="thismonth">'. html::a(inlink('effort', "account=$account&date=thismonth"), $lang->effort->thisMonthEfforts) . '</li>';
      echo '<li id="lastmonth">'. html::a(inlink('effort', "account=$account&date=lastmonth"), $lang->effort->lastMonthEfforts) . '</li>';
      ?>
      <script>$('#<?php echo $type;?>').addClass('active')</script>
    </ul>
  </nav>
</div>
<form class='main-table table-effort'>
  <table class='table table-fixed'>
    <thead>
      <tr class='colhead'>
        <th class='w-id'><?php echo $lang->idAB;?></th>
        <th class='w-date'><?php echo $lang->effort->date;?></th>
        <th class='w-80px'><?php echo $lang->effort->consumed;?></th>
        <th width='350'><?php echo $lang->effort->objectType;?></th>
        <th><?php echo $lang->effort->work;?></th>
      </tr>
    </thead>
    <tbody>
      <?php $times = 0?>
      <?php foreach($efforts as $effort):?>
      <tr class='text-center'>
        <td class='text-left'>
          <?php printf('%03d', $effort->id);?>
        </td>
        <td><?php echo $effort->date;?></td>
        <td><?php echo $effort->consumed;?></td>
        <td class='text-left'><?php if($effort->objectType != 'custom') echo html::a($this->createLink($effort->objectType, 'view', "id=$effort->objectID", '', true), $effort->objectTitle, '', "class='iframe'");?></td>
        <td class='text-left'><?php echo html::a($this->createLink('effort', 'view', "id=$effort->id&from=my"), $effort->work);?></td>
      </tr>
      <?php $times += $effort->consumed;?>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php if($efforts):?>
  <div class="table-footer"><?php $pager->show('right', 'pagerjs');?></div>
  <?php endif;?>
</form>
<?php include '../../../common/view/footer.html.php';?>
