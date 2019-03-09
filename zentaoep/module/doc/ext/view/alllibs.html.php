<?php if($type != 'book'):?>

  <?php
  $oldDir = getcwd();
  chdir(dirname(dirname(dirname(__FILE__))) . '/view');
  include './alllibs.html.php';
  chdir($oldDir);
  ?>

<?php else:;?>
  <?php include '../../../common/view/header.html.php';?>
  <?php $spliter = (empty($this->app->user->feedback) && !$this->cookie->feedbackView) ? true : false;?>
  <div class="main-row <?php if($spliter) echo 'split-row';?>" id="mainRow">
    <?php if($spliter):?>
    <?php
    $oldDir = getcwd();
    chdir(dirname(dirname(dirname(__FILE__))) . '/view');
    include './side.html.php';
    chdir($oldDir);
    ?>
    <?php endif;?>
  
    <?php if($this->cookie->browseType == 'bylist'):?>
    <?php include dirname(__FILE__) . '/alllibsbylist.html.php';?>
    <?php else:?>
    <?php include dirname(__FILE__) . '/alllibsbygrid.html.php';?>
    <?php endif;?>
  </div>
  <?php include '../../../common/view/footer.html.php';?>
<?php endif;?>
