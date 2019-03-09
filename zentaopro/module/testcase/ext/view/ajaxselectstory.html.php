<?php
/**
 * The ajax select story view file of testcase module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testcase
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<div id="mainContent" class="main-content">
  <div class='main-header'>
    <h2><?php echo $lang->testcase->selectStory;?></h2>
  </div>
  <form class='main-table' data-ride='table' method='post' target='hiddenwin' id='storyForm' action='<?php echo $this->createLink('testcase', 'exportTemplet', "productID={$product->id}")?>'>
    <table class='table table-fixed table-custom' id='storyList'>
      <thead>
        <tr>
          <th class='c-id'>
            <div class="checkbox-primary check-all" title="<?php echo $lang->selectAll?>">
              <label></label>
            </div>
            <?php echo $lang->idAB;?>
          </th>
          <th class='w-pri'><?php echo $lang->priAB;?></th>
          <th class='w-150px'><?php echo $lang->story->module;?></th>
          <th><?php echo $lang->story->title;?></th>
          <th class='w-80px'><?php echo $lang->story->stage;?></th>
          <th class='w-user'><?php echo $lang->openedByAB;?></th>
          <th class='w-80px'><?php echo $lang->story->estimateAB;?></th>
        </tr>
      </thead>
      <?php if($stories):?>
      <tbody>
        <?php foreach($stories as $story):?>
        <?php $storyLink = $this->createLink('story', 'view', "storyID=$story->id");?>
        <tr>
          <td class='c-id'>
            <div class="checkbox-primary">
              <input type='checkbox' name='stories[]'  value='<?php echo $story->id;?>' <?php if(strpos(",{$selectedStories},", "{$story->id}") !== false) echo 'checked';?>/>
              <label></label>
            </div>
            <?php echo html::hidden("products[$story->id]", $story->product);?>
            <?php printf('%03d', $story->id);?>
          </td>
          <td><span class='<?php echo 'pri' . zget($lang->story->priList, $story->pri, $story->pri)?>'><?php echo zget($lang->story->priList, $story->pri, $story->pri);?></span></td>
          <td class='text-left' title='<?php echo zget($modules, $story->module, '')?>'><?php echo zget($modules, $story->module, '')?></td>
          <td class='text-left nobr' title="<?php echo $story->title?>"><?php echo html::a($storyLink, $story->title);?></td>
          <td><?php echo zget($lang->story->stageList, $story->stage);?></td>
          <td><?php echo zget($users, $story->openedBy, $story->openedBy);?></td>
          <td><?php echo $story->estimate;?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
      <?php endif;?>
    </table>
    <div class='table-footer'>
      <div class="checkbox-primary check-all"><label><?php echo $lang->selectAll?></label></div>
      <div class="btn-toolbar">
        <div class='input-group w-250px'>
          <?php
          echo html::input('num', '10', "class='form-control w-110px' autocomplete='off'");
          echo "<span class='input-group-addon'></span>";
          echo html::select('fileType', array('xlsx' => 'xlsx', 'xls' => 'xls'), 'xlsx', "class='form-control w-80px'");
          echo "<span class='input-group-btn'>" . html::submitButton($lang->testcase->exportTemplet) . "</span>";
          ?>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
$(function()
{
    $.toggleQueryBox(true);

    $(document).on('change', 'input:checked', function()
    {
        selectedStories = '';
        $('.cell-id :checked').each(function()
        {
            if($(this).prop('checked') && $(this).val()) selectedStories += $(this).val() + ','
        });
        $.cookie('selectedStories', false);
        $.cookie('selectedStories[<?php echo $product->id?>]', selectedStories);
    });
})
</script>
<?php include '../../../common/view/footer.html.php';?>
