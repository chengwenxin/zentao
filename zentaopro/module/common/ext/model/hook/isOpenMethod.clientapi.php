<?php
if($module == 'api')
{
    if($method == 'mobilegetlist'    ||
       $method == 'mobilegetinfo'    ||
       $method == 'mobilegetuser'    ||
       $method == 'mobilegetusers'   ||
       $method == 'mobilegethistory' ||
       $method == 'mobilecomment'    ||
       $method == 'mobilegetcustom') return true;
}
