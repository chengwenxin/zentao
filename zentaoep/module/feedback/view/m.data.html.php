<div class='heading'>
  <div class='title'>
    <a id='sortTrigger' class='text-right sort-trigger' data-display data-target='#sortPanel' data-backdrop='true'><i class='icon icon-sort'></i>&nbsp;<span class='sort-name'><?php echo $lang->sort ?></span></a>
  </div>
  <?php if($this->methodName == 'browse'):?>
  <nav class='has-padding'>
    <a data-display='modal' data-placement='bottom' data-remote='<?php echo $this->createLink('feedback', 'create');?>' class='btn primary'><i class='icon icon-plus'> </i> &nbsp;&nbsp;<?php echo $lang->feedback->create;?></a>
  </nav>
  <?php endif;?>
</div>

<section id='page' class='section list-with-actions list-with-pager'>
  <?php $refreshUrl = $this->createLink('feedback', 'browse', "browseType={$browseType}&param=$param&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}");?>
  <div class='box' data-page='<?php echo $pager->pageID;?>' data-refresh-url='<?php echo $refreshUrl;?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th><?php echo $lang->feedback->title;?> </th>
          <th class='text-center w-80px'><?php echo $lang->feedback->status;?> </th>
          <th class='text-center w-80px'><?php echo $lang->feedback->openedBy;?> </th>
        </tr>
      </thead>
      <?php foreach($feedbacks as $feedback):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('feedback', $viewMethod, "feedbackID={$feedback->id}");?>' data-id='<?php echo $feedback->id;?>'>
        <td class='text-left'><?php echo $feedback->title;?></td>
        <td><?php echo zget($lang->feedback->statusList, $feedback->status);?></td>
        <td><?php echo zget($users, $feedback->openedBy);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<div class='list sort-panel hidden affix enter-from-bottom layer' id='sortPanel'>
  <?php
  $vars = "browseType={$browseType}&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";
  $sortOrders = array('id', 'product', 'title', 'status', 'openedBy', 'openedDate', 'processedBy', 'processedDate');
  foreach ($sortOrders as $sortOrder)
  {
      commonModel::printOrderLink($sortOrder, $orderBy, $vars, '<i class="icon icon-sort-indicator"></i>' . ($lang->feedback->{$sortOrder}));
  }
  ?>
</div>

<script>
$('#appnav > a').removeClass('active').filter('[href*="<?php echo $browseType ?>"]').addClass('active');
</script>
