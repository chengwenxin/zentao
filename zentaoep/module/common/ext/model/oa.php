<?php
public static function printLink($module, $method, $vars = '', $label, $misc = '', $print = true, $onlyBody = false, $type = '', $object = null)
{
    if(strpos($module, '.') !== false) list($appName, $module) = explode('.', $module);
    if($module == 'trip' or $module == 'egress') return false;
    if(!commonModel::hasPriv($module, $method)) return false;

    $content  = '';
    $canClick = true;
    $link     = helper::createLink($module, $method, $vars, '', $onlyBody);
    if(!$canClick)
    {
        $misc = str_replace("class='", "disabled='disabled' class='disabled ", $misc);
        $misc = str_replace("data-toggle='modal'", ' ', $misc);
        $misc = str_replace("deleter", ' ', $misc);
        if(strpos($misc, "class='") === false) $misc .= " class='disabled' disabled='disabled'";
    }
    if($type == 'li') $content .= '<li' . ($canClick ? '' : " disabled='disabled' class='disabled'") . '>';
    $content .= html::a($canClick ? $link : 'javascript:void(0)', $label, '', $misc);
    if($type == 'li') $content .= '</li>';

    if($print !== false) echo $content;
    return $content;
}
