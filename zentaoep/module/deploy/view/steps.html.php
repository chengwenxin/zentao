<?php
/**
 * The steps view file of deploy module of ZenTaoPMS.
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
<?php $width = 100 / count($lang->deploy->stageList);?>
<div id='mainMenu' class='clearfix'>
  <?php include './nav.html.php';?>
  <div class='btn-toolbar pull-right'>
    <?php
    $browseLink = $this->session->deployList ? $this->session->deployList :  inlink('browse');
    if(!$deploy->deleted)
    {
        common::printLink('deploy', 'manageStep', $params, "<i class='icon icon-plus'></i> " . $lang->deploy->manageStep, '', "class='btn btn-primary'");
        echo html::linkButton('<i class="icon-goback icon-level-up icon-large icon-rotate-270"></i> ' . $lang->goback, $browseLink);
    }
    else
    {
        echo html::linkButton('<i class="icon-goback icon-level-up icon-large icon-rotate-270"></i> ' . $lang->goback, $browseLink);
    }
    ?>
  </div>
</div>
<div class='main-content' id='kanban'>
  <table class='boards-layout table' id='kanbanHeader'>
    <thead>
      <tr>
        <?php foreach($lang->deploy->stageList as $stage => $name):?>
        <th class='col-<?php echo $stage?>' style='width:<?php echo $width;?>%'><?php echo $name;?></th>
        <?php endforeach;?>
      </tr>
    </thead>
  </table>
  <table class='boards-layout table active-disabled table-bordered' id='kanbanWrapper'>
    <thead>
      <tr>
        <?php foreach($lang->deploy->stageList as $stage => $name):?>
        <th class='col-<?php echo $stage?>' style='width:<?php echo $width;?>%'></th>
        <?php endforeach;?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php foreach($lang->deploy->stageList as $stage => $name):?>
        <td class='col-droppable col-<?php echo $stage?>' data-id='<?php echo $stage?>'>
          <?php if(!isset($stepGroups[$stage])) $stepGroups[$stage] = array();?>
          <?php foreach($stepGroups[$stage] as $step):?>
          <div class='board board-step board-step-<?php echo $step->status ?>' data-id='<?php echo $step->id?>' id='step-<?php echo $step->id?>'>
            <div class='board-title'>
              <?php echo html::a($this->createLink('deploy', 'viewStep', "id=$step->id", '', true), substr($step->begin, 11, 5) . ' ~ ' . substr($step->end, 11, 5) . ' ' . $step->title, '', 'class="kanbanFrame" title="' . $step->title . '"');?>
              <div class='board-actions'>
                <?php if($step->content):?>
                <button type="button" class="btn btn-mini btn-link btn-info-toggle"><i class="icon-angle-down"></i></button>
                <?php endif;?>
                <div class='dropdown'>
                  <button type='button' class='btn btn-mini btn-link dropdown-toggle' data-toggle='dropdown'>
                    <span class='icon-ellipsis-v'></span>
                  </button>
                  <div class='dropdown-menu pull-right'>
                    <?php
                    echo (common::hasPriv('deploy', 'finishStep', $step) and $step->status != 'done') ? html::a($this->createLink('deploy', 'finishStep', "stepID=$step->id", '', true), $lang->deploy->finish, '', "class='kanbanFrame'") : '';
                    echo (common::hasPriv('deploy', 'assignTo', $step))   ? html::a($this->createLink('deploy', 'assignTo', "stepID=$step->id", '', true), $lang->deploy->assignTo, '', "class='kanbanFrame'") : '';
                    echo (common::hasPriv('deploy', 'editStep', $step))   ? html::a($this->createLink('deploy', 'editStep', "stepID=$step->id", '', true), $lang->deploy->edit, '', "class='kanbanFrame'") : '';
                    echo (common::hasPriv('deploy', 'deleteStep', $step)) ? html::a($this->createLink('deploy', 'deleteStep', "stepID=$step->id"), $lang->deploy->delete, 'hiddenwin') : '';
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class='board-body content'><?php echo $step->content?></div>
            <div class='board-footer clearfix'>
              <span class="step-assignedTo" title='<?php echo $lang->deploy->assignedTo?>'>
                <?php echo (common::hasPriv('deploy', 'assignTo', $step)) ? html::a($this->createLink('deploy', 'assignTo', "stepID=$step->id", '', true), "<i class='icon icon-hand-right'></i>", '', "class='kanbanFrame'") : "<i class='icon icon-hand-right'></i>";?>
                <small> <?php echo zget($users, $step->assignedTo, $step->assignedTo);?></small>
              </span>
              <div class='pull-right'>
                <?php if($step->status != 'done'):?>
                <span class='step-status' title='<?php echo $lang->deploy->finish?>'>
                  <?php echo (common::hasPriv('deploy', 'finishStep', $step)) ? html::a($this->createLink('deploy', 'finishStep', "stepID=$step->id", '', true), "<i class='icon icon-ok-sign'></i> " . $lang->deploy->finish, '', "class='kanbanFrame'") : '';?>
                </span>
                <?php endif;?>
                <?php if($step->status == 'done'):?>
                <span class='step-status' title='<?php echo $lang->deploy->status?>'>
                  <i class='icon icon-info'></i> <?php echo zget($lang->deploy->statusList, $step->status);?>
                </span>
                <?php endif;?>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          <?php if($stage == 'testing' and !empty($stepGroups['cases'])):?>
          <?php foreach($stepGroups['cases'] as $case):?>
          <div class='board board-step board-step-<?php echo $stage ?>' data-id='<?php echo $case->id?>' id='case-<?php echo $case->id?>'>
            <div class='board-title'>
              <?php
              echo html::a($this->createLink('testcase', 'view', "id=$case->id", '', true), $case->title, '', 'class="kanbanFrame" title="' . $case->title . '"');
              ?>
              <div class='board-actions'>
                <div class='dropdown'>
                  <button type='button' class='btn btn-mini btn-link dropdown-toggle' data-toggle='dropdown'>
                    <span class='icon-ellipsis-v'></span>
                  </button>
                  <div class='dropdown-menu pull-right'>
                    <?php echo (common::hasPriv('testtask', 'runDeployCase')) ? html::a($this->createLink('testtask', 'runDeployCase', "deployID={$deploy->id}&caseID=$case->id&version=$case->version", '', true), $lang->testtask->runCase, '', "class='kanbanFrame'") : '';?>
                  </div>
                </div>
              </div>
            </div>
            <?php $result = zget($results, $case->id, '');?>
            <?php if($result):?>
            <div class='board-footer clearfix'>
              <span class="case-lastRunner" title='<?php echo $lang->testcase->lastRunner?>'>
                <i class='icon icon-user'></i>
                <small> <?php echo zget($users, $result->lastRunner);?></small>
              </span>
              <div class='pull-right'>
                <span class='step-result' title='<?php echo $lang->testcase->lastRunResult?>'>
                  <?php $hasResultsPriv = common::hasPriv('testtask', 'deployCaseResults', $case);?>
                  <?php if($hasResultsPriv):?>
                  <a href='<?php echo $this->createLink('testtask', 'deployCaseResults', "deployID={$deploy->id}&caseID=$case->id&version=$case->version", '', true)?>' class='iframe' data-width='80%'>
                  <?php endif;?>
                    <i class='icon icon-stack'></i> <?php echo zget($lang->testcase->resultList, $result->caseResult);?>
                  <?php if($hasResultsPriv):?>
                  </a>
                  <?php endif;?>
                </span>
              </div>
            </div>
            <?php endif;?>
          </div>
          <?php endforeach;?>
          <?php endif;?>
        </td>
        <?php endforeach;?>
      </tr>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.html.php';?>
