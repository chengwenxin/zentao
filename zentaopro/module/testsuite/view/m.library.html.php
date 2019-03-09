<?php
/**
 * The library mobile view file of testsuite module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testsuite
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
</div>

<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('testsuite', 'library', http_build_query($this->app->getParams()));?>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th><?php echo $lang->testcase->title;?></th>
          <th class='w-80px text-center'><?php echo $lang->testcase->status;?></th>
        </tr>
      </thead>
      <?php foreach($cases as $case):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('testcase', 'view', "caseID={$case->id}")?>' data-id='<?php echo$case->id;?>'>
        <td class='text-left'>
        <?php if($case->branch) echo "<span title='{$lang->product->branchName[$product->type]}' class='label label-branch label-badge'>{$branches[$case->branch]}</span> "?>
        <?php if($modulePairs and $case->module) echo "<span title='{$lang->testcase->module}' class='label label-info label-badge'>{$modulePairs[$case->module]}</span> "?>
        <?php echo "<span style='color:$case->color'>" . $case->title . '</span>';?>
        </td>
        <td class='testcase-<?php echo $case->status;?>'><?php echo zget($lang->testcase->statusList, $case->status);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <nav class='nav justified pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "libID=$libID&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
  $sortOrders = array('id', 'pri', 'title', 'status', 'openedBy', 'openedDate', 'type', 'lastRunner', 'lastRunDate', 'lastRunResult');
  foreach ($sortOrders as $order)
  {
      commonModel::printOrderLink($order, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->testcase->{$order}));
  }
  ?>
</div>
<?php include '../../common/view/m.footer.html.php';?>
