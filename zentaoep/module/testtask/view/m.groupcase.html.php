<?php
/**
 * The groupcase mobile view file of testtask module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     testtask
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include './m.caseheader.html.php';?>
<section id='page' class='section list-with-pager'>
  <?php $refreshUrl = $this->createLink('testtask', 'groupcase', http_build_query($this->app->getParams()));?>
  <div class='box' data-refresh-url='<?php echo $refreshUrl ?>'>
    <table class='table bordered no-margin'>
      <thead>
        <tr>
          <th class='w-50px'></th>
          <th class='w-40px'><?php echo $lang->priAB;?></th>
          <th><?php echo $lang->testcase->title;?></th>
          <th class='w-80px text-center'><?php echo $lang->testcase->status;?></th>
        </tr>
      </thead>
      <?php foreach($cases as $groupKey => $groupTasks):?>
      <tr id='node-<?php echo $groupKey;?>' class='actie-disabled group-title'>
        <td class='text-right strong group-name'><i class='icon-caret-down'></i><?php echo $groupKey;?></td>
        <td colspan='3' class='text-left'><?php if($groupByList) echo $groupByList[$groupKey];?></td>
      </tr>
      <?php foreach($groupTasks as $case):?>
      <tr class='text-center child-of-node-<?php echo $groupKey;?>' data-url='<?php echo $this->createLink('testcase', 'view', "caseID={$case->id}")?>' data-id='<?php echo$case->id;?>'>
        <td></td>
		<td><span class='<?php echo 'pri' . zget($lang->testcase->priList, $case->pri);?>'><?php echo zget($lang->testcase->priList, $case->pri)?></span></td>
        <td class='text-left'>
        <?php echo "<span style='color:$case->color'>" . $case->title . '</span>';?>
        </td>
        <td class='testcase-<?php echo $case->status;?>'><?php echo zget($lang->testcase->statusList, $case->status);?></td>
      </tr>
      <?php endforeach;?>
      <?php endforeach;?>
    </table>
  </div>
</section>
<script>
$(function()
{
    $('tr[id^="node-"]').click(function()
    {
        var groupKey = $(this).attr('id').replace('node-', '');
        if($(this).hasClass('hidden-child'))
        {
            $(this).removeClass('hidden-child');
            $(this).find('.icon-caret-right').removeClass('icon-caret-right').addClass('icon-caret-down');
            $('tr.child-of-node-' + groupKey).show();
        }
        else
        {
            $(this).addClass('hidden-child');
            $(this).find('.icon-caret-down').removeClass('icon-caret-down').addClass('icon-caret-right');
            $('tr.child-of-node-' + groupKey).hide();
        }
    });
    $('#groupcaseTab').addClass('active');
})
</script>
<?php include '../../common/view/m.footer.html.php';?>
