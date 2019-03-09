<?php
$lang->menu->repo           = '代码|repo|browse';
$lang->menuOrder[21]        = 'repo';

$lang->repo                 = new stdclass();
$lang->repo->menu           = new stdclass();
$lang->repo->menu->browse   = array('link' =>'浏览|repo|browse|repoID=%s', 'alias' => 'diff,log,view,revision,blame,showsynccomment');
$lang->repo->menu->review   = '评审|repo|review|repoID=%s';
$lang->repo->menu->settings = '设置|repo|settings|repoID=%s';
$lang->repo->menu->delete   = array('link' => '删除|repo|delete|repoID=%s', 'target' => 'hiddenwin');
