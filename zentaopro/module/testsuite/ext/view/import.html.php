<?php include '../../../common/view/header.lite.html.php';?>
<main id="main">
  <div class="container">
    <div id='mainContent' class='main-content'>
      <div class='main-header'>
        <h2><?php echo $lang->testsuite->import;?></h2>
      </div>
      <form enctype='multipart/form-data' method='post' target='hiddenwin' style='padding: 20px 5%'>
        <table class='table table-form'>
          <tr>
            <td class='w-p70'><input type='file' name='file' class='form-control'/></td>
            <td><?php echo html::submitButton('', '', 'btn btn-primary');?></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</main>
<?php include '../../../common/view/footer.lite.html.php';?>
