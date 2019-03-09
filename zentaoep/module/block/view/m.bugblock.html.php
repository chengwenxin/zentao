<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $lang->bug->title;?></th>
      <th class='text-center w-70px'><?php echo $lang->bug->severityAB;?></th>
      <th class='text-center w-70px'><?php echo $lang->bug->statusAB;?></th>
    </tr>
  </thead>
  <?php foreach($bugs as $bug):?>
  <tr class= 'text-center' data-id='<?php echo $bug->id ?>' data-url='<?php echo $this->createLink('bug', 'view', 'bugID=' . $bug->id);?>'>
    <td class='text-left'><?php echo $bug->title;?></td>
    <td><?php echo zget($lang->bug->severityList, $bug->severity, $bug->severity);?></td>
    <td><?php echo zget($lang->bug->statusList, $bug->status, $bug->status);?></td>
  </tr>
  <?php endforeach;?>
</table>
