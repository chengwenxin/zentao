<?php
/**
 * The upload license view file of admin module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.lite.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->admin->uploadLicense;?></h2>
  </div>
  <?php if(empty($fixFile)):?>
  <form method='post' enctype='multipart/form-data' style='padding: 5% 20%'>
    <div class='input-group'>
      <input type='file' name='file' class='form-control' />
      <span class='input-group-btn'><?php echo html::submitButton();?></span>
    </div>
  </form>
  <?php else:?>
  <div class='alert alert-info'>
    <p><?php printf($lang->admin->notWritable, join('</code><code>', $fixFile))?></p>
  </div>
  <p style='padding:0 0 20px 20px;'><?php echo html::a(inlink('uploadLicense'), $lang->refresh, '', "class='btn'")?></p>
  <?php endif;?>
</div>
<?php include '../../../common/view/footer.lite.html.php';?>
