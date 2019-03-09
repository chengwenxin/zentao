<?php
/**
 * The view mobile view file of lieu module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     lieu 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}

$moduleMenu = false;
$bodyClass  = 'with-nav-bottom';
$browseLink = $this->session->lieuList ? $this->session->lieuList : inlink('personal');

include "../../common/view/m.header.html.php";
?>

<div id='page' class='list-with-actions'>
  <div class='section'>
    <div class='heading gray'>
      <div class='title'><i class='icon-calendar'> </i><?php echo $lang->lieu->view;?></div>
      <nav class='nav'><a class='btn primary' href='<?php echo $browseLink;?>'><?php echo $lang->goback ?></a></nav>
    </div>
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <td class='w-80px'><?php echo $lang->lieu->createdBy;?></td>
          <td><?php echo zget($users, $lieu->createdBy);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->lieu->status;?></td>
          <td><span class='label status-<?php echo $lieu->status;?>-pale'><?php echo zget($lang->lieu->statusList, $lieu->status);?></span></td>
        </tr>
        <tr>
          <td><?php echo $lang->lieu->begin;?></td>
          <td><?php echo $lieu->begin . ' ' . $lieu->start;?></td>
        </tr>
        <tr>
          <td><?php echo $lang->lieu->end;?></td>
          <td><?php echo $lieu->end . ' ' . $lieu->finish;?></td>
        </tr>
        <?php if($lieu->overtime):?>
        <tr>
          <td><?php echo $lang->lieu->overtime;?></th>
          <td>
            <?php foreach(explode(',', trim($lieu->overtime, ',')) as $overtime):?>
            <?php if($overtime) echo zget($overtimes, $overtime) . '<br/>';?>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <?php if($lieu->trip):?>
        <tr>
          <td><?php echo $lang->lieu->trip;?></th>
          <td>
            <?php foreach(explode(',', trim($lieu->trip, ',')) as $trip):?>
            <?php if($trip) echo zget($trips, $trip) . '<br/>';?>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <?php if(!empty($lieu->hours)):?>
        <tr>
          <td><?php echo $lang->lieu->hours;?></td>
          <td><?php echo $lieu->hours;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($lieu->desc)):?>
        <tr>
          <td><?php echo $lang->lieu->desc;?></td>
          <td><?php echo $lieu->desc;?></td>
        </tr>
        <?php endif;?>
        <?php if(!empty($lieu->reviewedBy)):?>
        <tr>
          <td><?php echo $lang->lieu->reviewedBy;?></td>
          <td><?php echo zget($users, $lieu->reviewedBy);?></td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>

  <nav class='nav affix dock-bottom nav-auto footer-actions'>
    <?php if($type == 'browseReview' and $lieu->status == 'wait'):?>
    <?php echo "<a data-remote='{$this->createLink('lieu', 'edit', "id={$lieu->id}")}' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";?>
    <?php echo "<a data-remote='{$this->createLink('lieu', 'review', "id={$lieu->id}&status=pass")}' data-display='ajaxAction' data-confirm='{$lang->lieu->confirmReview['pass']}' data-locate='self'>{$lang->lieu->statusList['pass']}</a>";?>
    <?php echo "<a data-remote='{$this->createLink('lieu', 'review', "id={$lieu->id}&status=reject")}' data-display='modal' data-placement='bottom' data-confirm='{$lang->lieu->confirmReview['reject']}' data-locate='self'>{$lang->lieu->statusList['reject']}</a>";?>
    <?php endif;?>
    <?php if($type == 'personal' and ($lieu->status == 'wait' or $lieu->status == 'draft')):?>
    <?php
    if($lieu->status == 'wait' or $lieu->status == 'draft')
    {
        $action = $lieu->status == 'wait' ? $lang->lieu->cancel : $lang->lieu->commit;
        echo "<a data-remote='{$this->createLink('lieu', 'switchstatus', "id={$lieu->id}")}' data-display='ajaxAction' data-locate='self'>{$action}</a>";
    }
    ?>
    <?php echo "<a data-remote='{$this->createLink('lieu', 'edit', "id={$lieu->id}")}' data-display='modal' data-placement='bottom'>{$lang->edit}</a>";?>
    <?php echo "<a data-remote='{$this->createLink('lieu', 'delete', "id={$lieu->id}")}' data-display='ajaxAction' data-ajax-delete='true' data-locate='self'>{$lang->delete}</a>";?>
    <?php endif;?>
  </nav>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
