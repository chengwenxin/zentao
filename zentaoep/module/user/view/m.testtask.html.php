<?php
/**
 * The testtask mobile view file of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     user
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>

<?php
$bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
include "./m.featurebar.html.php";
?>

<nav id='subMenu' class='menu nav gray'>
  <?php
  echo html::a($this->createLink('user', 'testtask', "account=$account"),  $lang->user->testTask2Him);
  echo html::a($this->createLink('user', 'testcase', "account=$account&type=case2Him"),  $lang->user->case2Him);
  echo html::a($this->createLink('user', 'testcase', "account=$account&type=caseByHim"),  $lang->user->caseByHim);
  ?>
  <a class='moreSubMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreSubMenu' class='list dropdown-menu'></div>
</nav>

<section id='page' class='section list-with-pager'>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $this->createLink('user', 'testtask', "account=$account&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"); ?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th><?php echo $lang->testtask->name;?> </th>
          <th><?php echo $lang->testtask->build;?> </th>
          <th class='text-center w-70px'><?php echo $lang->statusAB;?> </th>
        </tr>
      </thead>
      <?php foreach($tasks as $task):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('testtask', 'view', "testtaskID={$task->id}");?>' data-id='<?php echo $task->id;?>'>
        <td class='text-left'><?php echo $task->name;?></td>
        <td><?php echo $task->buildName;?></td>
        <td class='testtask-<?php echo $task->status;?>'><?php echo zget($lang->testtask->statusList, $task->status);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>

  <nav class='nav justify pager'>
    <?php $pager->show($align = 'justify');?>
  </nav>
</section>

<script>
$('#<?php echo $methodName?>' + 'Tab').addClass('active');
$('#subMenu > a').removeClass('active').filter('[href*="testtask"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
