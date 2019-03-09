<?php include '../../../common/view/header.html.php';?>
<div id='mainContent' class='main-row'>
  <div class='side-col col-lg'>
    <?php include '../../view/blockreportlist.html.php';?>
  </div>
  <div class='main-col'>
    <div class='cell'>
      <div class='with-padding'>
        <div class="table-row" id='conditions'>
          <div class='col-sm-4'>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->report->product;?></span>
              <?php echo html::select('product', $products, $productID, 'onchange="selectProduct(this.value);" class="form-control chosen"')?>
            </div>
          </div>
          <?php if($moduleID):?>
          <div class='col-sm-4'>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->report->module;?></span>
              <?php echo html::select('module' , $modules,  $moduleID,  'onchange="selectModule(this.value);"  class="form-control chosen"')?>
            </div>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
    <?php if(empty($stories)):?>
    <div class="cell">
      <div class="table-empty-tip">
        <p><span class="text-muted"><?php echo $lang->error->noData;?></span></p>
      </div>
    </div>
    <?php else:?>
    <div class='cell'>
      <div class='panel'>
        <div class="panel-heading">
          <div class="panel-title"><?php echo $title;?></div>
          <nav class="panel-actions btn-toolbar"></nav>
        </div>
        <div data-ride='table'>
          <table class='table table-condensed table-striped table-bordered table-fixed' id="stroyBugsList">
            <thead>
              <tr class='colhead'>
                <th class="w-250px"><?php echo $lang->report->bug->story;?></th>
                <th><?php echo $lang->report->bug->title;?></th>
                <th class="w-120px"><?php echo $lang->report->bug->status;?></th>
                <th class="w-120px"><?php echo $lang->report->bug->total;?></th>
              </tr>
            </thead>
            <?php if($stories):?>
            <tbody>
              <?php foreach($stories as $story):?>
              <?php if(!empty($story['bugList'])):?>
              <?php foreach($story['bugList'] as $key => $bug):?>
              <tr class="text-center">
                <?php if($story['total'] < 2 || ($story['total'] > 1 && !$key)):?>
                <td <?php if(!$key && $story['total'] > 1) echo 'rowspan="' . $story['total'] . '"';?>><?php echo $story['title'];?></td>
                <?php endif;?>

                <td><?php echo $bug->title;?></td>
                <td><?php echo $lang->bug->statusList[$bug->status];?></td>

                <?php if($story['total'] < 2 || ($story['total'] > 1 && !$key)):?>
                <td <?php if(!$key && $story['total'] > 1) echo 'rowspan="' . $story['total'] . '"';?>><?php echo $story['total'];?></td>
                <?php endif;?>
              </tr>
              <?php endforeach;?>
              <?php endif;?>
              <?php endforeach;?>
            </tbody>
            <?php endif;?>
          </table> 
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<script>
function selectProduct(productID)
{
    link = createLink('report', 'storylinkedbug', 'productID=' + productID);
    location.href=link;
}

function selectModule(moduleID)
{
    link = createLink('report', 'storylinkedbug', 'productID=<?php echo $productID;?>&moduleID=' + moduleID);
    location.href=link;
}
</script>
<?php include '../../../common/view/footer.html.php';?>
