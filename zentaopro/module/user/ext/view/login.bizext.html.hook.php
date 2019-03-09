<?php
$properties = $this->loadModel('api')->getLicenses();
$html       = '';
if(isset($properties['expireDate']) and $properties['expireDate'] != 'All Life')
{
    $expireDays = helper::diffDate($properties['expireDate'], date('Y-m-d'));
    if($expireDays <= 7 and $expireDays >= 0) $html = sprintf($lang->user->expireWaring, $expireDays);
}
?>
<script>
$(function()
{
    $('#poweredby').append(<?php echo json_encode($html);?>);
})
</script>
