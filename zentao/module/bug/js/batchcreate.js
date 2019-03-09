$(function()
{
    removeDitto();//Remove 'ditto' in first row.

    var $titleCol = $('#batchCreateForm table thead tr th.c-title');
    if($titleCol.width() < 150) $titleCol.width(150);
})

/**
 * Set branch related.
 *
 * @param  int     $branchID
 * @param  int     $productID
 * @param  int     $num
 * @access public
 * @return void
 */
function setBranchRelated(branchID, productID, num)
{
    moduleLink = createLink('tree', 'ajaxGetModules', 'productID=' + productID + '&viewType=bug&branch=' + branchID + '&num=' + num);
    $.get(moduleLink, function(modules)
    {
        if(!modules) modules = '<select id="modules' + num + '" name="modules[' + num + ']" class="form-control"></select>';
        $('#modules' + num).replaceWith(modules);
        $("#modules" + num + "_chosen").remove();
        $("#modules" + num).chosen();
    });

    projectLink = createLink('product', 'ajaxGetProjects', 'productID=' + productID + '&projectID=0&branch=' + branchID + '&num=' + num);
    $.get(projectLink, function(projects)
    {
        if(!projects) projects = '<select id="projects' + num + '" name="projects[' + num + ']" class="form-control"></select>';
        $('#projects' + num).replaceWith(projects);
        $("#projects" + num + "_chosen").remove();
        $("#projects" + num).chosen();
    });

    buildLink = createLink('build', 'ajaxGetProductBuilds', 'productID=' + productID + "&varName=openedBuilds&build=&branch=" + branchID + "&index=" + num);

    setOpenedBuilds(buildLink, num);
}

/**
 * Set opened builds.
 *
 * @param  string  $link
 * @param  int     $index
 * @access public
 * @return void
 */
function setOpenedBuilds(link, index)
{
    $.get(link, function(builds)
    {
        var row = $('#buildBox' + index).closest('tbody').find('tr').size()
        do
        {
            var selected = $('#buildBox' + index).find('select').val();
            $('#buildBox' + index).html(builds);
            $('#buildBox' + index).find('select').val(selected);
            $('#openedBuilds' + index + '_chosen').remove();
            $('#buildBox' + index + ' select').removeClass('select-3');
            $('#buildBox' + index + ' select').addClass('select-1');
            $('#buildBox' + index + ' select').attr('name','openedBuilds[' + index + '][]');
            $('#buildBox' + index + ' select').attr('id','openedBuilds' + index);
            $('#buildBox' + index + ' select').chosen();

            index++;
            if($('#projects' + index).val() != 'ditto') break;
        }while(index < row)
    });
}

/**
 * Load project builds
 *
 * @param  int $productID
 * @param  int $projectID
 * @param  int $index
 * @access public
 * @return void
 */
function loadProjectBuilds(productID, projectID, index)
{
    branch = $('#branches' + index).val();
    if(projectID)
    {
        link = createLink('build', 'ajaxGetProjectBuilds', 'projectID=' + projectID + '&productID=' + productID + "&varName=openedBuilds&build=&branch=" + branch + "&index=" + index);
    }
    else
    {
        link = createLink('build', 'ajaxGetProductBuilds', 'productID=' + productID + "&varName=openedBuilds&build=&branch=" + branch + "&index=" + index);
    }

    setOpenedBuilds(link, index);
}

$(document).on('click', '.chosen-with-drop', function()
{
    var select = $(this).prev('select');
    if($(select).val() == 'ditto')
    {
        var index = $(select).closest('td').index();
        var row   = $(select).closest('tr').index();
        var table = $(select).closest('tr').parent();
        var value = '';
        for(i = row - 1; i >= 0; i--)
        {
            value = $(table).find('tr').eq(i).find('td').eq(index).find('select').val();
            if(value != 'ditto') break;
        }
        $(select).val(value);
        $(select).trigger("chosen:updated");
    }
})
$(document).on('mousedown', 'select', function()
{
    if($(this).val() == 'ditto')
    {
        var index = $(this).closest('td').index();
        var row   = $(this).closest('tr').index();
        var table = $(this).closest('tr').parent();
        var value = '';
        for(i = row - 1; i >= 0; i--)
        {
            value = $(table).find('tr').eq(i).find('td').eq(index).find('select').val();
            if(value != 'ditto') break;
        }
        $(this).val(value);
    }
})

$(document).keydown(function(event)
{
    if(event.ctrlKey && event.keyCode == 38)
    {
        event.stopPropagation();
        event.preventDefault();
        selectFocusJump('up');
    }
    else if(event.ctrlKey && event.keyCode == 40)
    {
        event.stopPropagation();
        event.preventDefault();
        selectFocusJump('down');
    }
    else if(event.keyCode == 38)
    {
        inputFocusJump('up');
    }
    else if(event.keyCode == 40)
    {
        inputFocusJump('down');
    }
});
