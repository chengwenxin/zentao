<?php
/**
 * The task create mobile view file of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     task 
 * @version     $Id
 * @link        http://www.zentao.net
 */
?>

<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->task->create;?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>
<form class='content box' data-form-refresh='#page' method='post' id='createTaskForm' action='<?php echo $this->createLink('task', 'create', http_build_query($this->app->getParams()));?>' enctype='multipart/form-data'>
  <div class="control">
    <label for='module'><?php echo $lang->task->module;?></label>
    <div class='select'><?php echo html::select('module', $moduleOptionMenu, $task->module, "onchange='setStories(this.value,$project->id)'");?></div>
  </div>
  <div class="control">
    <label for='module'><?php echo $lang->task->type;?></label>
    <div class='select'><?php echo html::select('type', $lang->task->typeList, $task->type, 'onchange=setOwners(this.value)');?></div>
  </div>
  <div class='control'>
    <div class="checkbox pull-right">
      <input type="checkbox" name="multiple" value="1" id="multipleBox">
      <label for="multipleBox" class="text-link"><?php echo $lang->task->multipleAB;?></label>
    </div>
    <label for='assignedTo'><?php echo $lang->task->assignedTo;?></label>
    <div class='select flex'>
      <?php echo html::select('assignedTo[]', $members, $task->assignedTo);?>
    </div>
  </div>
  <div id='taskTeam' class='hidden has-padding gray'>
    <div class='control small muted'><label><?php echo $lang->task->team;?></label></div>
    <div class='row flex-nowrap'>
      <div class='cell'>
        <div class='control'>
          <div class='select'>
            <?php echo html::select("team[1]", $members);?>
          </div>
        </div>
      </div>
      <div class='cell-4'>
        <div class='control'>
          <?php echo html::input("teamEstimate[1]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->estimateAB}'") ?>
        </div>
      </div>
      <div class='cell flex-none'>
        <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
      </div>
    </div>
    <?php if(isset($currentOrder)):?>
    <div class='row flex-nowrap'>
      <div class='cell'>
        <div class='control'>
          <div class='select'>
            <?php echo html::select("team[]", $members, $member);?>
          </div>
        </div>
      </div>
      <div class='cell-4'>
        <div class='control'>
          <input type='number' step='0.01' name='real[]' class='input text-right member-estimate' value='<?php echo $currentOrder->plan ?>' placeholder='<?php echo $this->lang->contract->placeholder->real ?>'>
        </div>
      </div>
      <div class='cell flex-none'>
        <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
      </div>
    </div>
    <?php endif;?>
    <a class="btn text-primary btn-add-member"><i class="icon-plus"></i></a>
  </div>
  <?php if(strpos(",$showFields,", ',story,') !== false and $config->global->flow != 'onlyTask'):?>
  <div class='control'>
    <label for='story'><?php echo $lang->task->story;?></label>
    <div class='select'><?php echo html::select('story', $stories, $task->story, 'onchange=setStoryModule()');?></div>
  </div>
  <?php endif;?>
  <div class='control'>
    <label for='name'><?php echo $lang->task->name;?></label>
    <?php echo html::input('name', '', "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class='row'>
    <?php if(strpos(",$showFields,", ',pri,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='pri'><?php echo $lang->task->pri;?></label>
        <div class='select'><?php echo html::select('pri', $lang->task->priList);?></div>
      </div>
    </div>
    <?php endif;?>
    <?php if(strpos(",$showFields,", ',estimate,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='estimate'><?php echo $lang->task->estimate;?></label>
        <?php echo html::input('estimate', '', "class='input'");?>
      </div>
    </div>
    <?php endif;?>
  </div>
  <div class='control'>
    <label for='desc'><?php echo $lang->task->desc;?></label>
    <?php echo html::textarea('desc', '', "rews='5' class='textarea'");?>
  </div>
  <div class='row'>
    <?php if(strpos(",$showFields,", ',estStarted,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='estStarted'><?php echo $lang->task->estStarted;?></label>
        <input type='date' class='input' id='estStarted' name='estStarted'>
      </div>
    </div>
    <?php endif;?>
    <?php if(strpos(",$showFields,", ',deadline,') !== false):?>
    <div class='cell-6'>
      <div class='control'>
        <label for='deadline'><?php echo $lang->task->deadline;?></label>
        <input type='date' class='input' id='deadline' name='deadline'>
      </div>
    </div>
    <?php endif;?>
  </div>
  <?php if(strpos(",$showFields,", ',mailto,') !== false):?>
  <div class='control'>
    <label for='mailto[]'><?php echo $lang->task->mailto;?></label>
    <div class='select multiple'><?php echo html::select('mailto[]', $project->acl == 'private' ? $members : $users, str_replace(' ', '', $task->mailto), 'multiple');?></div>
  </div>
  <?php endif;?>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>


</form>
<div class='footer has-padding'>
  <button type='button' data-submit='#createTaskForm' class='btn primary'><?php echo $lang->save;?></button>
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
    <div class='cell-4'>
      <div class='control'>
        <?php echo html::input("teamEstimate[key]", '', "type='number' step='0.01' class='input text-center' autocomplete='off' placeholder='{$lang->task->estimateAB}'") ?>
      </div>
    </div>
    <div class='cell flex-none'>
      <a class='btn member-deleter'><i class='icon-trash text-danger'></i></a>
    </div>
  </div>
</div>

<script>
function setOwners(type)
{
    if(type == 'affair')
    {
        $('#assignedTo').attr('multiple', 'multiple');
    }
    else if($('#assignedTo').attr('multiple') == 'multiple')
    {
        $('#assignedTo').removeAttr('multiple');
    }
}

function setStoryModule()
{
    var storyID = $('#story').val();
    if(storyID)
    {
        var link = createLink('story', 'ajaxGetModule', 'storyID=' + storyID);
        $.get(link, function(moduleID){$('#module').val(moduleID);});
    }
}

function setStories(moduleID, projectID)
{
    link = createLink('story', 'ajaxGetProjectStories', 'projectID=' + projectID + '&productID=0&branch=0&moduleID=' + moduleID);
    $.get(link, function(stories)
    {
        var storyID = $('#story').val();
        if(!stories) stories = '<select id="story" name="story"></select>';
        $('#story').replaceWith(stories);
        $('#story').val(storyID);
    });
}
$(function()
{
    $('[name^=multiple]').change(function()
    {
        if($(this).prop('checked'))
        {
            $('#assignedTo').addClass('hidden');
            $('#assignedTo').parent('.flex').removeClass('select');
            $('#taskTeam').removeClass('hidden');
            $('#estimate').attr('readonly', true);
        }
        else
        {
            $('#assignedTo').removeClass('hidden');
            $('#assignedTo').parent('.flex').addClass('select');
            $('#taskTeam').addClass('hidden');
            $('#estimate').attr('readonly', false);
        }
    });

    $('#createTaskForm').modalForm().listenScroll({container: 'parent'});

    var memberKey = 2;
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
});
</script>
