<?php $sysURL = $this->session->notHead ? common::getSysURL() : '';?>
<table class='table main-table' id='legacyBugs'>
  <thead>
    <tr>
      <th class='w-id'>   <?php echo $lang->idAB;?></th>
      <th class='w-pri'>  <?php echo $lang->priAB;?></th>
      <th class='text-left'><?php echo $lang->bug->title;?></th>
      <th class='w-user'> <?php echo $lang->openedByAB;?></th>
      <th class='w-user'> <?php echo $lang->bug->resolvedBy;?></th>
      <th class='w-150px'><?php echo $lang->bug->resolvedDate;?></th>
      <th class='w-100px'> <?php echo $lang->statusAB;?></th>
    </tr>
  </thead>
  <?php if($legacyBugs):?>
  <tbody>
    <?php foreach($legacyBugs as $bug):?>
    <tr>
      <td><?php echo sprintf('%03d', $bug->id);?></td>
      <td><span class='label-pri label-pri-<?php echo $bug->pri;?>' title='<?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?>'><?php echo zget($lang->bug->priList, $bug->pri, $bug->pri);?></span></td>
      <td class='text-left' title='<?php echo $bug->title?>'><?php echo html::a($sysURL . $this->createLink('bug', 'view', "bugID=$bug->id", '', true), $bug->title, '', "data-toggle='modal' data-type='iframe' data-width='90%'");?></td>
      <td><?php echo zget($users, $bug->openedBy);?></td>
      <td><?php echo zget($users, $bug->resolvedBy);?></td>
      <td><?php if($bug->resolvedDate != '0000-00-00 00:00:00') echo substr($bug->resolvedDate, 2);?></td>
      <td title='<?php echo zget($lang->bug->statusList, $bug->status);?>'>
        <span class="status-bug status-<?php echo $bug->status?>">
          <?php echo zget($lang->bug->statusList, $bug->status);?>
        </span>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
  <?php else:?>
  <tr><td class='none-data' colspan='7'><?php echo $lang->testreport->none;?></td></tr>
  <?php endif?>
</table>
