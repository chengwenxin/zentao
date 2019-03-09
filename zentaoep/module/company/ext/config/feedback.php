<?php
$config->company->browse->search['fields']['feedback'] = $lang->user->feedback;
$config->company->browse->search['params']['feedback'] = array('operator' => '=', 'control' => 'select', 'values' => $lang->user->isFeedback);
