<form method='post' action='<?php echo $this->createLink('report', 'export', "module=$module&productID=$productID&taskID=$taskID")?>' target='hiddenwin' style="padding: 10px 5% 50px" id='exportForm'>
  <table class="w-p100 table-form">
    <tr>
      <th class="w-120px"><?php echo $lang->setFileName?></th>
      <td class="w-150px"><input type="text" name="fileName" id="fileName" class="form-control"></td>
      <td><?php echo html::submitButton($lang->save, '', 'btn btn-primary') . html::hidden('items') . html::hidden('datas');?></td>
    </tr>
  </table>
</form>
<script>
$(function()
{
    $('#exportForm #submit').click(function()
    {
        if($('#datas').size() == 0) return true;

        $(":checkbox:checked[name^='charts']").each(function()
        {
            items = $('#exportForm #items').val();
            items += $(this).val() + ',';
            $('#exportForm #items').val(items);
        });

        var dataBox    = "<input type='hidden' name='%name%' id='%id%' />";
        var canvasSize = $('.chart-wrapper canvas').size();
        if(canvasSize == 0)
        {
            alert('<?php echo $lang->report->errorNoChart?>');
            return false;
        }
        $('.chart-wrapper canvas').each(function(i)
        {
            var obj = $(this).get(0);
            if(typeof(obj.toDataURL) == 'undefined')
            {
                alert('<?php echo $lang->report->errorExportChart?>');
                return false;
            }
            dataURL = $(this).get(0).toDataURL("image/png");
            dataID  = $(this).attr('id');
            var thisDataBox = dataBox.replace('%name%', dataID);
            thisDataBox = thisDataBox.replace('%id%', dataID);
            $('#exportForm #submit').after(thisDataBox);
            $('#exportForm #' + dataID).val(dataURL);

            if(i == canvasSize - 1) $('#datas').remove();
        });
    });
})
</script>
