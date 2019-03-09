<?php
/**
 * The collabora view file of file module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     file
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.lite.html.php';?>
<style>
body{padding-bottom:0px;}
</style>
<?php if(common::hasPriv('file', 'edit') and isset($collaboraEdit)):?>
<?php echo html::a($collaboraEdit, "<i class='icon icon-edit' title='{$lang->edit}'></i>", 'collabora', "id='collaboraEdit' style='position:absolute;top:8px;right:30px;z-index:9999;'");?>
<?php endif;?>
<iframe src='<?php echo $collaboraUrl;?>' border='0' scrolling="no" allowfullscreen style='width:100%;height:100%;display:block;position:absolute;top:0;z-index:60;' id='collabora' name='collabora'></iframe>
<script>
$(function()
{
    $('#collaboraEdit').click(function(){$(this).hide();})
})
</script>
<?php include '../../../common/view/footer.lite.html.php';?>
