<?php
$lang->user->importLDAP = 'Import users from LDAP';
$lang->user->group      = 'Privileges';
$lang->user->link       = 'Link Local Account';

if(!isset($lang->user->error)) $lang->user->error = new stdclass();
$lang->user->error->repeat     = "%s, same user name exists in ZenTao, so it cannot be added! Edit the user name and then add it.";
$lang->user->error->illaccount = "%s, user name is not valid, so it failed! Edit the user name and add it.";
$lang->user->error->userLimit  = "The number of users has reached the limit of the licensed! No more users can be imported from LDAP!";
$lang->user->error->duplicated = 'Duplicated link local account.';

$lang->user->notice = new stdclass();
$lang->user->notice->checkbox = 'If not checked, it will not be imported!';
$lang->user->notice->ldapoff  = "LDAP is OFF!";
