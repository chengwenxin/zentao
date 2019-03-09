<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th class='text-center w-70px'><?php echo $lang->story->statusList['active'];?></th>
      <th class='text-center w-70px'><?php echo $lang->product->plans;?></th>
      <th class='text-center w-70px'><?php echo $lang->product->releases;?></th>
    </tr>
  </thead>
  <?php foreach($productStats as $product):?>
  <tr class= 'text-center' data-id='<?php echo $product->id ?>' data-url='<?php echo $this->createLink('product', 'browse', 'productID=' . $product->id);?>'>
    <td class='text-left'><?php echo $product->name;?></td>
    <td><?php echo $product->stories['active'];?></td>
    <td><?php echo $product->plans;?></td>
    <td><?php echo $product->releases;?></td>
  </tr>
  <?php endforeach;?>
</table>
