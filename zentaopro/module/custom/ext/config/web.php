<?php
$config->custom->moblieHidden['my'] = array('changePassword', 'manageContacts', 'profile');
if($config->global->flow != 'onlyTest')
{
    $config->custom->moblieHidden['main']    = array('repo', 'doc', 'report', 'admin');
    $config->custom->moblieHidden['product'] = array('branch', 'module', 'create', 'doc');
    $config->custom->moblieHidden['project'] = array('create', 'effort', 'product', 'doc');
    $config->custom->moblieHidden['qa']      = array('testsuite', 'report', 'create');
    $config->custom->moblieHidden['company'] = array('dept', 'todo', 'browseGroup', 'addGroup', 'batchAddUser', 'addUser');
}
else
{
    $config->custom->moblieHidden['main']    = array('repo', 'doc', 'report', 'admin', 'testsuite', 'caselib', 'product');
    $config->custom->moblieHidden['testtask'] = array('create', 'report');
    $config->custom->moblieHidden['company'] = array('dept', 'todo', 'browseGroup', 'addGroup', 'batchAddUser', 'addUser');
}
