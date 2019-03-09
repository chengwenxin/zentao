<?php if(strpos(",{$this->app->company->admins},", ",{$user->account},") === false):?>
<script>
$(function()
{
    appendFeedback('#account', '<?php echo $user->feedback?>', '<?php echo $lang->user->feedback?>', '<?php echo $lang->user->feedbackNotice?>');
    var groupValues = $('#groups').val();
    $('#feedback').change(function()
    {
       if($(this).prop('checked'))
       {
           $('#commiter').closest('tr').hide();
           $.get(createLink('group', 'ajaxGetPairs', "developer=0"), function(data)
           {
               $('#groups').closest('td').html(data);
               $('#group').attr('id', 'groups').attr('name', 'groups[]').attr('multiple', 'multiple').val(groupValues).chosen();
           })
           $('#realFeedback').val(1);
       }
       else
       {
           $('#commiter').closest('tr').show();
           $.get(createLink('group', 'ajaxGetPairs', "developer=1"), function(data)
           {
               $('#groups').closest('td').html(data);
               $('#group').attr('id', 'groups').attr('name', 'groups[]').attr('multiple', 'multiple').val(groupValues).chosen();
           })
           $('#realFeedback').val(0);
       }
    });
    $('#feedback').change();
})
</script>
<?php endif?>
