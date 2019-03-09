<?php
global $app;
if(!empty($app->user->feedback) or !empty($_COOKIE['feedbackView']))
{
    unset($config->doc->search['fields']['product']);
    unset($config->doc->search['fields']['project']);
    unset($config->doc->search['params']['product']);
    unset($config->doc->search['params']['project']);
}

$config->doc->notArticleType .= ',chapter';
