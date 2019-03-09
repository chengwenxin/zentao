<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th><?php echo $lang->release->build;?></th>
      <th class='text-center w-100px'><?php echo $lang->release->date;?></th>
    </tr>
  </thead>
  <?php foreach($releases as $release):?>
  <tr class= 'text-center' data-id='<?php echo $release->id ?>' data-url='<?php echo $this->createLink('release', 'view', 'releaseID=' . $release->id);?>'>
    <td class='text-left'><?php echo $release->name;?></td>
    <td class='text-left'><?php echo $release->buildName;?></td>
    <td><?php echo $release->date;?></td>
  </tr>
  <?php endforeach;?>
</table>
