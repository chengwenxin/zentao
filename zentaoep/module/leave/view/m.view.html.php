<?php
/**
 * The view mobile view file of leave module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     leave 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

$moduleMenu = false;
$bodyClass  = 'with-nav-bottom';
$browseLink = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : inlink('personal');

include "../../common/view/m.header.html.php";
?>

<div id='page' class='list-with-actions'>
  <div class='section'>
    <div class='heading gray'>
      <div class='title'><i class='icon-calendar'> </i><?php echo $lang->leave->view;?></div>
      <nav class='nav'><a class='btn primary' href='<?php echo $browseLink;?>'><?php echo $lang->goback ?></a></nav>
    </div>
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <td class='w-80px'><?php echo $lang->leave->createdBy;?></td>
          <td><?php echo zget($users, $leave->createdBy);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->leave->type;?></td>
          <td><?php echo zget($lang->leave->typeList, $leave->type);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->leave->status;?></td>
          <td><span class='label status-<?php echo $leave->status;?>-pale'><?php echo zget($lang->leave->statusList, $leave->status);?></span></td>
        </tr>
        <tr>
          <td><?php echo $lang->leave->begin;?></td>
          <td><?php echo $leave->begin . ' ' . $leave->start;?></td>
        </tr>
        <tr>
          <td><?php echo $lang->leave->end;?></td>
          <td><?php echo $leave->end . ' ' . $leave->finish;?></td>
        </tr>
        <?php if(!empty($leave->backDate)):?>
        <tr>
          <td><?php echo $lang->leave->backDate;?></td>
          <td><?php echo formatTime($leave->backDate);?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($leave->hours)):?>
        <tr>
          <td><?php echo $lang->leave->hours;?></td>
          <td><?php echo $leave->hours;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($leave->desc)):?>
        <tr>
          <td><?php echo $lang->leave->desc;?></td>
          <td><?php echo $leave->desc;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($leave->reviewedBy)):?>
        <tr>
          <td><?php echo $lang->leave->reviewedBy;?></td>
          <td><?php echo zget($users, $leave->reviewedBy);?></td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>

  <nav class='nav affix dock-bottom nav-auto footer-actions'>
    <?php if($type == 'browseReview' and $leave->status == 'wait'):?>
    <?php echo "<a data-remote='" . $this->createLink('leave', 'edit', "id={$leave->id}") . "' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";?>
    <?php echo "<a data-remote='" . $this->createLink('leave', 'review', "id={$leave->id}&status=pass") . "' class='success' data-display='ajaxAction' data-confirm='{$lang->leave->confirmReview['pass']}' data-locate='self'>{$lang->leave->statusList['pass']}</a>";?>
    <?php echo "<a data-remote='" . $this->createLink('leave', 'review', "id={$leave->id}&status=reject") . "' class='danger' data-display='modal' data-placement='bottom'>{$lang->leave->statusList['reject']}</a>";?>
    <?php endif;?>
    <?php if($type == 'personal' and ($leave->status == 'wait' or $leave->status == 'draft')):?>
    <?php
    if($leave->status == 'wait' or $leave->status == 'draft')
    {
        $action = $leave->status == 'wait' ? $lang->leave->cancel : $lang->leave->commit;
        echo "<a data-remote='" . $this->createLink('leave', 'switchstatus', "id={$leave->id}") . "' data-display='ajaxAction' data-locate='self'>{$action}</a>";
    }
    ?>
    <?php echo "<a data-remote='" . $this->createLink('leave', 'edit', "id={$leave->id}") . "' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";?>
    <?php echo "<a data-remote='" . $this->createLink('leave', 'delete', "id={$leave->id}") . "' data-display='ajaxAction' data-ajax-delete='true' data-locate='self'>{$lang->delete}</a>";?>
    <?php endif;?>
  </nav>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
