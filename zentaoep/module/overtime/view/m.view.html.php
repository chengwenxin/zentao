<?php
/**
 * The view mobile view file of overtime module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     overtime 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

$moduleMenu = false;
$bodyClass  = 'with-nav-bottom';
$browseLink = $this->session->overtimeList ? $this->session->overtimeList : inlink('personal');

include "../../common/view/m.header.html.php";
?>

<div id='page' class='list-with-actions'>
  <div class='section'>
    <div class='heading gray'>
      <div class='title'><i class='icon-calendar'> </i><?php echo $lang->overtime->view;?></div>
      <nav class='nav'><a class='btn primary' href='<?php echo $browseLink;?>'><?php echo $lang->goback ?></a></nav>
    </div>
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <td class='w-80px'><?php echo $lang->overtime->createdBy;?></td>
          <td><?php echo zget($users, $overtime->createdBy);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->overtime->type;?></td>
          <td><?php echo zget($lang->overtime->typeList, $overtime->type);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->overtime->status;?></td>
          <td><span class='label status-<?php echo $overtime->status;?>-pale'><?php echo zget($lang->overtime->statusList, $overtime->status);?></span></td>
        </tr>
        <tr>
          <td><?php echo $lang->overtime->begin;?></td>
          <td><?php echo $overtime->begin . ' ' . $overtime->start;?></td>
        </tr>
        <tr>
          <td><?php echo $lang->overtime->end;?></td>
          <td><?php echo $overtime->end . ' ' . $overtime->finish;?></td>
        </tr>
        <?php if(!empty($overtime->hours)):?>
        <tr>
          <td><?php echo $lang->overtime->hours;?></td>
          <td><?php echo $overtime->hours;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($overtime->desc)):?>
        <tr>
          <td><?php echo $lang->overtime->desc;?></td>
          <td><?php echo $overtime->desc;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($overtime->reviewedBy)):?>
        <tr>
          <td><?php echo $lang->overtime->reviewedBy;?></td>
          <td><?php echo zget($users, $overtime->reviewedBy);?></td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>

  <nav class='nav affix dock-bottom nav-auto footer-actions'>
    <?php
    if($overtime->createdBy == $this->app->user->account and ($overtime->status == 'wait' or $overtime->status == 'draft'))
    {
        if($overtime->status == 'wait' or $overtime->status == 'draft')
        {
            $action = $overtime->status == 'wait' ? $lang->overtime->cancel : $lang->overtime->commit;
            echo "<a data-remote='{$this->createLink('overtime', 'switchstatus', "id=$overtime->id")}' data-display='ajaxAction' data-locate='self'>{$action}</a>";
        }
        echo "<a data-remote='{$this->createLink('overtime', 'edit', "id={$overtime->id}")}' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";
        echo "<a data-remote='{$this->createLink('overtime', 'delete', "id=$overtime->id")}' class='text-danger' data-display='ajaxAction' data-ajax-delete='true' data-locate='{$this->createLink('overtime', 'browse')}'>{$lang->delete}</a>";
    }

    if($type == 'browseReview' && ($overtime->status == 'wait') && commonModel::hasPriv('overtime', 'review'))
    {
        echo "<a data-remote='{$this->createLink('overtime', 'review', "id=$overtime->id&status=pass")}' data-display='ajaxAction' data-locate='self'>{$lang->overtime->statusList['pass']}</a>";
        echo "<a data-remote='{$this->createLink('overtime', 'review', "id=$overtime->id&status=reject")}' data-display='modal' data-placement='bottom'>{$lang->overtime->statusList['reject']}</a>";
    }
    ?>
  </nav>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
