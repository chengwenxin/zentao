<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $lang->todo->name;?></th>
      <th class='text-center w-70px'><?php echo $lang->todo->beginAB;?></th>
      <th class='text-center w-70px'><?php echo $lang->todo->endAB;?></th>
    </tr>
  </thead>
  <?php foreach($todos as $todo):?>
  <tr class= 'text-center' data-id='<?php echo $todo->id ?>' data-url='<?php echo $this->createLink('todo', 'view', 'todoID=' . $todo->id);?>'>
    <td class='text-left'><?php echo $todo->name;?></td>
    <td><?php echo $todo->begin;?></td>
    <td><?php echo $todo->end;?></td>
  </tr>
  <?php endforeach;?>
</table>
