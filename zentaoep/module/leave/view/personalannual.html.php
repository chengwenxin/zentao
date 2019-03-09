<?php
/**
 * The set begin date view file of attend module of RanZhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gang Liu <liugang@cnezsoft.com>
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
    foreach($lang->leave->featurebar as $key => $menu)
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

<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php if(!$module):?>
<div class='with-side'>
  <div class='side'>
    <nav class='menu leftmenu'>
      <ul class='nav nav-primary'>
        <?php foreach($lang->leave->settings as $setting):?>
        <?php list($label, $module, $method) = explode('|', $setting);?>
        <li <?php if($method == $this->methodName) echo "class='active'";?>><?php extCommonModel::printLink($module, $method, '', $label);?></li>
        <?php endforeach;?>
      </ul>
    </nav>
  </div>
  <div class='main'>
<?php endif;?>
    <div class='panel'>
      <div class='panel-heading'><?php echo $lang->leave->totalAnnual;?></div>
      <div class='panel-body'>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
        <form id='ajaxForm' method='post'>
          <table class='table table-condensed table-borderless'>
            <tr class='text-center'>
              <th class='w-120px'><?php echo $lang->leave->account;?></th>
              <th class='w-300px'><?php echo $lang->leave->dateRange;?></th>
              <th class='w-100px'><?php echo $lang->day;?></th>
              <th></th>
            </tr>
            <?php if(!empty($this->config->leave->annualSetting)):?>
            <?php $annualSettings = json_decode($this->config->leave->annualSetting);?>
            <?php foreach($annualSettings as $account => $annualSetting):?>
            <tr>
              <td><?php echo html::select("account[]", $users, $account, "class='form-control chosen'");?></td>
              <td>
                <div class='input-group'>
                  <?php echo html::input("begin[]", $annualSetting->begin, "class='form-control form-date'");?>
                  <span class='input-group-addon fix-border'><?php echo $lang->minus;?></span>
                  <?php echo html::input("end[]", $annualSetting->end, "class='form-control form-date'");?>
                </div>
              </td>
              <td>
                <div class='input-group'>
                  <?php echo html::input("totalDays[]", $annualSetting->totalDays, "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->day;?></span>
                </div>
              </td>
              <td>
                <a class='btn addItem'><i class='icon icon-plus'></i></a>
                <a class='btn delItem'><i class='icon icon-remove'></i></a>
              </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
            <tr>
              <td><?php echo html::select("account[]", $users, '', "class='form-control chosen'");?></td>
              <td>
                <div class='input-group'>
                  <?php echo html::input("begin[]", '', "class='form-control form-date'");?>
                  <span class='input-group-addon fix-border'><?php echo $lang->minus;?></span>
                  <?php echo html::input("end[]", '', "class='form-control form-date'");?>
                </div>
              </td>
              <td>
                <div class='input-group'>
                  <?php echo html::input("totalDays[]", '', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->day;?></span>
                </div>
              </td>
              <td>
                <a class='btn addItem'><i class='icon icon-plus'></i></a>
                <a class='btn delItem'><i class='icon icon-remove'></i></a>
              </td>
            </tr>
            <tr>
              <td><?php echo baseHTML::submitButton();?></td>
              <td></td>
              <td></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
<?php if(!$module):?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
