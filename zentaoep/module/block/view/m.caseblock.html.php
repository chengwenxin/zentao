<table class='table bordered'>
  <thead>
    <tr>
      <th><?php echo $lang->case->title;?></th>
      <th class='text-center w-70px'><?php echo $lang->testtask->lastRunResult;?></th>
      <th class='text-center w-70px'><?php echo $lang->statusAB;?></th>
    </tr>
  </thead>
  <?php foreach($cases as $case):?>
  <tr class= 'text-center' data-id='<?php echo $case->id ?>' data-url='<?php echo $this->createLink('case', 'view', 'caseID=' . $case->id);?>'>
    <td class='text-left'><?php echo $case->title;?></td>
    <td><?php if($case->lastRunResult) echo $lang->testcase->resultList[$case->lastRunResult];?></td>
    <td><?php echo $lang->testcase->statusList[$case->status];?></td>
  </tr>
  <?php endforeach;?>
</table>
