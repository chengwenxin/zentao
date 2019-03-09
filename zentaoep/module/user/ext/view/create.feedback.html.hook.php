<script>
$(function()
{
    appendFeedback('#account', '0', "<?php echo $lang->user->feedback?>", "<?php echo $lang->user->feedbackNotice?>");
    $('#feedback').change(function()
    {
       if($(this).prop('checked'))
       {
           $('#commiter').closest('tr').hide();
           $.get(createLink('group', 'ajaxGetPairs', "developer=0"), function(data)
           {
               $('#group').closest('td').html(data);
               $('#group').chosen();
           })
           $('#realFeedback').val(1);
       }
       else
       {
           $('#commiter').closest('tr').show();
           $.get(createLink('group', 'ajaxGetPairs', "developer=1"), function(data)
           {
               $('#group').closest('td').html(data);
               $('#group').chosen();
           })
           $('#realFeedback').val(0);
       }
    });
    $('#feedback').change();
});
</script>
