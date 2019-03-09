<?php
/**
 * The view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     feedback
 * @version     $Id: view.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php $browseLink  = $app->session->feedbackList != false ? $app->session->feedbackList : inlink('browse', "productID=$feedback->product");?>
    <?php echo html::a($browseLink, "<i class='icon-back'></i> " . $lang->goback, '', "class='btn btn-link'");?>
    <div class='divider'></div>
    <div class='page-title'>
      <span class='label label-id'><?php echo $feedback->id;?></span>
      <strong>
      <?php
      if($feedback->public) echo "<span class='label label-info'>{$lang->feedback->public}</span>";
      echo $feedback->title;
      ?>
      </strong>
      <?php echo " <span class='label label-status status-{$feedback->status}'>{$lang->feedback->statusList[$feedback->status]}</span>";?>
      <?php echo " <span class='label label-info'>{$product}</span>";?>
    </div>
  </div>
</div>

<div id='mainContent' class='table-row'>
  <div class='main-col col-8'>
    <div class='cell'>
      <div class='detail'>
        <div class='detail-title'><?php echo $lang->feedback->desc;?></div>
        <div class='detail-content'><?php echo $feedback->desc;?></div>
      </div>
      <?php echo $this->fetch('file', 'printFiles', array('files' => $feedback->files, 'fieldset' => 'true'));?>
      <?php if($feedback->result and $type):?>
      <div id='resultInfoBox' class='detail'>
        <div class='detail-title'><?php echo $lang->feedback->$type;?></div>
        <div class='detail-content'>
          <span class="prefix"> <strong>#<?php echo $feedback->resultInfo->id;?></strong> </span>
          <span> <?php echo common::hasPriv($type, 'view') ? html::a($this->createLink($type, 'view', "id={$feedback->resultInfo->id}", 'html', true), $feedback->resultInfo->title, '', "class='iframe'") : $feedback->resultInfo->title;?> </span>
          <span class='<?php echo 'pri' . zget($lang->$type->priList, $feedback->resultInfo->pri);?>'> <?php echo zget($lang->$type->priList, $feedback->resultInfo->pri)?> </span>
          <span class="label label-info"><?php echo $lang->$type->statusList[$feedback->resultInfo->status];?></span>
        </div>
      </div>
      <?php endif;?>
      <?php include '../../common/view/action.html.php';?>
    </div>
    <div class='main-actions'>
      <div class="btn-toolbar">
        <?php common::printBack($browseLink);?>
        <?php if(!isonlybody()) echo "<div class='divider'></div>";?>
        <?php if(!$feedback->deleted):?>
        <?php
        $params      = "feedbackID=$feedback->id";
        $likeByTitle = '';
        if($feedback->public and $feedback->likes)
        {
            foreach(explode(',', $feedback->likes) as $likeBy) $likeByTitle .= zget($users, $likeBy, $likeBy) . ',';
            $likeByTitle .= $lang->feedback->feelLike;
        }
    
        if($app->user->account == $feedback->openedBy) echo html::a(inlink('comment', "feedbackID=$feedback->id&type=asked"), "<i class='icon-chat-line'></i> {$lang->feedback->ask}", '', "class='btn iframe'");
        if(empty($app->user->feedback) and $feedback->status != 'closed')
        {
            common::printIcon('feedback', 'comment', "feedbackID=$feedback->id&type=replied", $feedback, 'button', 'restart', '', 'iframe', '', '', $lang->feedback->reply);
            if($config->global->flow == 'full' or $config->global->flow == 'onlyStory') common::printIcon('story', 'create', "product=$feedback->product&branch=0&moduleID=0&storyID=0&projectID=0&bugID=0&planID=0&todoID=0&extra=$params", '', 'button', $lang->icons['story'], '', '', '', '', $lang->feedback->toStory);
            if($config->global->flow == 'full' or $config->global->flow == 'onlyTest')  common::printIcon('bug',   'create', "product=$feedback->product&branch=0&extra=$params", '', 'button', $lang->icons['bug'], '', '', '', '', $lang->feedback->toBug);
        }
        if($feedback->status != 'closed' and ($app->user->account == $feedback->openedBy or empty($app->user->feedback)))
        {
            common::printIcon('feedback', 'close', "feedbackID=$feedback->id", $feedback, 'button', '', '', 'iframe', '', '', $lang->feedback->close);
        }
    
        if($feedback->status == 'wait' and $app->user->account == $feedback->openedBy) echo html::a(inlink('edit', $params), "<i class='icon-pencil'></i> {$lang->edit}", '', "class='btn' title='{$lang->feedback->edit}'");
        if($feedback->public)
        {
            echo html::a(inlink('comment', "feedbackID=$feedback->id&type=commented"), "<i class='icon-confirm'></i> {$lang->feedback->comment}", '', "class='btn iframe'");
            echo "<span class='likesBox'>";
            echo html::a("javascript:like($feedback->id)", "<i class='icon icon-chevron-double-up'></i> ({$feedback->likesCount})", '', "class='btn' title='$likeByTitle'");
            echo "</span>";
        }
        if($app->user->account == $feedback->openedBy and $feedback->status == 'wait') echo html::a(inlink('delete', $params), "<i class='icon-remove'></i>", 'hiddenwin', "class='btn' title='{$lang->feedback->close}'");
        ?>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class='side-col col-4'>
    <div class='cell'>
      <div class='detail'>
        <div class='detail-title'><?php echo $lang->feedback->lblBasic;?></div>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px'><?php echo $lang->feedback->product?></th>
            <td><?php echo common::hasPriv('product', 'view') ? html::a($this->createLink('product', 'view', "id={$feedback->product}"), zget($products, $feedback->product)) : zget($products, $feedback->product);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->feedback->status?></th>
            <td><?php echo zget($lang->feedback->statusList, $feedback->status);?></td>
          </tr>
          <tr>
            <th><?php echo $lang->feedback->openedBy?></th>
            <td><?php echo zget($users, $feedback->openedBy) . $lang->at . $feedback->openedDate;?></td>
          </tr>
          <?php if($feedback->processedBy):?>
          <tr>
            <th><?php echo $lang->feedback->processedBy?></th>
            <td><?php echo zget($users, $feedback->processedBy) . $lang->at . $feedback->processedDate;?></td>
          </tr>
          <?php endif;?>
          <?php if($feedback->closedBy):?>
          <tr>
            <th><?php echo $lang->feedback->closedBy?></th>
            <td><?php echo zget($users, $feedback->closedBy) . $lang->at . $feedback->closedDate;?></td>
          </tr>
          <?php endif;?>
          <?php if($feedback->closedReason and $feedback->status == 'closed'):?>
          <tr>
            <th><?php echo $lang->feedback->closedReason?></th>
            <td><?php echo zget($lang->feedback->closedReasonList, $feedback->closedReason);?></td>
          </tr>
          <?php endif;?>
        </table>
      </div>
    </div>
  </div>
</div>
<div id='mainActions' class='main-actions'>
  <?php common::printPreAndNext($preAndNext);?>
</div>
<?php include '../../common/view/footer.html.php';?>
