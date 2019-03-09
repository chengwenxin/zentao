<?php
/**
 * The log view file of repo module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @author      Wang Yidong, Zhu Jinyong 
 * @package     repo
 * @version     $Id: browse.html.php $
 */
?>
<?php include '../../common/view/header.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div class="btn-toolbar pull-left">
    <?php echo html::backButton("<i class='icon icon-back icon-sm'></i>" . $lang->goback, '', 'btn btn-link');?>
    <div class="divider"></div>
    <div class="page-title">
      <strong>
      <?php
      echo html::a($this->repo->createLink('browse', "repoID=$repoID"), $repo->name);
      $paths= explode('/', $entry);
      $fileName = array_pop($paths);
      $postPath = '';
      foreach($paths as $pathName)
      {
          $postPath .= $pathName . '/';
          echo '/' . ' ' . html::a($this->repo->createLink('browse', "repoID=$repoID", "path=" . $this->repo->encodePath($postPath)), trim($pathName, '/'));
      }
      echo '/' . ' ' . $fileName;
      echo $repo->SCM == 'Git' ? " @ " . substr($revision, 0, 10) : " @ r" . $revision;;
      ?>
      </strong>
    </div>
  </div>
</div>

<div id="mainContent">
  <nav id="contentNav">
    <ul class="nav nav-default">
      <?php $encodeEntry = $this->repo->encodePath($entry);?>
      <li><a><?php echo $lang->repo->log;?></a></li>
      <li><?php  echo html::a($this->repo->createLink('view', "repoID=$repoID&entry=&revision=$revision", "entry=$encodeEntry"), $lang->repo->view);?></li>
      <?php if($info->kind == 'file') echo '<li>' . html::a($this->repo->createLink('blame', "repoID=$repoID&entry=&revision=$revision", "entry=$encodeEntry"), $lang->repo->blame) . '</li>';?>
      <?php if($info->kind == 'file') echo '<li>' . html::a($this->repo->createLink('download', "repoID=$repoID&path=&fromRevision=$revision", "path=$encodeEntry"), $lang->repo->download, 'hiddenwin') . '</li>';?>
    </ul>
  </nav>
  <form id='logForm' class='main-table' data-ride='table' action='<?php echo $this->repo->createLink('diff', "repoID=$repoID", "entry=" . $this->repo->encodePath($entry))?>' method='post'>
    <table class='table table-fixed' id='logList'>
      <thead>
        <tr>
          <th class='w-40px'></th>
          <th width='w-110px'><?php echo $lang->repo->revision?></th>
          <th width='w-150px'><?php echo $lang->repo->date?></th>
          <th width='w-80px'><?php echo $lang->repo->committer?></th>
          <th><?php echo $lang->repo->comment?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($logs as $log):?>
        <tr>
          <td>
            <div class='checkbox-primary'>
              <input type='checkbox' name='revision[]' value="<?php echo $log->revision?>" />
              <label></label>
            </div>
          </td>
          <td class='versions'><?php echo html::a($this->repo->createLink('revision', "repoID=$repoID&revision=" . $log->revision), substr($log->revision, 0, 10));?></td>
          <td><?php echo $log->time;?></td>
          <td><?php echo $log->committer;?></td>
          <td class='comment'><?php echo $log->comment;?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <div class='table-footer'>
      <?php echo html::submitButton($lang->repo->diff, '', 'btn btn-primary')?>
      <?php $pager->show('right', 'pagerjs');?>
    </div>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
