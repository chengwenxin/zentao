<?php
/**
 * The browse view file of feedback module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     feedback
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php js::set('browseType', isset($browseType) ? $browseType : '')?>
<?php $viewMethod = 'view'?>
<div id='mainMenu' class='clearfix'>
  <div class='btn-toolbar pull-left'>
    <?php foreach($lang->feedback->tabList as $type => $name):?>
    <?php $active = (isset($browseType) and $type == $browseType) ? "btn-active-text" : ''?>
    <?php echo html::a(inlink('browse', "browseType=$type"), "<span class='text'>{$name}</span>", '', "id='{$type}Tab' class='btn btn-link $active'")?>
    <?php endforeach?>
  </div>
  <div class='btn-toolbar pull-right'>
  <?php echo html::a(inlink('create'), "<i class='icon-plus'></i>" . $lang->feedback->create, '', "class='btn'")?>
  </div>
</div>
<div id='mainContent' class='main-table' data-ride='table'>
  <?php include './data.html.php';?>
</div>
<?php include '../../common/view/footer.html.php';?>
