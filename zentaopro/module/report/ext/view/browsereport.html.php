<?php
/**
 * The browseReport view file of report module of ZenTaoPMS.
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
<div id='mainContent' class='main-row'>
  <div class='side-col col-lg'>
    <div class='panel'>
      <div class='panel-heading'>
        <div class='panel-title'><?php echo $lang->report->list;?></div>
      </div>
      <div class='panel-body'>
        <div id='report-list' class='list-group'>
          <?php
          foreach($lang->crystal->moduleList as $module => $name)
          {
              if(empty($name)) $name = $lang->crystal->all;
              $class = $currentModule == $module ? 'selected' : '';
              echo html::a(inlink('browseReport', "module=$module"), '<i class="icon icon-file-text"></i> ' . $name, '', "class='$class'");
          }   
          ?>  
        </div>
      </div>
    </div>
  </div>
  <div class='main-col'>
    <div class='cell'>
      <div class='panel'>
        <div class='main-table' data-ride='table'>
          <table class='table table-condensed table-striped table-bordered table-fixed no-margin'>
            <thead>
              <tr>
                <th class='w-id'><?php echo $lang->crystal->id?></th>
                <th width='260'><?php echo $lang->crystal->name?></th>
                <th><?php echo $lang->crystal->desc?></th>
                <th class='w-100px'><?php echo $lang->crystal->module?></th>
                <th class='w-150px'><?php echo $lang->actions?></th>
              </tr>
            </thead>
            <tbody class='text-center'>
              <?php foreach($reports as $report):?>
              <tr>
                <td><?php echo $report->id;?></td>
                <td class='text-left'>
                  <?php
                  $name = json_decode($report->name, true);
                  if(empty($name)) $name[$this->app->getClientLang()] = $report->name;
                  echo zget($name, $this->app->getClientLang(), '');
                  ?>
                </td>
                <?php
                $desc = json_decode($report->desc, true);
                $desc = zget($desc, $this->app->getClientLang(), '');
                ?>
                <td class='text-left' title='<?php echo $desc?>'><?php echo $desc;?></td>
                <td>
                  <?php
                  $modules = explode(',', trim($report->module, ','));
                  foreach($modules as $module) echo $lang->crystal->moduleList[$module] . ' ';
                  ?>
                </td>
                <td>
                  <?php
                  if(common::hasPriv('report', 'useReport')) echo html::a(inlink('useReport', "reportID=$report->id"), $lang->report->useReport, '', $report->vars ? "data-type='iframe' data-toggle='modal'" : '');
                  if(common::hasPriv('report', 'editReport')) echo html::a(inlink('editReport', "reportID=$report->id"), $lang->report->editReport, '', "data-type='iframe' data-toggle='modal'");
                  if(common::hasPriv('report', 'deleteReport')) echo html::a(inlink('deleteReport', "reportID=$report->id"), $lang->delete, 'hiddenwin');
                  ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <div class='table-footer'>
            <?php $pager->show('right', 'pagerjs');?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
