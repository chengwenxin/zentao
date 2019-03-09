<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $lang->testtask->name;?></th>
      <th class='text-center w-100px'><?php echo $lang->testtask->begin;?></th>
      <th class='text-center w-100px'><?php echo $lang->testtask->end;?></th>
    </tr>
  </thead>
  <?php foreach($testtasks as $testtask):?>
  <tr class= 'text-center' data-id='<?php echo $testtask->id ?>' data-url='<?php echo $this->createLink('testtask', 'view', 'testtaskID=' . $testtask->id);?>'>
    <td class='text-left'><?php echo $testtask->name;?></td>
    <td><?php echo $testtask->begin;?></td>
    <td><?php echo $testtask->end;?></td>
  </tr>
  <?php endforeach;?>
</table>
