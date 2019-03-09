<?php 
/**
 * Print user avatar
 * 
 * @param  string $size
 * @static
 * @return void
 */
function printUserAvatar($class = 'circle', $user = null)
{
    global $app;
    if($user === null) $user = $app->user;

    echo "<div class='avatar text-tint $class' data-skin='{$user->id}'>";
    if(!empty($user->avatar)) echo html::image($user->avatar);
    else echo (!empty($user->realname) ? $user->realname : (!empty($user->name) ? $user->name : (!empty($user->account) ? $user->account : '<i class="icon icon-user"></i>')));
    echo '</div>';
}
?>
