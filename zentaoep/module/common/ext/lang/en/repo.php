<?php
$lang->menu->repo           = 'Repo|repo|browse';
$lang->menuOrder[21]        = 'repo';

$lang->repo                 = new stdclass();
$lang->repo->menu           = new stdclass();
$lang->repo->menu->browse   = array('link' =>'Browse|repo|browse|repoID=%s', 'alias' => 'diff,log,view,revision,blame,showsynccomment');
$lang->repo->menu->review   = 'Review|repo|review|repoID=%s';
$lang->repo->menu->settings = 'Setting|repo|settings|repoID=%s';
$lang->repo->menu->delete   = array('link' => 'Delete|repo|delete|repoID=%s', 'target' => 'hiddenwin');
