<?php if(isonlybody()):?>
<style>
.body-modal .main-header{padding-right:0px;}
</style>
<?php $html = '<div class="divider"></div><button id="closeModal" type="button" class="btn btn-link" data-dismiss="modal"><i class="icon icon-close"></i></button>';?>
<script>
$(function()
{
    parent.$('#triggerModal .modal-content .modal-header .close').hide()
    $('#mainContent .main-header .pull-right.btn-toolbar').append(<?php echo json_encode($html)?>);
})
</script>
<?php endif;?>
