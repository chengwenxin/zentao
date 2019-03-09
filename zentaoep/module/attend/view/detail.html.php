<?php
/**
 * The detail view file of attend module of RanZhi.
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
<?php $lang->attend->abbrStatusList['rest'] = '';?>
<div id='menuActions'>
  <?php extCommonModel::printLink('attend', 'exportDetail', "date=$currentYear$currentMonth", $lang->attend->export, "class='iframe btn btn-primary'")?>
</div>
<div class='with-side'>
  <div class='side'>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $currentYear . ($this->app->clientLang != 'en' ? $lang->year : '') . $lang->attend->detail;?></strong></div>
      <div class='panel-body'>
      <?php 
        $lastmonth = $currentYear == date('Y') ? date('m') : 12;
        for($month = 1; $month <= $lastmonth; $month++)
        {
            $class = $month == $currentMonth ? 'btn-primary' : '';
            $month = $month < 10 ? '0' . $month : $month;
            echo "<div class='col-xs-3 monthDIV'>" . baseHTML::a(inlink('detail', "date=$currentYear$month"), $month . ($this->app->clientLang != 'en' ? $lang->month : ''), "class='btn btn-mini $class'") . '</div>';
        }
      ?>
      </div>
    </div>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->attend->search;?></strong></div>
      <div class='panel-body'>
        <form id='searchForm' method='post' action='<?php echo inlink('detail');?>'>
          <div class='form-group'>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->user->dept;?></span>
              <?php echo html::select('dept', $deptList, $dept, "class='form-control chosen'");?>
            </div>
          </div>
          <div class='form-group'>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->attend->user;?></span>
              <?php echo html::select('account', $userList, $account, "class='form-control chosen'");?>
            </div>
          </div>
          <div class='form-group'>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->attend->date;?></span>
              <?php echo html::input('date', $date, "class='form-control form-month'");?>
            </div>
          </div>
          <div class='form-group'><?php echo baseHTML::submitButton($lang->attend->search);?></div>
        </form>
      </div>
    </div>
  </div>
  <div class='main'>
    <div class='panel'>
      <div class='panel-heading text-center'>
        <strong><?php echo $fileName;?></strong>
      </div>
      <table class='table table-data table-bordered text-center table-fixedHeader'>
        <thead>
          <tr class='text-center'>
            <th><?php echo $lang->user->dept;?></th>
            <th><?php echo $lang->attend->user;?></th>
            <th><?php echo $lang->attend->date;?></th>
            <th><?php echo $lang->attend->dayName;?></th>
            <th><?php echo $lang->attend->status;?></th>
            <th><?php echo $lang->attend->signIn;?></th>
            <th><?php echo $lang->attend->signOut;?></th>
            <th><?php echo $lang->attend->ip;?></th>
          </tr>
        </thead>
        <?php foreach($attends as $attend):?>
        <tr>
          <td><?php echo $attend->dept;?></td>
          <td><?php echo $attend->realname;?></td>
          <td><?php echo $attend->date;?></td>
          <td><?php echo $attend->dayName;?>
          <td><?php echo empty($attend->desc) ? $attend->status : $attend->desc;?></td>
          <td><?php echo $attend->signIn;?></td>
          <td><?php echo $attend->signOut;?></td>
          <td><?php echo $attend->ip;?></td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
