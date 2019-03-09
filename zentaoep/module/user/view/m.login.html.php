<?php
/**
 * The login mobile view file of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Fei Chen <chenfei@cnezsoft.com>
 * @package     user 
 * @version     $Id: login.html.php 3633 2016-02-23 09:21:34Z daitingting $
 * @link        http://www.zentao.net
 */
?>

<?php
$bodyClass = 'with-nav-top';
include '../../common/view/m.header.lite.html.php';
if(empty($config->notMd5Pwd)) js::import($webRoot . 'js/md5.js');
?>

<nav class='affix dock-top nav justify-center lang-menu'>
  <?php foreach($config->langs as $key => $value):?>
    <a data-value='<?php echo $key; ?>'<?php if($key === $this->app->getClientLang()) echo ' class="active"' ?>><?php echo $value;?></a>
  <?php endforeach;?>
</nav>

<div class='page with-nav-top'>
  <div id='login' class='column fluid-v no-margin flex-nowrap'>
    <div class='cell-3' id='loginLogo'>
      <div class='tile flex-center flex article'>
        <img src='<?php echo $webRoot . 'mobile/img/zentao.png' ?>' alt='<?php echo $lang->zentaoPMS;?>'>
      </div>
    </div>
    <div class='cell-5'>
      <div class='tile flex-center flex flex-column'>
        <form method='post' id='loginForm' target='hiddenwin'>
          <div class='control box danger form-message hide-empty'></div>
          <div class='control has-label-left fluid'>
            <input autofocus id='account' name='account' type='text' class='input' placeholder='<?php echo $lang->user->account?>'>
            <label for='account' title='<?php echo $lang->user->account;?>'><i class='icon icon-user'></i></label>
            <p class='help-text'></p>
          </div>
          <div class='control has-label-left fluid'>
            <input id='password' name='password' type='password' class='input' placeholder='<?php echo $lang->user->password;?>'>
            <label for='password' title='<?php echo $lang->user->password;?>'><i class='icon icon-lock'></i></label>
            <p class='help-text'></p>
          </div>
          <div class='control'>
            <div class='checkbox pull-right block'>
              <input type='checkbox' name='keepLogin' value='on'>
              <label for='keepLogin'><?php echo $lang->user->keepLogin['on'];?></label>
            </div>
          </div>
          <div class='control'>
            <button type='submit' class='btn rounded block fluid primary'><?php echo $lang->login;?></button>
          </div>
        </form>
      </div>
    </div>
    <?php echo html::hidden('verifyRand', $rand);?>
    <div class='cell-4'>
      <div class='text-center fluid has-padding affix dock-bottom'><?php printf($lang->welcome, isset($config->company->name) ? $config->company->name : '');?></div>
    </div>
  </div>
</div>

<?php include '../../common/view/m.footer.html.php';?>
