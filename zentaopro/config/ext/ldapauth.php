<?php
$config->accountRule = '|^[a-zA-Z0-9_\-]{1}[a-zA-Z0-9_\.\-]{0,}[a-zA-Z0-9_\-]{1}$|';

$filter->user->importldap = new stdclass();
$filter->user->importldap->cookie['pagerUserImportldap'] = 'int';
