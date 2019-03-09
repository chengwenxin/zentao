<?php
/**
 * The browse view file of attend module of Ranzhi.
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

<?php $lang->attend->abbrStatusList['rest'] = '';?>
<div id='menuActions'>
  <?php extCommonModel::printLink('attend', 'export', "date=$currentYear$currentMonth&company=$company", "{$lang->attend->export}", "class='iframe btn btn-primary'")?>
</div>
<div class='with-side'>
  <div class='side'>
    <div class='panel panel-sm'>
      <div class='panel-body'>
        <ul class='tree' data-collapsed='true'>
          <?php foreach($yearList as $year):?>
          <li class='<?php echo $year == $currentYear ? 'active' : ''?>'>
            <?php extCommonModel::printLink('attend', $company ? 'company' : 'department', "date=$year", $year);?>
            <ul>
              <?php foreach($monthList[$year] as $month):?>
              <li class='<?php echo ($year == $currentYear and $month == $currentMonth) ? 'active' : ''?>'>
                <?php extCommonModel::printLink('attend', $company ? 'company' : 'department', "date=$year$month", $year . $month);?>
              </li>
              <?php endforeach;?>
            </ul>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
    </div>
  </div>
  <div class='main'>
    <div class='panel'>
      <div class='panel-heading text-center'>
        <?php $title = $currentYear;?>
        <?php if($this->app->clientLang != 'en') $title .= $lang->year;?>
        <?php $title .= $currentMonth;?>
        <?php if($this->app->clientLang != 'en') $title .= $lang->month;?>
        <strong><?php echo $title . $lang->attend->report;?></strong>
      </div>
      <table class='table table-data table-bordered text-center table-fixed'>
        <thead>
          <tr class='text-center'>
            <th rowspan='2' class='w-80px text-middle'><?php echo $lang->user->dept;?></th>
            <th rowspan='2' class='w-80px text-middle'><?php echo $lang->user->realname;?></th>
            <?php for($day = 1; $day <= $dayNum; $day++):?>
            <th><?php echo $day?></th>
            <?php endfor;?>
          </tr>
          <tr class='text-center'>
            <?php $weekOffset = date('w', strtotime("$currentYear-$currentMonth-01")) - 1;?>
            <?php for($day = 1; $day <= $dayNum; $day++):?>
            <th><?php echo $lang->datepicker->abbrDayNames[($day + $weekOffset) % 7]?></th>
            <?php endfor;?>
          </tr>
        </thead>
        <?php foreach($attends as $dept => $deptAttends):?>
          <?php $isFirst = true;?>
          <?php foreach($deptAttends as $account => $userAttends):?>
          <tr>
            <?php if($isFirst):?>
            <td rowspan='<?php echo count($deptAttends);?>' class='text-middle'>
              <?php echo isset($users[$account]->dept) ? $deptList[$users[$account]->dept] : ''?>
            </td>
            <?php $isFirst = false;?>
            <?php endif;?>
            <td class='text-middle'><?php echo isset($users[$account]->realname) ? $users[$account]->realname : '';?></td>
            <?php for($day = 1; $day <= $dayNum; $day++):?>
              <?php $currentDate = date("Y-m-d", strtotime("{$currentYear}-{$currentMonth}-{$day}"));?>
              <?php if(isset($userAttends[$currentDate])):?>
              <?php 
              $attend = $userAttends[$currentDate];
              $status = $attend->status;
              if($attend->hoursList)
              {
                  $title  = '';
                  $icon   = '';
                  foreach($attend->hoursList as $status => $hours) 
                  {
                      $title .= $lang->attend->statusList[$status] . $hours . 'h ';
                      $icon  .= $lang->attend->markStatusList[$status];
                  }
              }
              else
              {
                  $title = $lang->attend->statusList[$attend->status];
                  $icon  = $lang->attend->markStatusList[$attend->status];
              }
              ?>
              <td class='attend-status attend-<?php echo $status;?>' title='<?php echo $title;?>'>
                <span><?php echo $icon;?></span>
              </td>
              <?php else:?>
              <td></td>
              <?php endif;?>
            <?php endfor;?>
          </tr>
          <?php endforeach;?>
        <?php endforeach;?>
      </table>
    </div>
    <div class='legend'>
    <?php foreach($lang->attend->markStatusList as $key => $value):?>
      <span class='legend-item attend-<?php echo $key?>'>
        <i class='legend-i'><?php echo $value?></i>
        <?php echo $lang->attend->statusList[$key]?>
      </span>
    <?php endforeach;?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
