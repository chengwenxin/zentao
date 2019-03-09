<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div id='mainContent' class='main-content'>
  <div class='main-header'>
    <h2><?php echo $lang->host->reason;?></h2>
  </div>
  <form method='post' target='hiddenwin'>
    <table class='table table-form' id='tabReason'>
      <tr>
        <td class='required'><?php echo html::textarea('reason', '', "class='form-control'");?></td>
      <tr>
      <tr>
        <td class='text-center form-actions'>
          <?php echo html::submitButton();?>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
