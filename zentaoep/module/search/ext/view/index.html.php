<?php include '../../../common/view/header.html.php';?>
<div class='row'>
  <div class='col-md-12'>
    <form method='post' action='<?php echo inlink('index')?>' style='margin-bottom:10px;'>
      <div class='input-group col-md-8 col-md-offset-2'>
        <span class='input-group-btn w-auto'><?php echo html::input('words', $words, "class='form-control'")?></span>
        <span class='input-group-btn select'><?php echo html::select('type[]', $lang->search->modules, $type, "class='form-control chosen' multiple")?></span>
        <span class='input-group-btn'><?php echo html::submitButton($lang->search->common, '', 'btn btn-primary')?></span>
        <span class="input-group-btn goback"><?php echo html::linkButton($lang->goback, $referer);?></span>
      </div>
    </form>
    <div class='list list-condensed'>
      <header>
        <h2><?php echo $lang->search->result;?></h2>
      </header>
      <section class='items items-hover'>
        <?php foreach($results as $object):?>
        <div class='item'>
          <div class='item-heading'>
            <div class="pull-right">
              <span><?php echo html::a($object->url . (strpos($object->url, '?') !== false ? '&onlybody=yes' : '?onlybody=yes'), "<i class='icon-eye-open'></i>" . $lang->search->preview, '', "class='iframe' data-width='90%' data-title=\"<a href='$object->url' target='_blank' class='btn'><i class='icon-eye-open'></i>$lang->preview</a>\"")?></span>
            </div>
            <h4>
              <?php
              $objectType = $object->objectType == 'case' ? 'testcase' : $object->objectType;
              echo html::a($object->url, $object->title, '', 'title="' . strip_tags($object->title) . '"');
              echo "<small class=''>[{$lang->searchObjects[$objectType]} #{$object->objectID}]</small> ";
              ?>
            </h4>
          </div>
          <div class='item-content'>
            <div class='text text-muted'><?php echo $object->summary;?></div>
          </div>
        </div>
        <?php endforeach;?>
      </section>
      <footer class='table-footer'>
        <?php echo str_replace($words, urlencode($words), $pager->get('right', 'short'));?>
        <span class='execute-info text-muted'><?php printf($lang->search->executeInfo, $pager->recTotal, $consumed);?></span> 
      </footer>
    </div>
  </div>
</div>
<script>
$(function()
{
    $('#searchbox #searchInput').val(<?php echo json_encode($words)?>);
})
</script>
<?php include '../../../common/view/footer.html.php';?>
