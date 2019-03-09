<?php
/**
 * The personal mobile view file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     attend 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}
include "../../common/view/m.header.html.php";
?>
<style>
table .otherMonth {background: #f0f0f0; color: #9e9e9e}
td .attend-normal {color: #38B03F;}
td .attend-leave  {color: #9E9E9E;}
td .attend-trip   {color: #8666B8;}
td .attend-rest   {color: #3280fc;}
.attend-late .attend-signin    {color: #EA644A;}
.attend-early .attend-signout  {color: #FF8A65;}
.attend-both [class^=attend]   {color: #FF5722;}
.attend-absent [class^=attend] {color: #F1A325;}
.attend-rest [class^=attend]   {color: #3280FC;}
.list > .list {margin-left: 10px;}
.list > .item {padding: 8px;}
</style>

<div class='heading'>
  <nav class='nav fluid'>
    <a data-display='dropdown' data-placement='beside-bottom-start'><i class='icon-bars'></i> &nbsp; <?php echo $lang->leave->date;?></a>
    <div class='list dropdown-menu'>
      <?php foreach($yearList as $year):?>    
      <a class='item item-year' href='<?php echo $this->createLink('attend', 'personal', "date={$year}");?>'><?php echo $year;?></a>
      <div class='list'>
        <?php foreach($monthList[$year] as $month):?>    
        <a class='item item-month' href='<?php echo $this->createLink('attend', 'personal', "date=$year$month");?>'><?php echo $year . $month;?></a>
        <?php endforeach;?>
      </div>
      <?php endforeach;?>
    </div>
  </nav>
</div>

<section id='page' class='section list-with-pager'>
  <div class='box'>
    <?php
    $weekIndex = 0;
    if($this->config->attend->workingDays > 7)
    {
        $startDate     = strtotime("$currentYear-$currentMonth-01");
        $startDate     = date('w', $startDate) == 0 ? $startDate : strtotime("last Sunday", $startDate);
        $endDate       = strtotime("next month -1 day $currentYear-$currentMonth-01");
        $endDate       = date('w', $endDate) == 6 ? $endDate : strtotime("next Saturday", $endDate);
        $firstDayIndex = 0;
        $lastDayIndex  = 6;
    }
    else
    {
        $startDate     = strtotime("$currentYear-$currentMonth-01");
        $startDate     = date('w', $startDate) == 1 ? $startDate : strtotime("last Monday", $startDate);
        $endDate       = strtotime("next month -1 day $currentYear-$currentMonth-01");
        $endDate       = date('w', $endDate) == 0 ? $endDate : strtotime("next Sunday", $endDate);
        $firstDayIndex = 1;
        $lastDayIndex  = 0;
    }
    ?>
    <?php while($startDate <= $endDate):?>
    <?php $dayIndex = date('w', $startDate);?>
    <?php if($dayIndex == $firstDayIndex):?>
    <table class='table bordered compact'>
      <thead>
        <tr class='text-center'>
          <th style='width:90px'><?php echo $lang->attend->weeks[$weekIndex];?></th>
          <th style='width:50px'><?php echo $lang->attend->dayName;?></th>
          <th style='width:65px'><?php echo $lang->attend->signIn;?></th>
          <th style='width:65px'><?php echo $lang->attend->signOut;?></th>
          <th><?php echo $lang->actions . '/' . $lang->attend->status;?></th>
        </tr>
      </thead>
      <tbody>
    <?php endif;?>
    <?php $currentDate = date("Y-m-d", $startDate);?>
    <?php if(isset($attends[$currentDate])):?>
    <?php $status = $attends[$currentDate]->status;?>
    <?php $reason = $attends[$currentDate]->reason;?>
    <?php $reviewStatus = isset($attends[$currentDate]->reviewStatus) ? $attends[$currentDate]->reviewStatus : '';?>
        <tr class="text-center attend-<?php echo $status?> <?php echo (date('m', $startDate) == $currentMonth) ? '' : 'otherMonth'?>" title='<?php echo $lang->attend->statusList[$status]?>'>
          <td><?php echo $currentDate;?></td>
          <td><?php echo $lang->datepicker->abbrDayNames[$dayIndex]?></td>
          <td class='attend-signin'>
            <?php $signIn = substr($attends[$currentDate]->signIn, 0, 5);?>
            <?php if(strpos(',late,absent,rest,', $status) !== false) $signIn = $lang->attend->statusList[$status];?>
            <?php if($status == 'both') $signIn = $lang->attend->statusList['late'];?>
            <?php echo $signIn;?>
          </td>
          <td class='attend-signout'>
            <?php $signOut = substr($attends[$currentDate]->signOut, 0, 5);?>
            <?php if(strpos(',early,absent,rest,', $status) !== false) $signOut = $lang->attend->statusList[$status];?>
            <?php if($status == 'both') $signOut = $lang->attend->statusList['early'];?>
            <?php echo $signOut;?>
          </td>
          <td>
            <?php if(strpos('rest, normal, trip, egress, leave, overtime,lieu', $status) === false):?>
            <?php if($reviewStatus == 'wait' or strpos('late,early,both', $status) !== false):?> 
            <a class='btn btn-sm warning' data-remote='<?php echo $this->createLink('attend', 'edit', "date=" . str_replace('-', '', $currentDate));?>' data-display='modal' data-placement='bottom'>
              <?php echo $reviewStatus == 'wait' ? $lang->attend->edited : $lang->attend->edit;?>
            </a>
            <?php elseif($reason == '' or $reason == 'normal'):?>
            <a class='btn btn-sm warning' data-remote='<?php echo $this->createLink('attend', 'edit', "date=" . str_replace('-', '', $currentDate));?>' data-display='modal' data-placement='bottom'>
              <?php echo $reviewStatus == 'wait' ? $lang->attend->edited : $lang->attend->edit;?>
            </a>
            <?php endif;?>
            <?php else:?>
            <span class="attend-<?php echo $status;?>">
            <?php if($status != 'rest') echo $lang->attend->statusList[$status];?>
            <?php if(strpos('leave,trip,egress,overtime,lieu', $status) !== false and $attends[$currentDate]->desc) echo ' ' . $attends[$currentDate]->desc . 'h';?>
            </span>
            <?php endif;?>
          </td>
        </tr>
        <?php else:?>
        <tr class="text-center <?php echo (date('m', $startDate) == $currentMonth) ? '' : 'otherMonth'?>">
          <td><?php echo $currentDate;?></td>
          <td><?php echo $lang->datepicker->abbrDayNames[$dayIndex]?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <?php endif;?>
      <?php if($dayIndex == $lastDayIndex):?>
      </tbody>
    </table>      
    <?php $weekIndex += 1;?>
    <?php endif;?>
    <?php $startDate = strtotime('+1 day', $startDate);?>
    <?php endwhile;?>
  </div>
</section>
<?php include "../../common/view/m.footer.html.php"; ?>
