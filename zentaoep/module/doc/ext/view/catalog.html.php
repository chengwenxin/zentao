<?php include '../../../common/view/header.html.php';?>
<?php js::set('path', $node ? explode(',', $node->path) : array(0));?>
<?php $spliter = (empty($this->app->user->feedback) && !$this->cookie->feedbackView && $this->from == 'doc') ? true : false;?>
<div class="main-row fade <?php if($spliter) echo 'split-row';?>" id="mainRow">
  <?php if($spliter):?>
  <?php $oldDir = getcwd();
  chdir(dirname(dirname(dirname(__FILE__))) . '/view');
  include './side.html.php';
  chdir($oldDir);
  ?>
  <?php endif;?>
  <div class="main-col" data-min-width="400">
    <div class="cell<?php if($browseType == 'bysearch') echo ' show';?>" id="queryBox"></div>
    <div class="panel block-files block-sm no-margin">
      <div class="panel-heading">
        <div class="panel-title font-normal">
          <i class="icon icon-book text-muted"></i>
          <?php echo $book->name . " <i class='icon-angle-right'></i> " . ($node ? $node->title : $lang->doc->catalog);?>
        </div>
      </div>
      <div class='panel-body'>
        <form class='load-indicator main-form form-ajax' method='post' enctype='multipart/form-data' id='dataform'>
          <table class='table table-form'>
            <thead>
              <tr class='text-center'>
                <th class='w-p10'><?php echo $lang->book->type;?></th>
                <th><?php echo $lang->book->title;?></th>
                <th class='w-p30'><?php echo $lang->book->keywords;?></th>
                <th class='w-80px'><?php echo $lang->actions; ?></th>
              </tr>
            </thead>
      
            <tbody>
              <?php $maxID = 0;?>
              <?php foreach($children as $child):?>
              <?php $maxID = $maxID < $child->id ? $child->id : $maxID;?>
              <tr class='text-center text-middle'>
                <td><?php echo html::select("type[$child->id]",     $lang->book->typeList, $child->type, "class='form-control'");?></td>
                <td><?php echo html::input("title[$child->id]",     $child->title,     "class='form-control'");?></td>
                <td><?php echo html::input("keywords[$child->id]",  $child->keywords,  "class='form-control'");?></td>
                <td>
                  <?php echo html::hidden("order[$child->id]", $child->order, "class='order'");?>
                  <?php echo html::hidden("mode[$child->id]", 'update');?>
                  <i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i>
                </td>
              </tr>
              <?php endforeach;?>
      
              <?php for($i = 0; $i < 5; $i ++):?>
              <tr class='text-center text-middle node'>
                <td><?php echo html::select("type[]", $lang->book->typeList, '', "class='form-control'");?></td>
                <td><?php echo html::input("title[]", '', "class='form-control'");?></td>
                <td><?php echo html::input("keywords[]", '', "class='form-control'");?></td>
                <td>
                  <?php echo html::hidden("order[]", '', "class='order'");?>
                  <?php echo html::hidden("mode[]", 'new');?>
                  <i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i>
                </td>
              </tr>
              <?php endfor;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan='4' class='text-center form-actions'>
                  <?php echo html::submitButton() . html::backButton();?>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php js::set('maxID', $maxID)?>
<?php include '../../../common/view/footer.html.php';?>
