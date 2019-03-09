<?php
/**
 * The setVarValues view file of report module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     report
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.lite.html.php'?>
<style>
.icon, [class*=" icon-"], [class^=icon-] {font-size: 16px;}
</style>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->crystal->addLang;?></h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='table table-form'>
      <thead>
        <tr>
          <th class='w-150px'><?php echo $lang->crystal->fieldName?></th>
          <th><?php echo $lang->crystal->fieldValue?></th>
          <th class='w-100px'></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($sqlLangs->fieldName as $i => $fieldName):?>
        <tr>
          <td><?php echo html::input('fieldName[]', $fieldName, "class='form-control'")?></td>
          <td>
            <div class='input-group'>
              <?php foreach($config->langs as $langKey => $langName):?>
              <span class='input-group-addon'><?php echo $langName?></span>
              <?php echo html::input("fieldValue[$langKey][]", zget($sqlLangs->fieldValue[$langKey], $i, ''), "class='form-control'")?>
              <?php endforeach;?>
            </div>
          </td>
          <td>
            <div class='btn-group'>
              <?php echo html::a('javascript:;', '<i class="icon-plus"></i>', '', "onclick='addField(this)' class='btn'")?></a>
              <?php echo html::a('javascript:;', '<i class="icon-close"></i>', '', "onclick='deleteField(this)' class='btn'")?></a>
            </div>
          </td>
        </tr>
        <?php endforeach;?>
        <tr>
          <td><?php echo html::input('fieldName[]', '', "class='form-control'")?></td>
          <td>
            <div class='input-group'>
              <?php foreach($config->langs as $langKey => $langName):?>
              <span class='input-group-addon'><?php echo $langName?></span>
              <?php echo html::input("fieldValue[$langKey][]", '', "class='form-control'")?>
              <?php endforeach;?>
            </div>
          </td>
          <td>
            <div class='btn-group'>
              <?php echo html::a('javascript:;', '<i class="icon-plus"></i>', '', "onclick='addField(this)' class='btn'")?></a>
              <?php echo html::a('javascript:;', '<i class="icon-close"></i>', '', "onclick='deleteField(this)' class='btn'")?></a>
            </div>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan='3' class='text-center'><?php echo html::submitButton()?></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php include '../../../common/view/footer.lite.html.php'?>
