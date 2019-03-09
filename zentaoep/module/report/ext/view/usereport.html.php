<?php
/**
 * The usereport view file of report module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     report
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.lite.html.php';?>
<div class='panel' style='padding-bottom:150px;'>
  <div class='panel-heading'>
    <div class='panel-title'><?php echo $lang->crystal->setVar?></div>
  </div>
  <div class='panel-body'>
    <form target='hiddenwin' method='post'>
    <div class='alert'><?php echo $sql?></div>
      <div class='row'>
        <?php include 'setvarvalues.html.php';?>
      </div>
      <div class='pdt-20'><?php echo html::submitButton();?></div>
    </form>
  </div>
</div>
<?php include '../../../common/view/footer.lite.html.php';?>

