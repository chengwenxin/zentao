<?php
/**
 * The mobile action view of common module of RanZhi.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     common 
 * @version     $Id: chosen.html.php 7417 2013-12-23 07:51:50Z wwccss $
 * @link        http://www.ranzhico.com
 */
?>
<?php $historyUID = 'histories-' . uniqid(); ?>
<style>
.change-show, .change-hide{font-family: ZenIcon;}
.change-show:before {content: "\e661";}
.change-hide:before {content: "\e662";}
.list-history.list{padding:0.5rem 0rem !important;}
.list-history.list>.item{padding:0.1rem 0.5rem !important;}
.list-history.list>.item>.title{padding:0rem !important;}
</style>

<div class='heading gray'>
  <div class="title"><i class='icon-history muted'></i> <strong><?php echo $lang->history?></strong></div>
  <nav class='nav'>
    <a data-toggle='reverse' data-target='#<?php echo $historyUID ?> > .item'><i class='icon-sort-by-order-alt'></i></a>
  </nav>
</div>

<div class='content list list-history' id='<?php echo $historyUID ?>'>
  <?php $i = 0;?>
  <?php foreach($actions as $action):?>
  <?php
    $canEditComment = ($action->action != 'record' and end($actions) == $action and $action->comment and (strpos($this->server->request_uri, 'view') !== false) and $action->actor == $this->app->user->account);
    if(isset($users[$action->actor])) $action->actor = $users[$action->actor];
    if($action->action == 'assigned' and isset($users[$action->extra]) ) $action->extra = $users[$action->extra];
    if(strpos($action->actor, ':') !== false) $action->actor = substr($action->actor, strpos($action->actor, ':') + 1);

    $hasCommentOrHistory = !(empty($action->comment) and empty($action->history));
  ?>
  <div class='item with-avatar <?php echo $hasCommentOrHistory ? 'multi-lines' : 'single-line' ?>' data-id='<?php echo ++$i;?>'>
    <?php if($hasCommentOrHistory):?><div class="content"><?php endif; ?>
    <div class="title">
      <?php echo $i . '. ';?><?php $this->action->printAction($action);?>
      <?php if(!empty($action->history)): ?>
      <span id='switchButton<?php echo $i;?>' class='toggle outline change-show btn btn-sm'></span>
      <?php endif; ?>
    </div>

    <?php if(!empty($action->history)): ?>
    <div class='history article break-word' style='display:none;'><?php echo $this->action->printChanges($action->objectType, $action->history, $action->action);?></div>
    <?php endif; ?>

    <?php if(!empty($action->comment)): ?>
    <div class='comment article primary-pale'>
      <?php echo strip_tags($action->comment) == $action->comment ? nl2br($action->comment) : $action->comment; ?>
      <?php if($canEditComment):?>
      <a href='#lastCommentBox' class='btn' data-display data-backdrop='true'><i class='icon-pencil'></i></a>
      <?php endif; ?>
    </div>
    <?php endif; ?>


    <?php if($hasCommentOrHistory):?></div><?php endif; ?>
  </div>
  <?php if(!empty($action->files)): ?>
  <div class='files list gray compact'>
    <div class='heading'><div class='title'><?php echo $lang->action->record->uploadFile;?></div></div>
    <?php foreach ($action->files as $file):?>
    <a class='item item-file with-avatar multi-lines' href='<?php echo helper::createLink('file', 'download', "fileID=$file->id&mouse=left") ?>' target='_blank'>
      <?php if($file->isImage): ?>
      <div class='avatar avatar-no-fix outline' style='background-image: url("<?php echo $file->smallURL; ?>")'></div>
      <?php else: ?>
      <div class='avatar avatar-no-fix text-tint align-start justify-end' data-skin='@<?php echo $file->extension?>'><small>.<?php echo $file->extension?></small></div>
      <?php endif; ?>
      <div class='content'>
        <div class='title'>
          <span class='text-link'><?php echo $file->title ?></span>
          <?php if($file->downloads): ?>
          <span class='pull-right text-yellow'><i class='icon icon-download-alt'></i> <?php echo $file->downloads ?></span>
        <?php endif; ?>
        </div>
        <div class='subtitle'>
          <?php echo formatBytes($file->size)?> &nbsp; 
          <?php echo $file->createdDate?>
        </div>
      </div>
    </a>
    <?php endforeach;?>
  </div>
  <?php endif; ?>
  <?php endforeach;?>
</div>
<?php if($canEditComment):?>
<div id='lastCommentBox' class='enter-from-bottom hidden affix layer'>
  <div class='heading'>
    <div class="title"><?php echo $lang->comment;?></div>
    <nav class='nav'><a data-dismiss='display' class='muted'><i class='icon-remove'></i></a></nav>
  </div>
  <form id='lastcommentForm' target='hiddenwin' class='has-padding' data-form-refresh='#history' method='post' action='<?php echo $this->createLink('action', 'editComment', "actionID=$action->id")?>'>
    <div class='control'><?php echo html::textarea('lastComment', htmlspecialchars($action->comment),"rows='5' class='textarea' data-default-val");?></div>
    <div class='control'><button type='submit' class='btn primary'><?php echo $lang->save ?></button></div>
  </form>
</div>
<?php endif; ?>

<script>
$(function()
{
    var $history = $('#<?php echo $historyUID ?>');
    if($history.parent().hasClass('modal'))
    {
        $history.listenScroll({container: 'parent'}).prev('.heading').addClass('divider').find('.nav').append('<a data-dismiss="display"><i class="icon icon-remove muted"></i></a>');
    }

    $('.toggle').click(function()
    {
         $(this).toggleClass('change-show').toggleClass('change-hide');
         if($(this).parent().next().find('.history').size())
         {
             $(this).parent().next().find('.history').toggle();
         }
         else
         {
             $(this).parent().next().toggle().find('.history').show();
         }
    });
});
</script>
