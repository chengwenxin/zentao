<?php
/**
 * The footer mobile view of common module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     common 
 * @version     $Id: header.lite.html.php 3299 2015-12-02 02:10:06Z daitingting $
 * @link        http://www.zentao.net
 */

if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}
if(isset($pageJS)) js::execute($pageJS);

/* Load hook files for current page. */
$extPath      = dirname(dirname(dirname(__FILE__))) . '/common/ext/view/';
$extHookRule  = $extPath . $config->devicePrefix['mhtml'] . 'footer.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
?>
<?php if(isonlybody()):?>
<script>
href = location.href;
if(href.indexOf('onlybody=yes') > 0)
{
    href = href.replace('?onlybody=yes', '');
    location.href = href.replace('&onlybody=yes', '');
}
$(function()
{
    $('.display.modal #page.list-with-actions').removeClass('list-with-actions');
})
</script>
<?php return false;?>
<?php endif;?>
<iframe name="hiddenwin" id="hiddenwin" scrolling="no" class="debugwin hidden" frameborder="0"></iframe>
</body>
</html>
