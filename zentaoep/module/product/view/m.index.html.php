<?php
/**
 * The index mobile view file of product module of ZentTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     product 
 * @version     $Id$
 * @link        http://www.zentao.net
 */

include "../../common/view/m.header.html.php";
?>
<?php echo $this->fetch('block', 'dashboard', 'module=product');?>
<?php include "../../common/view/m.footer.html.php"; ?>
