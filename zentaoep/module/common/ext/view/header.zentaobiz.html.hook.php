<style>
<?php if($this->app->getClientLang() == 'en'):?>
#navbar ul.nav li a{padding:10px 8px;}
<?php else:?>
#navbar ul.nav li a{padding:10px 13px;}
<?php endif;?>
</style>
<?php if(!empty($this->app->user->feedback) or $this->cookie->feedbackView):?>
<?php $config->global->novice = false; ?>
<?php $menuGroup = zget($this->lang->menugroup, $this->moduleName);?>
<?php if($menuGroup != 'oa' and $menuGroup != 'company'):?>
<style>
#header #subHeader{display:none}
</style>
<?php endif;?>
<style>
#userMenu #searchbox{display:none}
#extraNav{display:none;}
</style>
<?php endif;?>
