<?php
/**
 * The required view file of custom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     custom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include 'header.html.php';?>
<div id='mainContent' class='main-row'>
  <div class='side-col' id='sidebar'>
    <div class='cell'>
      <div class='list-group'>
        <?php
        foreach($config->custom->requiredModules as $requiredModule)
        {
            $requiredModuleName = zget($lang->custom->moduleName, $requiredModule, $lang->$requiredModule->common);
            echo html::a(inlink('required', "module=$requiredModule"), $requiredModuleName, '', "id='{$requiredModule}Tab'");
        }
        ?>
      </div>
    </div>
  </div>
  <div class='main-col main-content'>
    <form class="load-indicator main-form form-ajax" method='post'>
      <div class='main-header'>
        <div class='heading'>
          <strong><?php echo $lang->$moduleName->common?></strong>
        </div>
      </div>
      <table class='table table-form mw-800px'>
        <?php foreach($requiredFields as $method => $requiredField):?>
        <tr>
          <th class='w-100px'>
          <?php
          $fields = $this->custom->getFormFields($moduleName, $method);

          if($moduleName == 'doc'       and $method == 'createlib')  $method = 'createLib';
          if($moduleName == 'doc'       and $method == 'editlib')    $method = 'editLib';
          if($moduleName == 'testsuite' and $method == 'createlib')  $method = 'createLib';
          if($moduleName == 'testsuite' and $method == 'createcase')
          {
              $this->app->loadLang('testcase');
              $fields = $this->custom->getFormFields('testcase', $method);
              $method = 'createCase';
          }
          echo $lang->$moduleName->$method;
          ?>
          </th>
          <td><?php echo html::select("requiredFields[{$method}][]", $fields, $requiredField, "class='form-control chosen' multiple");?></td>
          <td></td>
        </tr>
        <?php endforeach;?>
        <tr>
          <td colspan='2' class='text-center form-actions'>
          <?php echo html::submitButton();?>
          <?php if(common::hasPriv('custom', 'resetRequired')) echo html::a(inlink('resetRequired', "module=$moduleName"), $lang->custom->restore, 'hiddenwin', "class='btn btn-wide'");?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<script>
$(function()
{
    $('#mainMenu #requiredTab').addClass('btn-active-text');
    $('#sidebar #<?php echo $moduleName?>Tab').addClass('active');
})
</script>
<?php include '../../common/view/footer.html.php';?>
