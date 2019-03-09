$(document).ready(function(){
    $('#osName').change(function(){
        var selectVal = $('#osName').val();
        $.get(createLink('host', 'ajaxGetOSVersion', 'field=' + selectVal), function(data)
        {
            $('select#osVersion').replaceWith(data);
            $('#osVersion_chosen').remove();
            $("select#osVersion").chosen();
        });
    });

    var oldVal = $('select#unit').val();
    $('select#unit').change(function(){
        var diskSize = $('input#diskSize').val();
        if(oldVal == 'GB' && diskSize < 1024) $('select#unit').val('GB');

        var selectVal = $('select#unit').val();
        if(selectVal != oldVal)
        {
            if(selectVal == 'TB')
            {
                $('input#diskSize').val(diskSize / 1024);
                oldVal = 'TB';
            }

            if(selectVal == 'GB')
            {
                $('input#diskSize').val(diskSize * 1024);
                oldVal = 'GB';
            }
        }
    });
});
