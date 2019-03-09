<?php if(common::hasPriv('user', 'effortcalendar')):?>
<script>
$('#mainContent #contentNav ul.nav').prepend(<?php echo json_encode("<li id='effortcalendar'>" . html::a(inlink('effortcalendar', "account=$account"), '<i class="icon icon-back icon-sm"></i> ' . $lang->goback) . '</li>');?>);
</script>
<?php endif;?>
