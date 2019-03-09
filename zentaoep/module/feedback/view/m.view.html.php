<?php
/**
 * The view mobile web file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     feedback
 * @version     $Id: view.html.php 4728 2013-05-03 06:14:34Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/m.header.html.php';?>
<div id='page' class='list-with-actions'>
  <div class='heading gray'>
    <div class='title'>
      <span class='prefix'><strong><?php echo $feedback->id;?></strong></span>
      <strong>
      <?php
      if($feedback->public) echo "<span class='label label-info'>{$lang->feedback->public}</span>";
      echo $feedback->title;
      ?>
      </strong>
    </div>
    <nav class='nav'><a href="javascript:history.go(-1);" class='btn primary'><?php echo $lang->goback;?></a></nav>
  </div>
  <div class='box'>
    <table class='table bordered table-detail'>
      <tr>
        <td class='w-80px'><?php echo $lang->feedback->product;?></td>
        <td><?php echo $product;?></td>
      </tr>
      <tr>
        <td><?php echo $lang->feedback->status;?></td>
        <td><span class='label status-<?php echo $feedback->status;?>'><?php echo $lang->feedback->statusList[$feedback->status];?></span></td>
      </tr>
      <tr>
        <td><?php echo $lang->feedback->desc;?></td>
        <td><?php echo $feedback->desc;?></td>
      </tr>
    </table>
  </div> 

  <?php if(!empty($feedback->files)):?>
  <div class='heading gray'>
    <div class='title'><i class='icon icon-file-text-o'> </i><?php echo $lang->file->common;?></div>
  </div>
  <div class='box'>
    <div class='list'>
      <?php echo $this->fetch('file', 'printFiles', array('files' => $feedback->files, 'fieldset' => 'false'))?>
    </div>
  </div>
  <?php endif;?>

  <?php if($feedback->result and $type):?>
  <div class='heading gray'>
    <div class='title'><i class='icon icon-file-text-o'> </i><?php echo $lang->feedback->$type;?></div>
  </div>
  <div class='box'>
    <span class="prefix"> <strong>#<?php echo $feedback->resultInfo->id;?></strong> </span>
    <span> <?php echo common::hasPriv($type, 'view') ? html::a($this->createLink($type, 'view', "id={$feedback->resultInfo->id}"), $feedback->resultInfo->title) : $feedback->resultInfo->title;?> </span>
    <span class='<?php echo 'pri' . zget($lang->$type->priList, $feedback->resultInfo->pri);?>'> <?php echo zget($lang->$type->priList, $feedback->resultInfo->pri)?> </span>
    <span class="label label-info"><?php echo $lang->$type->statusList[$feedback->resultInfo->status];?></span>
  </div>
  <?php endif;?>

  <div class='section' id='history'>
    <?php include '../../common/view/m.action.html.php';?>
  </div>

  <nav id='actionNav' class='nav affix dock-bottom nav-auto footer-actions'>
  <?php
  $params = "feedbackID=$feedback->id";

  if($app->user->account == $feedback->openedBy) common::printIcon('feedback', 'comment', "feedbackID=$feedback->id&type=asked", $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->feedback->ask);
  if(empty($app->user->feedback) and $feedback->status != 'closed')
  {
      common::printIcon('feedback', 'comment', "feedbackID=$feedback->id&type=replied", $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->feedback->reply);
      common::printIcon('story', 'create', "product=$feedback->product&branch=0&moduleID=0&storyID=0&projectID=0&bugID=0&planID=0&todoID=0&extra=$params", $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->feedback->toStory);
      common::printIcon('bug',   'create', "product=$feedback->product&branch=0&extra=$params", $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->feedback->toBug);
  }
  if($feedback->status != 'closed' and ($app->user->account == $feedback->openedBy or empty($app->user->feedback)))
  {
      common::printIcon('feedback', 'close', "feedbackID=$feedback->id", $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->feedback->close);
  }
  if($feedback->public)
  {
      common::printIcon('feedback', 'comment', "feedbackID=$feedback->id&type=commented", $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->feedback->comment);
      echo html::a("javascript:like($feedback->id)", "<i class='icon icon-thumbs-up'></i> ({$feedback->likesCount})", '', "id='likeLink'");
  }
  if($feedback->status == 'wait' and $app->user->account == $feedback->openedBy) common::printIcon('feedback', 'edit', $params, $feedback, 'button', '', '', '', false, "data-display='modal' data-placement='bottom'", $lang->edit);
  if($app->user->account == $feedback->openedBy and $feedback->status == 'wait') echo html::a(inlink('delete', $params), $lang->delete, 'hiddenwin');
  ?>
  </nav>
</div>

<script>
function like(feedbackID)
{
    var likeLink = createLink('feedback', 'ajaxLike', 'feedbackID=' + feedbackID);
    $.get(likeLink, function(likeHtml)
    {
        $('#likeLink').replaceWith(likeHtml);
    });
}
</script>
<?php include '../../common/view/m.footer.html.php';?>
