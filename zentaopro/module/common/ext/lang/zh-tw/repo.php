<?php
$lang->menu->repo           = '代碼|repo|browse';
$lang->menuOrder[21]        = 'repo';

$lang->repo                 = new stdclass();
$lang->repo->menu           = new stdclass();
$lang->repo->menu->browse   = array('link' =>'瀏覽|repo|browse|repoID=%s', 'alias' => 'diff,log,view,revision,blame,showsynccomment');
$lang->repo->menu->review   = '評審|repo|review|repoID=%s';
$lang->repo->menu->settings = '設置|repo|settings|repoID=%s';
$lang->repo->menu->delete   = array('link' => '刪除|repo|delete|repoID=%s', 'target' => 'hiddenwin');
