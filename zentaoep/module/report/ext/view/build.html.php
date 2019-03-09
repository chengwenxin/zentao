<?php include '../../../common/view/header.html.php';?>
<div id='mainContent' class='main-row'>
  <div class='side-col col-lg'>
    <?php include '../../view/blockreportlist.html.php';?>
  </div>
  <div class='main-col'>
    <div class='cell'>
      <div class='with-padding'>
        <div class="table-row" id='conditions'>
          <div class='input-group w-200px'>
            <?php echo html::select('product', $products, $productID, 'onchange="selectProduct(this.value);" class="form-control chosen"')?>
          </div>
        </div>
      </div>
    </div>
    <?php if(empty($bugs)):?>
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
          <table class='table table-condensed table-striped table-bordered table-fixed' id="buildList">
            <thead>
              <?php ksort($lang->bug->severityList);?>
              <?php unset($lang->bug->typeList[''])?>
              <?php unset($lang->bug->typeList['designchange'])?>
              <?php unset($lang->bug->typeList['newfeature'])?>
              <?php unset($lang->bug->typeList['trackthings'])?>
              <tr class='colhead'>
                <th width="100" rowspan="2"><?php echo $lang->report->project;?></th>
                <th width="150" rowspan="2"><?php echo $lang->report->buildTitle;?></th>
                <th width="100" colspan="<?php echo  count($lang->bug->severityList)?>"><?php echo $lang->report->severity;?></th>
                <th colspan="<?php echo count($lang->bug->typeList);?>"><?php echo $lang->report->bugType;?></th>
                <th width="150" colspan="3"><?php echo $lang->report->bugStatus;?></th>
              </tr>
              <tr class="text-center colhead">
                <?php foreach($lang->bug->severityList as $key => $severity):?>
                <td class='text-ellipsis' title='<?php echo $severity;?>'><?php $allTotal[$key] = 0; echo $severity;?></td>
                <?php endforeach;?>
                <?php foreach($lang->bug->typeList as $bugTypeKey => $bugType): ?>
                <td class='text-ellipsis' title='<?php echo $bugType;?>'><?php $allTotal[$bugTypeKey] = 0; echo $bugType?></td>
                <?php endforeach; ?> 
                <td><?php echo $lang->bug->statusList['active'];?></td>
                <td><?php echo $lang->bug->statusList['resolved'];?></td>
                <td><?php echo $lang->bug->statusList['closed'];?></td>
              </tr>
            </thead>
            <?php if($bugs):?>
            <?php $allTotal['active'] = $allTotal['resolved'] = $allTotal['closed'] = 0;?>
            <tbody>
              <?php foreach($bugs as $key =>$projectBuilds):?>
              <tr class="text-center">
                <?php $count = count($projectBuilds);?>
                <td align="left" rowspan="<?php echo $count;?>" title="<?php echo $projects[$key];?>"><?php echo $projects[$key];?></td>
                <?php foreach($projectBuilds as $buildId => $build):?>
                <td align="left" title="<?php echo isset($builds[$buildId]) ? $builds[$buildId] : '';?>"><?php echo isset($builds[$buildId]) ?  $builds[$buildId] : '';?></td>
                <?php foreach($lang->bug->severityList as $severity => $val):?>
                <td><?php $count = isset($build['severity'][$severity]) ? $build['severity'][$severity] : 0; $allTotal[$severity]  += $count; echo $count;?></td>
                <?php endforeach;?>
                <?php foreach($lang->bug->typeList as $bugTypeKey => $bugTypeVal):?>
                <td><?php $count = isset($build['type'][$bugTypeKey])   ? $build['type'][$bugTypeKey]   : 0; $allTotal[$bugTypeKey]  += $count; echo $count;?></td>
                <?php endforeach;?>
                <td><?php $count = isset($build['status']['active'])    ? $build['status']['active']    : 0; $allTotal['active'] += $count; echo $count;?></td>
                <td><?php $count = isset($build['status']['resolved'])  ? $build['status']['resolved']  : 0; $allTotal['resolved'] += $count; echo $count;?></td>
                <td><?php $count = isset($build['status']['closed'])    ? $build['status']['closed']    : 0; $allTotal['closed'] += $count; echo $count;?></td>
              </tr>
              <?php 
              if($count != 1) echo '<tr class="text-center">';
              $count --;
              ?>
              <?php endforeach;?>
              <?php endforeach;?>
              <tr class="text-center">
                <td colspan='2' class='text-right'><?php echo $lang->report->total;?></td>
                <?php foreach($allTotal as $count):?>
                <td><?php echo $count; ?></td>
                <?php endforeach;?>
              </tr>
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
    link = createLink('report', 'build', 'productID=' + productID);
    location.href=link;
}
</script>
<?php include '../../../common/view/footer.html.php';?>
