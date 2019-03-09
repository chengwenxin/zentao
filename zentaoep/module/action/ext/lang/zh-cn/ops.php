<?php
$lang->action->label->service    = '服务|service|view|id=%s';
$lang->action->label->serverroom = '机房|serverroom|browse|';
$lang->action->label->host       = '主机|host|view|id=%s';
$lang->action->label->deploy     = '上线计划|deploy|view|id=%s';
$lang->action->label->deploystep = '上线步骤|deploy|viewStep|id=%s';

$lang->action->objectTypes['service']    = '服务';
$lang->action->objectTypes['serverroom'] = '机房';
$lang->action->objectTypes['host']       = '主机';
$lang->action->objectTypes['deploy']     = '上线计划';
$lang->action->objectTypes['deploystep'] = '上线步骤';

$lang->action->desc->online        = '$date, 由 <strong>$actor</strong> 上架。' . "\n";
$lang->action->desc->offline       = '$date, 由 <strong>$actor</strong> 下架。' . "\n";
$lang->action->desc->linkhost      = '$date, 由 <strong>$actor</strong> 关联主机。' . "\n";
$lang->action->desc->linkservice   = '$date, 由 <strong>$actor</strong> 关联服务。' . "\n";
$lang->action->desc->linkcomponent = '$date, 由 <strong>$actor</strong> 关联组件' . "\n";
$lang->action->desc->linkcases     = '$date, 由 <strong>$actor</strong> 关联用例' . "\n";

$lang->action->label->online        = '上架了';
$lang->action->label->offline       = '下架了';
$lang->action->label->linkhost      = '主机关联到';
$lang->action->label->linkservice   = '服务关联到';
$lang->action->label->linkcomponent = '组件关联到';
$lang->action->label->linkcases     = '用例关联到';
