<?php
/**
 * The task edit mobile view file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     task 
 * @version     $Id
 * @link        http://www.ranzhico.com
 */
?>
<div class='heading divider'>
  <div class='title'><i class='icon-pencil muted'></i> <strong><?php echo $lang->task->edit;?></strong></div>
  <nav class='nav'>
    <a data-dismiss='display'><i class='icon icon-remove muted'></i></a>
  </nav>
</div>
<form class='content box' data-form-refresh='#page' method='post' id='editTaskForm' action='<?php echo $this->createLink('task', 'edit', "taskID={$task->id}");?>' enctype='multipart/form-data'>
  <div class='row'>
    <div class='cell-9'>
      <div class='control'>
        <label for='name'><?php echo $lang->task->name;?></label>
        <?php echo html::input('name', $task->name, "class='input' placeholder='{$lang->required}'");?>
      </div>
    </div>
    <div class='cell-3'>
      <div class='control'>
        <label for='primary'><?php echo $lang->task->pri;?></label>
        <div class='select'><?php echo html::select('pri', $lang->task->priList, $task->pri);?></div>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='project'><?php echo $lang->task->project;?></label>
    <div class='select'><?php echo html::select('project', $projects, $task->project);?></div>
  </div>
  <div class="control">
    <label for='module'><?php echo $lang->task->module;?></label>
    <div class='select'><?php echo html::select('module', $modules, $task->module, "onchange='setStories(this.value,$project->id)'");?></div>
  </div>
  <?php if($config->global->flow != 'onlyTask'):?>
  <div class='control'>
    <label for='story'><?php echo $lang->task->story;?></label>
    <div class='select'><?php echo html::select('story', $stories, $task->story, 'onchange=setStoryModule()');?></div>
  </div>
  <?php endif;?>
  <div class='control'>
    <div class="checkbox pull-right">
      <input type='checkBox' name='multiple' id='multiple' value='1' <?php echo empty($task->team) ? '' : 'checked';?> />
      <label for="multiple" class="text-link"><?php echo $lang->task->multipleAB;?></label>
    </div>
    <label for='assignedTo'><?php echo $lang->task->assignedTo;?></label>
    <div class='select'><?php echo html::select('assignedTo', $members, $task->assignedTo);?></div>
  </div>

  <div id='taskTeam' class='hidden has-padding gray'>
    <div class='control small muted'><label><?php echo $lang->task->team;?></label></div>
    <?php $memberKey = 1;?>
    <?php if(!empty($task->team)):?>
    <?php foreach($task->team as $member):?>
    <div class='row flex-nowrap'>
      <div class='cell'>
        <div class='control'>
          <div class='select'>
            <?php echo html::select("team[$memberKey]", $members, $member->account);?>
          </div>
        </div>
      </div>
      <div class='cell-2'>
        <div class='control'>
          <?php echo html::input("teamEstimate[$memberKey]", $member->estimate, "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->estimate}'") ?>
        </div>
      </div>
      <div class='cell-2'>
        <div class='control'>
          <?php echo html::input("teamConsumed[$memberKey]", $member->consumed, "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->consumed}'") ?>
        </div>
      </div>
      <div class='cell-2'>
        <div class='control'>
          <?php echo html::input("teamLeft[$memberKey]", $member->left, "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->left}'") ?>
        </div>
      </div>
      <div class='cell flex-none'>
        <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
      </div>
    </div>
    <?php $memberKey ++;?>
    <?php endforeach;?>
    <?php endif;?>
    <div class='row flex-nowrap'>
      <div class='cell'>
        <div class='control'>
          <div class='select'>
            <?php echo html::select("team[$memberKey]", $members);?>
          </div>
        </div>
      </div>
      <div class='cell-2'>
        <div class='control'>
          <?php echo html::input("teamEstimate[$memberKey]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->estimateAB}'") ?>
        </div>
      </div>
      <div class='cell-2'>
        <div class='control'>
          <?php echo html::input("teamConsumed[$memberKey]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->consumed}'") ?>
        </div>
      </div>
      <div class='cell-2'>
        <div class='control'>
          <?php echo html::input("teamLeft[$memberKey]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->left}'") ?>
        </div>
      </div>
      <div class='cell flex-none'>
        <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
      </div>
    </div>
    <a class="btn text-primary btn-add-member"><i class="icon-plus"></i></a>
  </div>
  <div class='control'>
    <label for='mailto[]'><?php echo $lang->task->mailto;?></label>
    <div class='select multiple'><?php echo html::select('mailto[]', $users, $task->mailto, 'multiple');?></div>
  </div>
  </div>
  <div class='control'>
    <label for='status'><?php echo $lang->task->status;?></label>
    <div class='select'><?php echo html::select('status', $lang->task->statusList, $task->status);?></div>
  </div>
  <div class='row'>
    <div class='cell-4'>
      <div class='control'>
        <label for='estimate'><?php echo $lang->task->estimate;?></label>
        <?php echo html::input('estimate', $task->estimate, "class='input'");?>
      </div>
    </div>
    <div class='cell-4'>
      <div class='control'>
        <label for='consumed'><?php echo $lang->task->consumed;?></label>
        <?php echo $task->consumed;?>
      </div>
    </div>
    <div class='cell-4'>
      <div class='control'>
        <label for='left'><?php echo $lang->task->left;?></label>
        <?php echo html::input('left', $task->left, "class='input'");?>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->task->desc;?></label>
    <?php echo html::textarea('desc', $task->desc, "rews='5' class='textarea'");?>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='estStarted'><?php echo $lang->task->estStarted;?></label>
        <input type='date' class='input' id='estStarted' value='<?php echo $task->estStarted;?>' name='estStarted'>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='realStarted'><?php echo $lang->task->realStarted;?></label>
        <input type='date' class='input' id='realStarted' value='<?php echo $task->realStarted;?>' name='realStarted'>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='deadline'><?php echo $lang->task->deadline;?></label>
    <input type='date' class='input' id='deadline' value='<?php echo $task->deadline;?>' name='deadline'>
  </div>
  <div class='space'></div>
  <div class='heading gray'>
    <div class='title text-important'><?php echo $lang->task->legendLife;?></div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='openedBy'><?php echo $lang->task->openedBy;?></label>
        <?php echo $users[$task->openedBy];?>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='openedDate'><?php echo $lang->task->openedDate;?></label>
        <?php echo $task->openedDate;?>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='finishedBy'><?php echo $lang->task->finishedBy;?></label>
        <div class='select'><?php echo html::select('finishedBy', $users, $task->finishedBy);?></div>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='finishedDate'><?php echo $lang->task->finishedDate;?></label>
        <?php echo html::input('finishedDate', $task->finishedDate, "class='input'");?>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='canceledBy'><?php echo $lang->task->canceledBy;?></label>
        <div class='select'><?php echo html::select('canceledBy', $users, $task->canceledBy);?></div>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='canceledDate'><?php echo $lang->task->canceledDate;?></label>
        <?php echo html::input('canceledDate', $task->canceledDate, "class='input'");?>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='cell-6'>
      <div class='control'>
        <label for='closedBy'><?php echo $lang->task->closedBy;?></label>
        <div class='select'><?php echo html::select('closedBy', $users, $task->closedBy);?></div>
      </div>
    </div>
    <div class='cell-6'>
      <div class='control'>
        <label for='closedDate'><?php echo $lang->task->closedDate;?></label>
        <?php echo html::input('closedDate', $task->closedDate, "class='input'");?>
      </div>
    </div>
  </div>
  <div class='control'>
    <label for='closedReason'><?php echo $lang->task->closedReason;?></label>
    <div class='select'><?php echo html::select('closedReason', $lang->task->reasonList, $task->closedReason);?>
  </div>

  <div class='control'>
    <label for='remark'><?php echo $lang->comment;?></label>
    <?php echo html::textarea('comment', '', "rews='5' class='textarea'");?>
  </div>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>
</form>

<div class='footer has-padding'>
  <button type='button' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
</div>

<div class='template'>
  <div class='row flex-nowrap'>
    <div class='cell'>
      <div class='control'>
        <div class='select'>
          <?php echo html::select("team[key]", $members);?>
        </div>
      </div>
    </div>
    <div class='cell-2'>
      <div class='control'>
        <?php echo html::input("teamEstimate[key]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->estimateAB}'") ?>
      </div>
    </div>
    <div class='cell-2'>
      <div class='control'>
        <?php echo html::input("teamConsumed[key]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->consumed}'") ?>
      </div>
    </div>
    <div class='cell-2'>
      <div class='control'>
        <?php echo html::input("teamLeft[key]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->left}'") ?>
      </div>
    </div>
    <div class='cell flex-none'>
      <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
    </div>
  </div>
</div>

<script>
$(function()
{
    $('[name^=multiple]').change(function()
    {
        if($(this).prop('checked'))
        {
            $('#assignedTo').addClass('hidden');
            $('#assignedTo').parent('div').removeClass('select');
            $('#taskTeam').removeClass('hidden');
            $('#estimate').attr('readonly', true);
        }
        else
        {
            $('#assignedTo').removeClass('hidden');
            $('#assignedTo').parent('div').addClass('select');
            $('#taskTeam').addClass('hidden');
            $('#estimate').attr('readonly', false);
        }
    });

    $('[name^=multiple]').change();

    $('#submitButton').click(function(){$('#editTaskForm').submit()});

    var memberKey = <?php echo ++$memberKey;?>;
    $('#taskTeam').on($.TapName, '.member-deleter', function()
    {
        if($('#taskTeam').find('.row').length == 1) return false;

        $(this).closest('.row').remove();
    });

    $(document).on($.TapName, '.btn-add-member', function(e)
    {
        var $member = $('.template').html().replace(/key/g, memberKey);
        $('.btn-add-member').before($member);
        memberKey ++;

        e.stopPropagation();
        e.preventDefault();
    });

    $(document).on('change', '[name*=teamEstimate]', function()
    {
        var time = 0;
        $('[name*=teamEstimate]').each(function()
        {
            var $this = $(this);
            estimate = parseFloat($this.val());
            if(!isNaN(estimate))
            {
                time += estimate;
            }

            $('#estimate').val(time);
        })
    });
})
</script>
