<?php include '../../../common/view/header.html.php';?>
<div id='mainContent' class='main-row'>
  <div class='side-col col-lg'>
    <?php include '../../view/blockreportlist.html.php';?>
  </div>
  <div class='main-col'>
    <?php if(empty($products)):?>
    <div class="cell">
      <div class="table-empty-tip">
        <p><span class="text-muted"><?php echo $lang->error->noData;?></span></p>
      </div>
    </div>
    <?php else:?>
    <div class='cell'>
      <div class='panel'>
        <div class="panel-heading">
          <div class="panel-title">
            <div class="table-row" id='conditions'>
              <div class="col-xs"><?php echo $title;?></div>
              <div class="col-xs text-right side-col text-gray"><?php echo $lang->report->conditions?></div>
              <div class='col'>
                <div class="checkbox-primary inline-block">
                  <input type="checkbox" name="closedProduct" value="closedProduct" id="closedProduct" <?php if(strpos($conditions, 'closedProduct') !== false) echo "checked='checked'"?> />
                  <label for="closedProduct"><?php echo $lang->report->closedProduct?></label>
                </div>
              </div>
            </div>
          </div>
          <nav class="panel-actions btn-toolbar"></nav>
        </div>
        <div class='roadmap-wrap' data-ride='table'>
          <table id="roadmap" class='table table-condensed table-striped table-bordered table-fixed active-disabled'>
            <thead>
              <tr class='colhead'>
                <th class="w-200px"><?php echo $lang->report->product;?></th>
                <th><?php echo $lang->report->plan;?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products as $productID => $product):?>
              <tr class="text-center">
                <td title="<?php echo $product?>"><?php echo $product?></td>
                <td>
                  <?php if(!empty($plans[$productID])):?>
                  <?php foreach($plans[$productID] as $plan):?>
                  <div class='plan'>
                    <div><?php echo $plan->title?></div>
                    <div><?php echo $plan->begin . ' ~ ' . $plan->end?></div>
                  </div>
                  <?php endforeach;?>
                  <?php endif;?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table> 
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<?php include '../../../common/view/footer.html.php';?>
