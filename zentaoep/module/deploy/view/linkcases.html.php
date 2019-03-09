<?php
/**
 * The linkCases view file of deploy module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     deploy
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainContent' class='main-content clearfix'>
  <div class='main-header'>
    <h2>
      <span class='label label-id'><?php echo $deploy->id;?></span>
      <?php echo $deploy->name?>
      <small class='text-muted'> <?php echo $lang->deploy->linkCases;?> <?php echo html::icon($lang->icons['link']);?></small>
      <div class='heading-actions' style='display: inline-block; margin-top: -5px; margin-left: 10px;'>
        <?php
        echo "<span class='dropdown'>";
        echo "<button class='btn btn-primary btn-sm' type='button' data-toggle='dropdown'>{$lang->testtask->linkBySuite} <span class='caret'></span></button>";
        echo "<ul class='dropdown-menu' style='max-height:240px;overflow-y:auto'>";
        if($suiteList)
        {
            foreach($suiteList as $suiteID => $suite)
            {
                $active = ($type == 'bysuite' and (int)$param == $suiteID) ? "class='active'" : '';
                $suiteName = $suite->name;
                if($suite->type == 'public') $suiteName .= " <span class='label label-info'>{$lang->testsuite->authorList[$suite->type]}</span>";
                echo "<li $active>" . html::a(inlink('linkCases', "deployID=$deploy->id&type=bysuite&param=$suiteID"), $suiteName) . "</li>";
            }
        }
        else
        {
            echo "<li>" . html::a('###', $lang->testsuite->noticeNone) . "</li>";
        }
        echo "</ul></span>";
        ?>
      </div>
    </h2>
    <div class='pull-right btn-toolbar'>
      <?php echo html::linkButton("<i class='icon-level-up icon-large icon-rotate-270'></i> {$lang->goback}", inlink('cases', "deployID=$deploy->id"));?>
    </div>
  </div>
  <div id='queryBox' class='show'></div>
  <form class='main-table' method='post' data-ride="table" target='hiddenwin'>
    <table class='table table-condensed table-hover table-striped table-fixed'>
      <caption class='text-left text-muted'>
        <?php echo html::icon('unlink');?> &nbsp;<strong><?php echo $lang->testtask->unlinkedCases;?></strong> (<?php echo $pager->recTotal;?>)
      </caption>
      <thead>
        <tr>
          <th class='c-id'>
            <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
              <label></label>
            </div>
            <?php echo $lang->idAB;?>
          </th>
          <th class='w-pri'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->testcase->title;?></th>
          <th class='w-type'><?php echo $lang->testcase->type;?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($cases as $case):?>
      <tr>
        <td class='c-id'>
          <div class="checkbox-primary">
            <input type='checkbox' name='cases[]' value='<?php echo $case->id;?>' />
            <label></label>
          </div>
          <?php printf('%03d', $case->id);?>
        </td>
        <td><span class='label-pri <?php echo 'label-pri-' . $case->pri?>'><?php echo zget($lang->testcase->priList, $case->pri, $case->pri)?></span></td>
        <td class='text-left'><?php echo $case->title;?></td>
        <td><?php echo $lang->testcase->typeList[$case->type];?></td>
      </tr>
      <?php endforeach;?>
      </tbody>
    </table>
    <?php if($cases):?>
    <div class='table-footer'> 
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class='table-actions btn-toolbar'><?php echo html::submitButton('', '', 'btn btn-primary');?></div>
      <?php echo html::backButton('', '', 'btn');?>
      <?php $pager->show('right', 'pagerjs');?>
      </td>
    </div>
    <?php endif;?>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
