<?php
/**
 * The create mobile view file of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<div class='heading divider'>
  <div class='title'><i class='icon-plus muted'></i> <strong><?php echo $lang->story->create; ?></strong></div>
  <nav class='nav'><a data-dismiss='display'><i class='icon icon-remove muted'></i></a></nav>
</div>

<form class='has-padding content' method='post' action='<?php echo $this->createLink('story', 'create', http_build_query($this->app->getParams()))?>' id='createForm' data-form-refresh='#page' enctype='multipart/form-data'>
  <?php if($branches):?>
  <div class="control">
    <label for='branch'><?php echo $lang->story->branch;?></label>
    <div class='select'><?php echo html::select('branch', $branches, $branch);?></div>
  </div>
  <?php endif;?>
  <div class="control">
    <label for='module'><?php echo $lang->story->module;?></label>
    <div class='select'><?php echo html::select('module', $moduleOptionMenu, $moduleID);?></div>
  </div>
  <div class="control">
    <label for='plan'><?php echo $lang->story->plan;?></label>
    <div class='select'><?php echo html::select('plan', $plans, $planID);?></div>
  </div>
  <?php if(strpos(",$showFields,", ',source,') !== false):?>
  <div class='row'>
    <div class='cell'>
      <div class="control">
        <label for='source'><?php echo $lang->story->source;?></label>
        <div class='select'><?php echo html::select('source', $lang->story->sourceList, $source);?></div>
      </div>
    </div>
    <div class='cell'>
      <div class="control">
        <label for='sourceNote'><?php echo $lang->comment;?></label>
        <?php echo html::input('sourceNote', $sourceNote, "class='input'");?>
      </div>
    </div>
  </div>
  <?php endif;?>
  <div class='row'>
    <div class='cell'>
      <div class='control'>
        <label for='reviewedBy'><?php echo $lang->story->reviewedBy;?></label>
        <div class='select'><?php echo html::select('assignedTo', $users, empty($needReview) ? $product->PO : '');?></div>
      </div>
      <?php if(!$this->story->checkForceReview()):?>
      <div class='cell-2'>
        <div class='control' style='padding-top:30px; padding-left:5px; width:100px'>
          <div class='checkbox'><?php echo html::checkbox('needNotReview', $lang->story->needNotReview, '', "id='needNotReview' {$needReview}");?></div>
        </div>
      </div>
      <?php endif;?>
    </div>
  </div>
  <?php
  $hiddenEst = strpos(",$showFields,", ',estimate,') === false;
  $hiddenPri = strpos(",$showFields,", ',pri,') === false;
  ?>
  <?php if(!$hiddenEst or !$hiddenPri):?>
  <div class='row'>
    <?php if(!$hiddenPri):?>
    <div class='cell'>
      <div class="control">
        <label for='pri'><?php echo $lang->story->pri;?></label>
        <div class='select'><?php echo html::select('pri', $lang->story->priList, $pri);?></div>
      </div>
    </div>
    <?php endif;?>
    <?php if(!$hiddenEst):?>
    <div class='cell'>
      <div class="control">
        <label for='estimate'><?php echo $lang->story->estimateAB;?></label>
        <?php echo html::input('estimate', $estimate, "class='input'");?>
      </div>
    </div>
    <?php endif;?>
  </div>
  <?php endif;?>
  <div class="control">
    <label for='title'><?php echo $lang->story->title;?></label>
    <?php echo html::input('title', $storyTitle, "class='input' placeholder='{$lang->required}'");?>
  </div>
  <div class="control">
    <label for='spec'><?php echo $lang->story->spec;?></label>
    <?php echo html::textarea('spec', $spec, "rows=4 class='textarea' placeholder='" . htmlspecialchars($lang->story->specTemplate) . "'");?>
  </div>
  <?php if(strpos(",$showFields,", ',verify,') !== false):?>
  <div class="control">
    <label for='verify'><?php echo $lang->story->verify;?></label>
    <?php echo html::textarea('verify', $verify, "rows=2 class='textarea'");?>
  </div>
  <?php endif;?>
  <?php if(strpos(",$showFields,", ',mailto,') !== false):?>
  <div class="row">
    <div class="control">
      <label for='mailto'><?php echo $lang->story->mailto;?></label>
      <div class='select'> <?php echo html::select('mailto[]', $users, str_replace(' ' , '', $mailto), "multiple");?></div>
    </div>
    <?php echo $this->fetch('my', 'buildContactLists');?>
  </div>
  <?php endif;?>
  <?php if(strpos(",$showFields,", ',keywords,') !== false):?>
  <div class="control">
    <label for='keywords'><?php echo $lang->story->keywords;?></label>
    <?php echo html::input('keywords', $keywords, "class='input'");?></div>
  </div>
  <?php endif;?>
  <div class='control'>
    <?php echo $this->fetch('file', 'buildForm', 'fileCount=1');?>
  </div>
  <?php echo html::hidden('product', $productID);?>
</form>

<div class='footer has-padding'>
  <button type='button' data-submit='#createForm' class='btn primary'><?php echo $lang->save ?></button>
</div>
<script>
$(function()
{
    if($('#needNotReview').prop('checked'))
    {
        $('#assignedTo').attr('disabled', 'disabled');
    }
    else
    {
        $('#assignedTo').removeAttr('disabled');
    }

    $('#needNotReview').change(function()
    {
        if($('#needNotReview').prop('checked'))
        {
            $('#assignedTo').attr('disabled', 'disabled');
        }
        else
        {
            $('#assignedTo').removeAttr('disabled');
        }
    });
    $('#createForm').modalForm().listenScroll({container: 'parent'});
})
</script>
