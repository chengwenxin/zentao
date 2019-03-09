<?php
/**
 * The manageStep view file of deploy module of ZenTaoPMS.
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
<?php include '../../common/view/datepicker.html.php';?>
<?php $width = 100 / count($lang->deploy->stageList);?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2>
      <span class='label lable-id'><?php echo $deploy->id;?></span>
      <?php echo $deploy->name . $lang->colon . $lang->deploy->manageStep;?>
      <span class='label label-info'><?php echo substr($deploy->begin, 0, 16) . ' ~ ' . substr($deploy->end, 0, 16)?></span>
    </h2>
  </div>
  <div>
    <form class='main-table' method='post' target='hiddenwin'>
      <table class='table table-form table-fixed with-border'>
        <thead>
          <tr>
            <th class='w-30px'><?php echo $lang->idAB?></th>
            <th class='w-100px'><?php echo $lang->deploy->stage?></th>
            <th class='w-140px required'><?php echo $lang->deploy->begin?></th>
            <th class='w-140px required'><?php echo $lang->deploy->end?></th>
            <th class='required'><?php echo $lang->deploy->title?></th>
            <th><?php echo $lang->deploy->content?></th>
            <th class='w-120px'><?php echo $lang->deploy->assignedTo?></th>
            <th class='w-120px'><?php echo $lang->actions?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $lang->deploy->stageList['ditto'] = $lang->deploy->ditto;
          $users['ditto'] = $lang->deploy->ditto;
          ?>
          <?php if(empty($stepGroups)):?>
          <?php for($i = 1; $i <= 10; $i++):?>
          <tr>
            <td class='text-center'><?php echo $i?></td>
            <td><?php echo html::select('stage[]', $lang->deploy->stageList, $i > 1 ? 'ditto' : '', "class='form-control'")?></td>
            <td><?php echo html::input('begin[]', '', "class='form-control form-datetime'")?></td>
            <td><?php echo html::input('end[]', '', "class='form-control form-datetime'")?></td>
            <td><?php echo html::input('title[]', '', "class='form-control'")?></td>
            <td><?php echo html::textarea('content[]', '', "class='form-control' rows='1'")?></td>
            <td style='overflow:visible'><?php echo html::select('assignedTo[]', $users, $i > 1 ? 'ditto' : '', "class='form-control chosen'")?></td>
            <td>
              <div class='btn-group'>
                <?php echo html::commonButton("<i class='icon icon-plus'></i>", "onclick='addStepItem(this)'");?>
                <?php echo html::commonButton("<i class='icon icon-trash'></i>", "onclick='removeStepItem(this)'");?>
              </div>
            </td>
          </tr>
          <?php endfor;?>
          <?php else:?>
          <?php $i = 1;?>
          <?php foreach($lang->deploy->stageList as $stage => $name):?>
          <?php if(!isset($stepGroups[$stage])) $stepGroups[$stage] = array();?>
          <?php foreach($stepGroups[$stage] as $step):?>
          <tr>
            <td class='text-center'><?php echo $i?></td>
            <td><?php echo html::select('stage[]', $lang->deploy->stageList, $step->stage, "class='form-control'")?></td>
            <td><?php echo html::input('begin[]', $step->begin == '0000-00-00 00:00:00' ? '' : substr($step->begin, 0, 16), "class='form-control form-datetime'")?></td>
            <td><?php echo html::input('end[]', $step->end == '0000-00-00 00:00:00' ? '' : substr($step->end, 0, 16), "class='form-control form-datetime'")?></td>
            <td><?php echo html::input('title[]', $step->title, "class='form-control'")?></td>
            <td><?php echo html::textarea('content[]', str_replace(array('<br>', '<br />'), '', $step->content), "class='form-control' rows='1'")?></td>
            <td style='overflow:visible'><?php echo html::select('assignedTo[]', $users, $step->assignedTo, "class='form-control chosen'")?></td>
            <td>
              <div class='btn-group'>
                <?php echo html::commonButton("<i class='icon icon-plus'></i>", "onclick='addStepItem(this)'");?>
                <?php echo html::commonButton("<i class='icon icon-trash'></i>", "onclick='removeStepItem(this)'");?>
              </div>
              <?php echo html::hidden('id[]', $step->id);?>
            </td>
          </tr>
          <?php $i++;?>
          <?php endforeach;?>
          <?php endforeach;?>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan='8' class='text-center form-actions'>
              <?php echo html::submitButton();?>
              <?php echo html::backButton();?>
            </td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
