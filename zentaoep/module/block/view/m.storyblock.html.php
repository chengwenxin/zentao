<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $lang->story->title;?></th>
      <th class='text-center w-70px'><?php echo $lang->statusAB;?></th>
      <th class='text-center w-90px'><?php echo $lang->story->stageAB;?></th>
    </tr>
  </thead>
  <?php foreach($stories as $story):?>
  <tr class= 'text-center' data-id='<?php echo $story->id ?>' data-url='<?php echo $this->createLink('story', 'view', 'storyID=' . $story->id);?>'>
    <td class='text-left'><?php echo $story->title;?></td>
    <td><?php echo zget($lang->story->statusList, $story->status, $story->status);?></td>
    <td><?php echo zget($lang->story->stageList, $story->stage, $story->stage);?></td>
  </tr>
  <?php endforeach;?>
</table>
