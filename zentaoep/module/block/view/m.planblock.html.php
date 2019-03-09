<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th class='text-center w-100px'><?php echo $lang->productplan->begin;?></th>
      <th class='text-center w-100px'><?php echo $lang->productplan->end;?></th>
    </tr>
  </thead>
  <?php foreach($plans as $plan):?>
  <tr class= 'text-center' data-id='<?php echo $plan->id ?>' data-url='<?php echo $this->createLink('plan', 'view', 'planID=' . $plan->id);?>'>
    <td class='text-left'><?php echo $plan->title;?></td>
    <td><?php echo $plan->begin;?></td>
    <td><?php echo $plan->end;?></td>
  </tr>
  <?php endforeach;?>
</table>
