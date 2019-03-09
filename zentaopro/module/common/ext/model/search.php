<?php
/**
 * Print the position bar of Search. 
 * 
 * @param  int    $module 
 * @param  int    $object 
 * @param  int    $keywords 
 * @access public
 * @return void
 */
public function printSearch($module, $object, $keywords)
{
    echo "<li> {$this->lang->search->common} </li>" . "<li>{$keywords}</li>";
}
