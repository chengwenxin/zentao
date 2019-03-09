<?php
/**
 * The setting view file of backup module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     backup
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->backup->setting;?></h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='w-p100'>
      <tr>
        <td style='height:80px;vertical-align:top'>
          <div class='input-group'>
            <?php echo html::checkbox('setting', $lang->backup->settingList, isset($config->backup->setting) ? $config->backup->setting : '');?>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class='input-group'>
            <span class='input-group-addon'><?php echo $lang->backup->settingDir;?></span>
            <?php echo html::input('settingDir', !empty($config->backup->settingDir) ? $config->backup->settingDir : $this->app->getTmpRoot() . 'backup/', "class='form-control'");?>
          </div>
        </td>
      </tr>
      <tr><td><?php echo html::submitButton('', '', 'btn btn-primary');?></td></tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php';?>

