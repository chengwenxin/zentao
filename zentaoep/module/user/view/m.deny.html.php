<?php
/**
 * The deny mobile view file of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     user
 * @version     $Id: index.html.php 3830 2016-05-18 09:34:17Z liugang $
 * @link        http://www.zentao.net
 */
?>
<?php
$bodyClass = 'with-menu-top';
include "../../common/view/m.header.html.php";
?>
<div id='page' class='list-with-actions'>
  <div class='section no-margin'>
    <div class='content'>
    <?php
    $moduleName = isset($lang->$module->common)  ? $lang->$module->common:  $module;
    $methodName = isset($lang->$module->$method) ? $lang->$module->$method: $method;

    /* find method name if method is lowercase letter. */
    if(!isset($lang->$module->$method))
    {
        $tmpLang = array();
        foreach($lang->$module as $key => $value)
        {
            $tmpLang[strtolower($key)] = $value;
        }    
        $methodName = isset($tmpLang[$method]) ? $tmpLang[$method] : $method;
    }

    printf($lang->user->errorDeny, $moduleName, $methodName);
    ?>
    </div>
    <nav class='nav nav-auto affix dock-bottom footer-actions'>
    <?php
    $isOnlybody = helper::inOnlyBodyMode();
    unset($_GET['onlybody']);
    echo html::a($this->createLink($config->default->module), $lang->my->common, ($isOnlybody ? '_parent' : ''), "class='btn'");
    if($refererBeforeDeny) echo html::a(helper::safe64Decode($refererBeforeDeny), $lang->user->goback, ($isOnlybody ? '_parent' : ''), "class='btn'");
    echo html::a($this->createLink('user', 'logout', "referer=" . helper::safe64Encode($denyPage)), $lang->user->relogin, ($isOnlybody ? '_parent' : ''), "class='btn btn-primary'");
    ?>
    </nav>
  </div>
</div>
<?php include "../../common/view/m.footer.html.php"; ?>
