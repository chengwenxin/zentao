<?php
/**
 * The view mobile view file of todo module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     todo 
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */

if($this->session->todoList)
{
    $browseLink = $this->session->todoList;
}
elseif($todo->account == $app->user->account)
{
    $browseLink = $this->createLink('my', 'todo');
}
else
{
    $browseLink = $this->createLink('user', 'todo', "account=$todo->account");
}

$bodyClass  = 'with-nav-bottom';
include "../../common/view/m.header.html.php";
?>

<div id='page' class='list-with-actions'>
  <div class='heading'>
    <div class='title'><i class='icon-calendar'> </i><?php echo $lang->todo->view;?></div>
    <nav class='nav'>
      <a href='<?php echo $browseLink;?>' class='btn primary'><?php echo $lang->goback;?></a>
    </nav>
  </div>
  <div class='section no-margin'> 
    <div class='box'>
      <table class='table bordered table-detail'>
        <tr>
          <td class='w-80px'><?php echo $lang->todo->name;?></td>
          <td><?php echo $todo->name;?></td>
        </tr>
        <tr>
          <td><?php echo $lang->todo->pri;?></td>
          <td><span class='label pri-<?php echo $todo->pri;?>'><?php echo zget($lang->todo->priList, $todo->pri);?></span></td>
        </tr>
        <tr>
          <td><?php echo $lang->todo->status;?></td>
          <td><span class='label status-<?php echo $todo->status;?>'><?php echo zget($lang->todo->statusList, $todo->status);?></span></td>
        </tr>
        <?php if($todo->private): ?>
        <tr>
        <td></td>
        <td><?php echo $lang->todo->private ?></td>
        </tr>
        <?php endif; ?>
        <?php if($todo->desc):?>
        <tr>
          <td><?php echo $lang->todo->desc;?></td>
          <td><?php echo $todo->desc;?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td><?php echo $lang->todo->type;?></td>
          <td><?php echo zget($lang->todo->typeList, $todo->type);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->todo->account;?></td>
          <td><?php echo zget($users, $todo->account);?></td>
        </tr>
        <tr>
          <td><?php echo $lang->todo->date;?></td>
          <td><?php echo $todo->date == '00000000' ? $lang->todo->periods['future'] : date(DT_DATE1, strtotime($todo->date));?></td>
        </tr>
        <?php if(isset($times[$todo->begin]) or isset($times[$todo->end])):?>
        <tr>
          <td><?php echo $lang->todo->beginAndEnd;?></td>
          <td><?php echo $times[$todo->begin] . ' ~ ' . $times[$todo->end];?></td>
        </tr>
        <?php endif;?>
      </table>
    </div>
  </div>

  <div class='section' id='history'>
  <?php include '../../common/view/m.action.html.php';?>
  </div>

  <nav class='nav nav-auto affix dock-bottom footer-actions'>
  <?php
  if(common::hasPriv('todo', 'finish') and $todo->status != 'done') echo html::a($this->createLink('todo', 'finish', "todoID=$todo->id"), $lang->todo->finish, 'hiddenwin');
  if($todo->account == $app->user->account)
  {   
      common::printIcon('todo', 'edit',   "todoID=$todo->id", $todo, 'button','', '', '', false, "data-display='modal' data-placement='bottom'", $lang->edit);
      if(common::hasPriv('todo', 'delete')) echo html::a($this->createLink('todo', 'delete', "todoID=$todo->id"), $lang->delete, 'hiddenwin');
  }
  ?>
  </nav>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
