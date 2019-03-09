<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th><?php echo $lang->build->product;?></th>
      <th class='text-center w-100px'><?php echo $lang->build->date;?></th>
    </tr>
  </thead>
  <?php foreach($builds as $build):?>
  <tr class= 'text-center' data-id='<?php echo $build->id ?>' data-url='<?php echo $this->createLink('build', 'view', 'buildID=' . $build->id);?>'>
    <td class='text-left'><?php echo $build->name;?></td>
    <td class='text-left'><?php echo $build->productName;?></td>
    <td><?php echo $build->date;?></td>
  </tr>
  <?php endforeach;?>
</table>
