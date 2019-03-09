<?php
/**
 * The view mobile view file of trip module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     trip 
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
      <div class='title'><i class='icon-calendar'> </i><?php echo $lang->trip->view;?></div>
      <nav class='nav'><a class='btn primary' href='<?php echo $browseLink;?>'><?php echo $lang->goback;?></a></nav>
    </div>
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <td class='w-110px'><?php echo $lang->$type->createdBy;?></td>
          <td><?php echo zget($users, $trip->createdBy);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->$type->name;?></td>
          <td><?php echo $trip->name;?></td>
        </tr>
        <?php if(!empty($trip->customers)):?>
        <tr>
          <td><?php echo $lang->$type->customer;?></td>
          <td>
            <?php foreach(explode(',', $trip->customers) as $customer) echo "<div>" . zget($customers, $customer) . "</div>";?>
          </td>
        </tr>
        <?php endif;?>
        <tr>
          <td><?php echo $lang->$type->begin;?></td>
          <td><?php echo $trip->begin . ' ' . $trip->start;?></td>
        </tr>
        <tr>
          <td><?php echo $lang->$type->end;?></td>
          <td><?php echo $trip->end . ' ' . $trip->finish;?></td>
        </tr>
        <?php if($type == 'trip'):?>
        <tr>
          <td><?php echo $lang->$type->from;?></td>
          <td><?php echo $trip->from;?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td><?php echo $lang->$type->to;?></td>
          <td><?php echo $trip->to;?></td>
        </tr>
        <?php if(!empty($trip->desc)):?>
        <tr>
          <td><?php echo $lang->$type->desc;?></td>
          <td><?php echo $trip->desc;?></td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>

  <nav class='nav affix dock-bottom nav-auto footer-actions'>
    <?php if($trip->createdBy == $this->app->user->account):?>
    <a data-remote='<?php echo $this->createLink("$type", 'edit', "id={$trip->id}");?>' data-display='modal' data-placement='bottom'><?php echo $lang->edit;?></a>
    <a data-remote='<?php echo $this->createLink("$type", 'delete', "id=$trip->id");?>' class='text-danger' data-display='ajaxAction' data-ajax-delete='true' data-locate='<?php echo $this->createLink("$type", 'browse');?>'><?php echo $lang->delete;?></a>
    <?php endif;?>
  </nav>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
