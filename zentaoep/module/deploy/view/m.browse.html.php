<?php include '../../common/view/m.header.html.php';?>
<section id='page' class='section list-with-actions list-with-pager'>
  <?php foreach($lang->deploy->dateList as $dateKey => $dateName):?>
  <table class="table bordered">
    <thead>
    <tr>
      <th><?php echo $dateName?></th>
      <th class="text-center w-70px"><?php echo $lang->deploy->owner?></th>
      <th class="text-center w-120px hidden"><?php echo $lang->actions?></th>
      <th class="text-center w-120px"><?php echo $lang->deploy->result?></th>
    </tr>
    </thead>
    <tbody>
      <?php foreach($plans[$dateKey] as $plan):?>
      <tr class="text-center" data-id="4" data-url="<?php echo $this->createLink('deploy', 'steps', "id=$plan->id");?>">
        <td class="text-left">
          <?php
          $begin = ($dateKey == 'today' or $dateKey == 'tomorrow') ? substr($plan->begin, 11, 5) : substr($plan->begin, 5, 11);
          $end   = ($dateKey == 'today' or $dateKey == 'tomorrow') ? substr($plan->end, 11, 5) : substr($plan->end, 5, 11);
          $time  = ($dateKey == 'today' or $dateKey == 'tomorrow') ? "$begin ~ $end" : $begin;
          echo html::a($this->createLink('deploy', 'steps', "id=$plan->id"), $time . ' ' . $plan->name, '', 'title="' . $plan->name . '"');
          ?>
        </td>
        <td><?php echo zget($users, $plan->owner);?></td>
        <td class="hidden">
          <?php if(common::hasPriv('deploy', 'finish', $plan) and deployModel::isClickable($plan, 'finish')):?>
          <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('deploy', 'finish', "deployID=$plan->id", '', 'true');?>'><?php echo $lang->deploy->finish;?></a>
          <?php endif;?>
          <?php if(common::hasPriv('deploy', 'activate', $plan) and deployModel::isClickable($plan, 'activate')):?>
          <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('deploy', 'activate', "deployID=$plan->id", '', 'true');?>'><?php echo $lang->deploy->activate;?></a>
          <?php endif;?>
          <?php if(common::hasPriv('deploy', 'edit', $plan)):?>
          <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('deploy', 'edit', "deployID=$plan->id", '', 'true');?>'><?php echo $lang->deploy->edit;?></a>
          <?php endif;?>
          <?php if(common::hasPriv('deploy', 'delete', $plan)):?>
          <a href='<?php echo $this->createLink('deploy', 'delete', "deployID=$plan->id", '', 'true');?>' target="hiddenwin"><?php echo $lang->deploy->delete;?></a>
          <?php endif;?>
        </td>
        <td><?php echo zget($lang->deploy->resultList, $plan->result);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php endforeach; ?>
</section>
<?php include '../../common/view/m.footer.html.php';?>
