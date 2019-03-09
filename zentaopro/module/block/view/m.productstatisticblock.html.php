<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th class='text-center w-70px'><?php echo $lang->story->planAB . DS . $lang->productplan->featureBar['browse']['unexpired'];?></th>
      <th class='text-center w-70px'><?php echo $lang->projectCommon . DS . $lang->project->statusList['doing']?></th>
      <th class='text-center w-70px'><?php echo $lang->release->common . DS . $lang->release->statusList['normal']?></th>
    </tr>
  </thead>
  <?php foreach($products as $product):?>
  <tr class= 'text-center' data-id='<?php echo $product->id ?>' data-url='<?php echo $this->createLink('product', 'browse', 'productID=' . $product->id);?>'>
    <td class='text-left'><?php echo $product->name;?></td>

    <?php $totalPlan     = $product->plans ? array_sum($product->plans) : 0;?>
    <?php $unexpiredPlan = $product->plans ? zget($product->plans, 'unexpired', 0) : 0;?>
    <td><?php echo $totalPlan . DS . $unexpiredPlan;?></td>

    <?php $totalProject = $product->projects ? array_sum($product->projects) : 0;?>
    <?php $doingProject = $product->projects ? zget($product->projects, 'doing', 0) : 0;?>
    <td><?php echo $totalProject . DS . $doingProject;?></td>

    <?php $totalRelease  = $product->releases ? array_sum($product->releases) : 0;?>
    <?php $normalRelease = $product->releases ? zget($product->releases, 'normal', 0) : 0;?>
    <td><?php echo $totalRelease . DS . $normalRelease;?></td>
  </tr>
  <?php endforeach;?>
</table>
