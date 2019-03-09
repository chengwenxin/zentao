<?php if($type != 'book'):?>
  <?php
  $oldDir = getcwd();
  chdir(dirname(dirname(dirname(__FILE__))) . '/view');
  include './view.html.php';
  chdir($oldDir);
  ?>
  <?php else:?>
  <?php include '../../../common/view/header.html.php';?>
  <?php $this->session->set('docList', inlink('browse', "bookID={$doc->lib}"));?>
  <?php $spliter = (empty($this->app->user->feedback) && !$this->cookie->feedbackView && $this->from == 'doc') ? true : false;?>
  <div class="main-row fade <?php if($spliter) echo 'split-row';?>" id="mainRow">

    <?php if($spliter):?>
    <?php
    $oldDir = getcwd();
    chdir(dirname(dirname(dirname(__FILE__))) . '/view');
    include './side.html.php';
    chdir($oldDir);
    ?>
    <?php endif;?>

    <?php $browseLink = $this->session->docList ? $this->session->docList : inlink('browse');?>
    <div class="main-col" data-min-width="400">
      <div class="cell<?php if($browseType == 'bysearch') echo ' show';?>" id="queryBox"></div>
      <div class="panel block-files block-sm no-margin">
        <div class="panel-heading">
          <div class="panel-title font-normal">
            <i class="icon icon-book text-muted"></i>
            <?php echo $doc->title . " <i class='icon-angle-right'></i> " . $lang->doc->view;?>
          </div>
          <nav class="panel-actions btn-toolbar">
          <?php
          common::printIcon('doc', 'edit', "docID=$doc->id", $doc);
          common::printIcon('doc', 'delete', "docID=$doc->id", $doc, 'button', '', 'hiddenwin');
          ?>
          </nav>
        </div>
        <div class='panel-body'>
          <div class='main-row'>
            <div class="main-col">
              <div class="cell">
                <div class="detail no-padding">
                  <div class="detail-content article-content no-margin no-padding">
                  <?php echo $doc->content?>

                  <?php foreach($doc->files as $file):?>
                  <?php if(in_array($file->extension, $config->file->imageExtensions)):?>
                  <div class='file-image'>
                    <a href="<?php echo $file->webPath?>" target="_blank">
                      <img onload="setImageSize(this,0)" src="<?php echo $this->createLink('file', 'read', "fileID={$file->id}");?>" alt="<?php echo $file->title?>">
                    </a>
                    <span class='right-icon'>
                      <?php if(common::hasPriv('file', 'delete')) echo html::a('###', "<i class='icon icon-close'></i>", '', "class='btn-icon' onclick='deleteFile($file->id)' title='$lang->delete'");?>
                    </span>
                  </div>
                  <?php unset($doc->files[$file->id]);?>
                  <?php endif;?>
                  <?php endforeach;?>
                  </div>
                </div>
                <?php echo $this->fetch('file', 'printFiles', array('files' => $doc->files, 'fieldset' => 'true'));?>
                <hr />
                <p class="small">
                  <strong><?php echo $lang->doc->keywords;?></strong>
                  <span class='article-keywords'><?php echo $doc->keywords;?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include '../../../common/view/footer.html.php';?>
<?php endif;?>
