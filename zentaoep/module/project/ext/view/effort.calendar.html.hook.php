<?php
$calendar = common::hasPriv('project', 'effortcalendar') ? html::a(helper::createLink('project', 'effortcalendar', "prejectID=$projectID"), $lang->effort->common, '', "class='btn btn-link' id='calendarTab'") : '';
?>
<script language='Javascript'>
$(function(){
    $('#mainMenu .btn-toolbar.pull-left').prepend(<?php echo json_encode($calendar);?>);
})
</script>
