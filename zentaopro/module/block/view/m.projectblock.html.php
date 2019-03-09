<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th class='text-center w-70px'><?php echo $lang->statusAB;?></th>
      <th class='text-center w-70px'><?php echo $lang->project->progress;?></th>
    </tr>
  </thead>
  <?php foreach($projectStats as $project):?>
  <tr class= 'text-center' data-id='<?php echo $project->id ?>' data-url='<?php echo $this->createLink('project', 'task', 'projectID=' . $project->id);?>'>
    <td class='text-left'><?php echo $project->name;?></td>
    <?php if(isset($project->delay)):?>
    <td><?php echo $lang->project->delayed;?></td>
    <?php else:?>
    <td><?php echo $lang->project->statusList[$project->status];?></td>
    <?php endif;?>
    <td><?php echo $project->hours->progress;?>%</td>
  </tr>
  <?php endforeach;?>
</table>
