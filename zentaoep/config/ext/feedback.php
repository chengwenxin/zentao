<?php
if(!defined('TABLE_FEEDBACK')) define('TABLE_FEEDBACK', '`' . $config->db->prefix . 'feedback`');
if(!defined('TABLE_FEEDBACKPRODUCT')) define('TABLE_FEEDBACKPRODUCT', '`' . $config->db->prefix . 'feedbackproduct`');

$config->objectTables['feedback'] = TABLE_FEEDBACK;

$filter->default->cookie['feedbackView'] = 'equal::1';
