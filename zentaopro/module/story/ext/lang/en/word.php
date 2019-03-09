<?php
if($this->methodName == 'export' and $this->moduleName == 'story')
{
    if(in_array('excel', $lang->exportFileTypeList))
    {
        unset($lang->exportFileTypeList['excel']);
        $lang->exportFileTypeList = array('excel' => 'excel', 'word' => 'word') + $lang->exportFileTypeList;
    }
    else
    {
        $lang->exportFileTypeList = array('word' => 'word') + $lang->exportFileTypeList;
    }
}
