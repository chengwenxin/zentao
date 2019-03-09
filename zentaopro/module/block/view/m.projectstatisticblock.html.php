<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $title;?></th>
      <th class='text-center w-70px'><?php echo $lang->task->allTasks . DS . $lang->task->noFinished;?></th>
      <th class='text-center w-70px'><?php echo $lang->story->total . DS . $lang->story->unclosed;?></th>
      <th class='text-center w-70px'><?php echo $lang->bug->allBugs . DS . $lang->bug->unResolved;?></th>
    </tr>
  </thead>
  <?php foreach($projects as $project):?>
  <tr class= 'text-center' data-id='<?php echo $project->id ?>' data-url='<?php echo $this->createLink('project', 'task', 'projectID=' . $project->id);?>'>
    <td class='text-left'><?php echo $project->name;?></td>
    <td><?php echo $project->totalTasks . DS . $project->undoneTasks;?></td>
    <td><?php echo $project->totalStories . DS . $project->unclosedStories;?></td>
    <td><?php echo $project->totalBugs . DS . $project->activeBugs;?></td>
  </tr>
  <?php endforeach;?>
</table>
