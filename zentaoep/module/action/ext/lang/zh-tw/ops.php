<?php
$lang->action->label->service    = '服務|service|view|id=%s';
$lang->action->label->serverroom = '機房|serverroom|browse|';
$lang->action->label->host       = '主機|host|view|id=%s';
$lang->action->label->deploy     = '上線計劃|deploy|view|id=%s';
$lang->action->label->deploystep = '上線步驟|deploy|viewStep|id=%s';

$lang->action->objectTypes['service']    = '服務';
$lang->action->objectTypes['serverroom'] = '機房';
$lang->action->objectTypes['host']       = '主機';
$lang->action->objectTypes['deploy']     = '上線計劃';
$lang->action->objectTypes['deploystep'] = '上線步驟';

$lang->action->desc->online        = '$date, 由 <strong>$actor</strong> 上架。' . "\n";
$lang->action->desc->offline       = '$date, 由 <strong>$actor</strong> 下架。' . "\n";
$lang->action->desc->linkhost      = '$date, 由 <strong>$actor</strong> 關聯主機。' . "\n";
$lang->action->desc->linkservice   = '$date, 由 <strong>$actor</strong> 關聯服務。' . "\n";
$lang->action->desc->linkcomponent = '$date, 由 <strong>$actor</strong> 關聯組件' . "\n";
$lang->action->desc->linkcases     = '$date, 由 <strong>$actor</strong> 關聯用例' . "\n";

$lang->action->label->online        = '上架了';
$lang->action->label->offline       = '下架了';
$lang->action->label->linkhost      = '主機關聯到';
$lang->action->label->linkservice   = '服務關聯到';
$lang->action->label->linkcomponent = '組件關聯到';
$lang->action->label->linkcases     = '用例關聯到';
