<table class='table'> 
  <caption><?php echo $lang->effort->history;?></caption>
  <thead>
    <tr>
      <th class='w-id'><?php echo $lang->idAB;?></th>
      <th class='w-date'><?php echo $lang->effort->date;?></th>
      <th class='w-100px'><?php echo $lang->effort->consumed;?></th>
      <th class='w-60px'><?php echo $lang->effort->account;?></th>
      <th><?php echo $lang->effort->work;?></th>
    </tr>  
  </thead>
  <tbody>
    <?php $times = 0?>
    <?php foreach($efforts as $effort):?>
    <tr class='text-center'>
      <td><?php echo $effort->id;?></td>
      <td><?php echo date(DT_DATE1, strtotime($effort->date));?></td>
      <td><?php if(isset($effort->consumed)) echo $effort->consumed;?></td>
      <td><?php echo zget($users, $effort->account);?> 
      <td class='text-left'><?php echo $effort->work;?></td>
    </tr>  
    <?php $times += $effort->consumed;?>
    <?php endforeach;?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan='5'><?php if($times) printf($lang->company->effort->timeStat, $times);?></td>
    </tr>
  </tfoot>
</table>
