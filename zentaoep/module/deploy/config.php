<?php
$config->deploy->create   = new stdclass();
$config->deploy->edit     = new stdclass();
$config->deploy->editstep = new stdclass();
$config->deploy->finish   = new stdclass();
$config->deploy->create->requiredFields   = 'name,owner,begin,end';
$config->deploy->edit->requiredFields     = 'name,owner,begin,end';
$config->deploy->editstep->requiredFields = 'title,begin,end';
$config->deploy->finish->requiredFields   = 'result';

$config->deploy->editor = new stdclass();
$config->deploy->editor->create       = array('id' => 'desc', 'tools' => 'simpleTools');
$config->deploy->editor->edit         = array('id' => 'desc', 'tools' => 'simpleTools');
$config->deploy->editor->view         = array('id' => 'comment', 'tools' => 'simpleTools');
$config->deploy->editor->activate     = array('id' => 'comment', 'tools' => 'simpleTools');
$config->deploy->editor->activatestep = array('id' => 'comment', 'tools' => 'simpleTools');
$config->deploy->editor->finishstep   = array('id' => 'comment', 'tools' => 'simpleTools');
$config->deploy->editor->assignto     = array('id' => 'comment', 'tools' => 'simpleTools');
$config->deploy->editor->finish       = array('id' => 'comment', 'tools' => 'simpleTools');
