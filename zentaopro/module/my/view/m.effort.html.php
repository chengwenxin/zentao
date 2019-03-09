<?php
/**
 * The effort mobile view file of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     my
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php
$bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
?>
<style>
  #dateBox{padding-top:8px;}
</style>
<nav id='menu' class='menu nav affix dock-top canvas'>
  <div id='dateBox'>
    <input type='date' class='input' id='date' name='date' value='<?php echo $date?>' onchange='changeDate(this.value)'>
  </div>
  <?php
  echo html::a(inlink('effort', "date=today"),     $lang->effort->todayEfforts, '', "id='today'");
  echo html::a(inlink('effort', "date=yesterday"), $lang->effort->yesterdayEfforts, '', "id='yesterday'");
  echo html::a(inlink('effort', "date=thisweek"),  $lang->effort->thisWeekEfforts, '', "id='thisweek'");
  echo html::a(inlink('effort', "date=lastweek"),  $lang->effort->lastWeekEfforts, '', "id='lastweek'");
  echo html::a(inlink('effort', "date=thismonth"), $lang->effort->thisMonthEfforts, '', "id='thismonth'");
  echo html::a(inlink('effort', "date=lastmonth"), $lang->effort->lastMonthEfforts, '', "id='lastmonth'");
  echo html::a(inlink('effort', "date=all"),       $lang->effort->allDaysEfforts, '', "id='all'");
  ?>
  <a class='moreMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $this->createLink('my', 'effort', http_build_query($this->app->getParams())); ?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th class='w-100px'><?php echo $lang->effort->date;?></th>
          <th><?php echo $lang->effort->work;?></th>
        </tr>
      </thead>
      <?php $times = 0?>
      <?php foreach($efforts as $effort):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('effort', 'view', "id=$effort->id");?>' data-id='<?php echo $effort->id;?>'>
        <td><?php echo $effort->date;?></td>
        <td class='text-left'><?php echo $effort->work . "({$effort->consumed}h)";?></td>
      </tr>
      <?php $times += $effort->consumed;?>
      <?php endforeach;?>
      <?php if($times):?>
      <tfoot><tr><td colspan='4' class='small'><?php printf($lang->company->effort->timeStat, $times);?></td></tr></tfoot>
      <?php endif;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel enter-from-bottom hidden affix layer' id='sortPanel'>
  <?php
  $vars = "type=$type&orderBy=%s&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage"; 
  $orders = array('id', 'date', 'consumed', 'left', 'work', 'objectType');
  foreach ($orders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->effort->{$order});
  }
  ?>
</div>

<script>
function changeDate(date)
{
    if(date.indexOf('-') != -1)
    {
        var datearray = date.split("-");
        var date = '';
        for(i = 0 ; i < datearray.length; i++) date = date + datearray[i];
    }
    link = createLink('my', 'effort', 'date=' + date);
    location.href=link;
}

$('#appnav > a').removeClass('active').filter('[href*="effort"]').addClass('active');
$('#menu > a').removeClass('active').filter('[href*="<?php echo $type?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
