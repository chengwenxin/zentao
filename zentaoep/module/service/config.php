<?php
$config->service->editor = new stdclass();
$config->service->editor->create = array('id' => 'desc', 'tools' => 'simpleTools');
$config->service->editor->edit   = array('id' => 'desc', 'tools' => 'simpleTools');

$config->service->create = new stdclass();
$config->service->edit   = new stdclass();
$config->service->create->requiredFields = 'name';
$config->service->edit->requiredFields   = 'name';
