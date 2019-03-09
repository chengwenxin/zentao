<?php
$lang->user->importLDAP = '从LDAP导入用户';
$lang->user->group      = '权限分组';
$lang->user->link       = '关联本地账号';

if(!isset($lang->user->error)) $lang->user->error = new stdclass();
$lang->user->error->repeat     = "%s，因为用户名重复，不能添加！，请修改用户名后再添加";
$lang->user->error->illaccount = "%s，因为用户名不合法，添加失败！，请修改用户名后再添加";
$lang->user->error->userLimit  = "人数已经达到授权的上限，不能从LDAP导入新用户！";
$lang->user->error->duplicated = '重复关联账号';

$lang->user->notice = new stdclass();
$lang->user->notice->checkbox = '没有勾选，则不导入！';
$lang->user->notice->ldapoff  = 'LDAP处于关闭状态。';
