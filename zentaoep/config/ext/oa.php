<?php
define('TABLE_ATTEND',     '`' . $config->db->prefix . 'attend`');
define('TABLE_ATTENDSTAT', '`' . $config->db->prefix . 'attendstat`');
define('TABLE_HOLIDAY',    '`' . $config->db->prefix . 'holiday`');
define('TABLE_LEAVE',      '`' . $config->db->prefix . 'leave`');
define('TABLE_OVERTIME',   '`' . $config->db->prefix . 'overtime`');
define('TABLE_LIEU',       '`' . $config->db->prefix . 'lieu`');
define('TABLE_TRIP',       '`' . $config->db->prefix . 'trip`');

$config->objectTables['attend']     = TABLE_ATTEND;
$config->objectTables['attendstat'] = TABLE_ATTENDSTAT;
$config->objectTables['holiday']    = TABLE_HOLIDAY;
$config->objectTables['leave']      = TABLE_LEAVE;
$config->objectTables['overtime']   = TABLE_OVERTIME;
$config->objectTables['lieu']       = TABLE_LIEU;
$config->objectTables['trip']       = TABLE_TRIP;
