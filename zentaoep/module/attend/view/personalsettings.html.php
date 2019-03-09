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

<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php if(!$module):?>
<div class='with-side'>
  <div class='side'>
    <nav class='menu leftmenu'>
      <ul class='nav nav-primary'>
        <li><?php extCommonModel::printLink('attend', 'settings', '', "{$lang->attend->settings}");?></li>
        <li><?php extCommonModel::printLink('attend', 'personalsettings', '', $lang->attend->personalSettings);?></li> 
        <li><?php extCommonModel::printLink('attend', 'setmanager', '', "{$lang->attend->setManager}");?></li>
      </ul>
    </nav>
  </div>
  <div class='main'>
<?php endif;?>
    <div class='panel'>
      <div class='panel-heading'><?php echo $lang->attend->beginDate->personal;?></div>
      <div class='panel-body'>
<?php include '../../common/view/form.html.php';?>
<script>$(function(){$.ajaxForm('#ajaxForm');})</script>
        <form id='ajaxForm' method='post'>
          <table class='table table-condensed table-borderless w-p40'>
            <?php foreach($config->attend->beginDate as $account => $date):?>
            <?php if($account == 'company') continue;?>
            <tr>
              <td class='w-120px'><?php echo html::select("account[]", $users, $account, "class='form-control chosen'");?></td>
              <td><?php echo html::input("date[]", $date, "class='form-control form-date'");?></td>
              <td class='w-100px'>
                <a class='btn addItem'><i class='icon icon-plus'></i></a>
                <a class='btn delItem'><i class='icon icon-remove'></i></a>
              </td>
            </tr>
            <?php endforeach;?>
            <tr>
              <td class='w-120px'><?php echo html::select("account[]", $users, '', "class='form-control chosen'");?></td>
              <td><?php echo html::input("date[]", '', "class='form-control form-date'");?></td>
              <td class='w-100px'>
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
