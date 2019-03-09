<div class='panel'>
  <div class='panel-heading'>
    <div class='panel-title'><?php echo $lang->crystal->result?></div>
    <?php if(common::hasPriv('report', 'crystalExport') and !empty($dataList)):?>
    <div class='panel-actions btn-toolbar'><?php echo html::a(inlink('crystalExport', "step=$step&reportID=$reportID"), $lang->export, '', "class='export btn btn-sm'")?></div>
    <?php endif;?>
  </div>
  <?php if($step == 2 and $reportData):?>
  <?php include('reportdata.html.php');?>
  <?php else:?>
  <div class='panel-body scroll-table'>
    <table class='table table-condensed table-striped table-bordered table-fixed'>
      <tr>
        <?php foreach($fields as $field):?>
        <th><nobr><?php echo $field;?></nobr></th>
        <?php endforeach;?>
      </tr>
      <?php $i = 1;?>
      <?php foreach($dataList as $data):?>
      <tr>
        <?php foreach($data as $field => $value):?>
        <td><?php echo $value?></td>
        <?php endforeach;?>
      </tr>
      <?php $i++;?>
      <?php if($i >= 11) break;?>
      <?php endforeach;?>
    </table>
  </div>
  <div class='panel-footer'><?php printf($lang->crystal->noticeResult, count($dataList), $i >= 11 ? 10 : count($dataList))?></div>
  <?php endif;?>
</div>
