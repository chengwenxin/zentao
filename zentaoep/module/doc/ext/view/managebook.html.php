<?php include '../../../common/view/header.html.php';?>
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
          <?php if($browseType != 'fastsearch'):?>
          <i class="icon icon-book text-muted"></i>
          <?php else:?>
          <i class="icon icon-search text-muted"></i>
          <?php endif;?>
          <?php echo $book->name;?>
        </div>
        <nav class="panel-actions btn-toolbar">
          <div class="dropdown">
            <button class="btn" type="button" data-toggle="dropdown"><i class='icon-cog'></i> <span class="caret"></span></button>
            <ul class='dropdown-menu'>
              <li><?php common::printLink('doc', 'catalog', "libID={$book->id}&nodeID=0", "<i class='icon icon-plus'></i>" . $lang->doc->catalog);?></li>
              <li><?php common::printLink('doc', 'editLib', "libID=$book->id", "<i class='icon icon-edit'></i>" . $lang->edit, '', "class='iframe'");?></li>
              <li><?php common::printLink('doc', 'deleteLib',  "libID=$book->id", "<i class='icon icon-close'></i>" . $lang->delete, 'hiddenwin');?></li>
            </ul>
          </div>
        </nav>
      </div>
      <div class='panel-body'>
        <?php if(empty($catalog)):?>
        <div class="table-empty-tip">
          <p>
            <span class="text-muted"><?php echo $lang->doc->addCatalogTip;?></span>
            <?php echo html::a(helper::createLink('doc', 'catalog', "bookID={$book->id}&nodeID=0"), "<i class='icon icon-plus'></i>" . $lang->doc->catalog, '',"class='btn btn-info'");?>
          <p>
        </div>
        <?php else:?>
        <div class='books'><?php echo $catalog;?></div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
