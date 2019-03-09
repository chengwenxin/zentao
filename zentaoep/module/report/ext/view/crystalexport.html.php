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
        parent.$.closeModal();
        $.cookie('downloading', null);
        clearInterval(time);
    }
}
</script>
<main id="main">
  <div class="container">
    <div id="mainContent" class='main-content load-indicator'>
      <div class='main-header'>
        <h2><?php echo $lang->export;?></h2>
      </div>
      <form method='post' target='hiddenwin' onsubmit='setDownloading();' style='margin: 10px -20px 0;'>
        <table class='table table-form' style='padding:30px'>
          <tr>
            <th class='w-80px'><?php echo $lang->setFileName;?></th>
            <td><?php echo html::input('fileName', $name, "class='form-control'");?></td>
            <td class='w-100px'>
              <?php
              unset($lang->exportFileTypeList['csv']);
              unset($lang->exportFileTypeList['xml']);
              echo html::select('fileType',   $lang->exportFileTypeList, '', 'class="form-control"');
              ?>
            </td>
            <td class='w-80px'><?php echo html::submitButton('', '', 'btn btn-primary btn-block');?></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</main>
<?php include '../../../common/view/footer.lite.html.php';?>
