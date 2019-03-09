<?php
/**
 * The story block view file of block module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<style>
.block-todoes .c-date {width: 100px;}
.block-todoes .c-pri {width: 45px;text-align: center;}
.block-todoes .c-status {width: 80px;}
</style>
<div class='panel-body has-table scrollbar-hover'>
  <table class='table table-borderless table-hover table-fixed table-fixed-head tablesorter block-todoes'>
    <thead>
      <tr>
        <th class='c-date'><?php echo $lang->todo->date;?></th>
        <th class="c-pri"><?php echo $lang->priAB?></th>
        <th class="c-name"><?php echo $lang->todo->name;?></th>
        <th class="c-status"><?php echo $lang->statusAB;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($todos as $todo):?>
      <?php
      $appid = isset($_GET['entry']) ? "class='app-btn' data-id='{$this->get->entry}'" : '';
      $viewLink = $this->createLink('todo', 'view', "todo={$todo->id}");
      ?>
      <tr data-url='<?php echo empty($sso) ? $viewLink : $sso . $sign . 'referer=' . base64_encode($viewLink); ?>' <?php echo $appid?>>
        <td class='c-date'>
          <?php if ($todo->date == '2030-01-01') :?>
          <?php echo $lang->todo->periods['future'];?>
          <?php else:?>
          <?php echo date(DT_DATE4, strtotime($todo->date)) . ' ' . $todo->begin;?>
          <?php endif;?>
        </td>
        <td class="c-pri"><span class="todo-pri label-pri label-pri-<?php echo $todo->pri?>" title="<?php echo zget($lang->todo->priList, $todo->pri);?>"><?php echo zget($lang->todo->priList, $todo->pri);?></span></td>
        <td class="c-name" title='<?php echo $todo->name;?>'><?php echo $todo->name;?></td>
        <td class='c-status'><?php echo zget($lang->todo->statusList, $todo->status);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
