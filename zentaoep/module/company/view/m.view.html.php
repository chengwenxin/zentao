<?php
/**
 * The company view mobile view file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     company
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<?php include "../../common/view/m.header.html.php";?>

<div id='page' class='list-with-actions'>
  <div class='section no-margin'>
    <div class='heading gray'>
      <div class='title'> <strong><?php echo $lang->company->view;?></strong></div>
    </div>
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <th class='w-80px'><?php echo $lang->company->name;?></th>
          <td><?php echo $company->name;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->phone;?></th>
          <td><?php echo $company->phone;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->fax;?></th>
          <td><?php echo $company->fax;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->address;?></th>
          <td><?php echo $company->address; ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->zipcode;?></th>
          <td><?php echo $company->zipcode;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->website;?></th>
          <td><?php echo $company->website;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->backyard;?></th>
          <td><?php echo $company->backyard;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->company->guest;?></th>
          <td><?php echo $lang->company->guestOptions[$company->guest];?></td>
        </tr>
      </table>
    </div>
  </form>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
