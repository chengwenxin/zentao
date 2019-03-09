<?php
/**
 * The action->dynamic view file of dashboard module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dashboard
 * @version     $Id: action->dynamic.html.php 1477 2011-03-01 15:25:50Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php foreach($lang->action->periods as $period => $label):?>
    <?php
    $label  = "<span class='text'>$label</span>";
    $active = '';
    if($period == $browseType)
    {
        $active = 'btn-active-text';
        $label .= " <span class='label label-light label-badge'>{$pager->recTotal}</span>";
    }
    echo html::a(inlink('dynamic', "browseType=$period"), $label, '', "class='btn btn-link $active' id='{$period}'")
    ?>
    <?php endforeach;?>
    <div class="input-control space w-150px"><?php echo html::select('account', $users, $account, 'onchange=changeUser(this.value) class="form-control chosen"');?></div>
    <div class="input-control space w-150px"><?php echo html::select('product', $products, $product, 'onchange=changeProduct(this.value) class="form-control chosen"');?></div>
    <?php if($config->global->flow != 'onlyTest'):?>
    <div class="input-control space w-150px"><?php echo html::select('project', $projects, $project, 'onchange=changeProject(this.value) class="form-control chosen"'); ?></div>
    <?php endif;?>
    <a class="btn btn-link querybox-toggle" id="bysearchTab"><i class="icon icon-search muted"></i> <?php echo $lang->action->dynamic->search;?></a>
  </div>
</div>

<div id='queryBox' class='cell <?php if($browseType =='bysearch') echo 'show';?>'></div>
<div id='mainContent' class='main-content'>
  <div id='dynamics'>
    <?php $firstAction = '';?>
    <?php foreach($dateGroups as $date => $actions):?>
    <?php $isToday = date(DT_DATE4) == $date;?>
    <div class="dynamic <?php if($isToday) echo 'active';?>">
      <div class="dynamic-date">
        <?php if($isToday):?>
        <span class="date-label"><?php echo $lang->action->dynamic->today;?></span>
        <?php endif;?>
        <span class="date-text"><?php echo $date;?></span>
        <button type="button" class="btn btn-info btn-icon btn-sm dynamic-btn"><i class="icon icon-caret-up"></i></button>
      </div>
      <ul class="timeline timeline-tag-left">
        <?php if($direction == 'next') $actions = array_reverse($actions);?>
        <?php foreach($actions as $i => $action):?>
        <?php if(empty($firstAction)) $firstAction = $action;?>
        <li <?php if($action->major) echo "class='active'";?>>
          <div>
            <span class="timeline-tag"><?php echo $action->time?></span>
            <span class="timeline-text">
              <?php echo zget($users, $action->actor) . ' ' . $action->actionLabel;?>
              <?php if($action->action != 'login' and $action->action != 'logout'):?>
              <span class="text-muted"><?php echo $action->objectLabel;?></span>
              <?php echo html::a($action->objectLink, $action->objectName);?>
              <span class="label label-id"><?php echo $action->objectID;?></span>
              <?php endif;?>
            </span>
          </div>
        </li>
        <?php endforeach;?>
      </ul>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php if(!empty($firstAction)):?>
<?php
$firstDate = date('Y-m-d', strtotime($firstAction->originalDate) + 24 * 3600);
$lastDate  = substr($action->originalDate, 0, 10);
$hasPre    = $this->action->hasPreOrNext($firstDate, 'pre');
$hasNext   = $this->action->hasPreOrNext($lastDate, 'next');
$preLink   = $hasPre ? inlink('dynamic', "browseType=$browseType&param=$param&recTotal={$pager->recTotal}&date=" . strtotime($firstDate) . '&direction=pre') : 'javascript:;';
$nextLink  = $hasNext ? inlink('dynamic', "browseType=$browseType&param=$param&recTotal={$pager->recTotal}&date=" . strtotime($lastDate) . '&direction=next') : 'javascript:;';
?>
<?php if($hasPre or $hasNext):?>
<div id="mainActions" class='main-actions'>
  <nav class="container">
    <a id="prevPage" class="btn btn-info<?php if(!$hasNext) echo ' disabled';?>" href="<?php echo $nextLink;?>"><i class="icon icon-chevron-left"></i></a>
    <a id="nextPage" class="btn btn-info<?php if(!$hasPre) echo ' disabled';?>" href="<?php echo $preLink;?>"><i class="icon icon-chevron-right"></i></a>
  </nav>
</div>
<?php endif;?>
<?php endif;?>
<script>
var browseType = '<?php echo $browseType;?>';
$(function()
{
    $('#dynamics').on('click', '.dynamic-btn', function()
    {
        $(this).closest('.dynamic').toggleClass('collapsed');
    });
})
</script>
<?php include '../../common/view/footer.html.php';?>
