<?php 
for($i = strtotime($begin); $i <= strtotime($end); $i +=86400)
{
    $days[] = date('Y-m-d', $i); 
}
?>
<div id='dataWrapper'>
<style>
p.todo{margin-bottom:2px; overflow:hidden;}
.effort-list {padding-left: 25px; overflow: hidden;}
.datatable-span.flexarea > .datatable-wrapper {border-right: 1px solid #ddd; overflow: hidden;}
.outer .table tbody td{vertical-align:top;}
.outer .datatable {border: none}
.datatable .table-bordered th {border-bottom: none}
</style>
<table id='datatable' class="calendar table table-condensed table-hover table-bordered table-striped table-fixed">
  <thead>
    <tr class="text-center">
      <th width="100" data-width="100" data-merge-rows='true'><nobr><?php echo $lang->company->dept;?></nobr></th>
      <th width="100" data-width="100" data-merge-rows='true'><nobr><?php echo $lang->company->user;?></nobr></th>
      <?php foreach($days as $day) echo '<th class="flex-col" data-width="200"><nobr>' . $day . '</nobr></th>';?>
    </tr>
  </thead>
  <?php foreach($datas as $deptID => $deptData):?>
    <?php foreach($deptData as $account => $userData):?>
    <?php if(empty($userData)) continue;?>
    <tr valign="top">
      <td valign="middle"><nobr><?php echo isset($depts[$deptID]) ? $depts[$deptID] : $lang->company->currentDept;?></nobr></td>
      <td valign="middle"><nobr><?php echo zget($users, $account);?></nobr></td>
      <?php foreach($days as $day):?>
      <td>
      <nobr>
      <?php 
      if(isset($userData[$day]))
      {
          if($type == 'todo')
          {
              foreach($userData[$day] as $work)
              {
                  echo "<p class='todo' title='{$work['todo']}'>";
                  echo (empty($work['begin'])) ? "<span style='margin-right:75px;'></span>" : '<span>' . $work['begin'] . '~' . $work['end'] . '</span> ';
                  echo $work['todo'] . '</p>';
              }
          }
          else
          {
              echo '<ol class="effort-list">';
              foreach($userData[$day] as $work) echo "<li title='{$work['work']} ({$work['consumed']}h)'>" . $work['work'] . " ({$work['consumed']}h)" . '</li>'; 
              echo '</ol>';
          }
      }
      ?>
      </nobr>
      </td>
      <?php endforeach;?>
    </tr>
    <?php
    unset($deptData[$account]);
    ?>
    <?php endforeach;?>
    <?php foreach($deptData as $account => $userData):?>
    <tr valign="top">
      <td valign="middle"><nobr><?php echo isset($depts[$deptID]) ? $depts[$deptID] : $lang->company->currentDept;?></nobr></td>
      <td valign="middle"><nobr><?php echo zget($users, $account);?></nobr></td>
      <?php foreach($days as $day):?>
      <td></td>
      <?php endforeach;?>
    </tr>
    <?php endforeach;?>
  <?php endforeach;?>
</table>
</div>
