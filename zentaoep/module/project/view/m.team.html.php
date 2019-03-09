<?php
/**
 * The team browse mobile view file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     project
 * @version     $Id
 * @link        http://www.zentao.net
 */

include "../../common/view/m.header.html.php";
?>

<div class='heading'>
  <div class='title'>
    <strong><?php echo $lang->project->team;?></strong>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <table class='table bordered'>
    <thead>
      <tr>
        <th><?php echo $lang->team->account;?></th>
        <th class='text-center w-140px'><?php echo $lang->team->join;?></th>
        <th class='text-center'><?php echo $lang->team->role;?></th>
        <th class='text-center'><?php echo $lang->team->totalHours;?></th>
      </tr>
    </thead>
    <?php $totalHours = 0;?>
    <?php foreach($teamMembers as $member):?>
    <tr class= 'text-center'>
      <?php $memberHours = $member->days * $member->hours;?>
      <?php $totalHours  += $memberHours;?>
      <td class='text-left'><?php echo $member->realname;?></td>
      <td><?php echo substr($member->join, 2);?></td>
      <td><?php echo $member->role;?></td>
      <td><?php echo $memberHours . $lang->project->workHour;?></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td colspan='4'><?php echo $lang->team->totalHours . '：' .  "<strong>$totalHours{$lang->project->workHour}</strong>";?></td>
    </tr>
  </table>
</section>

<?php include "../../common/view/m.footer.html.php"; ?>
