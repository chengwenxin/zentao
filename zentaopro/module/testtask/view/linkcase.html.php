<?php
/**
 * The linkcase view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     testtask
 * @version     $Id: linkcase.html.php 4411 2013-02-22 00:56:04Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php common::printBack($this->session->testtaskList, 'btn btn-link');?>
    <div class='divider'></div>
    <?php
    $lang->testtask->linkCase = $lang->testtask->linkByStory;
    $allActive     = $type == 'all' ? 'btn-active-text' : '';
    $bystoryActive = $type == 'bystory' ? 'btn-active-text' : '';
    common::printLink('testtask', 'linkCase', "taskID=$taskID&type=all", "<span class='text'>" . $lang->testtask->allCases . '</span>', '', "class='btn btn-link {$allActive}'");
    common::printLink('testtask', 'linkCase', "taskID=$taskID&type=bystory", "<span class='text'>" . $lang->testtask->linkByStory . '</span>', '', "class='btn btn-link {$bystoryActive}'");

    echo "<div class='btn-group'>";
    $suitViewName = $type == 'bysuite'? $suiteList[$param]->name : $lang->testtask->linkBySuite;
    $suitActive   = $type == 'bysuite' ? 'btn-active-text' : '';
    $bugActive    = $type == 'bybug' ? 'btn-active-text' : '';
    echo "<a href='javascript:;' class='btn btn-link {$suitActive}' data-toggle='dropdown'><span class='text'>{$suitViewName}</span> <span class='caret'></span></a>";
    echo "<ul class='dropdown-menu' style='max-height:240px;overflow-y:auto'>";
    if($suiteList)
    {
        foreach($suiteList as $suiteID => $suite)
        {
            $suiteName = $suite->name;
            if($suite->type == 'public') $suiteName .= " <span class='label label-info'>{$lang->testsuite->authorList[$suite->type]}</span>";
            echo "<li>" . html::a(inlink('linkCase', "taskID=$taskID&type=bysuite&param=$suiteID"), $suiteName) . "</li>";
        }
    }
    else
    {
        echo "<li>" . html::a('###', $lang->testsuite->noticeNone) . "</li>";
    }
    echo "</ul></div>";

    echo "<div class='btn-group'>";
    $buildViewName = $type == 'bybuild'? zget($testTask, $param) : $lang->testtask->linkByBuild;
    $buildActive   = $type == 'bybuild' ? 'btn-active-text' : '';
    echo "<a href='javascript:;' class='btn btn-link {$buildActive}' data-toggle='dropdown'><span class='text'>{$buildViewName}</span> <span class='caret'></span></a>";
    echo "<ul class='dropdown-menu' style='max-height:240px;overflow-y:auto'>";
    if($testTask)
    {
        foreach($testTask as $tmpID => $tmpTitle)
        {
            echo "<li>" . html::a(inlink('linkCase', "taskID=$taskID&type=bybuild&param=$tmpID"), $tmpTitle) . "</li>";
        }
    }
    else
    {
        echo "<li>" . html::a('###', $lang->testtask->noticeNoOther) . "</li>";
    }
    echo "</ul></div>";
    ?>
    <?php common::printLink('testtask', 'linkCase', "taskID=$taskID&type=bybug", "<span class='text'>" . $lang->testtask->linkByBug . '</span>', '', "class='btn btn-link {$bugActive}'");?>
    <?php if($type == 'all') echo "<a class='btn btn-link querybox-toggle' id='bysearchTab'><i class='icon icon-search muted'></i>{$lang->testcase->bySearch}</a>";?>
  </div>
</div>
<div class="cell show" id="queryBox"></div>
<div id='mainContent'>
  <form class='main-table table-case' data-ride='table' method='post'>
    <table class='table tablesorter'>
      <div class="table-header">
        <i class="icon-unlink"></i> &nbsp;<strong><?php echo $lang->testtask->unlinkedCases;?></strong> (<?php echo $pager->recTotal;?>)
      </div>
      <thead>
        <tr>
          <th class='c-id'>
            <?php if($cases):?>
            <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
              <label></label>
            </div>
            <?php endif;?>
            <?php echo $lang->idAB;?>
          </th>
          <th class='w-80px text-center'><nobr><?php echo $lang->testtask->linkVersion;?></nobr></th>
          <th class='c-pri'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->testcase->title;?></th>
          <th class='c-type'><?php echo $lang->testcase->type;?></th>
          <th class='c-user'><?php echo $lang->openedByAB;?></th>
          <th class='w-80px'><?php echo $lang->testtask->lastRunAccount;?></th>
          <th class='w-120px'><?php echo $lang->testtask->lastRunTime;?></th>
          <th class='w-80px'><?php echo $lang->testtask->lastRunResult;?></th>
          <th class='c-status'><?php echo $lang->statusAB;?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($cases as $case):?>
      <tr>
        <td class='cell-id'>
          <?php echo html::checkbox('cases', array($case->id => sprintf('%03d', $case->id)));?>
        </td>
        <td class='text-center'><?php echo html::select("versions[$case->id]", array_combine(range($case->version, 1), range($case->version, 1)), '', 'class="form-control"');?> </td>
        <td><span class='label-pri label-pri-<?php echo $case->pri;?>' title='<?php echo zget($lang->testcase->priList, $case->pri, $case->pri)?>'><?php echo zget($lang->testcase->priList, $case->pri, $case->pri)?></span></td>
        <td class='text-left title' title='<?php echo $case->title?>'>
          <?php
          echo $case->title . ' ( ';
          for($i = $case->version; $i >= 1; $i --)
          {
              echo html::a($this->createLink('testcase', 'view', "caseID=$case->id&version=$i", '', true), "#$i", '', "class='iframe' data-width='95%'");
          }
          echo ')';
          ?>
        </td>
        <td><?php echo $lang->testcase->typeList[$case->type];?></td>
        <td><?php echo zget($users, $case->openedBy);?></td>
        <td><?php echo zget($users, $case->lastRunner);?></td>
        <td><?php if(!helper::isZeroDate($case->lastRunDate)) echo date(DT_MONTHTIME1, strtotime($case->lastRunDate));?></td>
        <td class='<?php echo $case->lastRunResult;?>'><?php if($case->lastRunResult) echo $lang->testcase->resultList[$case->lastRunResult];?></td>
        <td class='case-<?php echo $case->status?>'><?php echo $lang->testcase->statusList[$case->status];?></td>
      </tr>
      <?php endforeach;?>
      </tbody>
    </table>
    <?php if($cases):?>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class="table-actions btn-toolbar show-always"><?php echo html::submitButton('', '', 'btn btn-secondary');?></div>
      <div class="table-statistic"></div>
      <?php $pager->show('right', 'pagerjs');?>
    </div>
    <?php endif;?>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
