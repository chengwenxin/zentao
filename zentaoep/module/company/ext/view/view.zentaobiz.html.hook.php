<?php if(!empty($this->app->user->feedback) or $this->cookie->feedbackView):?>
<script>
<?php
$featurebar  = "<div id='featurebar'><ul class='nav'>";
list($name, $module, $method) = explode('|', $lang->company->menu->browseUser['link']);
if(common::hasPriv($module, $method)) $featurebar .= "<li>" . html::a($this->createLink($module, $method), $name) . '</li>';

list($name, $module, $method) = explode('|', $lang->company->menu->browseGroup['link']);
if(common::hasPriv($module, $method)) $featurebar .= '<li>' . html::a($this->createLink($module, $method), $name) . '</li>';

list($name, $module, $method) = explode('|', $lang->company->menu->view['link']);
if(common::hasPriv($module, $method)) $featurebar .= "<li class='active'>" . html::a($this->createLink($module, $method), $name) . '</li>';
$featurebar .= '</ul></div>';
?>
$('.outer').prepend(<?php echo json_encode($featurebar)?>);
</script>
<?php endif;?>
