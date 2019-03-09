<?php
/**
 * The settings view file of attend module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     attend
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php include '../../common/view/header.html.php';?>
  <style>
  #menuActions{float:right !important; margin-top: -60px !important;}
  .input-group-required > .required::after, .required-wrapper.required::after {top:12px !important;}
  .modal-body .table {margin-bottom:0px !important;}
  </style>
  <div id='featurebar'>
    <ul class='nav'>
    <?php
    $methodName = strtolower($this->app->getMethodName());
    foreach($lang->attend->featurebar as $key => $menu)
    {
        if(is_string($menu)) $link = $menu;
        if(is_array($menu)) $link = $menu['link'];
        list($name, $currentModule, $currentMethod, $params) = explode('|', $link);
       $class = strtolower($key) == $methodName ? "class='active'" : '';
        if(isset($menu['alias'])) $class = strpos(strtolower($menu['alias']), strtolower($key)) !== false ? "class='active'" : $class;
        if(common::hasPriv($currentModule, $currentMethod)) echo "<li id='$key' $class>" . html::a($this->createLink($currentModule, $currentMethod, $params), $name) . '</li>';
    }
    ?>
    </ul>
  </div>

<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php if(!$module):?>
<div class='with-side'>
  <div class='side'>
    <nav class='menu leftmenu'>
      <ul class='nav nav-primary'>
        <li><?php extCommonModel::printLink('attend', 'settings', '', $lang->attend->settings);?></li>
        <li><?php extCommonModel::printLink('attend', 'personalsettings', '', $lang->attend->personalSettings);?></li> 
        <li><?php extCommonModel::printLink('attend', 'setManager', '', $lang->attend->setManager);?></li>
      </ul>
    </nav>
  </div>
  <div class='main'>
<?php endif;?>
    <div class='panel'>
      <div class='panel-heading'><?php echo $lang->attend->settings;?></div>
      <div class='panel-body'>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
        <form id='ajaxForm' method='post'>
          <table class='table table-form table-condensed w-p70'>
            <tr>
              <th class='w-150px'><?php echo $lang->attend->beginDate->company;?></th>
              <td class='w-300px'><?php echo html::input('beginDate[company]', $beginDate, "class='form-control form-date'")?></td>
              <td style='padding-left: 10px'><a data-toggle='tooltip' title='<?php echo $lang->attend->note->beginDate;?>'><i class='icon-question-sign'></i></a></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->signInLimit?></th>
              <td><?php echo html::input('signInLimit', $signInLimit, "class='form-control form-time'")?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->signOutLimit?></th>
              <td>
                <div class='input-group'>
                  <?php echo html::input('signOutLimit', $signOutLimit, "class='form-control form-time'")?>
                  <span class='input-group-addon'><?php echo html::checkbox('mustSignOut', array('yes' => $lang->attend->mustSignOut), $mustSignOut);?></span>
                </div>
              </td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->workingHours?></th>
              <td><?php echo html::input('workingHours', $workingHours, "class='form-control'")?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->workingDays?></th>
              <td><?php echo html::select('workingDays', $lang->attend->workingDaysList, $workingDays, "class='form-control'")?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->reviewedBy;?></th>
              <td><?php echo html::select('reviewedBy', array('' => $this->lang->dept->manager) + $users, $reviewedBy, "class='form-control chosen'")?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->ipList;?></th>
              <td>
                <div class='input-group'>
                  <?php echo html::input('ip', $ip, "class='form-control' title='{$lang->attend->note->ip}'");?>
                  <div class='input-group-addon'>
                    <label class="checkbox-inline"><input type="checkbox" id="allip" name="allip" value="1"> <?php echo $lang->attend->note->allip;?></label>
                  </div>
                </div>
              </td>
              <td style='padding-left: 10px'>
                <?php echo baseHTML::a('javascript:void(0)', "<i class='icon-question-sign'></i>", "data-original-title='{$lang->attend->note->ip}' data-toggle='tooltip' data-placement='right' ");?>     
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->noAttendUsers;?></th>
              <td><?php echo html::select('noAttendUsers[]', $users, $noAttendUsers, "class='form-control chosen' multiple")?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->attend->signInClient;?></th>
              <td><?php echo html::select('signInClient', $lang->attend->clientList, $config->attend->signInClient, "class='form-control'")?></td>
              <td style='padding-left: 10px'>
                <?php echo baseHTML::a('javascript:void(0)', "<i class='icon-question-sign'></i>", "data-original-title='{$lang->attend->note->signInClient}' data-toggle='tooltip' data-placement='right' ");?>     
              </td>
            </tr>
            <tr><th></th><td colspan='2'><?php echo baseHTML::submitButton();?></td></tr>
          </table>
        </form>
      </div>
    </div>
<?php if(!$module):?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
