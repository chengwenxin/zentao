<?php
/**
 * The browse view file of makeup module of Ranzhi.
 *
 * @copyright   Copyright 2009-2018 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     makeup
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
    foreach($lang->makeup->featurebar as $key => $menu)
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

<?php js::set('confirmReview', $lang->makeup->confirmReview)?>
<div id='menuActions'>
  <?php extCommonModel::printLink('oa.makeup', 'export', "mode=all&orderBy={$orderBy}", $lang->exportIcon . $lang->export, "class='btn btn-primary iframe' data-width='700'");?>
  <?php extCommonModel::printLink('oa.makeup', 'create', '', "<i class='icon icon-plus'></i> {$lang->makeup->create}", "data-toggle='modal' class='btn btn-primary'")?>
</div>
<?php if($type != 'browseReview'):?>
<div class='with-side'>
  <div class='side'>
    <div class='panel panel-sm'>
      <div class='panel-body'>
        <ul class='tree' data-collapsed='true'>
          <?php foreach($yearList as $year):?>
          <li class='<?php echo $year == $currentYear ? 'active' : ''?>'>
            <?php extCommonModel::printLink('oa.makeup', $type, "date=$year", $year);?>
            <ul>
              <?php foreach($monthList[$year] as $month):?>
              <li class='<?php echo ($year == $currentYear and $month == $currentMonth) ? 'active' : ''?>'>
                <?php extCommonModel::printLink('oa.makeup', $type, "date=$year$month", $year . $month);?>
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
<?php $batchReview = $type == 'browseReview' && commonModel::hasPriv('makeup', 'batchReview');?>
    <div class='panel'>
      <?php if($batchReview):?>
      <form id='batchReviewForm' method='post' action='<?php echo inlink('batchReview', 'status=pass');?>'>
      <?php endif;?>
      <table class='table table-hover text-center table-fixed tablesorter' id='makeupTable'>
        <thead>
          <tr class='text-center'>
            <?php $vars = "&date={$date}&orderBy=%s";?>
            <th class='w-50px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->makeup->id, 'makeup', $type);?></th>
            <th class='w-80px'><?php commonModel::printOrderLink('createdBy', $orderBy, $vars, $lang->makeup->createdBy, 'makeup', $type);?></th>
            <th class='w-80px visible-lg'><?php echo $lang->user->dept;?></th>
            <th class='w-120px'><?php commonModel::printOrderLink('begin', $orderBy, $vars, $lang->makeup->begin, 'makeup', $type);?></th>
            <th class='w-120px'><?php commonModel::printOrderLink('end', $orderBy, $vars, $lang->makeup->end, 'makeup', $type);?></th>
            <th class='w-70px visible-lg'><?php commonModel::printOrderLink('hours', $orderBy, $vars, $lang->makeup->hours, 'makeup', $type);?></th>
            <th class='text-left'><?php echo $lang->makeup->desc;?></th>
            <th class='w-100px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->makeup->status, 'makeup', $type);?></th>
            <?php if($type == 'personal'):?>
            <?php $class = $this->app->clientLang == 'en' ? 'w-180px' : 'w-130px';?>
            <th class='<?php echo $class;?>'><?php echo $lang->actions;?></th>
            <?php else:?>
            <?php $class = $this->app->clientLang == 'en' ? 'w-130px' : 'w-100px';?>
            <th class='<?php echo $class;?>'><?php echo $lang->actions;?></th>
            <?php endif;?>
          </tr>
        </thead>
        <?php foreach($makeupList as $makeup):?>
        <?php $viewUrl = commonModel::hasPriv('oa.makeup', 'view') ? $this->createLink('makeup', 'view', "id=$makeup->id&type=$type") : '';?>
        <tr id='makeup<?php echo $makeup->id;?>' data-url='<?php echo $viewUrl;?>'>
          <td class='idTD'>
            <?php if($batchReview):?>
            <label class='checkbox-inline'><input type='checkbox' name='makeupIDList[]' value='<?php echo $makeup->id;?>'/> <?php echo $makeup->id;?></label>
            <?php else:?>
            <?php echo $makeup->id;?>
            <?php endif;?>
          </td>
          <td><?php echo zget($users, $makeup->createdBy);?></td>
          <td class='visible-lg'><?php echo zget($deptList, $makeup->dept, ' ');?></td>
          <td><?php echo formatTime($makeup->begin . ' ' . $makeup->start, DT_DATETIME2);?></td>
          <td><?php echo formatTime($makeup->end . ' ' . $makeup->finish, DT_DATETIME2);?></td>
          <td class='visible-lg'><?php echo $makeup->hours == 0 ? '' : $makeup->hours;?></td>
          <td class='text-left' title='<?php echo $makeup->desc?>'><?php echo $makeup->desc;?></td>
          <td class='makeup-<?php echo $makeup->status?>'><?php echo $makeup->statusLabel;?></td>
          <td class='actionTD text-left'>
            <?php
            if($viewUrl) echo baseHTML::a($viewUrl, $lang->detail, "data-toggle='modal'");
            if($type == 'personal')
            {
                $switchLabel = $makeup->status == 'wait' ? $lang->makeup->cancel : $lang->makeup->commit;
                if(strpos(',wait,draft,', ",$makeup->status,") !== false) 
                {
                    extCommonModel::printLink('oa.makeup', 'switchstatus', "id=$makeup->id", $switchLabel, "class='reload'");
                }
                else
                {
                    echo baseHTML::a('###', $switchLabel,  "disabled='disabled'");
                }
                if(strpos(',wait,draft,reject,', ",$makeup->status,") !== false) 
                {
                    extCommonModel::printLink('oa.makeup', 'edit',   "id=$makeup->id", $lang->edit,   "data-toggle='modal'");
                    extCommonModel::printLink('oa.makeup', 'delete', "id=$makeup->id", $lang->delete, "class='deleter'");
                }
                else
                {
                    echo baseHTML::a('###', $lang->edit,   "disabled='disabled'");
                    echo baseHTML::a('###', $lang->delete, "disabled='disabled'");
                }
            }
            else
            {
                if(strpos(',wait,doing,', ",$makeup->status,") !== false)
                {
                    extCommonModel::printLink('oa.makeup', 'review', "id=$makeup->id&status=pass",   $lang->makeup->statusList['pass'],   "class='reviewPass'");
                    extCommonModel::printLink('oa.makeup', 'review', "id=$makeup->id&status=reject", $lang->makeup->statusList['reject'], "data-toggle='modal'");
                }
                else
                {
                    echo baseHTML::a('###', $lang->makeup->statusList['pass'],   "disabled='disabled'");
                    echo baseHTML::a('###', $lang->makeup->statusList['reject'], "disabled='disabled'");
                }
            }
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
      <?php if($makeupList && $batchReview):?>
      <?php endif;?>
      <?php if(!$makeupList):?>
      <?php endif;?>
    </div>
<?php if($type != 'browseReview'):?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
