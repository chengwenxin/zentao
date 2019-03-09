<?php
/**
 * The view of doc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Jia Fu <fujia@cnezsoft.com>
 * @package     doc
 * @version     $Id: view.html.php 975 2010-07-29 03:30:25Z jajacn@126.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php echo css::internal($keTableCSS);?>
<?php $browseLink = $this->session->docList ? $this->session->docList : inlink('browse');?>
<?php
js::set('fullscreen', $lang->doc->fullscreen);
js::set('retrack', $lang->doc->retrack);
?>
<div id="mainMenu" class="clearfix">
  <div class="btn-toolbar pull-left">
    <?php echo html::a($browseLink, "<i class='icon icon-back icon-sm'></i> " . $lang->goback, '', "class='btn btn-primary'");?>
    <div class="divider"></div>
    <div class="page-title">
      <span class="label label-id"><?php echo $doc->id;?></span><span class="text" title='<?php echo $doc->title;?>'><?php echo $doc->title;?></span>
      <?php if($doc->deleted):?>
      <span class='label label-danger'><?php echo $lang->doc->deleted;?></span>
      <?php endif; ?>
      <?php if($doc->version > 1):?>
      <?php
      $versions = array();
      $i = 1;
      foreach($actions as $action)
      {
          if($action->action == 'created')
          {
              $versions[$i] =  "#$i " . zget($users, $action->actor) . ' ' . substr($action->date, 2, 14);
              $i++;
          }
          if($action->action == 'edited')
          {
              foreach($action->history as $history)
              {
                  if($history->field == 'content')
                  {
                      $versions[$i] = "#$i " . zget($users, $action->actor) . ' ' . substr($action->date, 2, 14);
                      $i++;
                      break;
                  }
              }
          }
      }
      krsort($versions);
      ?>
      <small class='dropdown'>
        <a href='#' data-toggle='dropdown' class='text-muted'><?php echo '#' . $version;?> <span class='caret'></span></a>
        <ul class='dropdown-menu'>
          <?php
          foreach($versions as $i => $versionTitle)
          {
              $class = $i == $version ? " class='active'" : '';
              echo '<li' . $class .'>' . html::a(inlink('view', "docID=$doc->id&version=$i"), $versionTitle) . '</li>';
          }
          ?>
        </ul>
      </small>
      <?php endif; ?>
    </div>
  </div>
</div>
<div id="mainContent" class="main-row">
  <div class="main-col col-8">
    <div class="cell">
      <div class="detail no-padding">
        <div class="detail-content article-content no-margin no-padding">
          <?php
          if($doc->type == 'url')
          {
              $url = $doc->content;
              if(!preg_match('/^https?:\/\//', $doc->content)) $url = 'http://' . $url;
              $urlIsHttps = strpos($url, 'https://') === 0;
              $serverIsHttps = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on';
              if(($urlIsHttps and $serverIsHttps) or (!$urlIsHttps and !$serverIsHttps))
              {
                  echo "<iframe width='100%' id='urlIframe' src='$url'></iframe>";
              }
              else
              {
                  $parsedUrl = parse_url($url);
                  $urlDomain = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

                  $title    = '';
                  $response = common::http($url);
                  preg_match_all('/<title>(.*)<\/title>/Ui', $response, $out);
                  if(isset($out[1][0])) $title = $out[1][0];

                  echo "<div id='urlCard'>";
                  echo "<div class='url-icon'><img src='{$urlDomain}/favicon.ico' width='45' height='45' /></div>";
                  echo "<div class='url-content'>";
                  echo "<div class='url-title'>{$title}</div>";
                  echo "<div class='url-href'>" . html::a($url, $url, '_target') . "</div>";
                  echo "</div></div>";
              }
          }
          else
          {
              echo $doc->content;
          }
          ?>

          <?php foreach($doc->files as $file):?>
          <?php if(in_array($file->extension, $config->file->imageExtensions)):?>
          <div class='file-image'>
            <a href="<?php echo $file->webPath?>" target="_blank">
              <img onload="setImageSize(this, 0)" src="<?php echo $this->createLink('file', 'read', "fileID={$file->id}");?>" alt="<?php echo $file->title?>">
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
    </div>
    <div class='main-actions'>
      <div class="btn-toolbar">
        <?php common::printBack($browseLink);?>
        <div class='divider'></div>
        <button type='button' class='btn fullscreen-btn' title='<?php echo $lang->doc->retrack;?>'><i class='icon icon-fullscreen'></i></button>
        <?php
        if(!$doc->deleted)
        {
            common::printIcon('doc', 'edit', "docID=$doc->id", $doc);
            common::printIcon('doc', 'delete', "docID=$doc->id", $doc, 'button', '', 'hiddenwin');
        }
        ?>
      </div>
    </div>
  </div>
  <div class="side-col col-4 hidden">
    <div class="cell">
      <details class="detail" open>
        <summary class="detail-title"><?php echo $lang->doc->digest;?></summary>
        <div class="detail-content">
          <?php echo !empty($doc->digest) ? $doc->digest : "<div class='text-center text-muted'>" . $lang->noData . '</div>';?>
        </div>
      </details>
    </div>
    <div class="cell">
      <details class="detail" open>
        <summary class="detail-title"><?php echo $lang->doc->keywords;?></summary>
        <div class="detail-content">
          <?php echo !empty($doc->keywords) ? $doc->keywords : "<div class='text-center text-muted'>" . $lang->noData . '</div>';?>
        </div>
      </details>
    </div>
    <div class="cell">
      <details class="detail" open>
        <summary class="detail-title"><?php echo $lang->doc->basicInfo;?></summary>
        <div class="detail-content">
          <table class="table table-data">
            <tbody>
              <?php if($doc->productName):?>
              <tr>
                <th><?php echo $lang->doc->product;?></th>
                <td><?php echo $doc->productName;?></td>
              </tr>
              <?php endif;?>
              <?php if($doc->projectName):?>
              <tr>
                <th><?php echo $lang->doc->project;?></th>
                <td><?php echo $doc->projectName;?></td>
              </tr>
              <?php endif;?>
              <tr>
                <th class='w-80px'><?php echo $lang->doc->lib;?></th>
                <td><?php echo $lib->name;?></td>
              </tr>
              <tr>
                <th><?php echo $lang->doc->module;?></th>
                <td><?php echo $doc->moduleName ? $doc->moduleName : '/';?></td>
              </tr>
              <tr>
                <th><?php echo $lang->doc->addedDate;?></th>
                <td><?php echo $doc->addedDate;?></td>
              </tr>
              <tr>
                <th><?php echo $lang->doc->editedBy;?></th>
                <td><?php echo zget($users, $doc->editedBy);?></td>
              </tr>
              <tr>
                <th><?php echo $lang->doc->editedDate;?></th>
                <td><?php echo $doc->editedDate;?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </details>
    </div>
    <div class='cell'>
      <?php $actionFormLink = $this->createLink('action', 'comment', "objectType=doc&objectID=$doc->id");?>
      <?php include '../../common/view/action.html.php';?>
    </div>
  </div>
</div>

<div id="mainActions" class='main-actions'>
  <?php common::printPreAndNext($preAndNext);?>
</div>
<?php include '../../common/view/syntaxhighlighter.html.php';?>
<?php include '../../common/view/footer.html.php';?>
