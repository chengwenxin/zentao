<?php
/**
 * The bug mobile view file of user module of ZenTaoPMS.
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
  echo html::a(inlink('bug', "account=$account&type=assignedTo"), $lang->user->assignedTo);
  echo html::a(inlink('bug', "account=$account&type=openedBy"),   $lang->user->openedBy);
  echo html::a(inlink('bug', "account=$account&type=resolvedBy"), $lang->user->resolvedBy); 
  echo html::a(inlink('bug', "account=$account&type=closedBy"),   $lang->user->closedBy);
  ?>
  <a class='moreSubMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreSubMenu' class='list dropdown-menu'></div>
</nav>

<section id='page' class='section list-with-pager'>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $this->createLink('user', 'bug', "account=$account&type=$type&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"); ?>'>
    <table class='table bordered'>
      <thead>
        <tr>
          <th><?php echo $lang->bug->title;?> </th>
          <th class='text-center w-80px'><?php echo $lang->bug->status;?> </th>
        </tr>
      </thead>
      <?php foreach($bugs as $bug):?>
      <tr class='text-center' data-url='<?php echo $this->createLink('bug', 'view', "bugID={$bug->id}");?>' data-id='<?php echo $bug->id;?>'>
        <td class='text-left'><?php echo $bug->title;?></td>
        <td class='bug-<?php echo $bug->status?>'><?php echo zget($lang->bug->statusList, $bug->status);?></td>
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
$('#subMenu > a').removeClass('active').filter('[href*="<?php echo $type?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
