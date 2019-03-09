<?php $calendar = html::a(inlink('calendar'), "<span class='text'>{$lang->company->calendar}</span>", '', "class='btn btn-link' id='calendarTab'");?>
<script>
$('#mainMenu .btn-toolbar.pull-left').prepend(<?php echo json_encode($calendar);?>);
</script>
