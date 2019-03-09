<?php
$viewDir      = dirname(__FILE__);
$file2Include = file_exists(dirname($viewDir) . "/ext/view/m.{$code}block.html.php") ? dirname($viewDir) . "/ext/view/m.{$code}block.html.php" : "{$viewDir}/m.{$code}block.html.php";
if(file_exists($file2Include)) include $file2Include;
?>
