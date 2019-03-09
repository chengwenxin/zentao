<?php
/**
 * The effort mobile view file of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     user
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<?php
$bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
include "./m.featurebar.html.php";
?>

<nav id='subMenu' class='menu nav gray'>
  <?php
  echo html::a(inlink('effort', "account=$account&date=today"),     $lang->effort->todayEfforts, '', "id='today'");
  echo html::a(inlink('effort', "account=$account&date=yesterday"), $lang->effort->yesterdayEfforts, '', "id='yesterday'");
  echo html::a(inlink('effort', "account=$account&date=thisweek"),  $lang->effort->thisWeekEfforts, '', "id='thisweek'");
  echo html::a(inlink('effort', "account=$account&date=lastweek"),  $lang->effort->lastWeekEfforts, '', "id='lastweek'");
  echo html::a(inlink('effort', "account=$account&date=thismonth"), $lang->effort->thisMonthEfforts, '', "id='thismonth'");
  echo html::a(inlink('effort', "account=$account&date=lastmonth"), $lang->effort->lastMonthEfforts, '', "id='lastmonth'");
  echo html::a(inlink('effort', "account=$account&date=all"),       $lang->effort->allDaysEfforts, '', "id='all'");
  ?>
  <a class='moreSubMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreSubMenu' class='list dropdown-menu'></div>
</nav>

<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
  <nav class='nav'><a class='btn primary' href='<?php echo $this->createLink('company', 'browse');?>'><?php echo $lang->goback;?></a></nav>
</div>

<section id='page' class='section list-with-pager'>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $this->createLink('user', 'effort', http_build_query($this->app->getParams())); ?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th class='w-100px'><?php echo $lang->effort->date;?></th>
          <th><?php echo $lang->effort->work;?></th>
        </tr>
      </thead>
      <?php foreach($efforts as $effort):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('effort', 'view', "id=$effort->id");?>' data-id='<?php echo $effort->id;?>'>
        <td><?php echo $effort->date;?></td>
        <td class='text-left'><?php echo $effort->work . "({$effort->consumed}h)";?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel enter-from-bottom hidden affix layer' id='sortPanel'>
  <?php
  $vars = "account=$account&type=$type&orderBy=%s&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage"; 
  $orders = array('id', 'date', 'consumed', 'left', 'work', 'objectType');
  foreach ($orders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . $lang->effort->{$order});
  }
  ?>
</div>

<script>
$('#<?php echo $methodName?>' + 'Tab').addClass('active');
$('#subMenu > a').removeClass('active').filter('[href*="<?php echo $type?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
