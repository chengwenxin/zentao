<?php
/**
 * The linkcase view file of testsuite module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     testsuite
 * @version     $Id: linkcase.html.php 4411 2013-02-22 00:56:04Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php js::set('flow', $config->global->flow);?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php common::printBack($this->session->testsuiteList, 'btn btn-link');?>
    <div class='divider'></div>
    <div class='page-title'>
      <span class='label label-id'><?php echo $suite->id;?></span>
      <span class='text' title='<?php echo $suite->name;?>'><?php echo $suite->name;?></span>
      <?php echo $lang->arrow . $lang->testsuite->linkCase;?>
    </div>
  </div>
</div>
<div class="cell show" id="queryBox"></div>
<div id='mainContent'>
  <form class='main-table table-testcase' data-ride='table' method='post'>
    <div class="table-header">
      <i class="icon-unlink"></i> &nbsp;<strong><?php echo $lang->testsuite->unlinkedCases;?></strong> (<?php echo $pager->recTotal;?>)
    </div>
    <table class='table tablesorter' id='testcaseList'>
      <thead>
        <tr>
          <th class='w-id'>
            <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
              <label></label>
            </div>
            <?php echo $lang->idAB;?>
          </th>
          <th class='w-70px text-center'><nobr><?php echo $lang->testsuite->linkVersion;?></nobr></th>
          <th class='w-pri text-center'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->testcase->title;?></th>
          <th class='w-type'><?php echo $lang->testcase->type;?></th>
          <th class='w-user text-center'><?php echo $lang->openedByAB;?></th>
          <th class='w-status text-center'><?php echo $lang->statusAB;?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($cases as $case):?>
      <tr class='text-center'>
        <td class='cell-id'>
          <?php echo html::checkbox('cases', array($case->id => sprintf('%03d', $case->id)));?>
        </td>
        <td><?php echo html::select("versions[$case->id]", array_combine(range($case->version, 1), range($case->version, 1)), '', 'class="form-control"');?> </td>
        <td><span class='label-pri label-pri-<?php echo $case->pri;?>' title='<?php echo zget($lang->testcase->priList, $case->pri, $case->pri)?>'><?php echo zget($lang->testcase->priList, $case->pri, $case->pri)?></span></td>
        <td class='text-left'>
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
        <td class='case-<?php echo $case->status?>'><?php echo $lang->testcase->statusList[$case->status];?></td>
      </tr>
      <?php endforeach;?>
      </tbody>
    </table>
    <?php if($cases):?>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class='table-actions btn-toolbar show-always'>
        <?php echo html::submitButton('', '', 'btn btn-secondary');?>
      </div>
      <div class="table-statistic"></div>
      <?php $pager->show('right', 'pagerjs');?>
    </div>
    <?php endif;?>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
