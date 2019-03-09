<?php
/**
 * The license view file of admin module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'><?php common::printAdminSubMenu('system');?></div>
</div>
<div id='mainContent' class='main-content'>
  <div class='center-block mw-600px'>
    <div class='main-header'>
      <h2><?php echo $lang->admin->license?></h2>
      <div class='btn-toolbar pull-right'><?php echo html::a(inlink('uploadLicense'), $lang->admin->uploadLicense, '', "class='btn btn-primary iframe'")?></div>
    </div>
    <table class='table table-borderless table-data'>
      <?php foreach($lang->admin->property as $key => $name):?>
      <tr>
        <th class='w-100px'><?php echo $name?></th>
        <?php
        $property = zget($ioncubeProperties, $key);
        if($key == 'expireDate' and $property == 'All Life') $property = $lang->admin->licenseInfo['alllife'];
        if($key == 'user' and empty($property)) $property = $lang->admin->licenseInfo['nouser'];
        ?>
        <td><?php echo $property?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</div>
<script>
$('#subNavbar li[data-id=system]').addClass('active');
</script>
<?php include '../../../common/view/footer.html.php';?>
