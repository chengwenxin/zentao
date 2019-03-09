<?php
/**
 * The browse view file of deploy module of ZenTaoPMS.
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
<div id='mainMenu'>
  <div class='heading'>
    <div class='dropdown' style='margin:-8px 0px;'>
      <button class='btn btn-link dropdown-toggle' type='button' data-toggle='dropdown' style='color:rgb(20, 20, 20)'>
        <strong><?php echo date($lang->deploy->monthFormat, strtotime($date))?></strong>
        <span class='caret'></span>
      </button>
      <ul class='dropdown-menu'>
        <?php list($currentYear, $currentMonth) = explode('-', $date);?>
        <?php for($year = date('Y'); $year >= $firstYear; $year--):?>
        <li class='dropdown-submenu'>
          <a href='###'><?php echo $year;?></a>
          <ul class='dropdown-menu'>
            <?php foreach($lang->datepicker->monthNames as $monthKey => $monthName):?>
            <?php $monthKey = sprintf('%02d', ($monthKey + 1));?>
            <li class='<?php echo $monthKey == $currentMonth ? 'active' : ''?>'>
              <?php echo html::a(inlink('browse', "product=$product&date={$year}{$monthKey}"), $monthName);?>
            </li>
            <?php endforeach;?>
          </ul>
        </li>
        <?php endfor;?>
      </ul>
    </div>
  </div>
</div>
<div id='mainContent' class='main-content'>
<div id='kanban'>
  <table class='boards-layout table' id='kanbanHeader'>
    <thead>
      <tr>
        <?php foreach($lang->deploy->dateList as $dateKey => $dateName):?>
        <th class='col-<?php echo $dateKey?>'><?php echo $dateName?></th>
        <?php endforeach;?>
      </tr>
    </thead>
  </table>
  <table class='boards-layout table active-disabled table-bordered' id='kanbanWrapper'>
    <thead>
      <tr>
        <?php foreach($lang->deploy->dateList as $dateKey => $dateName):?>
        <th class='col-<?php echo $dateKey?>'></th>
        <?php endforeach;?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php foreach($lang->deploy->dateList as $dateKey => $dateName):?>
        <td class='col-droppable col-<?php echo $dateKey?>' data-id='<?php echo $dateKey?>'>
          <?php foreach($plans[$dateKey] as $plan):?>
          <div class='board board-deploy board-deploy-<?php echo $dateKey ?>' data-id='<?php echo $plan->id?>' id='deploy-<?php echo $plan->id?>'>
            <div class='board-title'>
              <?php
              $begin = ($dateKey == 'today' or $dateKey == 'tomorrow') ? substr($plan->begin, 11, 5) : substr($plan->begin, 5, 11);
              $end   = ($dateKey == 'today' or $dateKey == 'tomorrow') ? substr($plan->end, 11, 5) : substr($plan->end, 5, 11);
              $time  = ($dateKey == 'today' or $dateKey == 'tomorrow') ? "$begin ~ $end" : $begin;
              echo html::a($this->createLink('deploy', 'steps', "id=$plan->id"), $time . ' ' . $plan->name, '', 'title="' . $plan->name . '"');
              ?>
              <div class='board-actions'>
                <div class='dropdown'>
                  <button type='button' class='btn btn-mini btn-link dropdown-toggle' data-toggle='dropdown'>
                    <span class='icon-ellipsis-v'></span>
                  </button>
                  <div class='dropdown-menu pull-right'>
                    <?php
                    echo (common::hasPriv('deploy', 'finish', $plan)   and deployModel::isClickable($plan, 'finish')) ? html::a($this->createLink('deploy', 'finish',   "deployID=$plan->id", '', 'true'), $lang->deploy->finish, '', "class='kanbanFrame'") : '';
                    echo (common::hasPriv('deploy', 'activate', $plan) and deployModel::isClickable($plan, 'activate')) ? html::a($this->createLink('deploy', 'activate', "deployID=$plan->id", '', 'true'), $lang->deploy->activate, '', "class='kanbanFrame'") : '';
                    echo (common::hasPriv('deploy', 'edit', $plan))   ? html::a($this->createLink('deploy', 'edit',        "deployID=$plan->id", '', 'true'), $lang->deploy->edit, '', "class='kanbanFrame'") : '';
                    echo (common::hasPriv('deploy', 'delete', $plan)) ? html::a($this->createLink('deploy', 'delete',      "deployID=$plan->id"), $lang->deploy->delete, 'hiddenwin') : '';
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class='board-footer clearfix'>
              <span class="deploy-owner" title='<?php echo $lang->deploy->owner?>'>
                <i class='icon icon-user'></i>
                <small> <?php echo zget($users, $plan->owner);?></small>
              </span>
              <span class="deploy-result pull-right <?php if($plan->result == 'fail') echo 'text-danger'?>" title='<?php echo $lang->deploy->result?>'>
                <small> <?php echo zget($lang->deploy->resultList, $plan->result);?></small>
              </span>
            </div>
          </div>
          <?php endforeach;?>
        </td>
        <?php endforeach;?>
      </tr>
    </tbody>
  </table>
</div>
</div>
<?php include '../../common/view/footer.html.php';?>
