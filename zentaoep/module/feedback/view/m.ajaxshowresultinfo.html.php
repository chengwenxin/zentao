<div class='heading gray'>
  <div class='title'><i class='icon icon-file-text-o'> </i><?php echo $lang->feedback->$type;?></div>
</div>
<div class='box'>
  <table class='table bordered table-detail'>
    <tr>
      <td class='w-80px'><?php echo $lang->$type->id;?></td>
      <td><?php echo $result->id;?></td>
    </tr>
    <tr>
      <td><?php echo $lang->$type->title;?></td>
      <td><?php echo $result->title;?></td>
    </tr>
    <tr>
      <td><?php echo $lang->$type->pri;?></td>
      <td><span class='<?php echo 'pri' . zget($lang->$type->priList, $result->pri);?>'><?php echo zget($lang->$type->priList, $result->pri)?></span></td>
    </tr>
    <tr>
      <td><?php echo $lang->$type->status;?></td>
      <td><?php echo $lang->$type->statusList[$result->status];?></td>
    </tr>
  </table>
</div>

<div class='heading gray'>
  <div class='title'><i class='icon icon-file-text-o'> </i><?php echo $lang->$type->common . $lang->history;?></div>
</div>

<div class='content list list-history'>
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
    <?php endif;?>
    <?php if($hasCommentOrHistory):?></div><?php endif; ?>
  </div>
  <?php endforeach;?>
</div>
