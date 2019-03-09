<?php include '../../common/view/header.lite.html.php';?>
<main id="main">
  <div class="container">
    <div id='mainContent' class='main-content'>
      <div class='main-header'>
        <h2><?php echo $lang->misc->zentao->labels['about'];?></h2>
      </div>
      <table class='table table-form'>
        <tr>
          <td class='text-center w-160px'>
            <img src='<?php echo $config->webRoot . 'theme/default/images/main/zt-logo.png';?>' />
            <h4><?php printf($lang->misc->zentao->version, $config->version);?></h4>
          </td>
          <td><?php include './links.html.php';?></td>
        </tr>
        <tr>
          <td colspan='2' class="copyright text-right text-middle">
            <div class='pull-left'><?php echo $lang->designedByAIUX;?></div>
            <?php echo $lang->misc->copyright;?>
          </td>
        </tr>
      </table>
    </div>
  </div>
</main>
<?php include '../../common/view/footer.lite.html.php';?>
