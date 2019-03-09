<?php
$config->message->available['sms'] = $config->message->available['mail'];

$config->message->condition['sms']['story']    = 'pri,assignedTo';
$config->message->condition['sms']['task']     = 'pri,assignedTo';
$config->message->condition['sms']['bug']      = 'pri,assignedTo';
$config->message->condition['sms']['testtask'] = 'pri,owner';

$config->message->setting['sms']['setting'] = $config->message->available['sms'];
