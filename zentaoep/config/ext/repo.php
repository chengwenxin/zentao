<?php
if(!defined('TABLE_REPO'))        define('TABLE_REPO', $config->db->prefix . 'repo');
if(!defined('TABLE_REPOHISTORY')) define('TABLE_REPOHISTORY', $config->db->prefix . 'repohistory');
if(!defined('TABLE_REPOFILES'))   define('TABLE_REPOFILES', $config->db->prefix . 'repofiles');

$filter->repo = new stdclass();
$filter->repo->default = new stdclass();
$filter->repo->addbug  = new stdclass();
$filter->repo->diff    = new stdclass();
$filter->repo->view    = new stdclass();

$filter->repo->default->get['path']  = 'reg::base64';
$filter->repo->default->get['entry'] = 'reg::base64';
$filter->repo->addbug->get['file']   = 'reg::base64';

$filter->repo->diff->cookie['arrange']   = 'reg::word';
$filter->repo->diff->cookie['repoPairs'] = 'array';
$filter->repo->view->cookie['repoPairs'] = 'array';
