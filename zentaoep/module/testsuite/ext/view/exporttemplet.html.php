<?php include '../../../common/view/header.lite.html.php';?>
<script>
function setDownloading()
{
    if($.browser.opera) return true;   // Opera don't support, omit it.

    $.cookie('downloading', 0);
    time = setInterval("closeWindow()", 300);
    return true;
}

function closeWindow()
{
    if($.cookie('downloading') == 1)
    {
        parent.$.closeModal(null, 'this');
        $.cookie('downloading', null);
        clearInterval(time);
    }
}
</script>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->testsuite->exportTemplet;?></h2>
  </div>
  <form method='post' target='hiddenwin' onsubmit='setDownloading();' style='padding: 20px 5%'>
  <table class='table table-form'>
    <tr>
      <th class='w-120px'><?php echo $lang->testcase->num;?></th>
      <td><?php echo html::input('num', '10', "class='form-control'");?></td>
      <td class='w-100px'><?php echo html::select('fileType', array('xlsx' => 'xlsx', 'xls' => 'xls'), 'xlsx', "class='form-control'");?>
      <td><?php echo html::submitButton('', '', 'btn btn-primary');?></td>
    </tr>
  </table>
  </form>
</div>
<?php include '../../../common/view/footer.lite.html.php';?>
