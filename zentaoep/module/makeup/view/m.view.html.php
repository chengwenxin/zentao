<?php
/**
 * The view mobile view file of makeup module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     makeup 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

$moduleMenu = false;
$bodyClass  = 'with-nav-bottom';
$browseLink = $this->session->makeupList ? $this->session->makeupList : inlink('personal');

include "../../common/view/m.header.html.php";
?>

<div id='page' class='list-with-actions'>
  <div class='section'>
    <div class='heading gray'>
      <div class='title'><i class='icon-calendar'> </i><?php echo $lang->makeup->view;?></div>
      <nav class='nav'><a class='btn primary' href='<?php echo $browseLink;?>'><?php echo $lang->goback ?></a></nav>
    </div>
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <td class='w-80px'><?php echo $lang->makeup->createdBy;?></td>
          <td><?php echo zget($users, $makeup->createdBy);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->makeup->status;?></td>
          <td><span class='label status-<?php echo $makeup->status;?>-pale'><?php echo zget($lang->makeup->statusList, $makeup->status);?></span></td>
        </tr>
        <tr>
          <td><?php echo $lang->makeup->begin;?></td>
          <td><?php echo $makeup->begin . ' ' . $makeup->start;?></td>
        </tr>
        <tr>
          <td><?php echo $lang->makeup->end;?></td>
          <td><?php echo $makeup->end . ' ' . $makeup->finish;?></td>
        </tr>
        <?php if($makeup->leave):?>
        <tr>
          <td><?php echo $lang->makeup->leave;?></th>
          <td>
            <?php foreach(explode(',', trim($makeup->leave, ',')) as $leave):?>
            <?php if($leave) echo zget($leaves, $leave) . '<br/>';?>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <?php if(!empty($makeup->hours)):?>
        <tr>
          <td><?php echo $lang->makeup->hours;?></td>
          <td><?php echo $makeup->hours;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($makeup->desc)):?>
        <tr>
          <td><?php echo $lang->makeup->desc;?></td>
          <td><?php echo $makeup->desc;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($makeup->reviewedBy)):?>
        <tr>
          <td><?php echo $lang->makeup->reviewedBy;?></td>
          <td><?php echo zget($users, $makeup->reviewedBy);?></td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>

  <nav class='nav affix dock-bottom nav-auto footer-actions'>
    <?php if($type == 'browseReview' and $makeup->status == 'wait'):?>
    <?php echo "<a data-remote='{$this->createLink('makeup', 'edit', "id={$makeup->id}")}' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";?>
    <?php echo "<a data-remote='{$this->createLink('makeup', 'review', "id={$makeup->id}&status=pass")}' data-display='ajaxAction' data-confirm='{$lang->makeup->confirmReview['pass']}' data-locate='self'>{$lang->makeup->statusList['pass']}</a>";?>
    <?php echo "<a data-remote='{$this->createLink('makeup', 'review', "id={$makeup->id}&status=reject")}' data-placement='bottom' data-display='modal'>{$lang->makeup->statusList['reject']}</a>";?>
    <?php endif;?>
    <?php if($type == 'personal' and ($makeup->status == 'wait' or $makeup->status == 'draft')):?>
    <?php
    if($makeup->status == 'wait' or $makeup->status == 'draft')
    {
        $action = $makeup->status == 'wait' ? $lang->makeup->cancel : $lang->makeup->commit;
        echo "<a data-remote='{$this->createLink('makeup', 'switchstatus', "id={$makeup->id}")}' data-display='ajaxAction' data-locate='self'>{$action}</a>";
    }
    ?>
    <?php echo "<a data-remote='{$this->createLink('makeup', 'edit', "id={$makeup->id}")}' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";?>
    <?php echo "<a data-remote='{$this->createLink('makeup', 'delete', "id=$makeup->id")}' class='text-danger' data-display='ajaxAction' data-ajax-delete='true' data-locate='{$this->createLink('makeup', 'browse')}'>{$lang->delete}</a>";?>
    <?php endif;?>
  </nav>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
