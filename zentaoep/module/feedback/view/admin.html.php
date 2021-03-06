<?php
/**
 * The admin view file of feedback module of ZenTaoPMS.
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
<div id='queryBox' class='cell <?php if($browseType == 'bysearch') echo 'show';?>'></div>
<div id='mainContent' class='main-table' data-ride='table'>
  <?php $viewMethod = 'adminView'?>
  <?php include './data.html.php';?>
</div>
<?php include '../../common/view/footer.html.php';?>
