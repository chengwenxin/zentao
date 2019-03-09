<?php
if(!defined('TABLE_SEARCHINDEX')) define('TABLE_SEARCHINDEX', $config->db->prefix . 'searchindex');
if(!defined('TABLE_SEARCHDICT'))  define('TABLE_SEARCHDICT',  $config->db->prefix . 'searchdict');

$filter->search->index->get['words'] = 'reg::any';
$filter->search->index->get['type']  = 'code';
