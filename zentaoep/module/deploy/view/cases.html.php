<?php
/**
 * The cases view file of deploy module of ZenTaoPMS.
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
<div id='mainMenu' class='clearfix'>
  <?php include './nav.html.php';?>
  <div class='btn-toolbar pull-right'>
    <?php
    $browseLink = $this->session->stepList ? $this->session->stepList :  inlink('steps', "deployID=$deploy->id");
    $params     = "deployID=$deploy->id";
    common::printLink('deploy', 'linkCases', $params, "<i class='icon icon-link'></i> " . $lang->deploy->linkCases, '', "class='btn'");
    echo html::linkButton("<i class='icon-level-up icon-large icon-rotate-270'></i> " . $lang->goback, $browseLink);
    ?>
  </div>
</div>
<div id='mainContent'>
  <form class='main-table' method='post' data-ride='table' target='hiddenwin' action='<?php echo $this->createLink('deploy', 'batchUnlinkCases', "deployID={$deploy->id}")?>'>
    <table class='table table-condensed table-fixed'>
      <thead>
        <tr>
          <th class="w-100px">
            <?php if(common::hasPriv('deploy', 'batchUnlinkCases')):?>
            <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
              <label></label>
            </div>
            <?php endif;?>
            <?php echo $lang->idAB?>
          </th>
          <th class='w-pri'><?php echo $lang->priAB?></th>
          <th><?php echo $lang->testcase->title?></th>
          <th class='w-70px'><?php echo $lang->testcase->type?></th>
          <th class='w-50px'><?php echo $lang->actions?></th>
        <tr>
      </thead>
      <tbody>
        <?php foreach($cases as $case):?>
        <tr>
          <td class='c-id'>
            <?php if(common::hasPriv('deploy', 'batchUnlinkCases')):?>
            <?php echo html::checkbox('idList', array($case->id => $case->id));?>
            <?php endif;?>
          </td>
          <td><span class="label-pri label-pri-<?php echo $case->pri?>"><?php echo zget($lang->testcase->priList, $case->pri)?></span></td>
          <td title='<?php echo $case->title?>'><?php echo html::a($this->createLink('testcase', 'view', "id={$case->id}"), $case->title);?></td>
          <td><?php echo zget($lang->testcase->typeList, $case->type, '');?></td>
          <td class='c-actions'><?php common::printLink('deploy', 'unlinkCase', "deploy=$deploy->id&id=$case->id", "<i class='icon icon-unlink'></i>", 'hiddenwin', "class='btn'");?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <?php if(common::hasPriv('deploy', 'batchUnlinkCases') and $cases):?>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class='table-actions btn-toolbar'>
        <?php echo html::submitButton($lang->deploy->unlinkCase, '', 'btn btn-primary');?>
      </div>
    </div>
    <?php endif;?>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
