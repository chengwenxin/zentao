<?php
$lang->ldap->common = 'LDAP Settings';
$lang->ldap->index  = 'Settings';
$lang->ldap->base   = 'Basic Settings';
$lang->ldap->attr   = 'Attributes Settings';
$lang->ldap->import = 'Import users from LDAP';

$lang->ldap->turnon       = 'Status';
$lang->ldap->type         = 'Server Type';
$lang->ldap->host         = 'LDAP Server';
$lang->ldap->port         = 'Port';
$lang->ldap->version      = 'LDAP Version';
$lang->ldap->admin        = 'Admin Account';
$lang->ldap->password     = 'Password';
$lang->ldap->baseDN       = 'Base DN';
$lang->ldap->account      = 'Login Account';
$lang->ldap->realname     = 'Real Name';
$lang->ldap->email        = 'Email';
$lang->ldap->phone        = 'Phone';
$lang->ldap->mobile       = 'Mobile';
$lang->ldap->anonymous    = 'Anonymous';
$lang->ldap->charset      = 'LDAP Charset';
$lang->ldap->defaultGroup = 'Default Group';

$lang->ldap->example     = 'For example,';
$lang->ldap->accountPS   = 'Account on LDAP server';
$lang->ldap->groupPS     = 'Group to which LDAP user belongs after login';

$lang->ldap->successSave    = 'Saved!';

$lang->ldap->error          = new stdclass();
$lang->ldap->error->connect = "LDAP server is not connected. LDAP address or port error!";
$lang->ldap->error->verify  = 'Account/Password Error, or LDAP verison Error!';
$lang->ldap->error->noempty = '[%s] should not be empty.';

$lang->ldap->turnonList[0] = 'OFF';
$lang->ldap->turnonList[1] = 'ON';

$lang->ldap->versionList[3] = '3';
$lang->ldap->versionList[2] = '2';

$lang->ldap->typeList['ldap'] = "LDAP Server";
$lang->ldap->typeList['ad']   = "Active Directory";

$lang->ldap->noldap          = new stdclass();
$lang->ldap->noldap->header  = "ERROR:LDAP extension of PHP is not loaded. ";
$lang->ldap->noldap->content = 'This function depends on LDAP extension,you could modify the php.ini file, or install it. Specific instructions can refer to <a href="https://www.zentao.pm/book/zentaopromanual/137.html" target="_blank">Install LDAP extension</a>.';

