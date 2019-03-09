<?php
/**
 * The browse view file of overtime module of Ranzhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     overtime
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
    foreach($lang->overtime->featurebar as $key => $menu)
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

<?php js::set('confirmReview', $lang->overtime->confirmReview)?>
<div id='menuActions'>
  <?php extCommonModel::printLink('oa.overtime', 'export', "mode=all&orderBy={$orderBy}", $lang->exportIcon . $lang->export, "class='btn btn-primary iframe' data-width='700'");?>
  <?php extCommonModel::printLink('oa.overtime', 'create', "", "<i class='icon icon-plus'></i> {$lang->overtime->create}", "data-toggle='modal' class='btn btn-primary'")?>
</div>
<?php if($type != 'browseReview'):?>
<div class='with-side'>
  <div class='side'>
    <div class='panel panel-sm'>
      <div class='panel-body'>
        <ul class='tree' data-collapsed='true'>
          <?php foreach($yearList as $year):?>
          <li class='<?php echo $year == $currentYear ? 'active' : ''?>'>
            <?php extCommonModel::printLink('oa.overtime', $type, "date=$year", $year);?>
            <ul>
              <?php foreach($monthList[$year] as $month):?>
              <li class='<?php echo ($year == $currentYear and $month == $currentMonth) ? 'active' : ''?>'>
                <?php extCommonModel::printLink('oa.overtime', $type, "date=$year$month", $year . $month);?>
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
<?php endif;?>
<?php $batchReview = $type == 'browseReview' && commonModel::hasPriv('overtime', 'batchReview');?>
    <div class='panel'>
      <?php if($batchReview):?>
      <form id='batchReviewForm' method='post' action='<?php echo inlink('batchReview', 'status=pass');?>'>
      <?php endif;?>
      <table class='table table-hover text-center table-fixed tablesorter' id='overtimeTable'>
        <thead>
          <tr class='text-center'>
            <?php $vars = "&date={$date}&orderBy=%s";?>
            <th class='w-80px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->overtime->id, 'overtime', $type);?></th>
            <th class='w-80px'><?php commonModel::printOrderLink('createdBy', $orderBy, $vars, $lang->overtime->createdBy, 'overtime', $type);?></th>
            <th class='w-80px visible-lg'><?php echo $lang->user->dept;?></th>
            <th class='w-80px'><?php commonModel::printOrderLink('type', $orderBy, $vars, $lang->overtime->type, 'overtime', $type);?></th>
            <th class='w-150px'><?php commonModel::printOrderLink('begin', $orderBy, $vars, $lang->overtime->begin, 'overtime', $type);?></th>
            <th class='w-150px'><?php commonModel::printOrderLink('end', $orderBy, $vars, $lang->overtime->end, 'overtime', $type);?></th>
            <th class='w-70px visible-lg'><?php commonModel::printOrderLink('hours', $orderBy, $vars, $lang->overtime->hours, 'overtime', $type);?></th>
            <th class='text-left'><?php echo $lang->overtime->desc;?></th>
            <th class='w-100px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->overtime->status, 'overtime', $type);?></th>
            <?php if($type == 'personal'):?>
            <?php $class = $this->app->clientLang == 'en' ? 'w-180px' : 'w-130px';?>
            <th class='<?php echo $class;?>'><?php echo $lang->actions;?></th>
            <?php else:?>
            <?php $class = $this->app->clientLang == 'en' ? 'w-130px' : 'w-100px';?>
            <th class='<?php echo $class;?>'><?php echo $lang->actions;?></th>
            <?php endif;?>
          </tr>
        </thead>
        <?php foreach($overtimeList as $overtime):?>
        <?php $viewUrl = commonModel::hasPriv('oa.overtime', 'view') ? $this->createLink('overtime', 'view', "id=$overtime->id&type=$type") : '';?>
        <tr id='overtime<?php echo $overtime->id;?>' data-url='<?php echo $viewUrl;?>'>
          <td class='idTD'>
            <?php if($batchReview):?>
            <label class='checkbox-inline'><input type='checkbox' name='overtimeIDList[]' value='<?php echo $overtime->id;?>'/> <?php echo $overtime->id;?></label>
            <?php else:?>
            <?php echo $overtime->id;?>
            <?php endif;?>
          </td>
          <td><?php echo zget($users, $overtime->createdBy);?></td>
          <td class='visible-lg'><?php echo zget($deptList, $overtime->dept);?></td>
          <td><?php echo zget($this->lang->overtime->typeList, $overtime->type);?></td>
          <td><?php echo formatTime($overtime->begin . ' ' . $overtime->start, DT_DATETIME2);?></td>
          <td><?php echo formatTime($overtime->end . ' ' . $overtime->finish, DT_DATETIME2);?></td>
          <td class='visible-lg'><?php echo $overtime->hours == 0 ? '' : $overtime->hours;?></td>
          <td class='text-left' title='<?php echo $overtime->desc?>'><?php echo $overtime->desc;?></td>
          <td class='overtime-<?php echo $overtime->status?>'><?php echo $overtime->statusLabel;?></td>
          <td class='actionTD text-left'>
            <?php 
            if($viewUrl) echo baseHTML::a($viewUrl, $lang->detail, "data-toggle='modal'");
            if($type == 'personal')
            {
                $switchLabel = $overtime->status == 'wait' ? $lang->overtime->cancel : $lang->overtime->commit;
                if(strpos(',wait,draft,', ",$overtime->status,") !== false)
                {
                    extCommonModel::printLink('oa.overtime', 'switchstatus', "id=$overtime->id", $switchLabel, "class='reload'");
                }
                else
                {
                    echo baseHTML::a('###', $switchLabel,  "disabled='disabled'");
                }
                if(strpos(',wait,draft,reject,', ",$overtime->status,") !== false)
                {
                    extCommonModel::printLink('oa.overtime', 'edit',   "id=$overtime->id", $lang->edit,   "data-toggle='modal'");
                    extCommonModel::printLink('oa.overtime', 'delete', "id=$overtime->id", $lang->delete, "class='deleter'");
                }
                else
                {
                    echo baseHTML::a('###', $lang->edit,   "disabled='disabled'");
                    echo baseHTML::a('###', $lang->delete, "disabled='disabled'");
                }
            }
            else
            {
                if(strpos(',wait,doing,', ",$overtime->status,") !== false)
                {
                    extCommonModel::printLink('oa.overtime', 'review', "id=$overtime->id&status=pass",   $lang->overtime->statusList['pass'],   "class='reviewPass'");
                    extCommonModel::printLink('oa.overtime', 'review', "id=$overtime->id&status=reject", $lang->overtime->statusList['reject'], "data-toggle='modal'");
                }
                else
                {
                    echo baseHTML::a('###', $lang->overtime->statusList['pass'],   "disabled='disabled'");
                    echo baseHTML::a('###', $lang->overtime->statusList['reject'], "disabled='disabled'");
                }
            }
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
      <?php if($overtimeList && $batchReview):?>
      <?php endif;?>
      <?php if(!$overtimeList):?>
      <?php endif;?>
    </div>
<?php if($type != 'browseReview'):?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
