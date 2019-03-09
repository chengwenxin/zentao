<?php
/**
 * The mail file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     attend
 * @version     $Id
 * @link        http://www.ranzhico.com
 */
?>
<?php $mailTitle = "{$lang->attend->common} - $label#" . zget($users, $attend->account) . " {$attend->date}";?>
<?php include '../../common/view/m.mail.header.html.php';?>
<tr>
  <td>
    <table cellpadding='0' cellspacing='0' width='600' style='border: none; border-collapse: collapse;'>
      <tr>
        <td style='padding: 10px; background-color: #F8FAFE; border: none; font-size: 14px; font-weight: 500; border-bottom: 1px solid #e5e5e5;'>
          <?php echo $mailTitle;?>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style='padding: 10px; border: none;'>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $lang->attend->common;?></legend>
      <div style='padding:5px;'>
        <p><?php echo $lang->attend->status . ':' . zget($lang->attend->statusList, $attend->status)?></p>
        <p><?php echo "{$lang->attend->date}: {$attend->date}"?></p>
        <p><?php echo $lang->attend->reason . ':' . zget($lang->attend->reasonList, $attend->reason)?></p>
        <p><?php echo $lang->attend->desc?></p>
        <p><?php echo $attend->desc?></p>
      </div>
    </fieldset>
  </td>
</tr>
<?php include '../../common/view/m.mail.footer.html.php';?>
