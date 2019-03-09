<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $lang->task->name;?></th>
      <th class='text-center w-70px'><?php echo $lang->task->estimateAB;?></th>
      <th class='text-center w-70px'><?php echo $lang->statusAB;?></th>
    </tr>
  </thead>
  <?php foreach($tasks as $task):?>
  <tr class= 'text-center' data-id='<?php echo $task->id ?>' data-url='<?php echo $this->createLink('task', 'view', 'taskID=' . $task->id);?>'>
    <td class='text-left'><?php echo $task->name;?></td>
    <td><?php echo $task->estimate;?></td>
    <td><?php echo zget($lang->task->statusList, $task->status, $task->status);?></td>
  </tr>
  <?php endforeach;?>
</table>
