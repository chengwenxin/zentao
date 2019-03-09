<?php
if(!empty($_SESSION['user']->feedback) or !empty($_COOKIE['feedbackView']))
{
    $config->custom->moblieHidden['main'][] = 'ops';
}
$config->custom->moblieHidden['my']         = array('changePassword', 'manageContacts', 'profile', 'review');
$config->custom->moblieHidden['oa']         = array('holiday', 'review');
$config->custom->moblieHidden['feedback'][] = 'products';
$config->custom->moblieHidden['ops'][]      = 'setting';
