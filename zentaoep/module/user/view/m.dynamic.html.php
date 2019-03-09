<?php
/**
 * The dynamic mobile view file of user module of ZenTaoPMS.
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
  echo html::a(inLink('dynamic', "period=today&account=$account"),      $lang->action->dynamic->today);
  echo html::a(inLink('dynamic', "period=yesterday&account=$account"),  $lang->action->dynamic->yesterday);
  echo html::a(inLink('dynamic', "period=twodaysago&account=$account"), $lang->action->dynamic->twoDaysAgo);
  echo html::a(inLink('dynamic', "period=thisweek&account=$account"),   $lang->action->dynamic->thisWeek);
  echo html::a(inLink('dynamic', "period=lastweek&account=$account"),   $lang->action->dynamic->lastWeek);
  echo html::a(inLink('dynamic', "period=thismonth&account=$account"),  $lang->action->dynamic->thisMonth);
  echo html::a(inLink('dynamic', "period=lastmonth&account=$account"),  $lang->action->dynamic->lastMonth);
  echo html::a(inLink('dynamic', "period=all&account=$account"),        $lang->action->dynamic->all);
  ?>
  <a class='moreSubMenu hidden' data-display='dropdown' data-placement='beside-bottom'><?php echo $lang->more;?></a>
  <div id='moreSubMenu' class='list dropdown-menu'></div>
</nav>

<section id='page' class='section list-with-pager'>
  <div class='box' data-page='<?php echo $pager->pageID ?>' data-refresh-url='<?php echo $this->createLink('user', 'dynamic', "period=$period&account=$account&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"); ?>'>
    <table class='table bordered'>
      <?php foreach($actions as $action): ?>
      <tr data-id='<?php echo $action->id;?>'>
        <td class='w-80px'><?php echo isset($users[$action->actor]) ? $users[$action->actor] : $action->actor; ?></td>
        <td>
          <?php echo $action->actionLabel;?>
          <?php if(strpos(',login,logout,', ",$action->action,") === false):?>
          <?php echo ' ' . $action->objectLabel;?>
          <a class='text-link' href='<?php echo $action->objectLink ?>'><?php echo $action->objectName ?></a>
          <?php endif;?>
        </td>
        <td class='w-120px'><?php echo $action->date ?></td>
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
$('#subMenu > a').removeClass('active').filter('[href*="<?php echo $period?>"]').addClass('active');
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
