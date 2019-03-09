<?php
$config->dev->group['ops']           = 'ops';
$config->dev->group['host']          = 'ops';
$config->dev->group['asset']         = 'ops';
$config->dev->group['serverroom']    = 'ops';
$config->dev->group['service']       = 'ops';
$config->dev->group['deploy']        = 'ops';
$config->dev->group['deploystep']    = 'ops';
$config->dev->group['deployproduct'] = 'ops';
$config->dev->group['deployscope']   = 'ops';

$config->dev->tableMap['asset']         = 'host';
$config->dev->tableMap['deploystep']    = 'deploy';
$config->dev->tableMap['deployproduct'] = 'deploy';
$config->dev->tableMap['deployscope']   = 'deploy';
