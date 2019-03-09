<?php
/**
 * The show view file of report module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2014 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     report
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datatable.html.php';?>
<div id='mainContent' class='main-row'>
  <div class='side-col col-lg'><?php include '../../view/blockreportlist.html.php'?></div>
  <div class='main-col'>
    <?php if($setVars):?>
    <div class="cell">
      <div class="with-padding">
        <form method='post'>
          <div class="table-row" id='conditions'>
            <?php include 'setvarvalues.html.php';?>
            <div class='col-md-3 col-sm-6'><?php echo html::submitButton($lang->crystal->query, '', 'btn btn-primary');?></div>
          </div>
        </form>
      </div>
    </div>
    <?php endif;?>
    <?php if(!empty($dataList) and isset($step)):?>
    <div class='cell'>
      <div class='panel'>
        <div class="panel-heading">
          <div class="panel-title">
            <?php echo $title;?>
            <?php
            $desc = json_decode($report->desc, true);
            $clientLang = $this->app->getClientLang();
            if(!empty($desc[$clientLang])):
            ?>
            <i class="icon icon-exclamation-sign icon-rotate-180"></i>
            <span class="hidden" id="desc"><?php echo $desc[$clientLang];?></span>
            <?php endif;?>
          </div>
          <?php if(common::hasPriv('report', 'crystalExport')):?>
          <nav class="panel-actions btn-toolbar">
            <?php echo html::a($this->createLink('report', 'crystalExport', "step=$step&reportID=$reportID"), $lang->export, '', "data-width='600' class='export btn btn-primary btn-sm'")?>
          </nav>
          <?php endif;?>
        </div>
        <div class='panel-body' style='padding:0px;'>
        <?php if($step == 2):?>
          <?php include 'reportdata.html.php';?>
        </div>
        <?php elseif($step == 1):?>
          <table class='reportData table table-condensed table-striped table-bordered table-fixed datatable' style='width: auto; min-width: 100%' data-fixed-left-width='90'>
            <thead>
              <tr>
                <?php $i = 0;?>
                <?php foreach($fields as $field):?>
                <?php $attr = $i == 0 ? "data-flex='false' data-width='auto'" : "data-flex='true' data-width='90' class='text-center'";?>
                <th <?php echo $attr?>><?php echo $field;?></th>
                <?php $i++;?>
                <?php endforeach;?>
              </tr>
            </thead>
            <tbody>
              <?php foreach($dataList as $data):?>
              <tr>
                <?php foreach($data as $field => $value):?>
                <td><?php echo $value?></td>
                <?php endforeach;?>
              </tr>
              <?php endforeach;?>
            <tbody>
          </table>
        </div>
        <div class='panel-footer'><?php printf($lang->crystal->noticeResult, count($dataList), count($dataList))?></div>
        <?php endif;?>
      </div>
    </div>
    <?php else:?>
    <div class="cell">
      <div class="table-empty-tip">
        <p><span class="text-muted"><?php echo $lang->error->noData;?></span></p>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
