<?php
/**
 * The change password  view of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     user
 * @version     $Id: editprofile.html.php 2605 2012-02-21 07:22:58Z wwccss $
 * @link        http://www.zentao.net
 */
?>

<?php include "../../common/view/m.header.html.php";?>

<div id='page' class='list-with-actions'>
  <div class='heading divider'>
    <div class='title'> <strong><?php echo $user->account . ' :: ' . $lang->my->changePassword;?></strong></div>
  </div>
  <form class='content box' data-form-refresh='#page' method='post' id='changePassordForm' target='hiddenwin' action='<?php echo $this->createLink('my', 'changePassword');?>' enctype='multipart/form-data'>
    <div class="control">
      <label for='originalPassword'><?php echo $lang->user->originalPassword;?></label>
      <?php echo html::password('originalPassword', '', "class='input'");?>
    </div>  
    <div class="control">
      <label for='password1'><?php echo $lang->user->password;?></label>
      <?php echo html::password('password1', '', "class='input' autocomplete='off' onkeyup='checkPassword(this.value)' placeholder='" . (!empty($config->safe->mode) ? $lang->user->placeholder->passwordStrength[$config->safe->mode] : '') . "'");?>
      <p class='help-text text-important' id='passwordStrength'></p>
    </div>  
    <div class="control">
      <label for='password2'><?php echo $lang->user->password2;?></label>
      <?php echo html::password('password2', '', "class='input'");?>
    </div>
    <div class='control'>
      <button type='submit' id='submitButton' class='btn primary'><?php echo $lang->save ?></button>
      <?php echo html::hidden('account',$user->account);?>
    </div>
    <?php if(!empty($this->app->user->modifyPasswordReason)):?>
    <?php $this->app->loadLang('admin');?>
    <div class='alert alert-info'>
      <?php echo $lang->admin->safe->common . ' : ';?>
      <?php echo $this->app->user->modifyPasswordReason == 'weak' ? $lang->admin->safe->changeWeak : $lang->admin->safe->modifyPasswordFirstLogin;?>
    </div>
    <?php endif;?>
  </form>  
</div>

<?php js::set('passwordStrengthList', $lang->user->passwordStrengthList)?>
<script>
function checkPassword(password)
{
    $('#passwordStrength').html(password == '' ? '' : passwordStrengthList[computePasswordStrength(password)]);
    $('#passwordStrength').css('display', password == '' ? 'none' : 'display');
}
</script>
<?php include "../../common/view/m.footer.html.php"; ?>
